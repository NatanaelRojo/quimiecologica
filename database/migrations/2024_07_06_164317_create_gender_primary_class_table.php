<?php

use App\Models\Gender;
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
        if (!Schema::hasTable('gender_primary_class')) {
            Schema::create('gender_primary_class', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Gender::class);
                $table->foreignIdFor(PrimaryClass::class);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender_primary_class');
    }
};
