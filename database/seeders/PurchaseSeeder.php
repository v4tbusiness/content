<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $packages = Package::all();

        foreach ($users as $user) {
            Purchase::create([
                'user_id' => $user->id,
                'package_id' => $packages->random()->id,
            ]);
        }
    }
}
