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
        $this->call(UserGiftRequestSeeder::class);
    }

    protected function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@holiday.test'],
            [
                'name' => 'Holiday Admin',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
        );
    }

    protected function seedTestUser(): void
    {
        User::updateOrCreate(
            ['email' => 'user@holiday.test'],
            [
                'name' => 'Journey Tester',
                'password' => Hash::make('Password123!'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        );
    }
}
