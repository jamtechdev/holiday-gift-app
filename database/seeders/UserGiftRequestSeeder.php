<?php

namespace Database\Seeders;

use App\Models\UserGiftRequest;
use App\Models\Category;
use Illuminate\Database\Seeder;

class UserGiftRequestSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            return;
        }

        $requests = [
            [
                'category_id' => $categories->random()->id,
                'name' => 'Mike Mikyska',
                'street_address' => '1993 Yellowfin Circle',
                'city' => 'Naples',
                'state' => 'FL',
                'zip' => '06710',
                'telephone' => '9145238753',
                'email' => 'mike.mikyska@graphtech.com',
                'company' => 'Graphtech',
                'status' => 'pending',
            ],
            [
                'category_id' => $categories->random()->id,
                'name' => 'Sarah Johnson',
                'street_address' => '456 Oak Street',
                'city' => 'Miami',
                'state' => 'FL',
                'zip' => '33101',
                'telephone' => '3051234567',
                'email' => 'sarah.johnson@example.com',
                'company' => 'Tech Solutions',
                'status' => 'approved',
            ],
            [
                'category_id' => $categories->random()->id,
                'name' => 'David Smith',
                'street_address' => '789 Pine Avenue',
                'city' => 'Orlando',
                'state' => 'FL',
                'zip' => '32801',
                'telephone' => '4079876543',
                'email' => 'david.smith@company.com',
                'company' => null,
                'status' => 'shipped',
            ],
            [
                'category_id' => $categories->random()->id,
                'name' => 'Lisa Brown',
                'street_address' => '321 Maple Drive',
                'city' => 'Tampa',
                'state' => 'FL',
                'zip' => '33602',
                'telephone' => '8135551234',
                'email' => 'lisa.brown@email.com',
                'company' => 'Creative Agency',
                'status' => 'delivered',
            ],
        ];

        foreach ($requests as $request) {
            UserGiftRequest::create($request);
        }
    }
}