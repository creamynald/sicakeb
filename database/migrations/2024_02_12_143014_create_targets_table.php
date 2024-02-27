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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_id');
            $table->string('jenis_master');
            $table->string('master_id');
            $table->string('indikator');
            $table->string('sasaran');
            $table->year('tahun');
            $table->string('tw1');
            $table->string('tw2');
            $table->string('tw3');
            $table->string('tw4');
            $table->string('satuan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};