<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('album_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('fahrzeuges_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('slug')->nullable();
            $table->string('size')->nullable();
            $table->string('images')->nullable();
            $table->string('images_thumbnail')->nullable();
            $table->boolean('thumbnail')->nullable();
            $table->boolean('published')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
