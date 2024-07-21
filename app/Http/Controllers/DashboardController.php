<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index(Peminjaman $peminjaman)
    {
        $asets = Aset::all(); //query untuk menampilkan data dari model
        $peminjaman = Peminjaman::all(); //query untuk menampilkan data dari model
        return view('dashboard', compact('asets','peminjaman'));
    }
}
