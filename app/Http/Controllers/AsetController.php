<?php

namespace App\Http\Controllers;

use App\Imports\AsetImport;
use Dataatables;
use App\Models\Aset;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $aset = Aset::latest()->paginate(10);

        $this->authorize('view'); //pengecekan izin akses masuk

        $aset = Aset::all();
        if ($request->ajax()) {
            return datatables()->of($aset)
                ->addColumn('action', function ($data) {
                    $urlShow = route('aset.show', $data->id); // Replace with your actual show route
                    $urlEdit = route('aset.edit', $data->id); // Replace with your actual edit route
                    $urlDelete = route('aset.destroy', $data->id); // Replace with your actual delete route

                    $button = '<a href="' . $urlShow . '" class="detail btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';
                    $userRole = auth()->user()->jabatan;
                    if (in_array($userRole, ['admin', 'sarana', 'kaprog'])) {
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="' . $urlEdit . '" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></a>';
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


        // return view('asets.index', compact('aset'))->with(request()->input('page'));
        return view('asets.index');
        // return response()->json($aset);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('action');
        return view('asets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('action');
        //validate the input
        $request->validate([
            'nama_aset' => 'required',
            'merek' => 'required',
            'lokasi' => 'required',
            'jumlah_satuan' => 'required',
            'tanggal_pembelian' => 'required',
            'harga_pembelian' => 'required',
            'kondisi' => 'required|in:Baik,Rusak Sedang,Rusak Berat',
            'keterangan' => ''
        ]);

        //create a new product in the database
        Aset::create($request->all());

        // redirect the user and send friendly message
        return redirect()->route('aset.index')->with('success', 'Asets Created Succressfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */


    public function show(Aset $aset)
    {
        $this->authorize('view');
        return view('asets.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function edit(Aset $aset)
    {
        $this->authorize('action');
        return view('asets.edit', compact('aset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aset $aset)
    {
        $this->authorize('action');
        $request->validate([
            'nama_aset' => 'required',
            'merek' => 'required',
            'lokasi' => 'required',
            'jumlah_satuan' => 'required',
            'tanggal_pembelian' => 'required',
            'harga_pembelian' => 'required',
            'kondisi' => 'required',
            'keterangan' => ''
        ]);

        //update a  product in the database
        $aset->update($request->all());

        // redirect the user and send friendly message
        return redirect()->route('aset.index')->with('success', 'Asets Updated Succressfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aset $aset)
    {
        $this->authorize('action');
        // delete the aset
        $aset->delete();


        //redirect the user adn display succes message
        return redirect()->route('aset.index')->with('success', 'Asets Deleted Succressfully');
    }

    public function importexcel(Request $request)
    {
        $this->authorize('import-excel');

        $data = $request->file('file');

        $namafile = $data->getClientOriginalName(); //mengambil nama bawaan dari file yang di import
        $data->move('AsetData', $namafile);

        //data yang diimport diletakan di AsetData dan mengambil nama file dari bawaan nama file yang diimport
        Excel::import(new AsetImport, \public_path('/AsetData/' . $namafile));
        return \redirect()->back();
    }
}
