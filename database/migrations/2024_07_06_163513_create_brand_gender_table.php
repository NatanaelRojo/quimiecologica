<?php

use App\Models\Brand;
use App\Models\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('brand_gender')) {
            Schema::create('brand_gender', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Brand::class);
                $table->foreignIdFor(Gender::class);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_gender');
    }
};
