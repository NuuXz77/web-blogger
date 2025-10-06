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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke auditor (user dengan role auditor)
            $table->unsignedBigInteger('auditor_id');
            $table->foreign('auditor_id')->references('id')->on('users')->onDelete('cascade');

            // Relasi ke author (user dengan role author)
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

            // Informasi visit
            $table->date('tanggal'); // tanggal kunjungan
            $table->text('alamat'); // alamat lengkap yang akan dikunjungi auditor
            $table->text('keterangan')->nullable(); // catatan dari admin
            
            // Data hasil visit dari auditor
            $table->decimal('lat', 10, 7)->nullable();   // Latitude lokasi selfie
            $table->decimal('long', 10, 7)->nullable();  // Longitude lokasi selfie
            $table->string('selfie')->nullable();        // path foto selfie
            $table->text('hasil')->nullable();           // hasil laporan kunjungan

            // Status kunjungan: pending, konfirmasi, selesai
            $table->enum('status', ['pending', 'konfirmasi', 'selesai'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
