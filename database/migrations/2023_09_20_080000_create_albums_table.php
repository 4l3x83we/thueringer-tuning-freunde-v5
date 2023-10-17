<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('size')->nullable();
            $table->string('description')->nullable();
            $table->string('kategorie')->nullable();
            $table->string('path')->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
