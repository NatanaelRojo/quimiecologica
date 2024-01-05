<?php

use App\Models\PendingOrder;
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
        if (!Schema::hasTable('pending_orders')) {
            Schema::create('pending_orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('service_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreignId('gender_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreignIdFor(Product::class);
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname');
                $table->string('owner_phone_number', 10);
                $table->string('owner_city');
                $table->string('owner_state');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_orders');
    }
};
