<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\ImageRelat;
use App\Models\Post;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RubricSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
        ]);

        Image::factory(50)->create();

        Vendor::factory(10)
            ->has(ImageRelat::factory(1), 'images')
            ->create();

        Post::factory(50)
            ->has(ImageRelat::factory(1), 'images')
            ->create();

        Product::factory(500)
            ->has(ImageRelat::factory(5), 'images')
            ->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
