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

        .container {
            margin: 20px;
            padding: 20px;
        }

        .heading {
            padding: 25px
        }

        .heading .title{
            display: flex;
            justify-content: center;
            position: relative;
            font-size: 2.4rem;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase
        }

        .table-wrapper {
            border-collapse: collapse;
            display: flex;
            justify-content: center
        }

        .table-wrapper th, td {
            border: 1px #000000 solid;
            padding: 10px;
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
                
            </div>
        </div>

        <div class="table-wrapper">
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Pembeli</th>
                    <th>Petugas Pelelang</th>
                    <th>Tanggal Lelang</th>
                    <th>Harga Barang</th>
                    <th>Harga Lelang</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chitato</td>
                    <td>Agus</td>
                    <td>Firman</td>
                    <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                    <td>@money(200000)</td>
                    <td>@money(350000)</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
