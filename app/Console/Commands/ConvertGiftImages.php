<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ConvertGiftImages extends Command
{
    protected $signature = 'gifts:convert-images';
    protected $description = 'Convert single image strings to JSON arrays for gifts';

    public function handle()
    {
        $this->info('Converting gift images to JSON format...');
        
        $gifts = DB::table('gifts')->get();
        $converted = 0;
        
        foreach ($gifts as $gift) {
            if ($gift->image && !is_null($gift->image)) {
                // Try to decode as JSON
                $decoded = json_decode($gift->image, true);
                
                // If not valid JSON, convert single string to JSON array
                if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                    DB::table('gifts')
                        ->where('id', $gift->id)
                        ->update(['image' => json_encode([$gift->image])]);
                    $converted++;
                }
            }
        }
        
        $this->info("Conversion complete! Converted {$converted} gift(s).");
        return 0;
    }
}

