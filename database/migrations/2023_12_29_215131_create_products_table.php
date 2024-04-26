<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Gender;
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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Brand::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(TypeSale::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->boolean('is_active');
                $table->string('name');
                $table->text('description');
                $table->unsignedBigInteger('price');
                $table->unsignedBigInteger('wholesale_price')->nullable()->default(0);
                $table->jsonb('image_urls');
                $table->unsignedBigInteger('stock')->default(1);
                $table->string('slug')->unique()->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
