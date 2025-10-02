<?php

namespace Database\Seeders;

use App\Models\Expense;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::factory()->count(31)->create();
    }
}
