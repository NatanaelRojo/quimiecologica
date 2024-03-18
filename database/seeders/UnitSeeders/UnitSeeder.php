<?php

namespace Database\Seeders\UnitSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('units')->insert([
                'name' => "Unidad {$i}",
                'abbreviation' => 'u',
            ]);
        }
    }
}
