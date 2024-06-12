@extends('asets.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('aset.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('aset.update',$aset->id) }}" method="POST">
        @csrf
        @method('PUT')
    
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Aset:</strong>
                    <input type="text" name="nama_aset" value="{{ $aset->nama_aset }}" class="form-control" placeholder="Nama Aaset">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis Aset:</strong>
                    <input type="text" name="jenis_aset" value="{{ $aset->jenis_aset }}" class="form-control" placeholder="Jenis Aaset">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Merek:</strong>
                    <input type="text" name="merek" value="{{ $aset->merek }}" class="form-control" placeholder="Merek">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Model:</strong>
                    <input type="text" name="model" value="{{ $aset->model }}" class="form-control" placeholder="Model">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Seri:</strong>
                    <input type="text" name="nomor_seri" value="{{ $aset->nomor_seri }}" class="form-control" placeholder="Nomor Seri">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kondisi:</strong>
                    <input type="text" name="kondisi" value="{{ $aset->kondisi }}" class="form-control" placeholder="Kondisi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi:</strong>
                    <input type="text" name="lokasi" value="{{ $aset->lokasi }}" class="form-control" placeholder="Lokasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>tanggal Pembelian:</strong>
                    <input type="date" name="tanggal_pembelian" value="{{ $aset->tanggal_pembelian }}" class="form-control" placeholder="Tanggal Pembelian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Pembelian:</strong>
                    <input type="number" name="harga_pembelian" value="{{ $aset->harga_pembelian }}" class="form-control" placeholder="Harga Pembelian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kondisi:</strong>
                    <input type="text" name="kondisi" value="{{ $aset->kondisi }}" class="form-control" placeholder="Kondisi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Keterangan:</strong>
                    <textarea class="form-control" style="height:150px" name="keterangan" placeholder="Keterangan">{{ $aset->keterangan }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    
    </form>
@endsection