<?php

use App\Models\Product;
use App\Models\TypeSale;
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
        if (!Schema::hasTable('product_type_sale')) {
            Schema::create('product_type_sale', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(TypeSale::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_sale');
    }
};
