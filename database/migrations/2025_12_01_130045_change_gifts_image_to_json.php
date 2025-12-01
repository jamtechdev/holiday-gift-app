<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change the column type first to avoid truncation errors
        $driver = DB::getDriverName();
        
        if ($driver === 'mysql') {
            // Use raw SQL for MySQL - change to LONGTEXT first
            DB::statement('ALTER TABLE `gifts` MODIFY `image` LONGTEXT NULL');
        } else {
            // For SQLite and other databases
            Schema::table('gifts', function (Blueprint $table) {
                $table->text('image')->nullable()->change();
            });
        }

        // Then migrate existing data - convert single image strings to JSON arrays
        $gifts = DB::table('gifts')->get();
        foreach ($gifts as $gift) {
            if ($gift->image && !is_null($gift->image) && !empty($gift->image)) {
                // Check if already JSON, if not convert
                $decoded = json_decode($gift->image, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Not JSON, convert single image string to JSON array
                    DB::table('gifts')
                        ->where('id', $gift->id)
                        ->update(['image' => json_encode([$gift->image])]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert JSON arrays back to single strings (take first image)
        $gifts = DB::table('gifts')->get();
        foreach ($gifts as $gift) {
            if ($gift->image && !is_null($gift->image)) {
                $images = json_decode($gift->image, true);
                if (is_array($images) && count($images) > 0) {
                    // Take the first image
                    DB::table('gifts')
                        ->where('id', $gift->id)
                        ->update(['image' => $images[0]]);
                }
            }
        }

        // Change the column type back to string
        Schema::table('gifts', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};
