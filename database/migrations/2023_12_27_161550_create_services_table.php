<?php

use App\Models\ServiceType;
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
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(ServiceType::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('name', 20);
                $table->string('banner')->nullable();
                $table->string('slug')->unique()->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('price');
                $table->json('conditions')->nullable();
                // $table->string('considerations');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
