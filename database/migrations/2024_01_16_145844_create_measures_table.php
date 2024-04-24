<?php

use App\Models\Unit;
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
        if (!Schema::hasTable('measures')) {
            Schema::create('measures', function (Blueprint $table) {
                $table->id();
                // $table->string('name');
                $table->string('size', 10)->default('');
                $table->float('quantity')->default(0);
                $table->string('unit')->default('');
                $table->string('type');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measures');
    }
};
