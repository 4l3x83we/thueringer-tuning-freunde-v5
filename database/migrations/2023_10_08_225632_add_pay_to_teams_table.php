<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('zahlungs_art')->after('ip_adresse')->nullable();
            $table->decimal('zahlung', 10, 2)->after('zahlungs_art')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('zahlungs_art');
            $table->dropColumn('zahlung');
        });
    }
};
