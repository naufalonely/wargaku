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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->enum('jenis_surat', [
                'Kartu Keluarga',
                'Kartu Tanda Penduduk',
                'Kartu Identitas Anak',
                'Surat Keterangan Pindah',
                'Surat Keterangan Pindah Luar Negeri',
                'Surat Keterangan Tempat Tinggal',
                'Surat Keterangan Lahir Mati',
                'Surat Keterangan Pembatalan Perkawinan',
                'Surat Keterangan Pembatalan Perceraian',
                'Surat Keterangan Pengangkatan Anak',
                'Surat Keterangan Pelepasan Kewarganegaraan Indonesia',
                'Surat Keterangan Pengganti Tanda Identitas',
                'Surat Keterangan Pencatatan Sipil',
                'Akta Kelahiran',
                'Akta Kematian',
                'Akta Perkawinan',
                'Akta Perceraian',
                'Akta Pengakuan Anak',
                'Akta Pengesahan Anak',
            ]);
            $table->text('keperluan');
            $table->date('tanggal_surat');
            $table->enum('status', ['Draft', 'Diterbitkan', 'Dibatalkan'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
