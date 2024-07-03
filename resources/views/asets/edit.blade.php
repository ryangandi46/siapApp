@extends('templateLayout')

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

    <br>
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
                    <strong>Spesifikasi:</strong>
                    <input type="text" name="merek" value="{{ $aset->merek }}" class="form-control" placeholder="Merek">
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
                    <strong>Jumlah Satuan:</strong>
                    <input type="number" name="jumlah_satuan" value="{{ $aset->jumlah_satuan }}" class="form-control" placeholder="Jumlah Satuan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Pembelian:</strong>
                    <input type="date" name="tanggal_pembelian" value="{{ $aset->tanggal_pembelian }}" class="form-control" placeholder="Tanggal Pembelian">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Pembelian:</strong>
                    <input type="number" name="harga_pembelian" value="{{ $aset->harga_pembelian }}" class="form-control" placeholder="Harga Pembelian">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="kondisi" value="{{ $aset->kondisi }}">Kondisi :</label>
                <select class="form-control" id="kondisi" name="kondisi"  required>
                  <option value="{{ $aset->kondisi }}">{{ $aset->kondisi }}</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak Sedang">Rusak Sedang</option>
                  <option value="Rusak Berat">Rusak Berat</option>
                </select>
                </div>
              </div>

            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kondisi:</strong>
                    <input type="text" name="kondisi" value="" class="form-control" placeholder="Kondisi">
                </div>
            </div> -->

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Keterangan:</strong>
                    <textarea class="form-control" style="height:150px" name="keterangan" placeholder="Keterangan">{{ $aset->keterangan }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    
    </form>
@endsection