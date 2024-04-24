<?php

use App\Models\Presentation;
use App\Models\Product;
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
        if (!Schema::hasTable('presentation_product')) {
            Schema::create('presentation_product', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Presentation::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentation_product');
    }
};
