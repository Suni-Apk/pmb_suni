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
        Schema::create('notifies', function (Blueprint $table) {
            $table->id();
            $table->text('notif_otp')->nullable();
            $table->text('notif_isi_biodata_formal')->nullable();
            $table->text('notif_isi_biodata_nonformal')->nullable();
            $table->text('notif_isi_document')->nullable();
            $table->text('notif_administrasi_formal')->nullable();
            $table->text('notif_administrasi_nonformal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifies');
    }
};
