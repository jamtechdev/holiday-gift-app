<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_gift_requests', function (Blueprint $table) {
            $table->string('lastname')->nullable()->after('name');
            $table->string('street_address2')->nullable()->after('street_address');
            $table->string('country')->nullable()->after('zip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gift_requests', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'street_address2', 'country']);
        });
    }
};
