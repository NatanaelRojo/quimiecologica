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
            DB::table('categories')->updateOrInsert([
                'name' => $category,
            ], [
                'primary_class_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
