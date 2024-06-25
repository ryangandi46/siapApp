@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventaris Aset</h6>
        </div>
        <div class="card-body">
            <!-- MULAI TOMBOL TAMBAH -->
            <a class="btn btn-info" id="tombol-tambah" href="{{ route('user.create') }}">Tambah User</a>
            <br><br>
            <!-- AKHIR TOMBOL -->
            <div class="table-responsive">
                <table id="table_user" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            {{-- <th>id</th> --}}
                            {{-- <th>NAma Aset</th>
                                <th>Jenis Aset</th> --}}
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

    @extends('template.scriptTable')

    <script>
        // new DataTable('#table_aset');
        $(document).ready(function() {
            //id dari table diatas
            $('#table_user').DataTable({
                processing: true,
                //untuk mengaktifkan datatables serverside
                serverSide: true,
                ajax: {
                    //route yang diambol dari controller
                    url: "{{ route('user.index') }}",
                    type: 'GET'
                },
                //columns data yang akan ditampilkan
                columns: [{
                        data: null, // Untuk kolom no. urut
                        render: function(data, type, row, meta) {
                            // Hitung no. urut berdasarkan index row
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [0, 'asc'] // dimulai dari dan pilih type urutan data asc/desc
                ]
                
            });
        });
    </script>
@endsection
