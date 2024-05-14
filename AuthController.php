<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Method untuk melakukan proses login
    public function login(Request $request)
    {
        // Ambil data email dan password dari request
        $credentials = $request->only('email', 'password');

        // Lakukan proses otentikasi
        if (Auth::attempt($credentials)) {
            // Jika otentikasi berhasil, arahkan ke halaman daftar film
            return redirect()->route('films.index');
        }

        // Jika otentikasi gagal, kembali ke halaman sebelumnya dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Method untuk menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Method untuk melakukan proses registrasi
    public function register(Request $request)
    {
        // Validasi data yang dikirimkan oleh user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru berdasarkan data yang diterima
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
