<?php

use App\Models\Analysis;
use App\Models\AnalysisType;
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
        if (!Schema::hasTable('analysis_parameters')) {
            Schema::create('analysis_parameters', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Analysis::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(AnalysisType::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('name');
                $table->string('description')->nullable();
                $table->unsignedBigInteger('price_per_hour');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_parameters');
    }
};
