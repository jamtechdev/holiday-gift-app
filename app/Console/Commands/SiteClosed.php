<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SiteClosed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:closed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close the site and show closed message to all visitors';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Create the closed status file
            Storage::put('site-closed.txt', date('Y-m-d H:i:s'));
            $this->info('✅ Site is now CLOSED. All visitors will see the closed message.');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
