<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Officials;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Officials::insert([
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'captain',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'secretary',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'treasurer',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'sk',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
