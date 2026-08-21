<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->string('pendidikan_terakhir');
            $table->string('bidang_keahlian');
            $table->string('foto')->nullable();
            $table->string('ktp')->nullable();
            $table->string('status_verifikasi')->default('pending'); // pending, disetujui, ditolak
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_anggotas');
    }
};
