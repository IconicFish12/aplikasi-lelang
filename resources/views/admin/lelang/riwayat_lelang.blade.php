@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>{{ $page_header }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Komponen Pelelangan</li>
                <li class="breadcrumb-item active">Riwayat Hasil Pelelang</li>
            </ol>
        </nav>
    </div>
    <div>
        @if ($dataArr->count())
        <button type="button" class="btn btn-primary navigate">
            <i class='bx bxs-report bx-fw bx-sm'></i>
            <span>Buat Laporan</span>
        </button>
            <div class="d-flex justify-content-between flex-column flex-md-row my-2">
                <form action="{{ asset('admin/riwayat') }}" method="GET" class="d-block mb-2">
                    @if (request()->has('search'))
                        <div class="form-group">
                            <input type="hidden" name="search" class="form-control" value="{{ request('search') }}">
                        </div>
                    @endif
                    <span class="d-block">Data Per Page</span>
                    <input type="number" name="paginate" id="paginate" list="paginates" class="form-control"
                        value="{{ request('paginate') }}">
                    <datalist id="paginates">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </datalist>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Nama Pembeli</th>
                            <th>Petugas Pelelang</th>
                            <th>Tanggal Lelang</th>
                            <th>Harga Barang</th>
                            <th>Harga Lelang</th>
                            <th>Jenis Transaksi</th>
                            <th>Proses Pelelangan</th>
                        </tr>
                    </thead>
                    @foreach ($dataArr as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->user->nama_lengkap }}</td>
                                <td>{{ $item->petugas->nama_petugas }}</td>
                                <td>{{ $item->tgl_lelang }}</td>
                                <td>@money($item->harga_barang)</td>
                                <td>@money($item->harga_lelang)</td>
                                <td>
                                    @if ($item->jenis_transaksi === 'jual')
                                        <div class="badge text-bg-success mx-auto">Barang Dijual</div>
                                    @else
                                        <div class="badge text-bg-warning mx-auto">Barang Disewakan</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="badge text-bg-success mx-auto">Sudah Dijual</div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Nama Pembeli</th>
                            <th>Petugas Pelelang</th>
                            <th>Tanggal Lelang</th>
                            <th>Harga Barang</th>
                            <th>Harga Lelang</th>
                            <th>Jenis Transaksi</th>
                            <th>Proses Pelelangan</th>
                        </tr>
                    </tfoot>
                </table>
                {{ $dataArr->links() }}
            </div>
        @else
            <div class="mt-3 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid mt-4 text-center fs-3">
                            Data Not available
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('.navigate').click(function() {
                window.location.href = `{{ asset('/admin/riwayat/generate') }}`
            })

        });
    </script>
@endsection
