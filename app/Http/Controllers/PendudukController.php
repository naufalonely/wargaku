<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('tempat_lahir', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $penduduks = $query->paginate(10);
        return view('penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:penduduks',
            'nama' => 'required|string|max:255',
            'tempat_lahir_type' => 'required|in:Kota,Kabupaten',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'agama' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'kabupaten_kota' => 'required|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
        ]);

        $data = $request->only([
            'nik','nama','tempat_lahir_type','tempat_lahir','tanggal_lahir','jenis_kelamin',
            'alamat','rt','rw','agama','status_perkawinan','pekerjaan','kewarganegaraan',
            'no_telepon','kabupaten_kota','kecamatan','kelurahan','status'
        ]);

        // ensure NIK stored as digits only
        $data['nik'] = preg_replace('/\D+/', '', $data['nik']);

        if (empty($data['status'])) $data['status'] = 'Aktif';

        Penduduk::create($data);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir_type' => 'required|in:Kota,Kabupaten',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'agama' => 'required|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'status' => 'required|in:Aktif,Pindah,Meninggal',
            'kabupaten_kota' => 'required|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
        ]);

        $data = $request->only([
            'nik','nama','tempat_lahir_type','tempat_lahir','tanggal_lahir','jenis_kelamin',
            'alamat','rt','rw','agama','status_perkawinan','pekerjaan','kewarganegaraan',
            'no_telepon','kabupaten_kota','kecamatan','kelurahan','status'
        ]);
        $data['nik'] = preg_replace('/\D+/', '', $data['nik']);

        $penduduk->update($data);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }

    // AJAX search for penduduk by name or NIK
    public function search(Request $request)
    {
        $q = $request->get('q', '');

        $results = Penduduk::where('nama', 'like', "%{$q}%")
            ->orWhere('nik', 'like', "%{$q}%")
            ->limit(10)
            ->get(['id', 'nama', 'nik', 'tanggal_lahir']);

        return response()->json($results);
    }
}
