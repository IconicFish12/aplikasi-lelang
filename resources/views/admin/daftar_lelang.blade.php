@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>{{ $page_header }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Komponen Pelelangan</li>
                <li class="breadcrumb-item active">Daftar Barang Pelelang</li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="{{ asset('/admin/daftar-lelang/barang') }}" class="text-decoration-none btn btn-primary">
            <i class='bx bx-clipboard bx-fw bx-sm'></i>
            <span>Barang Lelang</span>
        </a>
        @if ($dataArr->count())
            <div class="d-flex justify-content-between flex-column flex-md-row my-2">
                <form action="{{ asset('admin/daftar-lelang') }}" method="GET" class="d-block mb-2">
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
                            <th>Tanggal mulai</th>
                            <th>Tanggal selesai</th>
                            <th>Harga Awal</th>
                            <th>Harga Lelang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($dataArr as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang->nama_barang ?? $item->backup->nama_barang}}</td>
                                <td>{{ $item->user->nama_lengkap ?? 'Barang Belum Dilelang' }}</td>
                                <td>{{ $item->petugas->nama_petugas ?? 'Barang Belum Dilelang' }}</td>
                                <td>{{ $item->tgl_mulai }}</td>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>@money($item->harga_awal)</td>
                                <td>
                                    @if (is_null($item->harga_lelang))
                                        Barang Belum Dilelang
                                    @else
                                        @money($item->harga_lelang)
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="badge text-bg-warning me-2 getData"
                                            value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ asset("/admin/daftar-lelang/$item->id") }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge text-bg-danger">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
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
                            <th>Tanggal mulai</th>
                            <th>Tanggal selesai</th>
                            <th>Harga Awal</th>
                            <th>Harga Lelang</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rubah data Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post" id="edit_form" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang"
                                            class="form-control @error('nama_barang') is-invalid  @enderror"
                                            id="edit_nama_barang" placeholder="Masukan Nama Barang"
                                            value="{{ old('nama_barang') }}">
                                        @error('nama_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
