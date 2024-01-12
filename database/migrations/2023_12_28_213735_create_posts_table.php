<?php

use App\Models\Category;
use App\Models\Gender;
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
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                // $table->foreignIdFor(Gender::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                // $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('title');
                $table->string('thumbnail')->nullable();
                $table->string('slug');
                $table->text('body');
                $table->boolean('published');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
