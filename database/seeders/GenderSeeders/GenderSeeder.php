<?php

namespace Database\Seeders\GenderSeeders;

use App\Models\Category;
use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenderSeeder extends Seeder
{
    protected static array $genders = [
        'Hombre',
        'Mujer',
        'Niños',
        'Otro',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::$genders as $gender) {
            DB::table('genders')->updateOrInsert([
                'name' => $gender,
            ], [
                'is_active' => true,
                'created_at' => Carbon::now(),
            ]);
        }
        foreach (Gender::all() as $gender) {
            $categoriesIds = [];
            foreach (Category::all() as $category) {
                $categoriesIds[] = $category->id;
            }
            $gender->categories()->attach($categoriesIds);
        }
    }
}
