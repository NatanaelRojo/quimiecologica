<?php

namespace Database\Seeders\PrimaryClassSeeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimaryClassSeeder extends Seeder
{
    protected static array $primaryClasses = [
        'Cosmeticos',
        'Prendas',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 1;
        foreach (static::$primaryClasses as $primaryClass) {
            DB::table('primary_classes')->updateOrInsert([
                'id' => $count,
                'name' => $primaryClass,
            ], [
                'is_active' => true,
                'description' => '',
                'created_at' => Carbon::now(),
            ]);
            $count++;
        }
    }
}
