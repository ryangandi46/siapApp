<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $peminjaman = Peminjaman::all();
        if ($request->ajax()) {
            return datatables()->of($peminjaman)
                ->addColumn('action', function ($data) {                    
                    $urlEdit = route('peminjaman.edit', $data->id); // Replace with your actual edit route
                    $urlDelete = route('peminjaman.destroy', $data->id); // Replace with your actual delete route

                    $button = '<a href="' . $urlEdit . '" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<form action="' . $urlDelete . '" method="POST" style="display:inline-block">';
                    $button .= csrf_field();
                    $button .= method_field('DELETE'); // Add method field for DELETE request
                    $button .= '<button type="submit" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                    $button .= '</form>';
                    return '<div class="text-center">' . $button . '</div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
       
        return view('peminjam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
          //validate the input
          $request->validate([
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'nama_aset' => 'required',
            'jumlah' => 'required',
            'status' => 'required|in:Dipinjam, Dikembalikan',
            'waktu_meminjam' => 'required',
            'waktu_pengembalian' => '',
            'keterangan' => 'required'
        ]);

        //create a new product in the database
        Peminjaman::create($request->all());

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
        $asets = Aset::all(); //query untuk menampilkan data dari model
        $peminjam = Peminjaman::all(); //query untuk menampilkan data dari model
        return view('peminjam.edit', compact('asets','peminjaman')); //compact untuk pasing data ke halaman create
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
        $request->validate([
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'nama_peminjam' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'waktu_meminjam' => 'required',
            'waktu_pengembalian' => 'required',
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
        $peminjaman->delete();

         //redirect the user adn display succes message
         return redirect()->route('peminjaman.index')->with('success', 'peminjams Deleted Succressfully');
    }
}
