<?php

namespace Database\Seeders\PrimaryClassSeeders;

use App\Models\PrimaryClass;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PrimaryClassSeeder extends Seeder
{
    protected static array $primaryClasses = [
        'Cosméticos',
        'Prendas',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$primaryClasses as $primaryClass) {
            DB::table('primary_classes')->updateOrInsert([
                'name' => $primaryClass,
            ], [
                'slug' => Str::slug($primaryClass),
                'is_active' => true,
                'description' => '',
                'created_at' => Carbon::now(),
            ]);
        }
        foreach (PrimaryClass::all() as $primaryClass) {
            $primaryClass->brands()->attach([1]);
        }
    }
}
