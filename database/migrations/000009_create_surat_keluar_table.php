<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 100);
            $table->string('tujuan', 150);
            $table->string('perihal', 255);
            $table->string('lampiran', 150)->nullable();
            $table->string('file_pdf')->nullable();
            $table->string('penandatangan', 150)->nullable();
            $table->date('tanggal_surat');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};