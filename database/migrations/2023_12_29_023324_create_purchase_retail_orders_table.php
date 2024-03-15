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
        if (!Schema::hasTable('purchase_retail_orders')) {
            Schema::create('purchase_retail_orders', function (Blueprint $table) {
                $table->id();
                // $table->foreignIdFor(Service::class);
                // $table->foreignIdFor(Gender::class);
                // $table->foreignIdFor(Category::class);
                $table->string('owner_firstname', 30);
                $table->string('owner_lastname', 30);
                $table->string('owner_id');
                $table->string('owner_phone_number');
                $table->string('owner_city');
                $table->string('owner_state');
                $table->string('owner_address');
                $table->string('reference_number');
                $table->string('image')->nullable();
                $table->unsignedBigInteger('total_price');
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
        Schema::dropIfExists('purchase_retail_orders');
    }
};
