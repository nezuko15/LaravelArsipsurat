<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});


Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/about', [PageController::class, 'about'])->name('about');

	Route::get('/kategori', [PageController::class, 'kategori'])->name('kategori');
	Route::get('/kategori/tambah', [PageController::class, 'kategoriTambah'])->name('kategori.tambah');
	Route::post('/kategori/tambah/simpan', [PageController::class, 'kategoriSimpan'])->name('kategori.tambah.simpan');
	Route::get('/kategori/edit/{id}', [PageController::class, 'kategoriEdit'])->name('kategori.edit');
	Route::post('/kategori/update/{id}', [PageController::class, 'kategoriUpdate'])->name('kategori.update');
	Route::get('/kategori/hapus/{id}', [PageController::class, 'kategoriHapus'])->name('kategori.hapus');

	Route::get('/arsip', [PageController::class, 'arsip'])->name('arsip');
	Route::get('/arsip/tambah', [PageController::class, 'arsipTambah'])->name('arsip.tambah');
	Route::post('/arsip/tambah/simpan', [PageController::class, 'arsipSimpan'])->name('arsip.tambah.simpan');
	Route::get('/arsip/lihat/{id}', [PageController::class, 'arsipLihat'])->name('arsip.lihat');
	Route::get('/arsip/edit/{id}', [PageController::class, 'arsipEdit'])->name('arsip.edit');
	Route::put('/arsip/update/{id}', [PageController::class, 'arsipUpdate'])->name('arsip.update');
	Route::get('/arsip/hapus/{id}', [PageController::class, 'arsipHapus'])->name('arsip.hapus');

	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
