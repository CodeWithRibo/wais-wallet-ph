<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            ExpenseSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User1 ',
            'email' => 'test1@example.com',
            'password' => 'test12345',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => 'test12345',
        ]);

        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test3@example.com',
            'password' => 'test12345',
        ]);

        User::factory()->create([
            'name' => 'Admin User 1',
            'email' => 'admin1@example.com',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Admin User 2',
            'email' => 'admin2@example.com',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);
    }
}
