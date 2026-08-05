<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat', ['masuk', 'keluar']);
            $table->unsignedBigInteger('surat_id');
            $table->string('nomor_surat', 100);
            $table->date('tanggal_surat');
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
