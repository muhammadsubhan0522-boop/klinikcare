<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu agar tidak error kalau tabelnya sudah terlanjur ada
        if (!Schema::hasTable('jadwal_dokters')) {
            Schema::create('jadwal_dokters', function (Blueprint $table) {
                $table->id();
                $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
                $table->string('hari');
                $table->string('poliklinik');
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
    }
};