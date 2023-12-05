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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->foreignId('id_tahun_ajarans');
            $table->foreignId('id_jurusans')->nullable();
            $table->foreignId('id_courses')->nullable();
            $table->enum('type', ['whatsapp', 'zoom']);
            $table->enum('gender', ['Laki-Laki', 'Perempuan', 'all']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
