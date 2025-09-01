<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PelayananDukcapil;
use App\Models\Penduduk;

class PelayananDukcapilController extends Controller
{
    public function index(Request $request)
    {
        $query = PelayananDukcapil::with(['penduduk', 'pegawai']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nomor_permohonan', 'like', "%{$search}%")
                  ->orWhere('jenis_pelayanan', 'like', "%{$search}%")
                  ->orWhereHas('penduduk', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pelayanan = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pelayanan.index', compact('pelayanan'));
    }

    public function create()
    {
        $penduduks = Penduduk::where('status', 'Aktif')->get();
        return view('pelayanan.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_pelayanan' => 'required|string',
            'keterangan' => 'required|string',
            'tanggal_permohonan' => 'required|date',
        ]);

        $nomorPermohonan = $this->generateNomorPermohonan();

        PelayananDukcapil::create([
            'nomor_permohonan' => $nomorPermohonan,
            'penduduk_id' => $request->penduduk_id,
            'pegawai_id' => Auth::guard('pegawai')->id(),
            'jenis_pelayanan' => $request->jenis_pelayanan,
            'keterangan' => $request->keterangan,
            'tanggal_permohonan' => $request->tanggal_permohonan,
        ]);

        return redirect()->route('pelayanan.index')->with('success', 'Permohonan berhasil dibuat!');
    }

    public function show(PelayananDukcapil $pelayanan)
    {
        return view('pelayanan.show', compact('pelayanan'));
    }

    public function edit(PelayananDukcapil $pelayanan)
    {
        $penduduks = Penduduk::where('status', 'Aktif')->get();
        return view('pelayanan.edit', compact('pelayanan', 'penduduks'));
    }

    public function update(Request $request, PelayananDukcapil $pelayanan)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_pelayanan' => 'required|string',
            'keterangan' => 'required|string',
            'tanggal_permohonan' => 'required|date',
            'status' => 'required|in:Diajukan,Diproses,Selesai,Ditolak',
            'catatan' => 'nullable|string',
        ]);

        $pelayanan->update($request->all());

        return redirect()->route('pelayanan.index')->with('success', 'Data pelayanan berhasil diperbarui!');
    }

    public function destroy(PelayananDukcapil $pelayanan)
    {
        $pelayanan->delete();
        return redirect()->route('pelayanan.index')->with('success', 'Data pelayanan berhasil dihapus!');
    }

    private function generateNomorPermohonan()
    {
        $year = date('Y');
        $month = date('m');
        $lastPermohonan = PelayananDukcapil::whereYear('created_at', $year)
                                          ->whereMonth('created_at', $month)
                                          ->count();

        $number = str_pad($lastPermohonan + 1, 3, '0', STR_PAD_LEFT);
        return "DUKCAPIL/{$number}/{$month}/{$year}";
    }
}
