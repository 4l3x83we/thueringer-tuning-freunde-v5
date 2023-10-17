<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fahrzeuges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('fahrzeug')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->date('baujahr')->nullable();
            $table->text('besonderheiten')->nullable();
            $table->text('motor')->nullable();
            $table->text('karosserie')->nullable();
            $table->text('felgen')->nullable();
            $table->text('fahrwerk')->nullable();
            $table->text('bremsen')->nullable();
            $table->text('innenraum')->nullable();
            $table->text('anlage')->nullable();
            $table->longText('description')->nullable();
            $table->string('path')->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fahrzeuges');
    }
};
