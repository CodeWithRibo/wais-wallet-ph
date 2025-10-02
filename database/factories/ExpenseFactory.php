<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        $categories = [
            'Transportation',
            'Healthcare',
            'Food & Dining',
            'Entertainment',
            'Shopping',
            'Utilities',
            'Education',
            'Insurance',
            'Groceries',
            'Travel',
            'Personal Care',
            'Home & Garden',
            'Electronics',
            'Charity',
            'Miscellaneous'
        ];

        $walletTypes = [
            'creditcard',
            'debitcard',
            'personal',
            'shared'
        ];

        $paymentMethods = [
            'Gcash',
            'Maya',
            'Cash'
        ];

        $notes = [
            'Monthly subscription payment',
            'Emergency expense',
            'Regular monthly expense',
            'One-time purchase',
            'Unexpected cost',
            'Planned expense',
            'Family expense',
            'Business related',
            'Medical emergency',
            'Routine maintenance',
            'Special occasion',
            'Investment purchase',
            'Gift for someone',
            'Vacation expense',
            'Home improvement'
        ];

        return [
            'amount' => $this->faker->randomFloat(2, 10, 5000),
            'category' => $this->faker->randomElement($categories),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'notes' => $this->faker->randomElement($notes),
            'wallet_type' => $this->faker->randomElement($walletTypes),
            'created_at' => $this->faker->dateTimeBetween('-30 minutes', '-1 minute'),
        ];
    }
}
