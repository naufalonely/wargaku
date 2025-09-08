<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Penduduk;
use Faker\Factory as Faker;

class PendudukSeeder extends Seeder
{
    /**
     * Jalankan seed untuk database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $kabupatenKotaJabar = [
            'Kabupaten Bandung', 'Kabupaten Bandung Barat', 'Kabupaten Bekasi',
            'Kabupaten Bogor', 'Kabupaten Ciamis', 'Kabupaten Cianjur',
            'Kabupaten Cirebon', 'Kabupaten Garut', 'Kabupaten Indramayu',
            'Kabupaten Karawang', 'Kabupaten Kuningan', 'Kabupaten Majalengka',
            'Kabupaten Pangandaran', 'Kabupaten Purwakarta', 'Kabupaten Subang',
            'Kabupaten Sukabumi', 'Kabupaten Sumedang', 'Kabupaten Tasikmalaya',
            'Kota Bandung', 'Kota Banjar', 'Kota Bekasi', 'Kota Bogor',
            'Kota Cimahi', 'Kota Cirebon', 'Kota Depok', 'Kota Sukabumi',
            'Kota Tasikmalaya'
        ];

        Penduduk::create([
            'nik' => '3273010101010010',
            'nama' => 'Jason Susanto',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Merdeka No. 10',
            'rt' => '001',
            'rw' => '001',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'PNS',
            'kewarganegaraan' => 'WNI',
            'no_telepon' => '081234567890',
            'status' => 'Aktif',
        ]);

        for ($i = 0; $i < 30; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $pekerjaan = $faker->randomElement(['Pegawai Swasta', 'Wiraswasta', 'Mahasiswa', 'Pelajar', 'Ibu Rumah Tangga', 'Buruh', 'Petani']);
            $statusPerkawinan = $faker->randomElement(['Belum Kawin', 'Kawin']);

            Penduduk::create([
                'nik' => $faker->unique()->numerify('################'),
                'nama' => $faker->name($gender == 'L' ? 'male' : 'female'),
                'tempat_lahir' => $faker->randomElement($kabupatenKotaJabar),
                'tanggal_lahir' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'jenis_kelamin' => $gender,
                'alamat' => $faker->streetAddress . ', ' . $faker->randomElement($kabupatenKotaJabar),
                'rt' => $faker->numerify('00#'),
                'rw' => $faker->numerify('00#'),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'status_perkawinan' => $statusPerkawinan,
                'pekerjaan' => $pekerjaan,
                'kewarganegaraan' => 'WNI',
                'no_telepon' => $faker->unique()->phoneNumber,
                'status' => $faker->randomElement(['Aktif', 'Aktif', 'Aktif', 'Pindah', 'Meninggal']),
            ]);
        }
    }
}
