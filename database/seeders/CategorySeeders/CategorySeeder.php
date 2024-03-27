<?php

namespace Database\Seeders\CategorySeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CategorySeeders\BaseCategory;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    protected static array $categories = [
        'Cabina',
        'Corporal',
        'Facial',
        'Manos',
        'Pies',
        'Spa',
        'Zona íntima',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now(),
            ]);
        }
        // for ($i = 0; $i < 5; $i++) {
        //     DB::table('categories')->insert([
        //         'name' => "Categoria {$i}",
        //     ]);
        // }
    }
}
