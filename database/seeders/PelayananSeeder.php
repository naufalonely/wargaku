<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PelayananDukcapil;
use App\Models\Penduduk;
use App\Models\Pegawai;
use Faker\Factory as Faker;

class PelayananSeeder extends Seeder
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

        $jenisPelayananOptions = [
            'Pendaftaran Kelahiran',
            'Pendaftaran Kematian',
            'Pindah Datang',
            'Pindah Keluar',
            'Penerbitan KTP',
            'Penerbitan KK',
            'Perubahan Data'
        ];

        $statusOptions = ['Diajukan', 'Diproses', 'Selesai', 'Ditolak'];

        for ($i = 0; $i < 20; $i++) {
            PelayananDukcapil::create([
                'nomor_permohonan' => 'DUK/' . date('Ymd') . '/' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'penduduk_id' => $faker->randomElement($pendudukIds),
                'pegawai_id' => $faker->randomElement($pegawaiIds),
                'jenis_pelayanan' => $faker->randomElement($jenisPelayananOptions),
                'keterangan' => $faker->sentence(10, true),
                'tanggal_permohonan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement($statusOptions),
                'catatan' => $faker->sentence(5, true),
            ]);
        }
    }
}
