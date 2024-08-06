<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Peminjaman $peminjaman)
    {
        $asets = Aset::all(); //query untuk menampilkan data dari model
        // $peminjaman = Peminjaman::all(); //query untuk menampilkan data dari model
        // $peminjaman = Peminjaman::where('status', 'Dipinjam')->paginate(10); // Atur jumlah item per halaman sesuai kebutuhan
        // return view('dashboard', compact('asets', 'peminjaman'));

        // Mengambil data aset yang terlambat dikembalikan (lebih dari satu hari)
        // $overdueLoans = DB::table('peminjaman', 'asets')
        //     ->where('waktu_pengembalian', '<', now())
        //     ->where('status', '!=', 'dikembalikan')
        //     ->with('aset')
        //     ->get();

        // // Menghitung jumlah aset yang sedang dipinjam
        // $asetDipinjam = DB::table('peminjaman')
        //     ->where('status', 'Dipinjam')
        //     ->get();

        // $overdueLoans = Peminjaman::with('aset')
        //     ->where('waktu_pengembalian', '<', now())
        //     ->where('status', '!=', 'dikembalikan')
        //     ->get();


        // // Menghitung jumlah peminjaman yang terlambat dikembalikan
        // $overdueCount = $overdueLoans->count();

        // // Mengambil data aset yang sedang dipinjam
        // $asetDipinjam = Peminjaman::with('aset')
        //     ->where('status', 'Dipinjam')
        //     ->get();


        // $overdueCount = $overdueLoans->count();
        // $listPeminjaman = $asetDipinjam->count();

        // Mengambil data peminjaman yang belum dikembalikan dan sudah melewati waktu pengembalian dengan pagination
        $overdueLoans = Peminjaman::with('aset')
            ->where('waktu_pengembalian', '<', now())
            ->where('status', '!=', 'dikembalikan')
            // ->latest()
            ->paginate(10); // Atur jumlah item per halaman sesuai kebutuhan

        // Menghitung jumlah peminjaman yang terlambat dikembalikan
        $overdueCount = Peminjaman::where('waktu_pengembalian', '<', now())
            ->where('status', '!=', 'dikembalikan')
            ->count();

        // Mengambil data aset yang sedang dipinjam dengan pagination
        $asetDipinjam = Peminjaman::with('aset')
            ->where('status', 'Dipinjam')
            // ->latest()
            ->paginate(10); // Atur jumlah item per halaman sesuai kebutuhan

        // Menghitung jumlah aset yang sedang dipinjam
        $listPeminjaman = Peminjaman::where('status', 'Dipinjam')->count();


        // Data peminjaman lainnya
        // $peminjaman = Peminjaman::all();

        return view('dashboard', compact('asets', 'peminjaman', 'overdueLoans', 'overdueCount', 'asetDipinjam', 'listPeminjaman'))->with(request()->input('page'));
    }
}
