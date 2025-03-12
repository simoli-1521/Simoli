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
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_penjadwalan');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_penjadwalan')->references('id')->on('penjadwalans')->onDelete('cascade');
            // $table->float('jadwal_lokasi_peta_latitude');
            // $table->float('jadwal_lokasi_peta_longtitude');
            // $table->timestamp('jadwal_waktu_mulai')->nullable();
            // $table->timestamp('jadwal_waktu_selesai')->nullable();
            $table->float('lokasi_peta_latitude')->nullable();
            $table->float('lokasi_peta_longtitude')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->string('waktu_mulai_status', 255);
            $table->string('waktu_selesai_status', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
