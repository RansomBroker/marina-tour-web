<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Cultural Tours',
            'Nature Tours',
            'Adventure Tours',
            'Island Tours',
            'Honeymoon Tours',
        ];

        foreach ($categories as $category) {
            \App\Models\TourCategory::firstOrCreate([
                'slug' => \Illuminate\Support\Str::slug($category),
            ], [
                'name' => $category,
                'description' => 'Explore our custom and hand-picked ' . $category . '.',
            ]);
        }
    }
}
