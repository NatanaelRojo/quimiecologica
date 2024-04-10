<?php

namespace Database\Seeders\ServiceTypeSeeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceTypeSeeder extends Seeder
{
    protected static array $serviceTypes = [
        [
            'name' => 'Molienda',
        ],
        [
            'name' => 'Pulverizacion',
        ],
        [
            'name' => 'Análisis cosmetico'
        ],
        [
            'name'  => 'Acesorías',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$serviceTypes as $serviceType) {
            DB::table('service_types')->insert([
                'is_active' => true,
                'name' =>  $serviceType['name'],
                'slug' => Str::slug($serviceType['name']),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
