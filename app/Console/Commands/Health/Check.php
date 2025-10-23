<?php

namespace App\Console\Commands\Health;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemHealthAlert;

class Check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the health of the application';

    // app/Console/Commands/Health/Check.php
    public function handle()
    {
        $issues = [];

        // Check database connection
        try {
            $this->test();
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $issues[] = 'Database connection failed: ' . $e->getMessage();
        }

        // Check queue system
        $pendingJobs = DB::table('jobs')->count();
        if ($pendingJobs > 100) {
            $issues[] = "High number of pending jobs: {$pendingJobs}";
        }

        // Check disk space
        $freeSpace = disk_free_space('/');
        $totalSpace = disk_total_space('/');
        $freePercent = ($freeSpace / $totalSpace) * 100;
        if ($freePercent < 10) {
            $issues[] = "Low disk space: {$freePercent}% free";
        }

        if (!empty($issues)) {
            Mail::to('admin@example.com')->send(new SystemHealthAlert($issues));
            $this->error('Health check found issues: ' . count($issues));
        } else {
            $this->info('Health check passed');
        }
    }
}
