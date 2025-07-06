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
        Schema::table('fuzzy_rules', function (Blueprint $table) {
            // Menambahkan kolom tanaman_id
            $table->foreignId('tanaman_id')->nullable()->constrained('tanamans')->onDelete('set null');
            
            // Menyimpan data rekomendasi yang ada (jika perlu)
            // Kode ini akan dijalankan jika kolom rekomendasi sudah ada
            if (Schema::hasColumn('fuzzy_rules', 'rekomendasi')) {
                // Kolom rekomendasi akan dihapus setelah migrasi data
                $table->string('rekomendasi_temp')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuzzy_rules', function (Blueprint $table) {
            $table->dropForeign(['tanaman_id']);
            $table->dropColumn('tanaman_id');
            
            // Mengembalikan kolom rekomendasi jika dihapus
            if (!Schema::hasColumn('fuzzy_rules', 'rekomendasi')) {
                $table->string('rekomendasi')->nullable();
            }
        });
    }
};