<?php

use App\Models\Analysis;
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
        if (!Schema::hasTable('analysis_types')) {
            Schema::create('analysis_types', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Analysis::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('name', 20);
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_types');
    }
};
