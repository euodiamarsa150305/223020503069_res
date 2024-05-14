<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class AdminController extends Controller
{
    // Method untuk menampilkan semua film
    public function index()
    {
        // Ambil semua data film dari database
        $films = Film::all();
        // Kirim data film ke view 'admin'
        return view('admin', ['films' => $films]);
    }

    // Method untuk menyimpan film baru
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh user
        $request->validate([
            'judul' => 'required',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric',
            'genre' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Periksa apakah upload file berhasil
        if ($request->hasFile('img')) {
            // Pindahkan file yang diupload ke direktori public/img
            $gambarName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $gambarName);
        } else {
            // Redirect dengan pesan error jika upload file gagal
            return redirect()->route('admin')->with('error', 'File upload failed.');
        }
    
        // Buat instance Film baru dan simpan ke database
        $film = new Film();
        $film->judul = $request->judul;
        $film->harga = $request->harga;
        $film->durasi = $request->durasi;
        $film->genre = $request->genre;
        $film->img = $gambarName;
    
        // Simpan film ke database
        $film->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Film berhasil ditambahkan.');
    }
    

    // Method untuk mengupdate film
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan oleh user
        $request->validate([
            'judul' => 'required',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric',
            'genre' => 'required',
        ]);

        // Temukan film yang akan diupdate berdasarkan ID
        $film = Film::findOrFail($id);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('img')) {
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Pindahkan file gambar baru ke direktori public/img
            $gambarName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $gambarName);
            $film->img = $gambarName;
        }

        // Update informasi film
        $film->judul = $request->judul;
        $film->harga = $request->harga;
        $film->durasi = $request->durasi;
        $film->genre = $request->genre;
        $film->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Film berhasil diperbarui.');
    }

    // Method untuk menghapus film
    public function destroy($id)
    {
        // Temukan film yang akan dihapus berdasarkan ID
        $film = Film::findOrFail($id);
        // Hapus film dari database
        $film->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Film berhasil dihapus.');
    }
}
