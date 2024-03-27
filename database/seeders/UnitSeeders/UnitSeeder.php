<?php

namespace Database\Seeders\UnitSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UnitSeeder extends Seeder
{
    protected static array $units = [
        [
            'name' => 'Kilogramo',
            'abbreviation' => 'Kg'
        ],
        [
            'name' => 'Gramo',
            'abbreviation' => 'g',
        ],
        [
            'name' => 'Miligramo',
            'abbreviation' => 'mg',
        ],
        [
            'name' => 'Kilolitro',
            'abbreviation' => 'Kl',
        ],
        [
            'name' => 'Litro',
            'abbreviation' => 'l',
        ],
        [
            'name' => 'Mililitro',
            'abbreviation' => 'ml',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$units as $unit) {
            DB::table('units')->insert([
                'name' => $unit['name'],
                'abbreviation' => $unit['abbreviation'],
                'created_at' => Carbon::now(),
            ]);
        }
        // for ($i = 0; $i < 5; $i++) {
        //     DB::table('units')->insert([
        //         'name' => "Unidad {$i}",
        //         'abbreviation' => 'u',
        //     ]);
        // }
    }
}
