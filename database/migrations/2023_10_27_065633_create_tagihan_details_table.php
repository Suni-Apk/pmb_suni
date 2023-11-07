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
        Schema::create('tagihan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tagihans');
            $table->foreignId('id_biayas');
            $table->foreignId('id_transactions')->nullable();
            $table->foreignId('id_users');
            $table->string('status');
            $table->integer('amount');
            $table->date('start_date')->nullable();
            $table->date('end_date');
            $table->date('before_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_details');
    }
};
