@extends('templateLayout')

@extends('template.headTable')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add Peminjaman</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('peminjaman.index') }}"> Back</a>
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
                    action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penanggungJawab" class="control-label">Penanggung Jawab</label>
                                <input type="text" name="penanggungJawab" id="penanggungJawab" class="form-control" placeholder="PenanggungJawab"
                                    value="{{ auth()->user()->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_peminjam" class="control-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                                    placeholder="Nama Peminjam" value="" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label for="kelas" class="control-label">Kelas</label>
                                <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas"
                                    value="" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_aset" class="control-label">Nama Barang</label>
                                <select name="nama_aset" id="nama_aset" class="form-control" required>
                                    <option value="" disabled selected>Pilih Nama Barang</option>
                                    @foreach ($asets as $aset)
                                        <option value="{{ $aset->id }}">{{ $aset->nama_aset }} - {{ $aset->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah" class="control-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Jumlah" value="" required>
                            </div>
                            {{-- <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>- Pilih Status -</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                        </div> --}}

                            <div class="form-group">
                                <label for="waktu_meminjam" class="control-label">Waktu Meminjam</label>
                                <input type="datetime-local" name="waktu_meminjam" id="waktu_meminjam" class="form-control"
                                    placeholder="Waktu Meminjam" value="" required>
                            </div>

                            {{-- <div class="form-group">
                            <label for="waktu_pengembalian" class="control-label">Waktu Pengembalian</label>
                            <input type="datetime-local" name="waktu_pengembalian" id="waktu_pengembalian" class="form-control" placeholder="Waktu Pengembalian" value="">
                        </div> --}}

                            <div class="form-group">
                                <label for="keterangan" class="control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary" id="tombol-simpan" value="create">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
