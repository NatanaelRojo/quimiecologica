<?php

namespace Database\Seeders\GenderSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenderSeeder extends Seeder
{
    protected static array $genders = [
        'Hombre',
        'Mujer',
        'Niños',
        'Otro',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$genders as $gender) {
            DB::table('genders')->insert([
                'name' => $gender,
                'created_at' => Carbon::now(),
            ]);
        }
        // for ($i = 0; $i < 5; $i++) {
        //     DB::table('genders')->insert([
        //         'name' => "Genero {$i}",
        //     ]);
        // }
    }
}
