<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smithtravelbali.com'],
            [
                'name' => 'Admin Smith Travel',
                'password' => bcrypt('password123'),
                'is_admin' => true,
            ]
        );

        $this->call([
            TourCategorySeeder::class,
            TourPackageSeeder::class,
            BlogSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
