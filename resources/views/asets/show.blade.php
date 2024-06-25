@extends('templateLayout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show aset</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('aset.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card-columns" >
    <div class="card bg-primary">
      <div class="card-body text-center">
        <p class="card-text" style="color: white;">Name Aset: {{ $aset->nama_aset }}</p>
        <p class="card-text" style="color: white;">Spesifikasi: {{ $aset->merek }}</p>
        <p class="card-text" style="color: white;">Lokasi: {{ $aset->lokasi }}</p>
        <p class="card-text" style="color: white;">Jumlah satuan: {{ $aset->jumlah_satuan }}</p>
        <p class="card-text" style="color: white;">Tanggal Pembelian: {{ $aset->tanggal_pembelian }}</p>
        <p class="card-text" style="color: white;">Harga Pembelian: {{ $aset->harga_pembelian }}</p>
        <p class="card-text" style="color: white;">Kondisi: {{ $aset->kondisi }}</p>
        <p class="card-text" style="color: white;">Keterangan: {{ $aset->keterangan }}</p>
      </div>
    </div>

    <!--<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name Aset:</strong>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spesifikasi:</strong>
              
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi:</strong>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah satuan:</strong>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Pembelian:</strong>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga Pembelian:</strong>
              
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>kondisi:</strong>
               
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan:</strong>
            
            </div>
        </div>
    </div>-->
@endsection