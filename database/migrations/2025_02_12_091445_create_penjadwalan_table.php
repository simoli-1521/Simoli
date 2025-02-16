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
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_akhir');
            $table->string('nama_lokasi');
            $table->float('latitude');
            $table->float('longtude ');
            $table->float('radius');
            $table->foreignid('id_mobil')->constrained('mobil', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
