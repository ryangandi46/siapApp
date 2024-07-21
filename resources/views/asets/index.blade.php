@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventaris Aset</h6>
        </div>
        <div class="card-body">
            @can('action')
                <div class="d-flex">
                    <!-- MULAI TOMBOL TAMBAH -->
                    <a class="btn btn-info" id="tombol-tambah" href="{{ route('aset.create') }}">Tambah Aset</a>
                    <br><br>
                    <!-- AKHIR TOMBOL -->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal">
                        Import Aset
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
                            <form action="{{ route('importexcelAset') }}" method="POST" enctype="multipart/form-data">
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
                <br>
            @endcan

            <div class="table-responsive">
                <table id="table_aset" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Aset</th>
                            <th>Jurusan</th>
                            <th>Tanggal</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <script>
        // new DataTable('#table_aset');
        $(document).ready(function() {
            //id dari table diatas
            $('#table_aset').DataTable({
                processing: true,
                //untuk mengaktifkan datatables serverside
                serverSide: true,
                ajax: {
                    //route yang diambol dari controller
                    url: "{{ route('aset.index') }}",
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
                        data: 'nama_aset', //diambil dari database
                        name: 'nama_aset'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'tanggal_pembelian',
                        name: 'tanggal_pembelian'
                    },
                    {
                        data: 'kondisi',
                        name: 'kondisi'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
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
    @extends('template.scriptTable')
@endsection
