@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit peminjaman</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('peminjaman.index') }}"> Back</a>
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

            <div class="container" id="tambah-edit-form">
                <div class="header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                </div>
                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal"
                    action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penanggung_jawab" class="control-label">Penanggung Jawab</label>
                                <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control" placeholder="Penanggung_jawab"
                                    value="{{ $peminjaman->user->name  }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_peminjam" class="control-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                                    placeholder="Nama Peminjam" value="{{ $peminjaman->nama_peminjam }}" required>
                            </div>

                            <div class="form-group">
                                <label for="kelas" class="control-label">Kelas</label>
                                <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas"
                                    value="{{ $peminjaman->kelas }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_aset" class="control-label">Nama Barang</label>
                                <select name="nama_aset" id="nama_aset" class="form-control" required>                               
                                    <option value="{{ $peminjaman->nama_aset }}">{{ $peminjaman->aset->nama_aset }} - {{ $peminjaman->aset->jurusan }}</option>
                                    @foreach ($asets as $aset)
                                        <option value="{{ $aset->id }}">{{ $aset->nama_aset }} - {{ $aset->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah" class="control-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Jumlah" value="{{ $peminjaman->jumlah }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="{{ $peminjaman->status }}">{{ $peminjaman->status }}</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Dikembalikan">Dikembalikan</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="waktu_meminjam" class="control-label">Waktu Meminjam</label>
                                <input type="datetime-local" name="waktu_meminjam" id="waktu_meminjam" class="form-control"
                                    placeholder="Waktu Meminjam" value="{{ $peminjaman->waktu_meminjam }}" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu_pengembalian" class="control-label">Waktu Pengembalian</label>
                                <input type="datetime-local" name="waktu_pengembalian" id="waktu_pengembalian"
                                    class="form-control" placeholder="Waktu Pengembalian"
                                    value="{{ $peminjaman->waktu_pengembalian }}">
                            </div>

                            <div class="form-group">
                                <label for="keterangan" class="control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" required>{{ $peminjaman->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary" id="tombol-simpan" value="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
