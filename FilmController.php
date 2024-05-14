<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    // Method untuk menampilkan daftar film dengan pagination
    public function index()
    {
        // Ambil daftar film dengan pagination, 8 film per halaman
        $films = Film::paginate(8);
        // Kirim data film ke view 'films'
        return view('films', ['films' => $films]);
    }

    // Method untuk melakukan pencarian film berdasarkan judul
    public function search(Request $request)
    {
        // Ambil kata kunci pencarian dari input form
        $search = $request->input('search');
        // Cari film berdasarkan judul yang mengandung kata kunci pencarian dan lakukan paginasi dengan 10 item per halaman
        $films = Film::where('judul', 'like', '%'.$search.'%')->paginate(10);
        // Kirim data film hasil pencarian ke view 'films'
        return view('films', compact('films'));
    }

    // Method untuk melakukan pencarian film berdasarkan genre
    public function searchGenre(Request $request)
    {
        // Ambil input genre dari form pencarian
        $genre = $request->input('genre');
        // Cari film berdasarkan genre yang dipilih dan lakukan paginasi dengan 10 item per halaman
        $films = Film::where('genre', $genre)->paginate(10);
        // Kirim data film hasil pencarian ke view 'films' bersama dengan parameter genre
        return view('films', ['films' => $films, 'genre' => $genre]);
    }

}
