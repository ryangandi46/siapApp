@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventaris peminjam</h6>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <!-- MULAI TOMBOL TAMBAH -->
                @can('action')
                    <a class="btn btn-info" id="tombol-tambah" href="{{ route('peminjaman.create') }}">Pinjam Barang</a>
                    <br><br>

                    <!-- Button to Open the Modal -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Open Form Modal
            </button>
            <br><br> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">
                        Import Peminjaman
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih file yang akan di import</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('importexcelPeminjaman') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="file" name="file" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <br></br>
            @endcan


            <!-- AKHIR TOMBOL -->
            <div class="table-responsive">
                <table id="table_peminjaman" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>kelas</th>
                            <th>Nama Barang</th>
                            <th>jumlah</th>
                            <th>waktu Meminjam</th>
                            <th>status</th>
                            <th>waktu Pengembalian</th>
                            <th>keterangan</th>
                            @can('action')
                                <th>Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- start form modal --}}

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form Title</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_peminjam">Nama Peminjam:</label>
                                    <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control"
                                        placeholder="Masukkan nama peminjam" required>
                                </div>

                                <div class="form-group">
                                    <label for="kelas">Kelas:</label>
                                    <input type="text" id="kelas" name="kelas" class="form-control"
                                        placeholder="Masukkan kelas" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama_aset">Nama Aset:</label>
                                    <input type="text" id="nama_aset" name="nama_aset" class="form-control"
                                        placeholder="Masukkan nama aset" required>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control"
                                        placeholder="Masukkan jumlah" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="" disabled selected>Pilih status</option>
                                        <option value="Dipinjam">Dipinjam</option>
                                        <option value="Dikembalikan">Dikembalikan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="waktu_meminjam">Waktu Meminjam:</label>
                                    <input type="datetime-local" id="waktu_meminjam" name="waktu_meminjam"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="waktu_pengembalian">Waktu Pengembalian:</label>
                                    <input type="datetime-local" id="waktu_pengembalian" name="waktu_pengembalian"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan:</label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                {{-- {{-- <!-- Modal Footer --> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- end form modal --}}

    @extends('template.scriptTable')
    <script>
        // new DataTable('#table_peminjam');
        $(document).ready(function() {
            //id dari table diatas
            $('#table_peminjaman').DataTable({
                processing: true,
                //untuk mengaktifkan datatables serverside
                serverSide: true,
                ajax: {
                    //route yang diambol dari controller
                    url: "{{ route('peminjaman.index') }}",
                    type: 'GET'
                },
                //columns data yang akan ditampilkan
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'No',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_peminjam',
                        name: 'nama_peminjam'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'nama_aset',
                        name: 'nama_aset'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'waktu_meminjam',
                        name: 'waktu_meminjam'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'waktu_pengembalian',
                        name: 'waktu_pengembalian'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    @can('action')
                        {
                            data: 'action',
                            name: 'action'
                        },
                    @endcan
                ],
                order: [
                    [0, 'asc'] // dimulai dari dan pilih type urutan data asc/desc
                ],
                drawCallback: function(settings) {
                    var currentPage = settings.page;
                    var startRow = settings._iDisplayStart;

                    $('#table_peminjaman tbody tr').each(function(index, row) {
                        var rowIndex = index + 1;
                        var rowNumber = startRow + rowIndex;
                        $(row).find('td:first').html(rowNumber);
                    });
                }
            });
        });
    </script>
@endsection
