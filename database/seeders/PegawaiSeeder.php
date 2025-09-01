<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::create([
            'nip' => '198501012010011001',
            'nama' => 'Administrator',
            'email' => 'admin@simduk.com',
            'password' => Hash::make('admin123'),
            'jabatan' => 'Administrator Sistem',
            'level' => 'admin',
        ]);

        Pegawai::create([
            'nip' => '198502022010012002',
            'nama' => 'Staff Pelayanan',
            'email' => 'staff@simduk.com',
            'password' => Hash::make('staff123'),
            'jabatan' => 'Staff Pelayanan',
            'level' => 'staff',
        ]);

        Pegawai::create([
            'nip' => '10122264',
            'nama' => 'Atmin Ori',
            'email' => 'atmin@simduk.com',
            'password' => Hash::make('atmin123'),
            'jabatan' => 'Administrator Sistem',
            'level' => 'admin',
        ]);
    }
}
