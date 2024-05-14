<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman daftar film
use App\Http\Controllers\FilmController;
Route::get('/films', [FilmController::class, 'index'])->name('films.index');

// Route untuk pencarian film berdasarkan judul
Route::get('/films/search', [FilmController::class, 'search'])->name('films.search');

// Route untuk pencarian film berdasarkan genre
Route::get('/films/searchGenre', [FilmController::class, 'searchGenre'])->name('films.searchGenre');

// Route untuk proses login, tampilkan halaman login, dan proses registrasi
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk CRUD admin
use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'index'])->name('admin'); // Menampilkan daftar film oleh admin
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create'); // Menampilkan form tambah film oleh admin
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store'); // Proses penyimpanan film oleh admin
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Menampilkan form edit film oleh admin
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update'); // Proses update film oleh admin
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Proses penghapusan film oleh admin

