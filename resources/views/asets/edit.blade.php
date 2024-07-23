@extends('templateLayout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Aset</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Aset</h2>
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

            <form action="{{ route('aset.update', $aset->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Nama Aset:</strong>
                            <input type="text" name="nama_aset" value="{{ $aset->nama_aset }}" class="form-control"
                                placeholder="Nama Aaset">
                        </div>

                        <div class="form-group">
                            <strong>Spesifikasi:</strong>
                            <input type="text" name="merek" value="{{ $aset->merek }}" class="form-control"
                                placeholder="Merek">
                        </div>

                        <div class="form-group">
                            <strong>Lokasi:</strong>
                            <input type="text" name="lokasi" value="{{ $aset->lokasi }}" class="form-control"
                                placeholder="Lokasi">
                        </div>

                        <div class="form-group">
                            <strong>Jumlah Satuan:</strong>
                            <input type="number" name="jumlah_satuan" value="{{ $aset->jumlah_satuan }}"
                                class="form-control" placeholder="Jumlah Satuan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Tanggal Pembelian:</strong>
                            <input type="date" name="tanggal_pembelian" value="{{ $aset->tanggal_pembelian }}"
                                class="form-control" placeholder="Tanggal Pembelian">
                        </div>


                        <div class="form-group">
                            <label for="jurusan" class="control-label">Jurusan :</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="{{ $aset->jurusan }}">{{ $aset->jurusan }}</option>
                                <option value="TKJ">TKJ</option>
                                <option value="AKL">AKL</option>                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kondisi" class="control-label">Kondisi :</label>
                            <select class="form-control" id="kondisi" name="kondisi" required>
                                <option value="{{ $aset->kondisi }}">{{ $aset->kondisi }}</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak Sedang">Rusak Sedang</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <strong>Keterangan:</strong>
                            <textarea class="form-control" style="height:150px" name="keterangan" placeholder="Keterangan">{{ $aset->keterangan }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12  text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    @endsection
