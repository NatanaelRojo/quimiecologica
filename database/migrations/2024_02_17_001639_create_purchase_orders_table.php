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
        if (!Schema::hasTable('purchase_orders')) {
            Schema::create('purchase_orders', function (Blueprint $table) {
                $table->id();
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname', 30);
                $table->string('owner_id');
                $table->string('owner_phone_number');
                $table->string('owner_email');
                $table->string('owner_city');
                $table->string('owner_state');
                $table->string('owner_address');
                $table->string('reference_number');
                $table->string('image')->nullable();
                $table->unsignedBigInteger('total_price');
                $table->json('products_info');
                $table->string('status', 20)->default('En espera');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
