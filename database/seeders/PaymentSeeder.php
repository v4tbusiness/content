<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'payment_method' => 'QR Code',
            'instructions' => '<p>Scan QR Code ini menggunakan aplikasi e-wallet untuk melakukan pembayaran.</p>',
            'minimum_transaction' => 1,
        ]);

        Payment::create([
            'payment_method' => 'Bank Transfer',
            'instructions' => '<p>Silakan transfer ke rekening berikut: BCA 123456789 a/n PT. Contoh</p>',
            'minimum_transaction' => 2,
        ]);

        Payment::create([
            'payment_method' => 'PayPal',
            'instructions' => '<p>Gunakan akun PayPal Anda dan kirim pembayaran ke email: payment@example.com</p>',
            'minimum_transaction' => 3,
        ]);
    }
}
