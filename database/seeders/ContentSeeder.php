<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();

        $contents = [
            ['title' => 'Content 1', 'slug' => 'content-1', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/laravel_intro.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg', 'is_premium' => 1],
            ['title' => 'Content 2', 'slug' => 'content-2', 'content_type' => 'video', 'source_type' => 'url', 'source' => 'https://cdn.example.com/vuejs-beginner.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg', 'is_premium' => 1],
            ['title' => 'Content 3', 'slug' => 'content-3', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/php_advanced.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg', 'is_premium' => 1],
            ['title' => 'Content 4', 'slug' => 'content-4', 'content_type' => 'video', 'source_type' => 'url', 'source' => 'https://cdn.example.com/react-master.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg', 'is_premium' => 1],
            ['title' => 'Content 5', 'slug' => 'content-5', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/js_essentials.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg', 'is_premium' => 1],
            ['title' => 'Content 6', 'slug' => 'content-6', 'content_type' => 'video', 'source_type' => 'url', 'source' => 'https://cdn.example.com/python-ds.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg', 'is_premium' => 1],
            ['title' => 'Content 7', 'slug' => 'content-7', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg', 'is_premium' => 1],
            ['title' => 'Content 8', 'slug' => 'content-8', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg', 'is_premium' => 1],
            ['title' => 'Content 9', 'slug' => 'content-9', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg', 'is_premium' => 1],
            ['title' => 'Content 10', 'slug' => 'content-10', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg', 'is_premium' => 1],
            ['title' => 'Content 11', 'slug' => 'content-11', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg', 'is_premium' => 1],
            ['title' => 'Content 12', 'slug' => 'content-12', 'content_type' => 'video', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg', 'is_premium' => 1],

            ['title' => 'Content 13', 'slug' => 'content-13', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/laravel_intro.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg', 'is_premium' => 1],
            ['title' => 'Content 14', 'slug' => 'content-14', 'content_type' => 'image', 'source_type' => 'url', 'source' => 'https://cdn.example.com/vuejs-beginner.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg', 'is_premium' => 1],
            ['title' => 'Content 15', 'slug' => 'content-15', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/php_advanced.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg', 'is_premium' => 1],
            ['title' => 'Content 16', 'slug' => 'content-16', 'content_type' => 'image', 'source_type' => 'url', 'source' => 'https://cdn.example.com/react-master.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg', 'is_premium' => 1],
            ['title' => 'Content 17', 'slug' => 'content-17', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/js_essentials.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg', 'is_premium' => 1],
            ['title' => 'Content 18', 'slug' => 'content-18', 'content_type' => 'image', 'source_type' => 'url', 'source' => 'https://cdn.example.com/python-ds.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg', 'is_premium' => 1],
            ['title' => 'Content 19', 'slug' => 'content-19', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg', 'is_premium' => 1],
            ['title' => 'Content 20', 'slug' => 'content-20', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg', 'is_premium' => 1],
            ['title' => 'Content 21', 'slug' => 'content-21', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg', 'is_premium' => 1],
            ['title' => 'Content 22', 'slug' => 'content-22', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg', 'is_premium' => 1],
            ['title' => 'Content 23', 'slug' => 'content-23', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg', 'is_premium' => 1],
            ['title' => 'Content 24', 'slug' => 'content-24', 'content_type' => 'image', 'source_type' => 'file', 'source' => 'storage/videos/django_rest.mp4', 'thumbnail' => 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg', 'is_premium' => 1],
        ];

        foreach ($contents as $content) {
            Content::create([
                'package_id' => $packages->random()->id,
                'title' => $content['title'],
                'slug' => $content['slug'],
                'content_type' => $content['content_type'],
                'source_type' => $content['source_type'],
                'source' => $content['source'],
                'thumbnail' => $content['thumbnail'],
                'is_premium' => $content['is_premium'],
            ]);
        }
    }
}
