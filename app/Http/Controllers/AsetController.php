<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aset = Aset::latest()->paginate(10);

        return view('asets.index', compact('aset'))->with(request()->input('page'));
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
        return redirect()->route('aset.index')->with('success','Asets Created Succressfully');
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
        return redirect()->route('aset.index')->with('success','Asets Updated Succressfully');
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
        return redirect()->route('aset.index')->with('success','Asets Deleted Succressfully');

    }
}
