<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
    
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@admin.com'),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        User::insert($data);
    }
}
