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
            'name' => 'Pulverización',
        ],
        [
            'name' => 'Análisis cosmético'
        ],
        [
            'name'  => 'Asesorías',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 1;
        foreach (static::$serviceTypes as $serviceType) {
            DB::table('service_types')->updateOrInsert([
                'id' => $count,
                'name' =>  $serviceType['name'],
            ], [
                'is_active' => true,
                'slug' => Str::slug($serviceType['name']),
                'created_at' => Carbon::now(),
            ]);
            $count++;
        }
    }
}
