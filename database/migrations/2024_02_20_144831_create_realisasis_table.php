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
        Schema::create('realisasis', function (Blueprint $table) {
            $table->id();
            $table->string('target_id');
            $table->string('tw1')->nullable();
            $table->string('tw2')->nullable();
            $table->string('tw3')->nullable();
            $table->string('tw4')->nullable();
            $table->string('pendukung')->nullable();
            $table->string('penghambat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasis');
    }
};
