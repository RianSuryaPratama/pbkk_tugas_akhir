<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Page\PaketController;
use App\Http\Controllers\Page\PelangganController;
use App\Http\Controllers\Page\UserController;
use App\Http\Controllers\Page\TransaksiController;

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

Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	dd("Sudah Bersih nih!, Silahkan Kembali ke Halaman Utama");
});
Route::get('/', function () {
	return view('page.login');
})->name('login');
Route::post('auth/request_login',[AuthController::class,'ceklogin'])->name('ceklogin');
Route::get('auth/logout',[AuthController::class,'logout'])->name('logout');


Route::prefix('page')->group(function() {
	Route::middleware(['auth', 'ceklevel:Owner,Admin'])->group(function() {
		Route::get('dashboard',[HomeController::class,'index'])->name('index.dashboard');
	});

	Route::middleware(['auth', 'ceklevel:Admin'])->prefix('data_master')->group(function() {
		Route::get('paket',[PaketController::class,'index'])->name('index.paket');
		Route::post('paket/save',[PaketController::class,'save'])->name('save.paket');
		Route::get('paket/get_edit/{id_paket}',[PaketController::class,'get_edit']);
		Route::post('paket/update',[PaketController::class,'update'])->name('update.paket');
		Route::get('paket/destroy/{id_paket}',[PaketController::class,'delete']);

		Route::get('pelanggan',[PelangganController::class,'index'])->name('index.pelanggan');
		Route::post('pelanggan/save',[PelangganController::class,'save'])->name('save.pelanggan');
		Route::get('pelanggan/get_edit/{id_pelanggan}',[PelangganController::class,'get_edit']);
		Route::post('pelanggan/update',[PelangganController::class,'update'])->name('update.pelanggan');
		Route::get('pelanggan/destroy/{id_pelanggan}',[PelangganController::class,'delete']);
	});
	Route::middleware(['auth', 'ceklevel:Owner'])->prefix('data_master')->group(function() {
		Route::get('user',[UserController::class,'index'])->name('index.user');
		Route::post('user/save',[UserController::class,'save'])->name('save.user');
		Route::get('user/get_edit/{id_pelanggan}',[UserController::class,'get_edit']);
		Route::post('user/update',[UserController::class,'update'])->name('update.user');
		Route::get('user/destroy/{id_pelanggan}',[UserController::class,'delete']);
	});
	Route::middleware(['auth', 'ceklevel:Owner,Admin'])->prefix('transaksi')->group(function() {
		Route::get('transaksi',[TransaksiController::class,'index'])->name('index.transaksi');
		Route::post('transaksi/save',[TransaksiController::class,'save'])->name('save.transaksi');
		Route::get('transaksi/get_edit/{id_transaksi}',[TransaksiController::class,'get_edit']);
		Route::post('transaksi/update',[TransaksiController::class,'update'])->name('update.transaksi');
		Route::get('transaksi/destroy/{id_transaksi}',[TransaksiController::class,'delete']);

		Route::get('invoice/{id_transaksi}',[TransaksiController::class,'invoice'])->name('invoice');
	});
	Route::middleware(['auth', 'ceklevel:Owner'])->prefix('transaksi')->group(function() {
		Route::get('riwayat_transaksi',[TransaksiController::class,'riwayat_transaksi'])->name('index.riwayat_transaksi');
	});
	Route::middleware(['auth', 'ceklevel:Owner,Admin'])->prefix('laporan')->group(function() {
		Route::get('transaksi',[TransaksiController::class,'laporan'])->name('index.laporan');
		Route::get('transaksi/export',[TransaksiController::class,'export_laporan'])->name('export_laporan');
	});
	Route::get('myprofil',[HomeController::class,'myprofil'])->name('myprofil');
	Route::post('myprofil/update',[HomeController::class,'update_profil'])->name('update_profil');
});
