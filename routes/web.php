<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
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
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// Route::post('/peminjaman', [LoginController::class, 'create']);

// Route::get('/peminjaman/create', function () {
//     return view('peminjam.create');
// })->name('peminjaman.create');
