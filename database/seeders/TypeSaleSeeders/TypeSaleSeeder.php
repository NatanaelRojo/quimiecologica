<?php

namespace Database\Seeders\TypeSaleSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSaleSeeder extends Seeder
{
    protected static array $type_sales = [
        [
            'name' => 'Detal',
            'description' => 'Venta de productos a pequeñas cantidades',
        ],
        [
            'name' => 'Granel',
            'description' => 'Venta de productos a grandes cantidades (un solo recipiente)',
        ],
        [
            'name' => 'Mayor',
            'description' => 'Venta de productos a grandes cantidades (varios recipientes)',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$type_sales as $type_sale) {
            DB::table('type_sales')->insert([
                'name' => $type_sale['name'],
                'description' => $type_sale['description'],
            ]);
        }
        // DB::table('type_sales')->insert([
        //     'name' => 'Detal',
        //     'description' => 'Ventas de productos a pequeñas cantidades',
        // ]);
        // DB::table('type_sales')->insert([
        //     'name' => 'Granel',
        //     'description' => 'Ventas de productos a grandes cantidades',
        // ]);
    }
}
