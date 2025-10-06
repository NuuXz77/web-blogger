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
        Schema::table('visits', function (Blueprint $table) {
            // Author confirmation columns
            $table->boolean('author_confirmed')->default(false)->after('status');
            $table->timestamp('author_confirmed_at')->nullable()->after('author_confirmed');
            
            // Reschedule request columns
            $table->boolean('reschedule_requested')->default(false)->after('author_confirmed_at');
            $table->text('reschedule_reason')->nullable()->after('reschedule_requested');
            $table->date('preferred_date')->nullable()->after('reschedule_reason');
            $table->string('preferred_time')->nullable()->after('preferred_date');
            $table->timestamp('reschedule_requested_at')->nullable()->after('preferred_time');
            
            // Admin response to reschedule request
            $table->text('rejection_reason')->nullable()->after('reschedule_requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn([
                'author_confirmed',
                'author_confirmed_at',
                'reschedule_requested',
                'reschedule_reason',
                'preferred_date',
                'preferred_time',
                'reschedule_requested_at',
                'rejection_reason'
            ]);
        });
    }
};
