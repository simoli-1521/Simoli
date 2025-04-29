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
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->string('alasan',20);
            $table->datetime('waktu_izin');
            $table->enum('status_admin', [
                'Diterima Admin', 
                'Ditolak Admin',])->nullable();
            $table->enum('status_sekdin', [
                'Diterima Sekdin', 
                'Ditolak Sekdin',])->nullable();
            $table->enum('status_kadin', [
                'Diterima Kadin', 
                'Ditolak Kadin',])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
