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
        Schema::create('buku_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade'); 
            $table->foreignId('kategori_id')->constrained('kategori_bukus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_kategori');
    }
};
