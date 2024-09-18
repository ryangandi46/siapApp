<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Imports\PeminjamanImport;
use PhpParser\Node\Stmt\Else_;

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
                ->editColumn('nama_aset', function ($peminjaman) {
                    return $peminjaman->aset->nama_aset; // Fetch the related asset name
                })
                ->editColumn('penanggung_jawab', function ($user) {
                    return $user->user->name; // Fetch the related asset name
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
    public function store(Request $request, Peminjaman $peminjaman)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        //validate the input
        $request->validate([
            'penanggung_jawab' => '',
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'nama_aset' => 'required',
            'jumlah' => 'required',
            'kondisi_dipinjam' => 'required',
            'waktu_meminjam' => 'required',
            'keterangan' => '',
            'berita_acara' => 'nullable' // Contoh validasi file
            // 'berita_acara' => 'nullable|mimes:pdf,doc,docx|max:5120', // Validasi file
        ]);

        //create a new product in the database
        $peminjaman = new Peminjaman($request->all());

        // Jika ada file yang diupload
        if ($request->file('berita_acara')) {
            // Ambil file yang diupload
            $file = $request->file('berita_acara');

            // Beri nama unik untuk file (misalnya: berita_acara_123456789.pdf)
            $filename = 'berita_acara_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage (misalnya di folder storage/app/public/berita_acara)
            $file->storeAs('public/berita_acara', $filename);

            // Simpan nama file ke dalam variabel untuk disimpan di database
            $beritaAcaraFile = $filename;
        }


        $peminjaman->berita_acara = $peminjaman->berita_acara ? $beritaAcaraFile : null; // Simpan nama file jika ada
        $peminjaman->nama_peminjam = $request->nama_peminjam;

        $peminjaman->status = 'Dipinjam';
        $peminjaman->save();

        // redirect the user and send friendly message
        return redirect()->route('peminjaman.index')->with('success', 'Berhasil Menambahkan Data Peminjaman');
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
            'kondisi_dipinjam' => 'required',
            'kondisi_dikembalikan' => '',
            'status' => 'required',
            'waktu_meminjam' => 'required',
            'waktu_pengembalian' => '',
            'keterangan' => '',
            'berita_acara' => 'nullable' // Contoh validasi file
        ]);

        //update a  product in the database
        $peminjaman->update($request->all());

        if ($request->file('berita_acara')) {
            // Ambil file yang diupload
            $file = $request->file('berita_acara');

            // Beri nama unik untuk file (misalnya: berita_acara_123456789.pdf)
            $filename = 'berita_acara_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage (misalnya di folder storage/app/public/berita_acara)
            $file->storeAs('public/berita_acara', $filename);

            // Jika ada file berita acara sebelumnya, hapus file lama
            if ($peminjaman->berita_acara) {
                Storage::delete('public/berita_acara/' . $peminjaman->berita_acara);
            }

            // Simpan nama file ke dalam variabel untuk disimpan di database
            $beritaAcaraFile = $filename;
            $peminjaman->berita_acara = $peminjaman->berita_acara ? $beritaAcaraFile : null;
            // $peminjaman->update($request->berita_acara($beritaAcaraFile));
        }



        $peminjaman->save();

        // redirect the user and send friendly message
        return redirect()->route('peminjaman.index')->with('success', 'Data Peminjaman Berhasil Di Upadate');
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
        if ($peminjaman->berita_acara && Storage::exists('public/berita_acara/' . $peminjaman->berita_acara)) {
            // Hapus file dari storage
            Storage::delete('public/berita_acara/' . $peminjaman->berita_acara);

            // Hapus nama file dari database (optional, jika ingin mengosongkan kolom berita_acara)
            $peminjaman->berita_acara = null;
        }

        $peminjaman->delete();
        // $peminjaman->save();

        //redirect the user adn display succes message
        return redirect()->route('peminjaman.index')->with('success', 'Data Peminjaman Berhasil Dihapus');
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
        $this->authorize('action'); //pengecekan izin akses masuk
        $peminjaman = Peminjaman::find($request->id);
        $peminjaman->kondisi_dikembalikan = $request->kondisi_dikembalikan;
        $peminjaman->waktu_pengembalian = now();
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        return response()->json(['success' => 'Barang berhasil dikembalikan']);
        // return response()->with('success', 'Aset Telah Dikembalikan');
    }
    public function downloadTemplatePeminjaman()
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename=template_aset.xlsx',
        ];

        return response()->download(public_path('templateExcel/template-import-peminjaman.xlsx'), 'template_peminjaman.xlsx', $headers);
        return redirect()->route('peminjaman.index')->with('success', 'Tamplate Berhasil Di Download');
    }

    public function downloadTemplateBeritaAcara()
    {
        // $file = storage_path('app/public/templates/template_berita_acara.docx');

        // Set flash message sebelum return response download
        session()->flash('success', 'File berhasil diunduh!');
        // return redirect()->route('peminjaman.index')->with('success', 'Tamplate Berhasil Di Download');
        return response()->download(public_path('templates/tamplate_berita_acara.docx'));
    }

    public function downloadBeritaAcara($filename)
    {
        $this->authorize('action'); //pengecekan izin akses masuk
        // Cek apakah file ada di storage
        // if (Storage::exists('public/berita_acara/' . $filename)) {
        //     // Download file
        //     return Storage::download('public/berita_acara/' . $filename);
        // } else {
        //     return redirect()->back()->with('error', 'File tidak ditemukan.');
        // }
        return response()->download(storage_path('storage/app/public/berita_acara/' . $filename));
        return redirect()->route('peminjaman.index')->with('success', 'Berhasil Mendownload Berita Acara');
    }
}
