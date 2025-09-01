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
        Schema::create('pelayanan_dukcapils', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_permohonan')->unique();
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onDelete('set null');
            $table->enum('jenis_pelayanan', [
                'Pendaftaran Kelahiran',
                'Pendaftaran Kematian',
                'Pindah Datang',
                'Pindah Keluar',
                'Penerbitan KTP',
                'Penerbitan KK',
                'Perubahan Data'
            ]);
            $table->text('keterangan');
            $table->date('tanggal_permohonan');
            $table->enum('status', ['Diajukan', 'Diproses', 'Selesai', 'Ditolak'])->default('Diajukan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan_dukcapils');
    }
};
