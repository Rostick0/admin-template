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
                'link_name' => 'computers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Смартфоны',
                'link_name' => 'smartphones',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Бытовая техника',
                'link_name' => 'household_appliances',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Разное',
                'link_name' => 'leisure_andentertainment',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Category::insert($data);
    }
}
