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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biaya');
            $table->string('jenis_biaya');
            $table->enum('program_belajar', ['S1', 'BAHASA ARAB']);
            $table->foreignId('id_angkatans');
            $table->foreignId('id_jurusans');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('mounth');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
