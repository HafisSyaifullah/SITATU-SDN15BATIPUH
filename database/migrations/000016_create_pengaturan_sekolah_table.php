<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 150);
            $table->string('npsn', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kepala_sekolah', 150)->nullable();
            $table->string('logo')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_sekolah');
    }
};
