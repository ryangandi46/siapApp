<?php

namespace App\Http\Controllers;

use Dataatables;
use App\Models\Aset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        $aset = Aset::all();
        if ($request->ajax()) {
            return datatables()->of($aset)
                ->addColumn('action', function ($data) {
                    $urlShow = route('aset.show', $data->id); // Replace with your actual show route
                    $urlEdit = route('aset.edit', $data->id); // Replace with your actual edit route
                    $urlDelete = route('aset.destroy', $data->id); // Replace with your actual delete route

                   
                    $button = '<a href="' . $urlShow . '" class="detail btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="' . $urlEdit . '" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></a>';
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


        // return view('asets.index', compact('aset'))->with(request()->input('page'));
        return view('asets.table');
        // return response()->json($aset);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //validate the input
        $request->validate([
            'nama_aset' => 'required',
            'jenis_aset' => 'required',
            'merek' => 'required',
            'model' => 'required',
            'nomor_seri' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
            'tanggal_pembelian' => 'required',
            'harga_pembelian' => 'required',
            'keterangan' => 'required'
        ]);

        //create a new product in the database
        Aset::create($request->all());

        // redirect the user and send friendly message
        return redirect()->route('aset.index')->with('success', 'Asets Created Succressfully');

        // $id = $request->id;

        // $post   =   Aset::updateOrCreate(
        //     ['id' => $id],
        //     [
        //         'nama_aset' => $request->nama_aset,
        //         'jenis_aset' => $request->jenis_aset,
        //         'merek' => $request->merek,
        //         'model' => $request->model,
        //         'nomor_seri' => $request->nomor_seri,
        //         'kondisi' => $request->kondisi,
        //         'lokasi' => $request->lokasi,
        //         'tanggal_pembelian' => $request->tanggal_pemebelian,
        //         'harga_pembelian' => $request->harga_pembelian,
        //         'keterangan' => $request->keterangan,
        //     ]
        // );

        // return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aset  $aset
     * @return \Illuminate\Http\Response
     */
    public function show(Aset $aset)
    {
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
        //validate the input
        $request->validate([
            'nama_aset' => 'required',
            'jenis_aset' => 'required',
            'merek' => 'required',
            'model' => 'required',
            'nomor_seri' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
            'tanggal_pembelian' => 'required',
            'harga_pembelian' => 'required',
            'keterangan' => 'required'
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
        // delete the aset
        $aset->delete();


        //redirect the user adn display succes message
        return redirect()->route('aset.index')->with('success', 'Asets Deleted Succressfully');
    }
}
