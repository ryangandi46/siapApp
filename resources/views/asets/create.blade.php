@extends('templateLayout')



@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Aset</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add Aset</h2>
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

            <div class="container" id="tambah-edit-form">
                <div class="header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                </div>
                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal"
                    action="{{ route('aset.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_aset" class="control-label">Nama Aset</label>
                                <input type="text" class="form-control" id="nama_aset" name="nama_aset"
                                    placeholder="Nama Aset" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="merek" class="control-label">Spesifikasi</label>
                                <input type="text" name="merek" id="merek" class="form-control"
                                    placeholder="Spesifikasi" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="lokasi" class="control-label">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control"
                                    placeholder="Lokasi" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_satuan" class="control-label">Jumlah Satuan</label>
                                <input type="number" name="jumlah_satuan" id="jumlah_satuan" class="form-control"
                                    placeholder="Jumlah Satuan" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_pembelian" class="control-label">Tanggal Pembelian</label>
                                <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control"
                                    placeholder="Tanggal Pembelian" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="harga_pembelian" class="control-label">Harga Pembelian</label>
                                <input type="number" name="harga_pembelian" id="harga_pembelian" class="form-control"
                                    placeholder="Harga Pembelian" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="kondisi" class="control-label">Kondisi</label>
                                <select class="form-control" id="kondisi" name="kondisi" required>
                                    <option value="">- Pilih -</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Sedang">Rusak Sedang</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keterangan" class="control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary" id="tombol-simpan"
                                value="create">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
