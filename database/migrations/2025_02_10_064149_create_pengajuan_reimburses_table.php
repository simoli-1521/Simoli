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
        Schema::create('pengajuan_reimburses', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_pengajuan');
            $table->dateTime('tgl_diterima_keuangan')->nullable();
            $table->dateTime('tgl_ditolak_keuangan')->nullable();
            $table->dateTime('tgl_diterima_sekdin')->nullable();
            $table->dateTime('tgl_ditolak_sekdin')->nullable();
            $table->dateTime('tgl_diterima_kadin')->nullable();
            $table->dateTime('tgl_ditolak_kadin')->nullable();
            $table->enum('status_keuangan', [
                'Diterima Keuangan',
                'Ditolak Keuangan',
            ])->nullable();
            $table->enum('status_sekdin', [
                'Diterima Sekdin',
                'Ditolak Sekdin',
            ])->nullable();
            $table->enum('status_kadin', [
                'Diterima Kadin',
                'Ditolak Kadin',
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_reimburses');
    }
};
