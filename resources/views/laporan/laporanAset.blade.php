@extends('templateLayout')

@extends('template.headTable')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Aset</h6>
        </div>
        <div class="card-body">
            @can('action')
                <form id="filterForm">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">Semua Jurusan</option>
                                <option value="AKL">AKL</option>
                                <option value="TKJ">TKJ</option>
                            </select>
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
                            <button type="button" id="exportBtnExcel" class="btn btn-success form-control">Export
                                Excel</button>
                        </div>
                    </div>
                </form>
            @endcan

            <div class="table-responsive">
                <table id="table_laporan" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Aset</th>
                            <th>Merek</th>
                            <th>lokasi</th>
                            <th>Jumlah Satuan</th>
                            <th>Tanggal Pembelian</th>
                            <th>Jurusan</th>
                            <th>Kondisi</th>                            
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
            function fetch_data(start_date = '', end_date = '',  jurusan = '') {
                $('#table_laporan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('laporanAset.index') }}",
                        type: 'GET',
                        data: {
                            start_date: start_date,
                            end_date: end_date,
                            jurusan: jurusan
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'No',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_aset',
                            name: 'nama_aset'
                        },
                        {
                            data: 'merek',
                            name: 'merek'
                        },
                        {
                            data: 'lokasi',
                            name: 'lokasi'
                        },
                        {
                            data: 'jumlah_satuan',
                            name: 'jumlah_satuan'
                        },
                        {
                            data: 'tanggal_pembelian',
                            name: 'tanggal_pembelian'
                        },
                        {
                            data: 'jurusan',
                            name: 'jurusan'
                        },
                        {
                            data: 'kondisi',
                            name: 'kondisi'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan',                            
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
                var jurusan = $('#jurusan').val();
                if (start_date != '' && end_date != ''  ) {
                    $('#table_laporan').DataTable().destroy();
                    fetch_data(start_date, end_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#exportBtnPdf').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                var jurusan = $('#jurusan').val();
                if (start_date != '' && end_date != '' ) {
                    window.location.href = "{{ route('exportpdfAset') }}?start_date=" + start_date +
                        "&end_date=" + end_date ;
                } else {
                    alert('Both Date is required for export');
                }
            });

            $('#exportBtnExcel').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                var jurusan = $('#jurusan').val();
                if (start_date != '' && end_date != '') {
                    window.location.href = "{{ route('exportexcelAset') }}?start_date=" + start_date +
                        "&end_date=" + end_date;
                } else {
                    alert('Both Date is required for export');
                }
            });
        });
    </script>
@endsection
