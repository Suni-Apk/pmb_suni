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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();

            $table->string('name')->default('SUNI Indonesia');
            $table->string('phone');
            $table->string('email');
            $table->string('image');

            $table->string('title')->default('SUNI ID');
            $table->string('url')->default('https://suniindonesia.com/');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
