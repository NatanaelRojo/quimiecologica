<?php

namespace Database\Seeders\TypeSaleSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_sales')->insert([
            'name' => 'Detal',
            'description' => 'Ventas de productos a pequeñas cantidades',
        ]);
        DB::table('type_sales')->insert([
            'name' => 'Granel',
            'description' => 'Ventas de productos a grandes cantidades',
        ]);
    }
}
