<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .heading {
            padding: 15px
        }

        .heading .title {
            text-align: center;
            font-size: 2.4rem;
            text-transform: uppercase;
        }

        .heading .subtitle {
            margin-top: 5px;
            text-align: center;

        }

        .heading-content {
            display: flex
        }

        .content-left {
            float: left
        }

        .content-right {
            float: right
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="heading">
            <div class="title">
                Laporan Hasil Pelelangan
            </div>
            <div class="subtitle">
                Aplikasi Lelang Ibnu Syawal Aliefian - {{ \Carbon\Carbon::now()->format('d-m-Y') }}
            </div>
        </div>

        @if ($dataArr->count())
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Nama Pembeli</th>
                        <th>Petugas Pelelang</th>
                        <th>Tanggal Lelang</th>
                        <th>Harga Barang</th>
                        <th>Harga Lelang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataArr as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->user->nama_lengkap }}</td>
                            <td>{{ $item->petugas->nama_petugas }}</td>
                            <td>{{ \Carbon\Carbon::create($item->tgl_lelang)->format('d-m-Y') }}</td>
                            <td>@money($item->harga_barang)</td>
                            <td>@money($item->harga_lelang)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; font-size: 17px; margin-top: 5px;">
                No Data Available
            </div>
        @endif

    </div>

    <script>
        window.print()
    </script>
</body>

</html>
