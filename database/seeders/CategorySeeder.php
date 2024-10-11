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
                'name' => 'Computers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Smartphones',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Household appliances',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Leisure and entertainment',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Category::insert($data);
    }
}
