<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'alamat', 'rt', 'rw', 'agama', 'status_perkawinan', 'pekerjaan',
        'kewarganegaraan', 'no_telepon', 'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    public function pelayananDukcapils()
    {
        return $this->hasMany(PelayananDukcapil::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}
