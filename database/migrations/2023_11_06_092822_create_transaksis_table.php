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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_detail_id')->nullable();
            $table->foreignId('user_id');
            $table->string('status');
            $table->string('total');
            $table->text('payment_link');
            $table->string('jenis_pembayaran');
            $table->string('jenis_tagihan');
            $table->string('no_invoice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
