<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Report;
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

        User::factory()->create([
            'name' => 'Ricardo Miller',
            'email' => 'ricardomiller102003@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Sale::factory(10)->create([
            'TransactionID' => 1,
            'UserID' => 1,
            'ProductID' => 1,
            'Quantity' => 2,
            'TotalPrice' => 30.00,
        ]);
        Transaction::factory(10)->create([
            'UserID' => 1,
            'Quantity' => 2,
            'TotalPrice' => 30.00,
            'PaymentMethod' => 'Credit Card',
            'TransactionStatus' => 'Completed',
        ]);
    }
}
