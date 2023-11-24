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
        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jurusans');
            $table->foreignId('id_semesters')->nullable();
            $table->string('nama_matkuls');
            $table->string('nama_dosen');
            $table->string('mulai')->nullable();
            $table->string('selesai')->nullable();
            $table->string('hari')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkuls');
    }
};
