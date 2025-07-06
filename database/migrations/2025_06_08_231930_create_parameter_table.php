<?php

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
    Schema::create('parameter', function (Blueprint $table) {
        $table->id();
        $table->string('type');   // 'suhu' | 'kelembapan' | 'cahaya'
        $table->string('label');  // misal 'Rendah', 'Sedang', 'Tinggi'
        $table->float('min');     // nilai minimal
        $table->float('max');     // nilai maksimal
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter');
    }
};
