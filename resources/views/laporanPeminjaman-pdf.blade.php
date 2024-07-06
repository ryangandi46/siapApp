<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Waktu Meminjam</th>
                <th>Status</th>
                <th>Waktu Pengembalian</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->waktu_meminjam }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->waktu_pengembalian }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
