<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

use App\Imports\PeminjamanImport;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view'); //pengecekan izin akses masuk
        // $peminjaman = Peminjaman::all();
        // Get all peminjaman records with the related aset names
        $peminjaman = Peminjaman::with('aset')->get();
        $user = Peminjaman::with('user')->get();

        if ($request->ajax()) {
            return datatables()->of($peminjaman)
            ->editColumn('nama_aset', function($peminjaman) {
                return $peminjaman->aset->nama_aset ; // Fetch the related asset name
            })
            ->editColumn('penanggung_jawab', function($user) {
                return $user->user->name ; // Fetch the related asset name
            })
                ->addColumn('action', function ($data) {
                    $urlEdit = route('peminjaman.edit', $data->id); // Replace with your actual edit route
                    $urlDelete = route('peminjaman.destroy', $data->id); // Replace with your actual delete route

                    $button = ''; // Inisialisasi $button dengan string kosong

                    if (Gate::allows('action')) {
                        $button = '<a href="' . $urlEdit . '" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<form action="' . $urlDelete . '" method="POST" style="display:inline-block">';
                        $button .= csrf_field();
                        $button .= method_field('DELETE'); // Add method field for DELETE request
                        $button .= '<button type="submit" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                        $button .= '</form>';
                    }
                    return '<div class="text-center">' . $button . '</div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('peminjam.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        $asets = Aset::all(); //query untuk menampilkan data dari model
        return view('peminjam.create', compact('asets')); //compact untuk pasing data ke halaman create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        //validate the input
        $request->validate([
            'penanggung_jawab' => '',
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'nama_aset' => 'required',
            'jumlah' => 'required',
            'waktu_meminjam' => 'required',
            'keterangan' => ''
        ]);

        //create a new product in the database
        $peminjaman = new Peminjaman($request->all());
        $peminjaman->status = 'Dipinjam';
        $peminjaman->save();

        // redirect the user and send friendly message
        return redirect()->route('peminjaman.index')->with('success', 'peminjams Created Succressfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        $asets = Aset::all(); //query untuk menampilkan data dari model
        $peminjam = Peminjaman::all(); //query untuk menampilkan data dari model
        return view('peminjam.edit', compact('asets', 'peminjaman')); //compact untuk pasing data ke halaman create
        // return view('peminjam.edit', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        $request->validate([
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'nama_aset' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'waktu_meminjam' => 'required',
            'waktu_pengembalian' => '',
            'keterangan' => ''
        ]);

        //update a  product in the database
        $peminjaman->update($request->all());

        // redirect the user and send friendly message
        return redirect()->route('peminjaman.index')->with('success', 'peminjams Updated Succressfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        $peminjaman->delete();

        //redirect the user adn display succes message
        return redirect()->route('peminjaman.index')->with('success', 'peminjams Deleted Succressfully');
    }

    public function importexcelPeminjaman(Request $request)
    {
        $this->authorize('import-excel');
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName(); //mengambil nama bawaan dari file yang di import
        $data->move('PeminjamanData', $namafile); //memindahkan data ke directory peminjaman data

        //data yang diimport diletakan di AsetData dan mengambil nama file dari bawaan nama file yang diimport
        Excel::import(new PeminjamanImport, \public_path('/PeminjamanData/' . $namafile));
        return \redirect()->back();
    }

    public function pengembalianAset(Request $request)
    {
        $peminjaman = Peminjaman::find($request->id);
        $peminjaman->waktu_pengembalian = now();
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        return response()->json(['success' => true]);
    }
    public function downloadTemplatePeminjaman()
    {
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename=template_aset.xlsx',
        ];

        return response()->download(public_path('templateExcel/contoh_tamplate.xlsx'), 'template_aset.xlsx', $headers);
    }
}
