<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'status' => 'active',
            'type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
