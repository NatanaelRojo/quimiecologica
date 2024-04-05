<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\CategorySeeders\CategorySeeder;
use Database\Seeders\GenderSeeders\GenderSeeder;
use Database\Seeders\ServiceTypeSeeders\ServiceTypeSeeder;
use Database\Seeders\TypeSaleSeeders\TypeSaleSeeder;
use Database\Seeders\UnitSeeders\UnitSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            GenderSeeder::class,
            TypeSaleSeeder::class,
            UnitSeeder::class,
            ServiceTypeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
