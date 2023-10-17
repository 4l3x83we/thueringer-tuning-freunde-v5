<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veranstaltungens', function (Blueprint $table) {
            $table->id();
            $table->timestamp('datum_von')->nullable();
            $table->timestamp('datum_bis')->nullable();
            $table->string('veranstaltung')->nullable();
            $table->string('veranstaltungsort')->nullable();
            $table->string('veranstalter')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('quelle')->nullable();
            $table->string('slug')->nullable();
            $table->string('eintritt')->nullable();
            $table->tinyInteger('published')->nullable()->default(0);
            $table->timestamp('published_at')->nullable();
            $table->tinyInteger('anwesend')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veranstaltungens');
    }
};
