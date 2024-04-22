<?php

use App\Models\Product;
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
        if (!Schema::hasTable('product_product_type')) {
            Schema::create('product_product_type', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Product::class);
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
        Schema::dropIfExists('product_product_type');
    }
};
