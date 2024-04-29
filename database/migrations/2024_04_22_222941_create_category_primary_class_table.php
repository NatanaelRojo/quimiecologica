<?php

use App\Models\Category;
use App\Models\PrimaryClass;
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
        if (!Schema::hasTable('category_primary_class')) {
            Schema::create('category_primary_class', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(PrimaryClass::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_primary_class');
    }
};
