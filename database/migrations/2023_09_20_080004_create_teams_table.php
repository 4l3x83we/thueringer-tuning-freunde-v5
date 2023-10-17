<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('fahrzeuges_id')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('anrede')->nullable();
            $table->string('vorname')->nullable();
            $table->string('nachname')->nullable();
            $table->string('strasse')->nullable();
            $table->string('plz')->nullable();
            $table->string('wohnort')->nullable();
            $table->string('telefon')->nullable();
            $table->string('mobil')->nullable();
            $table->string('email')->nullable();
            $table->date('geburtsdatum')->nullable();
            $table->string('beruf')->nullable();
            $table->longText('description')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('funktion')->nullable();
            $table->string('ip_adresse')->nullable();
            $table->boolean('fahrzeug_vorhanden')->nullable();
            $table->string('path')->nullable();
            $table->boolean('published')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
