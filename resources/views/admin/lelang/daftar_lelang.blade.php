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
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tanggal Lelang</th>
                            <th>Harga Awal</th>
                            <th>Harga Lelang</th>
                            <th>Jenis Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($dataArr as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @empty($item->barang->nama_barang)
                                        <div class="badge text-bg-success mx-auto">Sudah Dilelang</div>
                                    @else
                                        {{ $item->barang->nama_barang }}
                                    @endempty
                                </td>
                                <td>
                                    @empty($item->user->nama_lengkap)
                                        <div class="badge text-bg-danger mx-auto">Belum Dilelang</div>
                                    @else
                                        {{ $item->user->nama_lengkap }}
                                    @endempty
                                </td>
                                <td>
                                    @empty($item->petugas->nama_petugas)
                                        <div class="badge text-bg-danger mx-auto">Belum Dilelang</div>
                                    @else
                                        {{ $item->petugas->nama_petugas }}
                                    @endempty
                                </td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_mulai)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_selesai)) }}</td>
                                <td>
                                    @empty($item->tgl_lelang)
                                        <div class="badge text-bg-danger mx-auto">Belum Dilelang</div>
                                    @else
                                        {{ $item->tgl_lelang }}
                                    @endempty
                                </td>
                                <td>@money($item->harga_awal)</td>
                                <td>
                                    @if (is_null($item->harga_lelang))
                                        <div class="badge text-bg-danger mx-auto">Belum Dilelang</div>
                                    @else
                                        @money($item->harga_lelang)
                                    @endif
                                </td>
                                <td>
                                    @if ($item->jenis_transaksi === 'jual')
                                        <div class="badge text-bg-success mx-auto">Barang Dijual</div>
                                    @else
                                        <div class="badge text-bg-warning mx-auto">Barang Disewakan</div>
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
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tanggal Lelang</th>
                            <th>Harga Awal</th>
                            <th>Harga Lelang</th>
                            <th>Jenis Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                {{ $dataArr->links() }}
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rubah data Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post" id="edit_form">
                                @method('put')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="tgl_mulai" class="form-label">Tanggal
                                            Mulai</label>
                                        <input type="date" class="form-control" name="tgl_mulai" id="edit_tgl_mulai">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_selesai" class="form-label">Tanggal
                                            Selesai</label>
                                        <input type="date" class="form-control" name="tgl_selesai" id="edit_tgl_selesai">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_transaksi" class="form-label">Jenis
                                            Transaksi</label>
                                        <select name="jenis_transaksi" class="form-control form-select"
                                            id="edit_jenis_transaksi">
                                            <option selected>-- Pilih Jenis Transaksi --
                                            </option>
                                            <option value="jual">Barang Dijual</option>
                                            <option value="sewa">Barang Disewa</option>
                                        </select>
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
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            let getData = e => {
                $.ajax({
                    url: `{{ asset('admin/daftar-lelang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        $("#edit_form").attr("action",
                            `{{ asset('admin/daftar-lelang/${resp.id}') }}`);
                        $("#edit_tgl_mulai").val(resp.tgl_mulai);
                        $("#edit_tgl_selesai").val(resp.tgl_selesai);
                        $("#edit_jenis_transaksi").val(resp.jenis_transaksi);
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }


            $(".getData").on("click", getData);
        })
    </script>
@endsection
