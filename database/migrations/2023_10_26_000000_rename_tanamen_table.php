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
        // If the table is named 'tanamen' but should be 'tanamans'
        if (Schema::hasTable('tanamen') && !Schema::hasTable('tanamans')) {
            Schema::rename('tanamen', 'tanamans');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('tanamans') && !Schema::hasTable('tanamen')) {
            Schema::rename('tanamans', 'tanamen');
        }
    }
};