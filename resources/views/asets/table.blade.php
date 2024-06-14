@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventaris Aset</h6>
        </div>
        <div class="card-body">
            <!-- MULAI TOMBOL TAMBAH -->
            <a class="btn btn-info" id="tombol-tambah" href="{{ route('aset.create') }}">Tambah Aset</a>
            <br><br>
            <!-- AKHIR TOMBOL -->
            <div class="table-responsive">
                <table id="table_aset" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nama Aset</th>
                            <th>Jenis Aset</th>
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
                        data: 'id', // diambil dari database
                        name: 'id'
                    },
                    {
                        data: 'nama_aset',
                        name: 'nama_aset'
                    },
                    {
                        data: 'jenis_aset',
                        name: 'jenis_aset'
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
