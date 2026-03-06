<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // <-- Wajib dipanggil untuk bikin user baru
use Illuminate\Support\Facades\Hash; // <-- Wajib dipanggil untuk enkripsi password

class AuthController extends Controller
{
    // ==============================================================
    // 1. FUNGSI UNTUK MEMPROSES LOGIN
    // ==============================================================
    public function loginPost(Request $request)
    {
        // 1. VALIDASI: Pastikan user mengisi form (tidak boleh kosong)
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!'
        ]);

        // 2. MAPPING: Petakan input 'username' dari form HTML ke kolom 'email' di Database
        $credentials = [
            'email'    => $request->input('username'), 
            'password' => $request->input('password')
        ];

        // 3. AUTENTIKASI: Coba login pakai email dan password
        if (Auth::attempt($credentials)) {
            
            // 4. KEAMANAN: Regenerasi session untuk mencegah serangan pencurian sesi
            $request->session()->regenerate();

            // 5. SUKSES: Arahkan ke halaman Home
            return redirect()->intended('/home'); 
        }

        // 6. GAGAL: Kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Email atau Password yang Anda masukkan salah!')->onlyInput('username');
    }

    // ==============================================================
    // 2. FUNGSI UNTUK MEMPROSES LOGOUT
    // ==============================================================
    public function logout(Request $request)
    {
        // Melakukan proses logout
        Auth::logout();
        
        // Menghapus sesi yang aktif (Standar keamanan)
        $request->session()->invalidate();
        
        // Memperbarui token CSRF (Standar keamanan)
        $request->session()->regenerateToken();

        // Mengembalikan user ke halaman awal (login)
        return redirect('/');
    }

    // ==============================================================
    // 3. FUNGSI UNTUK MEMPROSES REGISTER (TAMBAHAN BARU)
    // ==============================================================
    public function registerPost(Request $request)
    {
        // 1. VALIDASI: Pastikan form diisi dengan benar
        $request->validate([
            'username' => 'required|email|unique:users,email', // username = email, harus unik
            'password' => 'required|min:6|confirmed' // confirmed ngecek 'password_confirmation'
        ], [
            'username.required'  => 'Email wajib diisi!',
            'username.email'     => 'Format email tidak valid!',
            'username.unique'    => 'Email ini sudah terdaftar bosku!',
            'password.required'  => 'Password wajib diisi!',
            'password.min'       => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!'
        ]);

        // 2. SIMPAN KE DATABASE: Bikin user baru
        User::create([
            'name'     => 'Admin Skripsi', // Nama default, karena di form kamu nggak ada input Nama
            'email'    => $request->username, // Input username dari form dimasukkan ke kolom email
            'password' => Hash::make($request->password), // Enkripsi password biar aman dari hacker!
        ]);

        // 3. SUKSES: Arahkan ke halaman Login dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login bosku.');
    }
}