<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Department::factory()->create([
            'name' => 'Computer Science',
            'code' => 'CS',
        ]);
        Department::factory()->create([
            'name' => 'Japanese',
            'code' => 'japan',
        ]);
        Department::factory()->create([
            'name' => 'German',
            'code' => 'german',
        ]);

        Category::factory()->create([
            'name' => 'Computer Science',
            'code' => 'CS',
        ]);
        Category::factory()->create([
            'name' => 'Japanese',
            'code' => 'japan',
        ]);
        Category::factory()->create([
            'name' => 'German',
            'code' => 'german',
        ]);
    }
}
