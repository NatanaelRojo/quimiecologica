<?php

use App\Models\Category;
use App\Models\Gender;
use App\Models\PendingOrder;
use App\Models\Product;
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
        if (!Schema::hasTable('pending_orders')) {
            Schema::create('pending_orders', function (Blueprint $table) {
                $table->id();
                // $table->foreignIdFor(Service::class);
                // $table->foreignIdFor(Gender::class);
                // $table->foreignIdFor(Category::class);
                // $table->foreignIdFor(Product::class);
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname');
                $table->string('owner_id', 20);
                $table->string('owner_email');
                $table->string('owner_phone_number');
                $table->string('owner_state');
                $table->string('owner_city');
                $table->string('owner_address');
                $table->string('owner_request');
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
        Schema::dropIfExists('pending_orders');
    }
};
