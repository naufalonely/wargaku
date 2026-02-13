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
        // Mapping target total population per region (match keys used in dashboard normalization)
        $targetTotals = [
            'bandung' => 3519243,
            'bandung barat' => 2887654,
            'bekasi' => 3102345,
            'bogor' => 5809790,
            'ciamis' => 1496543,
            'cianjur' => 2638825,
            'cirebon' => 2951234,
            'garut' => 2629303,
            'indramayu' => 1765432,
            'karawang' => 2145678,
            'kuningan' => 1198456,
            'majalengka' => 1234567,
            'pangandaran' => 1012345,
            'purwakarta' => 1012345,
            'subang' => 1456789,
            'sukabumi' => 2868493,
            'sumedang' => 1056789,
            'tasikmalaya' => 1985394,
            'kota bandung' => 2394875,
            'kota banjar' => 201234,
            'kota bekasi' => 2401234,
            'kota bogor' => 1072485,
            'kota cimahi' => 567890,
            'kota cirebon' => 341234,
            'kota depok' => 2034567,
            'kota sukabumi' => 350000,
            'kota tasikmalaya' => 634567,
        ];

        // scale down factor to keep seeded rows reasonable; can be overridden via env SEED_SCALE
        $scale = intval(env('SEED_SCALE', 10000));

        // Helper normalize: keep 'kota ' prefix for cities to distinguish
        $normalize = function($name) {
            $lower = mb_strtolower(trim($name));
            if (strpos($lower, 'kota ') === 0) {
                return $lower; // e.g. 'kota bandung'
            }
            // remove 'kabupaten ' prefix if present
            $lower = preg_replace('/^kabupaten\s+/', '', $lower);
            return $lower;
        };

        $regions = [
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

        // create one known record
        Penduduk::create([
            'nik' => '3273010101010010',
            'nama' => 'Jason Susanto',
                    'tempat_lahir_type' => 'Kota',
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
                    'kabupaten_kota' => 'Kota Bandung',
                    'kecamatan' => 'Coblong',
                    'kelurahan' => 'Dago',
        ]);

        foreach ($regions as $region) {
            $key = $normalize($region);
            $target = $targetTotals[$key] ?? 100000; // fallback if not defined
            $count = max(1, intval(round($target / $scale)));

            for ($i = 0; $i < $count; $i++) {
                $gender = $faker->randomElement(['L', 'P']);
                $pekerjaan = $faker->randomElement(['Pegawai Swasta', 'Wiraswasta', 'Mahasiswa', 'Pelajar', 'Ibu Rumah Tangga', 'Buruh', 'Petani']);
                $statusPerkawinan = $faker->randomElement(['Belum Kawin', 'Kawin']);

                $isCity = stripos($region, 'Kota') === 0;
                $kecamatan = 'Kec. ' . $faker->word();
                $kelurahan = 'Kel. ' . $faker->word();

                Penduduk::create([
                    'nik' => $faker->unique()->numerify('################'),
                    'nama' => $faker->name($gender == 'L' ? 'male' : 'female'),
                    'tempat_lahir_type' => $isCity ? 'Kota' : 'Kabupaten',
                    'tempat_lahir' => $region,
                    'tanggal_lahir' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                    'jenis_kelamin' => $gender,
                    'alamat' => $faker->streetAddress . ', ' . $region,
                    'rt' => $faker->numerify('00#'),
                    'rw' => $faker->numerify('00#'),
                    'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                    'status_perkawinan' => $statusPerkawinan,
                    'pekerjaan' => $pekerjaan,
                    'kewarganegaraan' => 'WNI',
                    'no_telepon' => $faker->unique()->phoneNumber,
                    'status' => $faker->randomElement(['Aktif', 'Aktif', 'Aktif', 'Pindah', 'Meninggal']),
                    'kabupaten_kota' => $region,
                    'kecamatan' => $kecamatan,
                    'kelurahan' => $kelurahan,
                ]);
            }
        }
    }
}
