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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angkatan_id');
            $table->foreignId('jurusan_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->foreignId('user_id');
            $table->string('program_belajar');
            $table->string('image');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->text('address');
            $table->string('baca_quran')->nullable();
            $table->string('profesi')->nullable();
            $table->string('last_graduate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
