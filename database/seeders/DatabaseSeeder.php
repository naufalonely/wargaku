<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\PelayananDukcapil;
use App\Models\Pegawai;
use Database\Seeders\PegawaiSeeder;
use Database\Seeders\PendudukSeeder;
use Database\Seeders\SuratSeeder;
use Database\Seeders\PelayananSeeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PegawaiSeeder::class);

        $this->call(PendudukSeeder::class);

        $faker = Faker::create('id_ID');

        $pendudukIds = Penduduk::pluck('id')->all();
        $staff = Pegawai::where('level', 'staff')->first();
        $admin = Pegawai::where('level', 'admin')->first();

        if (empty($pendudukIds) || !$staff) {
            $this->command->info('Penduduk atau staff belum tersedia. Pastikan PegawaiSeeder dan PendudukSeeder berjalan.');
            return;
        }

        $now = Carbon::now();

        $suratCount = 80;
        for ($i = 0; $i < $suratCount; $i++) {
            $pid = $faker->randomElement($pendudukIds);
            $inCurrent = $i < intval($suratCount * 0.7);
            $date = $inCurrent ? $now->copy()->subDays(rand(0, max(0, $now->day - 1))) : $now->copy()->subMonths(rand(1,5))->subDays(rand(0,27));

            Surat::create([
                'nomor_surat' => 'SK/' . $date->format('Ym') . '/' . strtoupper(substr($faker->lexify('??????'),0,6)) . '/' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'penduduk_id' => $pid,
                'pegawai_id' => $staff->id,
                'jenis_surat' => $faker->randomElement([
                    'Kartu Keluarga',
                    'Kartu Tanda Penduduk',
                    'Kartu Identitas Anak',
                    'Surat Keterangan Pindah',
                    'Surat Keterangan Pindah Luar Negeri',
                    'Surat Keterangan Tempat Tinggal',
                    'Surat Keterangan Lahir Mati',
                    'Surat Keterangan Pembatalan Perkawinan',
                    'Surat Keterangan Pengangkatan Anak',
                    'Surat Keterangan Pengganti Tanda Identitas',
                    'Surat Keterangan Pencatatan Sipil',
                    'Akta Kelahiran',
                    'Akta Kematian',
                    'Akta Perkawinan'
                ]),
                'keperluan' => $faker->sentence(6),
                'tanggal_surat' => $date->format('Y-m-d'),
                'status' => $faker->randomElement(['Diterbitkan','Draft','Dibatalkan']),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $pelayananCount = 60;
        for ($i = 0; $i < $pelayananCount; $i++) {
            $pid = $faker->randomElement($pendudukIds);
            $inCurrent = $i < intval($pelayananCount * 0.75);
            $date = $inCurrent ? $now->copy()->subDays(rand(0, max(0, $now->day - 1))) : $now->copy()->subMonths(rand(1,4))->subDays(rand(0,27));

            PelayananDukcapil::create([
                'nomor_permohonan' => 'PLN/' . $date->format('Ym') . '/' . strtoupper(substr($faker->lexify('??????'),0,6)) . '/' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'penduduk_id' => $pid,
                'pegawai_id' => $staff->id,
                'jenis_pelayanan' => $faker->randomElement(['Penerbitan KTP','Pendaftaran Kelahiran','Perubahan Data']),
                'keterangan' => $faker->sentence(6),
                'tanggal_permohonan' => $date->format('Y-m-d'),
                'status' => $faker->randomElement(['Diajukan','Diproses','Selesai','Ditolak']),
                'catatan' => $faker->sentence(4),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        $this->command->info("Seed selesai: pegawai, penduduk, $suratCount surat, $pelayananCount pelayanan (mayoritas di bulan ini)");
    }
}
