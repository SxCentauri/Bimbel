<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 1. Cek Role ADMIN
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // 2. Cek Role GURU
            elseif ($user->role === 'guru') {
                return redirect()->route('dashboard');
            }

            // 3. Default: SISWA
            return redirect()->route('ruang.index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function daftar()
    {
        return view('daftar');
    }

    public function daftarProses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa', // Default pendaftaran umum tetap 'siswa'
        ]);

        Auth::login($user);

        return redirect()->route('ruang.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
    
    public function akunguru()
    {
        $guru = User::where('role', 'guru')->get();
        return view('dashboard.akun-guru', compact('guru'));
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('akun-guru')
            ->with('success', 'Akun guru berhasil ditambahkan.');
    }

    // ======================
    // TAMPIL HALAMAN GANTI PASSWORD
    // ======================
    public function showGantiPassword()
    {
        return view('ganti-password');
    }

    // ======================
    // PROSES GANTI PASSWORD
    // ======================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
        // Update password baru
        $user->password = Hash::make($request->password);

        return redirect()->route('dashboard')->with('success', 'Password berhasil diubah.');
    }
}