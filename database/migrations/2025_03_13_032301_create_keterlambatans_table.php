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
        Schema::create('keterlambatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kehadiran');
            $table->foreign('id_kehadiran')->references('id')->on('kehadirans')->onDelete('cascade');
            $table->string('keterangan');
            $table->string('foto',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keterlambatans');
    }
};
