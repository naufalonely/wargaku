<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat', 'penduduk_id', 'pegawai_id', 'jenis_surat',
        'keperluan', 'tanggal_surat', 'status'
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
