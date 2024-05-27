<?php

namespace Database\Seeders\BrandSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    protected static $brands = [
        [
            'is_active' => true,
            'logo_url' => '',
            'name' => 'Bastt',
            'description' => 'Description',
        ],
        [
            'is_active' => true,
            'logo_url' => '',
            'name' => 'Beauty',
            'description' => 'Description',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$brands as $brand) {
            DB::table('brands')->updateOrInsert([
                'name' => $brand['name'],
            ], [
                'slug' => Str::slug($brand['name']),
                'is_active' => $brand['is_active'],
                'logo_url' => $brand['logo_url'],
                'description' => $brand['description'],
            ]);
        }
    }
}
