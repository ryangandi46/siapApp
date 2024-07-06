@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventaris peminjam</h6>
        </div>
        <div class="card-body">
            <form id="filterForm">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="form-group col-xs-12  text-center">
                        <label>&nbsp;</label>
                        <button type="button" id="filterBtn" class="btn btn-primary form-control">Filter</button>
                    </div>
                    <div class="form-group col-xs-12">
                        <label>&nbsp;</label>
                        <button type="button" id="exportBtnPdf" class="btn btn-danger form-control">Export PDF</button>
                    </div>
                    <div class="form-group col-xs-12">
                        <label>&nbsp;</label>
                        <button type="button" id="exportBtnExcel" class="btn btn-success form-control">Export Excel</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="table_laporan" class="table table-bordered" width="100%" cellspacing="0">
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
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @extends('template.scriptTable')
    <script>
        $(document).ready(function() {
            function fetch_data(start_date = '', end_date = '') {
                $('#table_laporan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporan.index') }}",
                        type: 'GET',
                        data: {
                            start_date: start_date,
                            end_date: end_date
                        }
                    },
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
                    ],
                    order: [
                        [0, 'asc']
                    ],
                    drawCallback: function(settings) {
                        var currentPage = settings.page;
                        var startRow = settings._iDisplayStart;

                        $('#table_laporan tbody tr').each(function(index, row) {
                            var rowIndex = index + 1;
                            var rowNumber = startRow + rowIndex;
                            $(row).find('td:first').html(rowNumber);
                        });
                    }
                });
            }

            fetch_data();

            $('#filterBtn').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date != '' && end_date != '') {
                    $('#table_laporan').DataTable().destroy();
                    fetch_data(start_date, end_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#exportBtnPdf').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date != '' && end_date != '') {
                    window.location.href = "{{ route('exportpdf') }}?start_date=" + start_date +
                        "&end_date=" + end_date;
                } else {
                    alert('Both Date is required for export');
                }
            });

            $('#exportBtnExcel').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date != '' && end_date != '') {
                    window.location.href = "{{ route('exportexcel') }}?start_date=" + start_date +
                        "&end_date=" + end_date;
                } else {
                    alert('Both Date is required for export');
                }
            });
        });
    </script>
@endsection
