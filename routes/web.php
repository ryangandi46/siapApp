<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
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

Route::get('/', function () {
    return view('dashboard');
});



Route::resource('aset', AsetController::class)->middleware('auth');
Route::resource('login', LoginController::class);
Route::resource('register', RegisterController::class)->middleware('guest');
Route::resource('dashboard', DashboardController::class)->middleware('auth'); //tambahakan middleware supaya tidak dapat mengakses url dan harus login terlebih dahulu
Route::resource('user', UserController::class)->middleware('can:isAdmin');
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');
Route::resource('laporan', LaporanController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/changepassword', [UserController::class, 'changePassword'])->name('changepassword')->middleware('can:view');
Route::get('/changepass', [UserController::class, 'changePasswordForm'])->name('changepass')->middleware('can:view');
Route::get('/exportpdf', [LaporanController::class, 'exportpdf'])->name('exportpdf')->middleware('can:action');
Route::get('/exportexcel', [LaporanController::class, 'exportexcel'])->name('exportexcel')->middleware('can:action');
Route::post('/importexcel', [AsetController::class, 'importexcel'])->name('importexcel')->middleware('can:action');
Route::post('/importexcel', [PeminjamanController::class, 'importexcel'])->name('importexcel')->middleware('can:action');

// Route::get('/peminjaman/create', function () {
//     return view('peminjam.create');
// })->name('peminjaman.create');
