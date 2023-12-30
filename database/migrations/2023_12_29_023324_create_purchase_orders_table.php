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
                $table->foreignId('service_id')->constrained;
                $table->foreignId('gender_id')->constrained();
                $table->foreignId('category_id')->constrained();
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname');
                $table->string('owner_phone_number', 10);
                $table->unsignedBigInteger('total_price');
                // $table->string('products');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
