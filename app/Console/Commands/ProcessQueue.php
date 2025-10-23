<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ProcessQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:process {--tries=3} {--timeout=60} {--sleep=3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process the queue until it is empty';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting queue processing...');

        $tries = $this->option('tries');
        $timeout = $this->option('timeout');
        $sleep = $this->option('sleep');

        try {
            // Process the queue until empty
            $this->info('Processing jobs...');

            $exitCode = Artisan::call('queue:work', [
                '--stop-when-empty' => true,
                '--tries' => $tries,
                '--timeout' => $timeout,
                '--sleep' => $sleep,
            ]);

            if ($exitCode === 0) {
                $this->info('Queue processed successfully.');
                Log::info('Queue processed successfully.');
            } else {
                $this->error('Queue processing failed with exit code: ' . $exitCode);
                Log::error('Queue processing failed with exit code: ' . $exitCode);
            }

            // Check for failed jobs using the database instead of the command
            try {
                $failedCount = \DB::table('failed_jobs')->count();
                if ($failedCount > 0) {
                    $this->warn("There are {$failedCount} failed jobs in the queue.");
                    Log::warning("There are {$failedCount} failed jobs in the queue.");
                }
            } catch (\Exception $e) {
                $this->warn('Could not check for failed jobs: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            $this->error('Error processing queue: ' . $e->getMessage());
            Log::error('Error processing queue: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
