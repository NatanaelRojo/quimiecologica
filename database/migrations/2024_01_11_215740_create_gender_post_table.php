<?php

use App\Models\Gender;
use App\Models\Post;
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
        if (!Schema::hasTable('gender_post')) {
            Schema::create('gender_post', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Gender::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignIdFor(Post::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender_post');
    }
};
