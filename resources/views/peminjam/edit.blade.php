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
                    action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penanggung_jawab" class="control-label">Penanggung Jawab</label>
                                <input type="text" id="penanggung_jawab" class="form-control"
                                    placeholder="Penanggung_jawab" value="{{ $peminjaman->user->name }}" readonly>
                            </div>
                            <!-- Hidden field untuk menyimpan ID pengguna -->
                            <input type="hidden" name="penanggung_jawab" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="nama_peminjam" class="control-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                                    placeholder="Nama Peminjam" value="{{ $peminjaman->nama_peminjam }}" required>
                            </div>

                            <div class="form-group">
                                <label for="kelas" class="control-label">Kelas</label>
                                <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas"
                                    value="{{ $peminjaman->kelas }}" maxlength="4" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_aset" class="control-label">Nama Barang</label>
                                <select name="nama_aset" id="nama_aset" class="form-control" required>
                                    <option value="{{ $peminjaman->nama_aset }}">{{ $peminjaman->aset->nama_aset }} -
                                        {{ $peminjaman->aset->jurusan }}</option>
                                    @foreach ($asets as $aset)
                                        <option value="{{ $aset->id }}">{{ $aset->nama_aset }} - {{ $aset->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah" class="control-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Jumlah" value="{{ $peminjaman->jumlah }}" required>
                            </div>


                            <div class="form-group">
                                <!-- Jika ada berita acara sebelumnya, tampilkan link download -->
                                @if ($peminjaman->berita_acara)
                                    <div class="form-group d-flex align-items-center">
                                        <label for="berita_acara" class="mr-3">Berita Acara Saat Ini:</label>

                                        <!-- Input field untuk berita acara -->
                                        <input type="text" class="form-control mr-3" style="flex: 1;"
                                            value="{{ $peminjaman->berita_acara }}" readonly>

                                        <!-- Tombol untuk download berita acara -->
                                        <a href="{{ asset('storage/berita_acara/' . $peminjaman->berita_acara) }}"
                                            class="btn btn-success" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                @endif
                                <label for="berita_acara">Unggah Berita Acara (.PDF, .DOC, .DOCX)</label>
                                <input type="file" name="berita_acara" id="berita_acara" class="form-control"
                                    value="{{ $peminjaman->berita_acara }}" accept=".pdf,.doc,.docx">
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kondisi_dipinjam" class="control-label">Kondisi Dipinjam</label>
                                <select class="form-control" id="kondisi_dipinjam" name="kondisi_dipinjam" required>
                                    <option value="{{ $peminjaman->kondisi_dipinjam }}">
                                        {{ $peminjaman->kondisi_dipinjam }}</option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Rusak Sedang">Rusak Sedang</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>

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
                                <input type="datetime-local" name="waktu_meminjam" id="waktu_meminjam"
                                    class="form-control" placeholder="Waktu Meminjam"
                                    value="{{ $peminjaman->waktu_meminjam }}" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu_pengembalian" class="control-label">Waktu Pengembalian</label>
                                <input type="datetime-local" name="waktu_pengembalian" id="waktu_pengembalian"
                                    class="form-control" placeholder="Waktu Pengembalian"
                                    value="{{ $peminjaman->waktu_pengembalian }}">
                            </div>

                            <div class="form-group">
                                <label for="kondisi_dikembalikan" class="control-label">Kondisi Dikembalikan</label>
                                <select class="form-control" id="kondisi_dikembalikan" name="kondisi_dikembalikan">
                                    <option value="{{ $peminjaman->kondisi_dikembalikan }}">
                                        {{ $peminjaman->kondisi_dikembalikan }}</option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Rusak Sedang">Rusak Sedang</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
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
