<?php

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
        if (!Schema::hasTable('purchase_wholesale_orders')) {
            Schema::create('purchase_wholesale_orders', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname');
                $table->string('owner_id');
                $table->string('owner_phone_number');
                $table->string('owner_city');
                $table->string('owner_state');
                $table->string('owner_address');
                $table->string('reference_number');
                $table->string('image')->nullable();
                $table->unsignedBigInteger('total_price');
                $table->unsignedInteger('product_quantity');
                $table->string('unit');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_wholesale_orders');
    }
};
