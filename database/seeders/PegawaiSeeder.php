<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        // Admin
        Pegawai::create([
            'nip' => '198501012010011001',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@simduk.com',
            'password' => Hash::make('admin123'),
            'jabatan' => 'Administrator Sistem',
            'level' => 'admin',
            'is_active' => true,
        ]);

        // Staff Pelayanan Dukcapil
        Pegawai::create([
            'nip' => '198502022010012002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Pelayanan Dukcapil',
            'level' => 'staff',
            'is_active' => true,
        ]);

        // Staff Verifikasi Data
        Pegawai::create([
            'nip' => '198603032010013003',
            'nama' => 'Ahmad Wijaya',
            'email' => 'ahmad.wijaya@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Verifikasi Data',
            'level' => 'staff',
            'is_active' => true,
        ]);

        // Staff Input Data
        Pegawai::create([
            'nip' => '198704042010014004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi.lestari@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Input Data',
            'level' => 'staff',
            'is_active' => true,
        ]);

        // Staff Arsip
        Pegawai::create([
            'nip' => '198805052010015005',
            'nama' => 'Rudi Hermawan',
            'email' => 'rudi.hermawan@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Arsip dan Dokumentasi',
            'level' => 'staff',
            'is_active' => true,
        ]);

        // Kepala Bidang
        Pegawai::create([
            'nip' => '198401061994032001',
            'nama' => 'Ir. Hendra Gunawan, M.Si',
            'email' => 'hendra.gunawan@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Kepala Bidang Dukcapil',
            'level' => 'staff',
            'is_active' => true,
        ]);

        // Staff Nonaktif
        Pegawai::create([
            'nip' => '198906062010016006',
            'nama' => 'Eka Prasetyo',
            'email' => 'eka.prasetyo@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Pelayanan (Cuti)',
            'level' => 'staff',
            'is_active' => false,
        ]);
    }
}

