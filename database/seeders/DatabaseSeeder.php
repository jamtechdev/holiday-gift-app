<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedAdmin();
        $this->seedTestUser();
        $this->seedDemoUser();
    }

    protected function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@holiday.test'],
            [
                'name' => 'Holiday Admin',
                'first_name' => 'Holiday',
                'last_name' => 'Admin',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'street_address' => '123 Admin Street',
                'apt_suite_unit' => 'Suite 100',
                'city' => 'New York',
                'state' => 'NY',
                'zip' => '10001',
            ],
        );
    }

    protected function seedTestUser(): void
    {
        User::updateOrCreate(
            ['email' => 'user@holiday.test'],
            [
                'name' => 'Journey Tester',
                'first_name' => 'Journey',
                'last_name' => 'Tester',
                'password' => Hash::make('Password123!'),
                'role' => 'user',
                'email_verified_at' => now(),
                'street_address' => '456 Test Avenue',
                'apt_suite_unit' => 'Apt 5B',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'zip' => '90001',
            ],
        );
    }

    protected function seedDemoUser(): void
    {
        // Create demo user with email that can be accessed via "Graphtech" username
        User::updateOrCreate(
            ['email' => 'graphtech@thinkgraphtech.com'],
            [
                'name' => 'Graphtech',
                'first_name' => 'Graphtech',
                'last_name' => 'Demo',
                'password' => Hash::make('Holiday'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        );
    }
}
