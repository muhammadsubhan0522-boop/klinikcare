<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('pemeriksaans');

        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antrean_id')->constrained('antreans')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('set null');
            $table->text('keluhan_utama');
            $table->string('diagnosa');
            $table->text('tindakan_medis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};