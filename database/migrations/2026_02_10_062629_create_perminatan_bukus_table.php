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
        Schema::create('perminatan_bukus', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul');
            $table->string('penulis')->nullable();
            $table->string('kode_buku')->unique()->nullable();
            $table->string('penerbit', 50)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->unsignedBigInteger('id_buku')->nullable();
            //$table->foreign('id_buku')->references('id')->on('bukus')->onDelete('cascade');
            $table->dateTime('tgl_permintaan');
            $table->string('alasan_permintaan');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perminatan_bukus');
    }
};
