<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\Exports\LaporanExportAset;
use Maatwebsite\Excel\Facades\Excel;


use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class LaporanAsetController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view');
      
        if ($request->ajax()) {
            $query = Aset::query();

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('tanggal_pembelian', [$request->start_date, $request->end_date]);
            }
            if ($request->filled('jurusan')) {
                $query->where('jurusan', $request->jurusan);
            }
            
           

            return FacadesDataTables::of($query)              
                ->addIndexColumn()
                ->make(true);
        }

        return view('laporan.laporanAset');
    }

    public function exportpdfAset(Request $request)
    {
        $this->authorize('action');
        // $data = Aset::all();

        // view()->share('data', $data);
        // $pdf = FacadePdf::loadview('laporanAset-pdf');
        // return $pdf->download('laporan-Aset.pdf');       

        // Mendapatkan tanggal awal dan akhir dari request
        $tanggal_awal = $request->get('start_date');
        $tanggal_akhir = $request->get('end_date');
        $jurusan = $request->get('jurusan');

        // Melakukan query data Aset berdasarkan tanggal filter
        $query = Aset::query();

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal_pembelian', [$tanggal_awal, $tanggal_akhir]);
        }

        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }

        $data = $query->get();


        // Membagikan data ke view
        view()->share('data', $data);

        // Memuat view PDF dan generate PDF
        $pdf = FacadePdf::loadview('laporan.laporanAset-pdf');
        return $pdf->download('laporan.laporan-Aset.pdf');
    }

    public function exportexcelAset(Request $request)
    {
        $this->authorize('action');
        // return Excel::download(new LaporanExport, 'laporan-Aset.xlsx');
        // Get start and end dates from the request
        $tanggal_awal = $request->get('start_date');
        $tanggal_akhir = $request->get('end_date');
        $jurusan = $request->get('jurusan');

        // Query data based on date filter
        // $data = Aset::where('tanggal_pembelian', 'jurusan', [$tanggal_awal, $tanggal_akhir, $jurusan])->get();

        $query = Aset::query();

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal_pembelian', [$tanggal_awal, $tanggal_akhir]);
        }

        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }

        $data = $query->get();

        // Prepare Excel export using Laravel Excel
        return Excel::download(new LaporanExportAset($data), 'laporan-Aset.xlsx');
    }
}
