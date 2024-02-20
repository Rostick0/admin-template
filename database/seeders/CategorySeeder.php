<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = [
            [
                'name' => 'Компьютеры',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Смартфоны',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Бытовая техника',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Отдых и развлечение',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Category::insert($data);
    }
}
