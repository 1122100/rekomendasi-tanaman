<?php

// database/migrations/2025_06_XX_create_fuzzy_rules_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('fuzzy_rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('parameter_suhu_id')->constrained('parameter');
        $table->foreignId('parameter_kelembapan_id')->constrained('parameter');
        $table->foreignId('parameter_cahaya_id')->constrained('parameter');
        $table->string('rekomendasi');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('fuzzy_rules');
    }
};
