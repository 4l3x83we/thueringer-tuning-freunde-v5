<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->integer('status')->nullable();
            $table->integer('is_all_day')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('event_id')->nullable();
            $table->string('event_color')->nullable();
            $table->string('event_background_color')->nullable();
            $table->string('event_border_color')->nullable();
            $table->string('event_text_color')->nullable();
            $table->string('color')->nullable();
            $table->integer('colorID')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
