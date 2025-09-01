<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananDukcapil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_permohonan', 'penduduk_id', 'pegawai_id', 'jenis_pelayanan',
        'keterangan', 'tanggal_permohonan', 'status', 'catatan'
    ];

    protected $casts = [
        'tanggal_permohonan' => 'date',
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
