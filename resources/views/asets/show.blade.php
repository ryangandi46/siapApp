@extends('templateLayout')

@section('content')
    {{-- <div class="card-columns">
                <div class="card bg-primary">
                    <div class="card-body text-center">
                        <p class="card-text" style="color: white;">Name Aset: {{ $aset->nama_aset }}</p>
                        <p class="card-text" style="color: white;">Spesifikasi: {{ $aset->merek }}</p>
                        <p class="card-text" style="color: white;">Lokasi: {{ $aset->lokasi }}</p>
                        <p class="card-text" style="color: white;">Jumlah satuan: {{ $aset->jumlah_satuan }}</p>
                        <p class="card-text" style="color: white;">Tanggal Pembelian: {{ $aset->tanggal_pembelian }}</p>
                        <p class="card-text" style="color: white;">Harga Pembelian: {{ $aset->harga_pembelian }}</p>
                        <p class="card-text" style="color: white;">Kondisi: {{ $aset->kondisi }}</p>
                        <p class="card-text" style="color: white;">Keterangan: {{ $aset->keterangan }}</p>
                    </div>
                </div>
            </div> --}}


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Show Detail Aset</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2> Show aset</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('aset.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <br>
            {{-- start table --}}
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead class="">
                        <tr>
                            <th class="rotate">
                                <div><strong>Nama Data</strong></div>
                            </th>
                            <th class="rotate">
                                <div><span>Isian Data</span></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nama Aset</th>
                            <td>{{ $aset->nama_aset }}</td>
                        </tr>
                        <tr>
                            <th>Merek</th>
                            <td>{{ $aset->merek }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $aset->jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $aset->lokasi }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $aset->jumlah_satuan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <td>{{ $aset->tanggal_pembelian }}</td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>{{ $aset->kondisi }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $aset->keterangan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- end table --}}


        </div>
        {{-- end description list alignment --}}
    @endsection
