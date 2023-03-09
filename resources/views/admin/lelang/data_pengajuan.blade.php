@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>{{ $page_header }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Komponen Pelelangan</li>
                <li class="breadcrumb-item active">Daftar Permohonan Lelang</li>
            </ol>
        </nav>
    </div>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class='bx bx-plus bx-fw bx-sm'></i>
            <span>Create</span>
        </button>
        <div class="modal fade" id="createModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Data Permohonan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ asset('/admin/permohonan-lelang') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Nama Pemilik</label>
                                <select class="form-select form-control" name="user_id" id="edit_user_id"
                                    aria-label="Default select example">
                                    <option selected>-- Pilih User --</option>
                                    @foreach ($user as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid  @enderror" id="edit_nama_barang"
                                    placeholder="Masukan Nama Barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <select class="form-select form-control" name="kategori_id" id="edit_kategori_id"
                                    aria-label="Default select example">
                                    <option selected>-- Pilih Kategori --</option>
                                    @foreach ($kategori as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" name="harga_barang"
                                    class="form-control @error('harga_barang') is-invalid  @enderror" id="edit_harga_barang"
                                    placeholder="Masukan Harga Barang" value="{{ old('harga_barang') }}">
                                @error('harga_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga_lelang" class="form-label">Perkiraan Harga Lelang</label>
                                <input type="number" name="harga_lelang"
                                    class="form-control @error('harga_lelang') is-invalid  @enderror" id="edit_harga_lelang"
                                    placeholder="Masukan Harga Perkiraan dilelang" value="{{ old('harga_lelang') }}">
                                @error('harga_lelang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lelang_dimulai" class="form-label">Tanggal Mulai Dilelang</label>
                                <input type="date" name="lelang_dimulai"
                                    class="form-control @error('lelang_dimulai') is-invalid  @enderror"
                                    id="edit_lelang_dimulai" placeholder="Masukan Harga Barang"
                                    value="{{ old('lelang_dimulai') }}">
                                @error('lelang_dimulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lelang_diakhiri" class="form-label">Tanggal Terakhir Dilelang</label>
                                <input type="date" name="lelang_diakhiri"
                                    class="form-control @error('lelang_diakhiri') is-invalid  @enderror"
                                    id="edit_lelang_diakhiri" placeholder="Masukan Harga Barang"
                                    value="{{ old('lelang_diakhiri') }}">
                                @error('lelang_diakhiri')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Data Kategori --}}
        @if ($dataArr->count())
            <div class="d-flex justify-content-between flex-column flex-md-row my-2">
                <form action="{{ asset('admin/permohonan-lelang') }}" method="GET" class="d-block mb-2">
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
                            <th>Nama Pemilik</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Harga Barang</th>
                            <th>Harga Lelang Perkiraan</th>
                            <th>Tanggal Lelang Dimulai</th>
                            <th>Tanggal Lelang Selesai</th>
                            <th>Status Permohonan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama_lengkap }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>@money($item->harga_barang)</td>
                                <td>@money($item->harga_lelang)</td>
                                <td>{{ date('d-m-Y', strtotime($item->lelang_dimulai)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->lelang_diakhiri)) }}</td>
                                <td>
                                    @if ($item->status_pengajuan === 'tidak_setujui')
                                        <form action="{{ asset('/admin/permohonan-lelang/' . $item->id) }}"
                                            method="post">
                                            @method('put')
                                            @csrf
                                            <button class="badge text-bg-warning mx-auto" value="disetujui"
                                                name="status_pengajuan">
                                                Setujui Permohonan
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ asset("/admin/permohonan-lelang/$item->id") }}" method="post">
                                            @method('put')
                                            @csrf
                                            <button class="badge text-bg-success mx-auto" value="tidak_setujui"
                                                name="status_pengajuan">
                                                Permohonan Disetujui
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="badge text-bg-warning mx-3 getData"
                                            value="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ asset("/admin/permohonan-lelang/$item->id") }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge text-bg-danger">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Harga Barang</th>
                            <th>Harga Lelang Perkiraan</th>
                            <th>Tanggal Lelang Dimulai</th>
                            <th>Tanggal Lelang Selesai</th>
                            <th>Status Permohonan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                {{ $dataArr->links() }}
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buat Nama Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post" id="form">
                                @method('put')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Nama Pemilik</label>
                                        <select class="form-select form-control" name="user_id" id="user_id"
                                            aria-label="Default select example">
                                            <option selected>-- Pilih User --</option>
                                            @foreach ($user as $i)
                                                <option value="{{ $i->id }}">{{ $i->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori Barang</label>
                                        <select class="form-select form-control" name="kategori_id" id="kategori_id"
                                            aria-label="Default select example">
                                            <option selected>-- Pilih Kategori --</option>
                                            @foreach ($kategori as $i)
                                                <option value="{{ $i->id }}">{{ $i->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang"
                                            class="form-control @error('nama_barang') is-invalid  @enderror"
                                            id="nama_barang" placeholder="Masukan Nama Barang"
                                            value="{{ old('nama_barang') }}">
                                        @error('nama_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_barang" class="form-label">Harga Barang</label>
                                        <input type="number" name="harga_barang"
                                            class="form-control @error('harga_barang') is-invalid  @enderror"
                                            id="harga_barang" placeholder="Masukan Harga Barang"
                                            value="{{ old('harga_barang') }}">
                                        @error('harga_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_lelang" class="form-label">Perkiraan Harga Lelang</label>
                                        <input type="number" name="harga_lelang"
                                            class="form-control @error('harga_lelang') is-invalid  @enderror"
                                            id="harga_lelang" placeholder="Masukan Harga Perkiraan dilelang"
                                            value="{{ old('harga_lelang') }}">
                                        @error('harga_lelang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lelang_dimulai" class="form-label">Tanggal Mulai Dilelang</label>
                                        <input type="date" name="lelang_dimulai"
                                            class="form-control @error('lelang_dimulai') is-invalid  @enderror"
                                            id="lelang_dimulai" placeholder="Masukan Harga Barang"
                                            value="{{ old('lelang_dimulai') }}">
                                        @error('lelang_dimulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lelang_diakhiri" class="form-label">Tanggal Terakhir Dilelang</label>
                                        <input type="date" name="lelang_diakhiri"
                                            class="form-control @error('lelang_diakhiri') is-invalid  @enderror"
                                            id="lelang_diakhiri" placeholder="Masukan Harga Barang"
                                            value="{{ old('lelang_diakhiri') }}">
                                        @error('lelang_diakhiri')
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
                    url: `{{ asset('admin/permohonan-lelang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        $("#form").attr("action",
                            `{{ asset('admin/permohonan-lelang/${resp.id}') }}`);
                        $("#user_id").val(resp.user_id);
                        $("#kategori_id").val(resp.kategori_id);
                        $("#nama_barang").val(resp.nama_barang);
                        $("#harga_barang").val(resp.harga_barang);
                        $("#harga_lelang").val(resp.harga_lelang);
                        $("#lelang_dimulai").val(resp.lelang_dimulai);
                        $("#lelang_diakhiri").val(resp.lelang_diakhiri);
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
