<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Tampilkan form ganti password.
     */
    public function edit()
    {
        // Pastikan nama view ini sesuai dengan lokasi file blade Anda
        // Misalnya file tadi disimpan di: resources/views/auth/change-password.blade.php
        return view('ganti-password');
    }

    /**
     * Proses update password.
     */
    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => ['required', 'current_password'], // 'current_password' adalah validasi bawaan Laravel untuk cek password lama
            'password' => ['required', 'confirmed', 'min:8'], // 'confirmed' akan otomatis mengecek kesamaan dengan field 'password_confirmation'
        ], [
            // Custom pesan error (opsional, agar bahasa Indonesia)
            'current_password.current_password' => 'Password lama yang Anda masukkan salah.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        // 2. Update Password di Database
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        // 3. Redirect kembali dengan pesan sukses
        return back()->with('success', 'Password berhasil diperbarui!');
    }
}