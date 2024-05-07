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
        Schema::create('lhes', function (Blueprint $table) {
            $table->id();
            $table->integer('opd_id');
            $table->string('rekomendasi_lhe');
            $table->year('tahun');
            $table->string('tindak_lanjut')->nullable();
            $table->string('target_penyelesaian')->nullable();
            $table->string('progres')->nullable();
            $table->string('bukti_dukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhes');
    }
};
