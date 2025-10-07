<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing enum to support new status values
        DB::statement("ALTER TABLE visits MODIFY COLUMN status ENUM('pending', 'confirmed_by_author', 'confirmed_by_admin', 'in_progress', 'completed', 'konfirmasi', 'selesai') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert enum to original values
        DB::statement("ALTER TABLE visits MODIFY COLUMN status ENUM('pending', 'konfirmasi', 'selesai') DEFAULT 'pending'");
    }
};
