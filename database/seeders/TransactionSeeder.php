<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $payments = Payment::all();

        for ($i = 0; $i < 10; $i++) {
            Transaction::create([
                'user_id' => $users->random()->id,
                'amount' => rand(1, 1000),
                'price' => rand(1000, 1000000),
                'payment_id' => $payments->random()->id,
                'proof' => 'proof_' . ($i + 1) . '.jpg',
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
            ]);
        }
    }
}
