<?php

namespace App\Console\Commands;

use App\Mail\LowStockAlert;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendLowStockAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-low-stock-alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email alerts for low stock products';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $productService)
    {
        $this->info('Checking for low stock products...');
        
        // Get low stock products
        $lowStockProducts = $productService->getLowStockProducts();
        
        if ($lowStockProducts->isEmpty()) {
            $this->info('No low stock products found.');
            return Command::SUCCESS;
        }
        
        $this->info("Found {$lowStockProducts->count()} low stock products.");
        
        // Get admin users
        $admins = User::role('admin')->get();
        
        if ($admins->isEmpty()) {
            $this->warn('No admin users found to send notifications to.');
            Log::warning('Low stock alert: No admin users found to send notifications to.');
            return Command::SUCCESS;
        }
        
        $this->info("Sending email alerts to {$admins->count()} admin users...");
        
        // Send email to each admin
        foreach ($admins as $admin) {
            try {
                Mail::to($admin->email)->send(new LowStockAlert($lowStockProducts));
                $this->info("Email sent to: {$admin->email}");
            } catch (\Exception $e) {
                $this->error("Failed to send email to {$admin->email}: {$e->getMessage()}");
                Log::error("Low stock alert: Failed to send email to {$admin->email}: {$e->getMessage()}");
            }
        }
        
        $this->info('Low stock email alerts completed.');
        return Command::SUCCESS;
    }
}
