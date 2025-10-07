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
        Schema::table('visits', function (Blueprint $table) {
            // Add new fields for confirmation tracking
            $table->boolean('author_confirmed')->default(false);
            $table->timestamp('author_confirmed_at')->nullable();
            $table->boolean('admin_confirmed')->default(false);
            $table->timestamp('admin_confirmed_at')->nullable();
            
            // Add fields for reschedule requests
            $table->boolean('reschedule_requested')->default(false);
            $table->text('reschedule_reason')->nullable();
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time')->nullable();
            $table->timestamp('reschedule_requested_at')->nullable();
            
            // Add rejection reason field
            $table->text('rejection_reason')->nullable();
        });

        // Update existing enum to support new status values
        DB::statement("ALTER TABLE visits MODIFY COLUMN status ENUM('pending', 'confirmed_by_author', 'confirmed_by_admin', 'in_progress', 'completed', 'konfirmasi', 'selesai') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Drop new fields
            $table->dropColumn([
                'author_confirmed',
                'author_confirmed_at',
                'admin_confirmed',
                'admin_confirmed_at',
                'reschedule_requested',
                'reschedule_reason',
                'preferred_date',
                'preferred_time',
                'reschedule_requested_at',
                'rejection_reason'
            ]);
        });

        // Revert enum to original values
        DB::statement("ALTER TABLE visits MODIFY COLUMN status ENUM('pending', 'konfirmasi', 'selesai') DEFAULT 'pending'");
    }
};
