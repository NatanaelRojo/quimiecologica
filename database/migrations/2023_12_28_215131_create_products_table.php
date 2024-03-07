<?php

use App\Models\Category;
use App\Models\Gender;
use App\Models\Service;
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
                $table->boolean('is_active');
                $table->string('name');
                $table->text('description');
                $table->unsignedBigInteger('price');
                $table->jsonb('image_urls');
                $table->unsignedBigInteger('stock');
                $table->string('slug')->unique()->nullable();
                // $table->string('purchase_type');
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
