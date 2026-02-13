<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\IsAdmin::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index(Request $request)
    {
        $query = Pegawai::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
        }

        $pegawais = $query->paginate(10);
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:18|unique:pegawais',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|string|max:255',
            'level' => 'required|in:admin,staff',
            'is_active' => 'boolean',
        ]);

        Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'level' => $request->level,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nip' => 'required|string|max:18|unique:pegawais,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais,email,' . $pegawai->id,
            'jabatan' => 'required|string|max:255',
            'level' => 'required|in:admin,staff',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['nip', 'nama', 'email', 'jabatan', 'level']);
        $data['is_active'] = $request->is_active ?? true;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}
