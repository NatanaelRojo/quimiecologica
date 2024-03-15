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
        if (!Schema::hasColumn('products', 'unit_id', 'quantity')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreignIdFor(Unit::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->unsignedInteger('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['unit_id', 'quantity']);
        });
    }
};
