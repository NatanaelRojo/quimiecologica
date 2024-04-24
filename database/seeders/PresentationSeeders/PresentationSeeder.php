<?php

namespace Database\Seeders\PresentationSeeders;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresentationSeeder extends Seeder
{
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
            DB::table('presentations')->updateOrInsert([
                'id' => $count,
                'name' => "{$presentationSize} {$presentationName}",
            ], [
                'quantity' => $presentationSize,
                'unit' => $unit->name,
                'created_at' => Carbon::now(),
            ]);
            $count++;
            $presentationSize += 100;
        }
    }
}
