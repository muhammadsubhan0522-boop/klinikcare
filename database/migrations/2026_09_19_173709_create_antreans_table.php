<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('antreans'); // Hapus dulu kalau ada biar bersih

        Schema::create('antreans', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrean');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->string('poliklinik')->nullable(); // Ditambahkan nullable agar tidak error
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antreans');
    }
};