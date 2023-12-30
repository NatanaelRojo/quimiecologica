<?php

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
        if (!Schema::hasTable('product_purchase_order')) {
            Schema::create('product_purchase_order', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained();
                $table->foreignId('purchase_order_id')->constrained();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_purchase_order');
    }
};
