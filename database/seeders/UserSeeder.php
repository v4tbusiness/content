<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin123',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'telegram' => 'admin_telegram',
            'whatsapp' => '6281234567890',
            'coins' => 0,
            'access_level' => 'admin',
        ]);

        // for ($i = 1; $i <= 10; $i++) {
        //     User::create([
        //         'name' => "User $i",
        //         'username' => "user$i",
        //         'email' => "user$i@example.com",
        //         'password' => Hash::make('password'),
        //         'telegram' => "user$i",
        //         'whatsapp' => "62812345678$i",
        //         'coins' => rand(0, 500),
        //         'access_level' => 'user',
        //     ]);
        // }
    }
}
