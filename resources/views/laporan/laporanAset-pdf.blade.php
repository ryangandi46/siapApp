<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman</title>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .header h1,
        .header h2,
        .header h3,
        .header h4,
        .header h5,
        .header h6 {
            margin: 0;
        }

        .header .address {
            margin-top: 10px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature div {
            text-align: center;
            width: 200px;
        }

        .signature div p {
            margin-top: 70px;
            border-top: 1px solid black;
            padding-top: 5px;
        }

        .signature div:last-child {
            /* Right signature */
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('img/logo_itikurih.png') }}" alt="Logo SMK">
        <h2>Sekolah Menengah Kejuruan (SMK)</h2>
        <h3>ITIKURIH HIBARNA</h3>
        <p>TEKNIK KOMPUTER DAN JARINGAN - PERBANKAN</p>
        <p class="address">
            Jl. Raya Laswi No 782 Ciparay Kab. Bandung 40381 <br>
            Telp (022) 5957900 | Fax (022) 5953182 <br>
            Website: smk.itikurih-hibarna.sch.id | Email: smk@itikurih-hibarna.sch.id <br>
            Izin Pendirian Disdikbud Kab. Bandung Nomor: 421.3/2466 NSS: 322020813059 NPSN: 2025665
        </p>
        <hr>
        <h4>DAFTAR INVENTARIS BARANG TKJ</h4>
        <h5>SMK ITIKURIH HIBARNA</h5>

    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Aset</th>
                <th>Merek</th>
                <th>Lokasi</th>
                <th>Jumlah</th>
                <th>Tanggal Pembelian</th>
                <th>Jurusan</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->merek }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->jumlah_satuan }}</td>
                    <td>{{ $item->tanggal_pembelian }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->kondisi }}</td>                    
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="date-location">
        <p>{{ now()->format('d M Y') }}</p>
        <p>Tempat: Bandung</p>
    </div>

    <div class="signature">
        <div>
            <p>Toolman</p>
            {{-- <p>____________________</p> --}}
        </div>
        <div>
            <p>Kepala Program</p>
            {{-- <p>____________________</p> --}}
        </div>
    </div>
</body>

</html>
