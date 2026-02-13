<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\PelayananDukcapil;
use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalPenduduk' => Penduduk::where('status', 'Aktif')->count(),
            'totalPegawai' => Pegawai::where('is_active', true)->count(),
            'totalSurat' => Surat::whereMonth('created_at', date('m'))->count(),
            'totalPelayanan' => PelayananDukcapil::whereMonth('created_at', date('m'))->count(),
            'pendudukPria' => Penduduk::where('jenis_kelamin', 'L')->where('status', 'Aktif')->count(),
            'pendudukWanita' => Penduduk::where('jenis_kelamin', 'P')->where('status', 'Aktif')->count(),
            'suratTerbaru' => Surat::with(['penduduk', 'pegawai'])->latest()->take(5)->get(),
            'pelayananTerbaru' => PelayananDukcapil::with(['penduduk', 'pegawai'])->latest()->take(5)->get(),
        ];

        $statistik = \App\Models\Penduduk::select(
        'kabupaten_kota',
        DB::raw('COUNT(*) as total_penduduk'),
        DB::raw('SUM(CASE WHEN jenis_kelamin="L" THEN 1 ELSE 0 END) as laki_laki'),
        DB::raw('SUM(CASE WHEN jenis_kelamin="P" THEN 1 ELSE 0 END) as perempuan')
        )
        ->where('status', 'Aktif')
        ->groupBy('kabupaten_kota')
        ->get();


        return view('dashboard', compact('data', 'statistik'));
    }
}
