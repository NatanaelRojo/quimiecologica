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
        if (!Schema::hasTable('type_sales')) {
            Schema::create('type_sales', function (Blueprint $table) {
                $table->id();
                $table->string('name', 20);
                $table->string('description')->nullable();
                $table->boolean('deletable')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_sales');
    }
};
