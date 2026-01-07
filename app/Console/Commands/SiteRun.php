<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SiteRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open the site and allow normal access';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Remove the closed status file
            if (Storage::exists('site-closed.txt')) {
                Storage::delete('site-closed.txt');
                $this->info('✅ Site is now OPEN and accessible to all users!');
            } else {
                $this->info('✅ Site is already OPEN and accessible to all users!');
            }
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
