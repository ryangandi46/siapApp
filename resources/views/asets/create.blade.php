@extends('templateLayout')



@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Aset</h2>
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
    {{-- 
<form action="{{ route('aset.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Aset:</strong>
                <input type="text" name="nama_aset" class="form-control" placeholder="Nama Aaset">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Aset:</strong>
                <input type="text" name="jenis_aset" class="form-control" placeholder="Jenis Aaset">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Merek:</strong>
                <input type="text" name="merek" class="form-control" placeholder="Merek">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Model:</strong>
                <input type="text" name="model" class="form-control" placeholder="Model">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nomor Seri:</strong>
                <input type="text" name="nomor_seri" class="form-control" placeholder="Nomor Seri">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kondisi:</strong>
                <input type="text" name="kondisi" class="form-control" placeholder="Kondisi">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi:</strong>
                <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>tanggal Pembelian:</strong>
                <input type="date" name="tanggal_pembelian" class="form-control" placeholder="Tanggal Pembelian">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga Pembelian:</strong>
                <input type="number" name="harga_pembelian" class="form-control" placeholder="Harga Pembelian">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan:</strong>
                <textarea class="form-control" style="height:150px" name="keterangan" placeholder="Keterangan"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div> --}}

    <div class="container" id="tambah-edit-form">
        <div class="header">
            <h5 class="modal-title" id="modal-judul"></h5>
        </div>
        {{-- <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal"> --}}
            <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal" action="{{ route('aset.store') }}" method="POST">
                @csrf
            <input type="hidden" name="id" id="id">
        <br>        
            <div class="form-group">
                <label for="nama_aset" class="control-label">Nama Aset</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Nama Aset" value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="merek" class="control-label">Spesifikasi</label>
                <div class="col-sm-12">
                    <input type="text" name="merek" id="merek" class="form-control" placeholder="Spesifikasi"
                        value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi" class="control-label">Lokasi</label>
                <div class="col-sm-12">
                    <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi"
                        value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="jumlah_satuan" class="control-label">Jumlah Satuan</label>
                <div class="col-sm-12">
                    <input type="number" name="jumlah_satuan" id="jumlah_satuan" class="form-control" placeholder="Jumlah Satuan"
                        value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_pembelian" class="control-label">Tanggal Pembelian</label>
                <div class="col-sm-12">
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control"
                        placeholder="Tanggal Pembelian" value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="harga_pembelian" class="control-label">Harga Pembelian</label>
                <div class="col-sm-12">
                    <input type="number" name="harga_pembelian" id="harga_pembelian" class="form-control"
                        placeholder="Harga Pembelian" value="" required>
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="kondisi" class="control-label">Kondisi</label>
                <div class="col-sm-12">
                    <input type="text" name="kondisi" id="kondisi" class="form-control" placeholder="Kondisi"
                        value="" required>
                </div>
            </div> -->

            <div class="form-group">
                <div class="col-sm-12">
                <label for="kondisi">Kondisi :</label>
                <select class="form-control" id="kondisi" name="kondisi" required>
                  <option value="">- Pilih -</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak Sedang">Rusak Sedang</option>
                  <option value="Rusak Berat">Rusak Berat</option>
                </select>
                </div>
              </div>

            <div class="form-group">
                <label for="keterangan" class="control-label">Keterangan</label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="tombol-simpan" value="create">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
