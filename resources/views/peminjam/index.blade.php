@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Alert Error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                                        <p>Download Tamplate terlebih dahulu untuk mengetahui format dan cara penulisan yang
                                            digunakan</p>
                                        {{-- button download template --}}
                                        <div class="d-flex">
                                            <a href="{{ route('downloadTemplatePeminjaman') }}" class="btn btn-success">Download
                                                Template</a>
                                        </div>
                                        <br>
                                        <input type="file" name="file" accept=".xlsx, .xls, .csv" required>
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
                            <th>Penanggung Jawab</th>
                            <th>kelas</th>
                            <th>Nama Barang</th>
                            <th>jumlah</th>
                            <th>Kondisi Dipinjam</th>
                            <th>waktu Meminjam</th>
                            <th>status</th>
                            <th>waktu Pengembalian</th>
                            <th>Kondisi Dikembalikan</th>
                            <th>Berita Acara</th>
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

    <!-- Modal Kondisi Barang -->
    <div class="modal fade" id="modalKondisiBarang" tabindex="-1" aria-labelledby="modalKondisiBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKondisiBarangLabel">Kondisi Barang Saat Dikembalikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formKondisiBarang">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_peminjaman" id="id_peminjaman">
                        {{-- <div class="form-group">
                            <label for="waktu_pengembalian" class="control-label">Waktu Pengembalian</label>
                            <input type="date" name="waktu_pengembalian" id="waktu_pengembalian" class="form-control"
                                placeholder="Waktu Pengembalian" value="" readonly>
                        </div> --}}
                        <div class="form-group">
                            <label for="kondisi_dikembalikan" class="control-label">Kondisi Dipinjam</label>
                            <select class="form-control" id="kondisi_dikembalikan" name="kondisi_dikembalikan" required>
                                <option value="" disabled selected>- Pilih Kondisi -</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak Sedang">Rusak Sedang</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                        data: 'penanggung_jawab',
                        // data: 'user.name',
                        name: 'penanggung_jawab'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        // data: 'nama_aset',
                        data: 'aset.nama_aset',
                        name: 'nama_aset'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'kondisi_dipinjam',
                        name: 'kondisi_dipinjam'
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
                        name: 'waktu_pengembalian',
                        render: function(data, type, row) {
                            if (data == null) {
                                @can('action')
                                    return `<button class="btn btn-success kembalikan" data-id="${row.id}">Kembalikan</button>`;
                                @else
                                    return `<p class="text-danger">Belum Dikembalikan</p>`;
                                @endcan
                            } else {
                                return data;
                            }

                        }
                    },
                    {
                        data: 'kondisi_dikembalikan',
                        name: 'kondisi_dikembalikan',
                        render: function(data, type, row) {
                            if (data == null) {
                                return `<p class="text-danger">Belum Dikembalikan</p>`;
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'berita_acara',
                        name: 'berita_acara',
                        render: function(data, type, row) {
                            if (data) {
                                @can('action')
                                    return `<a href="/storage/berita_acara/${data}" target="_blank">Download Berita Acara</a>`;
                                    // return `<a href="/downloadBeritaAcara/${data}" target="_blank">Download Berita Acara</a>`;
                                @else
                                    return data;
                                @endcan
                            } else {
                                return `<p class="text-danger">Tidak Ada Berita Acara</p>`;
                            }
                        }
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
                    // $('.kembalikan').on('click', function() {
                    //     var id = $(this).data('id');
                    //     $.ajax({
                    //         url: '{{ route('pengembalianAset') }}',
                    //         method: 'POST',
                    //         data: {
                    //             _token: '{{ csrf_token() }}',
                    //             id: id
                    //         },
                    //         success: function(response) {
                    //             $('#table_peminjaman').DataTable().ajax.reload();
                    //         }
                    //     });
                    // });
                    $('.kembalikan').on('click', function() {
                        var id = $(this).data('id');
                        $('#id_peminjaman').val(id); // Set peminjaman ID di modal
                        $('#modalKondisiBarang').modal('show'); // Tampilkan modal
                    });

                    // Submit form modal untuk kondisi barang
                    $('#formKondisiBarang').on('submit', function(e) {
                        e.preventDefault();
                        var id = $('#id_peminjaman').val();
                        var kondisi = $('#kondisi_dikembalikan').val();

                        $.ajax({
                            url: '{{ route('pengembalianAset') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                                kondisi_dikembalikan: kondisi
                            },
                            success: function(response) {
                                $('#modalKondisiBarang').modal('hide');
                                $('#table_peminjaman').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                alert('Terjadi kesalahan saat menyimpan data!');
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection
