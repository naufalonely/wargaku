<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\Pegawai;
use Faker\Factory as Faker;

class SuratSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $pendudukIds = Penduduk::pluck('id')->all();
        $pegawaiIds = Pegawai::pluck('id')->all();

        if (empty($pendudukIds) || empty($pegawaiIds)) {
            $this->command->info('Tidak ada data penduduk atau pegawai. Silakan jalankan seeder untuk kedua tabel tersebut terlebih dahulu.');
            return;
        }

        $jenisSuratOptions = [
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
        ];

        $statusOptions = ['Draft', 'Diterbitkan', 'Dibatalkan'];

        for ($i = 0; $i < 30; $i++) {
            Surat::create([
                'nomor_surat' => 'DUKCAPIL/' . date('Ymd') . '/' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'penduduk_id' => $faker->randomElement($pendudukIds),
                'pegawai_id' => $faker->randomElement($pegawaiIds),
                'jenis_surat' => $faker->randomElement($jenisSuratOptions),
                'keperluan' => $faker->sentence(10, true),
                'tanggal_surat' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement($statusOptions),
            ]);
        }
    }
}
