@extends('templateLayout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Overdue Loans Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Aset Terlambat
                                    Dikembalikan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $overdueCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aset Dipinjam
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $listPeminjaman }}</div>
                                    </div>
                                    {{-- <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">List Aset Dipinjam</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {{-- start table --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%">
                                <thead class="">
                                    <tr>
                                        <th>NO</th>
                                        <th>
                                            Nama Peminjam
                                        </th>
                                        <th>
                                            Nama Aset
                                        </th>
                                        <th>
                                            Tanggal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asetDipinjam as $index => $peminjam)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $peminjam->nama_peminjam }}</td>
                                            {{-- <td>{{ $peminjam->nama_aset }}</td> --}}
                                            <td>{{ $peminjam->aset->nama_aset }}</td>
                                            <td>{{ $peminjam->waktu_meminjam }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $asetDipinjam->links() }}
                        </div>
                        {{-- end table --}}
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Peminjaman Terlambat</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Peminjam</th>
                                        <th>Nama Aset</th>
                                        <th>Tanggal Dipinjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overdueLoans as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $loan->nama_peminjam }}</td>
                                            {{-- <td>{{ $loan->nama_aset }}</td> --}}
                                            <td>{{ $loan->aset->nama_aset }}</td>
                                            <td>{{ $loan->waktu_meminjam }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination-bar text-center"> --}}
                            {{ $overdueLoans->links() }}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <!-- End of Main Content -->
@endsection
