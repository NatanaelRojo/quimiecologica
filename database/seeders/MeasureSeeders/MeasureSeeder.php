<?php

namespace Database\Seeders\MeasureSeeders;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasureSeeder extends Seeder
{
    protected static array $sizes = [
        [
            'name' => 'SS',
            'type' => 'Tallas',
        ],
        [
            'name' => 'S',
            'type' => 'Tallas',
        ],
        [
            'name' => 'M',
            'type' => 'Tallas',
        ],
        [
            'name' => 'L',
            'type' => 'Tallas',
        ],
        [
            'name' => 'XL',
            'type' => 'Tallas',
        ],
        [
            'name' => 'XXL',
            'type' => 'Tallas',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 1;
        $presentationSize = 100;
        $presentationName = '';
        foreach (Unit::all() as $unit) {
            if ($count >= 1) {
                $presentationName = "{$unit->name}s";
            }
            DB::table('measures')->updateOrInsert([
                'id' => $count,
                // 'name' => "{$presentationSize} {$presentationName}",
            ], [
                'quantity' => $presentationSize,
                'unit' => $unit->name,
                'type' => 'Unidades',
                'created_at' => Carbon::now(),
            ]);
            $count++;
            $presentationSize += 100;
        }
        foreach (static::$sizes as $size) {
            DB::table('measures')->updateOrInsert([
                'id' => $count,
                'size' => $size['name'],
            ], [
                'type' => $size['type'],
                'created_at' => Carbon::now(),
            ]);
            $count++;
        }
    }
}
