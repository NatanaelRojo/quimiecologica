<?php

use App\Models\Brand;
use App\Models\ProductType;
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
        if (!Schema::hasTable('brand_product_type')) {
            Schema::create('brand_product_type', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Brand::class);
                $table->foreignIdFor(ProductType::class);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_product_type');
    }
};
