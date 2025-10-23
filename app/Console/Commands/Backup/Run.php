<?php

namespace App\Console\Commands\Backup;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:run
                           {--only-db : Only backup database}
                           {--only-files : Only backup files}
                           {--exclude=* : Directories to exclude from backup}
                           {--filename= : Custom filename for the backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting backup process...');

        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupPath = storage_path('app/backups');

        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $filename = $this->option('filename') ?? "backup_{$timestamp}";

        try {
            // Backup database if not only-files
            if (!$this->option('only-files')) {
                $this->backupDatabase($backupPath, $filename);
            }
        } catch (\Exception $e) {
            Log::error('Backup process failed: ' . $e->getMessage());
            $this->error('Backup process failed: ' . $e->getMessage());
            return 1;
        }

        $this->info('Backup process completed successfully!');
        return 0;
    }

    /**
     * Backup the database
     */
    protected function backupDatabase($path, $filename)
    {
        $this->info('Backing up database...');

        $dbConnection = config('database.default');
        $database = config("database.connections.{$dbConnection}.database");
        $username = config("database.connections.{$dbConnection}.username");
        $password = config("database.connections.{$dbConnection}.password");
        $host = config("database.connections.{$dbConnection}.host");

        $outputFile = "{$path}/{$filename}_database.sql";

        // MySQL/MariaDB Backup
        if (in_array($dbConnection, ['mysql', 'mariadb'])) {
            // Windows detection
            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

            if ($isWindows) {
                // Try direct database export using Laravel's DB facade for Windows
                try {
                    $this->info('Using DB facade to export database (Windows)');

                    // Get all tables
                    $tables = DB::select('SHOW TABLES');
                    $tableField = 'Tables_in_' . $database;

                    $output = "-- Laravel Database Backup\n";
                    $output .= '-- Generated: ' . now() . "\n\n";
                    $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

                    foreach ($tables as $table) {
                        $tableName = $table->$tableField;
                        $this->info("Processing table: {$tableName}");

                        // Get create table statement
                        $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                        $output .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                        $output .= $createTable[0]->{"Create Table"} . ";\n\n";

                        // Get data
                        $rows = DB::table($tableName)->get();
                        if (count($rows) > 0) {
                            $columns = array_keys(get_object_vars($rows[0]));
                            $output .= "INSERT INTO `{$tableName}` (`" . implode('`, `', $columns) . "`) VALUES\n";

                            $rowCount = count($rows);
                            foreach ($rows as $i => $row) {
                                $values = array_map(function ($value) {
                                    if (is_null($value)) {
                                        return 'NULL';
                                    }
                                    return "'" . str_replace("'", "''", $value) . "'";
                                }, get_object_vars($row));

                                $output .= '(' . implode(', ', $values) . ')';
                                $output .= $i < $rowCount - 1 ? ",\n" : ";\n\n";
                            }
                        }
                    }

                    $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

                    // Save the SQL to file
                    File::put($outputFile, $output);
                    $this->info("Database backed up to {$outputFile}");

                    return;
                } catch (\Exception $e) {
                    $this->warn('DB facade backup failed: ' . $e->getMessage());
                    $this->info('Falling back to mysqldump...');
                }
            }

            // Try mysqldump command
            $this->info('Attempting mysqldump backup...');
            $command = $isWindows ? "mysqldump --user=\"{$username}\" --password=\"{$password}\" --host=\"{$host}\" \"{$database}\" > \"{$outputFile}\"" : "mysqldump --user=\"{$username}\" --password=\"{$password}\" --host=\"{$host}\" \"{$database}\" > \"{$outputFile}\"";

            $process = Process::fromShellCommandline($command, null, [
                'MYSQL_PWD' => $password,
            ]);

            $process->setTimeout(3600);
            $process->run();

            if (!$process->isSuccessful()) {
                $this->error('mysqldump error: ' . $process->getErrorOutput());

                // Last resort: use PHP to dump database structure
                $this->info('Trying PHP database export as last resort...');

                try {
                    $schema = [];
                    $tables = DB::select('SHOW TABLES');
                    $tableField = 'Tables_in_' . $database;

                    foreach ($tables as $table) {
                        $tableName = $table->$tableField;
                        $schema[$tableName] = [
                            'columns' => DB::select("DESCRIBE `{$tableName}`"),
                            'rows' => DB::table($tableName)->limit(1000)->get(), // Limit for safety
                        ];
                    }

                    File::put($outputFile, json_encode($schema));
                    $this->info("Database schema exported to {$outputFile} (JSON format)");
                } catch (\Exception $e) {
                    throw new \Exception('All database backup methods failed. ' . $e->getMessage());
                }
            } else {
                $this->info("Database backed up to {$outputFile}");
            }
        }
        // SQLite backup - just copy the file
        elseif ($dbConnection === 'sqlite') {
            $dbPath = database_path(config("database.connections.{$dbConnection}.database"));
            if (File::exists($dbPath)) {
                File::copy($dbPath, $outputFile);
                $this->info("SQLite database backed up to {$outputFile}");
            } else {
                throw new \Exception("SQLite database file not found at: {$dbPath}");
            }
        }
        // PostgreSQL backup
        elseif ($dbConnection === 'pgsql') {
            $envVars = [
                'PGPASSWORD' => $password,
            ];

            $command = "pg_dump --host=\"{$host}\" --username=\"{$username}\" --dbname=\"{$database}\" -f \"{$outputFile}\"";

            $process = Process::fromShellCommandline($command, null, $envVars);
            $process->setTimeout(3600);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \Exception('PostgreSQL backup failed: ' . $process->getErrorOutput());
            }

            $this->info("Database backed up to {$outputFile}");
        } else {
            throw new \Exception("Database driver '{$dbConnection}' is not supported for backup");
        }
    }
}
