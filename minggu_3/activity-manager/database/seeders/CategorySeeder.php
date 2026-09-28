<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Evaluasi',
            'Praktikum',
            'Presentasi',
            'Seminar',
            'Testing',
            'Workshop',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['slug' => strtolower($name)],
                ['name' => $name]
            );
        }
    }
}