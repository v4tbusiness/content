<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '<p>This is the privacy policy page content.</p>',
        ]);

        Page::create([
            'title' => 'Terms of Service',
            'slug' => 'terms-of-service',
            'content' => '<p>This is the terms of service page content.</p>',
        ]);
    }
}
