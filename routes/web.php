<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use  App\Livewire\Produk;
use App\Livewire\Transaksi;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', Beranda::class,)->middleware(['auth'])->name('dashboard');

Auth::routes();
Route::get('/home', Beranda::class,)->middleware(['auth'])->name('home');
Route::get('/user', User::class,)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class,)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class,)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class,)->middleware(['auth'])->name('transaksi');
Route::get('/cetak', ['App\Http\Controllers\HomeController', 'cetak']);
Route::get('/laporan/view/pdf', [Laporan::class, 'view_pdf']);
