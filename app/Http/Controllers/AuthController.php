<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        $pegawai = Pegawai::where('nip', $request->nip)
                          ->where('is_active', true)
                          ->first();

        if ($pegawai && Hash::check($request->password, $pegawai->password)) {
            Auth::guard('pegawai')->login($pegawai);
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['nip' => 'NIP atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('pegawai')->logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
