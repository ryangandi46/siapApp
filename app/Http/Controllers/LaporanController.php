<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;



use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view');
        if ($request->ajax()) {
            $query = Peminjaman::query();

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('waktu_meminjam', [$request->start_date, $request->end_date]);
            }

            return FacadesDataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }

        return view('laporan.index');
    }

    public function exportpdf(Request $request)
    {
        $this->authorize('action');
        // $data = Peminjaman::all();

        // view()->share('data', $data);
        // $pdf = FacadePdf::loadview('laporanPeminjaman-pdf');
        // return $pdf->download('laporan-peminjaman.pdf');       

        // Mendapatkan tanggal awal dan akhir dari request
        $tanggal_awal = $request->get('start_date');
        $tanggal_akhir = $request->get('end_date');

        // Melakukan query data peminjaman berdasarkan tanggal filter
        if ($tanggal_awal && $tanggal_akhir) {
            $data = Peminjaman::whereBetween('waktu_meminjam', [$tanggal_awal, $tanggal_akhir])->get();
        } else {
            $data = Peminjaman::all();
        }

        // Membagikan data ke view
        view()->share('data', $data);

        // Memuat view PDF dan generate PDF
        $pdf = FacadePdf::loadview('laporanPeminjaman-pdf');
        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function exportexcel(Request $request)
    {
        $this->authorize('action');
        // return Excel::download(new LaporanExport, 'laporan-peminjaman.xlsx');
        // Get start and end dates from the request
        $tanggal_awal = $request->get('start_date');
        $tanggal_akhir = $request->get('end_date');

        // Query data based on date filter
        $data = Peminjaman::whereBetween('waktu_meminjam', [$tanggal_awal, $tanggal_akhir])->get();

        // Prepare Excel export using Laravel Excel
        return Excel::download(new LaporanExport($data), 'laporan-peminjaman.xlsx');
    }
}
