<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Penduduk;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with(['penduduk', 'pegawai']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('jenis_surat', 'like', "%{$search}%")
                  ->orWhereHas('penduduk', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        $surats = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('surat.index', compact('surats'));
    }

    public function create()
    {
        $penduduks = Penduduk::where('status', 'Aktif')->get();
        return view('surat.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_surat' => 'required|date',
        ]);

        $nomorSurat = $this->generateNomorSurat();

        Surat::create([
            'nomor_surat' => $nomorSurat,
            'penduduk_id' => $request->penduduk_id,
            'pegawai_id' => Auth::guard('pegawai')->id(),
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'tanggal_surat' => $request->tanggal_surat,
            'status' => 'Diterbitkan',
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat!');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        $penduduks = Penduduk::where('status', 'Aktif')->get();
        return view('surat.edit', compact('surat', 'penduduks'));
    }

    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'status' => 'required|in:Draft,Diterbitkan,Dibatalkan',
        ]);

        $surat->update($request->all());

        return redirect()->route('surat.index')->with('success', 'Data surat berhasil diperbarui!');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Data surat berhasil dihapus!');
    }

    private function generateNomorSurat()
    {
        $year = date('Y');
        $month = date('m');
        $lastSurat = Surat::whereYear('created_at', $year)
                          ->whereMonth('created_at', $month)
                          ->count();

        $number = str_pad($lastSurat + 1, 3, '0', STR_PAD_LEFT);
        return "SK/{$number}/{$month}/{$year}";
    }
}
