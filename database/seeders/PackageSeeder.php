<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $packages = [
            ['name' => 'Free', 'slug' => 'free', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ex, recusandae provident molestiae ea dolores? Quibusdam a vel, omnis tenetur laborum iure ipsam consequatur dolor. Perferendis velit animi quo saepe.', 'cover' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg', 'price' => 0],
            ['name' => 'Package 1', 'slug' => 'package-1', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ex, recusandae provident molestiae ea dolores? Quibusdam a vel, omnis tenetur laborum iure ipsam consequatur dolor. Perferendis velit animi quo saepe.', 'cover' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg', 'price' => 100],
            ['name' => 'Package 2', 'slug' => 'package-2', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ex, recusandae provident molestiae ea dolores? Quibusdam a vel, omnis tenetur laborum iure ipsam consequatur dolor. Perferendis velit animi quo saepe.', 'cover' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg', 'price' => 200],
            ['name' => 'Package 3', 'slug' => 'package-3', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ex, recusandae provident molestiae ea dolores? Quibusdam a vel, omnis tenetur laborum iure ipsam consequatur dolor. Perferendis velit animi quo saepe.', 'cover' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg', 'price' => 300],
            ['name' => 'Package 4', 'slug' => 'package-4', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime ex, recusandae provident molestiae ea dolores? Quibusdam a vel, omnis tenetur laborum iure ipsam consequatur dolor. Perferendis velit animi quo saepe.', 'cover' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg', 'price' => 400],
        ];

        foreach ($packages as $package) {
            Package::create([
                'name' => $package['name'],
                'slug' => $package['slug'],
                'description' => $package['description'],
                'cover' => $package['cover'],
                'price' => $package['price'],
            ]);
        }
    }
}
