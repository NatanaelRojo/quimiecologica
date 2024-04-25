<?php

use App\Models\Unit;
use App\Models\WholesalePackage;
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
        if (!Schema::hasColumn('products', 'unit_id') && !Schema::hasColumn('products', 'quantity')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreignIdFor(Unit::class)->nullable()
                    ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->unsignedInteger('quantity')->default(0);
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
