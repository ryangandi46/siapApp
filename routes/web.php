<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanAsetController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Aset;
use App\Models\Peminjaman;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('aset', AsetController::class)->middleware('auth');
Route::resource('login', LoginController::class);
Route::resource('register', RegisterController::class)->middleware('guest');
Route::resource('dashboard', DashboardController::class)->middleware('auth'); //tambahakan middleware supaya tidak dapat mengakses url dan harus login terlebih dahulu
Route::resource('user', UserController::class)->middleware('can:isAdmin');
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');
Route::resource('laporan', LaporanController::class)->middleware('auth');
Route::resource('laporanAset', LaporanAsetController::class)->middleware('auth');
// Route::resource('laporanPeminjaman', LaporanController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/changepassword', [UserController::class, 'changePassword'])->name('changepassword')->middleware('can:view');
Route::get('/changepass', [UserController::class, 'changePasswordForm'])->name('changepass')->middleware('can:view');
Route::get('/exportpdfPeminjaman', [LaporanController::class, 'exportpdfPeminjaman'])->name('exportpdfPeminjaman')->middleware('can:action');
Route::get('/exportpdfAset', [LaporanAsetController::class, 'exportpdfAset'])->name('exportpdfAset')->middleware('can:action');
Route::get('/exportexcelPeminjaman', [LaporanController::class, 'exportexcelPeminjaman'])->name('exportexcelPeminjaman')->middleware('can:action');
Route::get('/exportexcelAset', [LaporanAsetController::class, 'exportexcelAset'])->name('exportexcelAset')->middleware('can:action');
Route::post('/importexcelAset', [AsetController::class, 'importexcelAset'])->name('importexcelAset')->middleware('can:action');
Route::post('/importexcelPeminjaman', [PeminjamanController::class, 'importexcelPeminjaman'])->name('importexcelPeminjaman')->middleware('can:action');
Route::post('/pengembalianAset', [PeminjamanController::class, 'pengembalianAset'])->name('pengembalianAset')->middleware('can:action');
Route::get('/laporanPeminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('laporanPeminjaman')->middleware('can:action');
Route::get('/downloadTemplateAset', [AsetController::class, 'downloadTemplateAset'])->name('downloadTemplateAset')->middleware('can:action');
Route::get('/downloadTemplatePeminjaman', [PeminjamanController::class, 'downloadTemplatePeminjaman'])->name('downloadTemplatePeminjaman')->middleware('can:action');

// Route::get('/peminjaman/create', function () {
//     return view('peminjam.create');
// })->name('peminjaman.create');
