@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>{{ $page_header }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Daftar Barang Pelelang</li>
            </ol>
        </nav>
    </div>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class='bx bx-plus bx-fw bx-sm'></i>
            <span>Create</span>
        </button>
        <div class="modal fade" id="createModal" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajukan Pelelangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ asset('/admin/daftar-barang') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid  @enderror" id="nama_barang"
                                    placeholder="Masukan Nama Barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama Pemilik</label>
                                <input type="text" name="nama_user"
                                    class="form-control @error('nama_user') is-invalid  @enderror" id="nama_user"
                                    placeholder="Masukan Nama Pemilik" value="{{ old('nama_user') }}">
                                @error('nama_user')
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
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" name="harga_barang"
                                    class="form-control @error('harga_barang') is-invalid  @enderror" id="harga_barang"
                                    placeholder="Masukan Harga Barang" value="{{ old('harga_barang') }}">
                                @error('harga_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                                <textarea name="deskripsi_barang" class="form-control @error('deskripsi_barang') is-invalid  @enderror"
                                    id="deskripsi_barang" placeholder="Masukan Deskripsi Barang" value="{{ old('deskripsi_barang') }}" rows="4"></textarea>
                                @error('deskripsi_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Barang</label>
                                <input type="file" name="foto"
                                    class="form-control @error('foto') is-invalid  @enderror" id="foto"
                                    placeholder="Masukan Nama Barang" value="{{ old('foto') }}">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalPetugas ">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Data Kategori --}}
        @if ($dataArr->count())
            <div class="d-flex justify-content-between flex-column flex-md-row my-2">
                <form action="{{ asset('admin/daftar-barang') }}" method="GET" class="d-block mb-2">
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
                            <th>Pemilik Barang</th>
                            <th>Kategori Barang</th>
                            <th>Harga Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Foto Barang</th>
                            <th>Status Pelelangan</th>
                            <th>Proses Pelelangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($dataArr as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->user->nama_lengkap }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>@money($item->harga_barang)</td>
                                <td class="text-break">{{ $item->deskripsi_barang }}</td>
                                <td>
                                    <img src="{{ asset($item->foto) }}" class="rounded mx-auto d-block " width="150px">
                                    {{-- @if (!is_null($item->foto) && Storage::disk('public_path')->exists($item->foto))
                                        <img src="{{ asset($item->foto) }}" class="rounded mx-auto d-block "
                                            width="150px">
                                    @elseif ($item->foto != null)
                                        <img src="{{ asset($item->foto) }}" class="rounded mx-auto d-block "
                                            width="150px">
                                    @else
                                        <i class="bi bi-image"></i>
                                        <span>Image Not Found</span>
                                    @endif --}}
                                </td>
                                <td>
                                    {{-- @dd(auth('petugas')->user()->role === 'petugas') --}}
                                    @if (auth('petugas')->user()->role === 'petugas')
                                        @if ($item->status_lelang == 'ditutup')
                                            <button type="button" name="status_lelang" data-bs-toggle="modal"
                                                value="{{ $item->id }}" data-bs-target="#modalLelang"
                                                class="badge text-bg-danger mx-auto postLelang">
                                                Pelelangan Ditutup
                                            </button>
                                            <div class="modal fade" id="modalLelang" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Buka
                                                                Pelelangan
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="" id="post_lelang" method="post">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="tgl_mulai" class="form-label">Tanggal
                                                                        Mulai</label>
                                                                    <input type="date" class="form-control"
                                                                        name="tgl_mulai" id="tgl_mulai">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tgl_selesai" class="form-label">Tanggal
                                                                        Selesai</label>
                                                                    <input type="date" class="form-control"
                                                                        name="tgl_selesai" id="tgl_selesai">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        name="email" id="post_email">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="status_lelang"
                                                                    value="dibuka" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <form action="{{ asset('/admin/daftar-barang/' . $item->id) }}"
                                                method="post">
                                                @method('put')
                                                @csrf
                                                <button type="submit" name="status_lelang" value="ditutup"
                                                    class="badge text-bg-success mx-auto">
                                                    Pelelangan Dibuka
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        @if ($item->status_lelang == 'ditutup')
                                            <div class="badge text-bg-danger mx-auto">
                                                Pelelangan Ditutup
                                            </div>
                                        @else
                                            <div class="badge text-bg-success mx-auto">
                                                Pelelangan Dibuka
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($item->proses === 'belum')
                                        <button class="badge text-bg-danger updateProses" type="button"
                                            data-bs-toggle="modal" value="{{ $item->id }}"
                                            data-bs-target="#modalProses">Belum
                                            Dilelang</button>
                                    @elseif ($item->proses === 'sedang')
                                        <button class="badge text-bg-warning updateProses" type="button"
                                            data-bs-toggle="modal" value="{{ $item->id }}"
                                            data-bs-target="#modalProses">Sedang
                                            Dilelang</button>
                                    @else
                                        <button class="badge text-bg-success updateProses" type="button"
                                            data-bs-toggle="modal" value="{{ $item->id }}"
                                            data-bs-target="#modalProses">Sudah
                                            Dilelang</button>
                                    @endif
                                    <div class="modal fade" id="modalProses" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Pelelangan
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" id="update_proses" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="tgl_selesai" class="form-label">Proses
                                                                Pelelangan</label>
                                                            <select name="proses" id="proses"
                                                                class="form-control form-select">
                                                                <option selected>-- Pilih Proses --</option>
                                                                <option value="belum">Belum Dilelang</option>
                                                                <option value="sedang">Sedang Dilelang</option>
                                                                <option value="sudah">Sudah Dilelang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="status_lelang" value="dibuka"
                                                            class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        {{-- <button type="button" class="badge text-bg-info" data-bs-toggle="modal"
                                            data-bs-target="#modalPetugas  ">
                                            <i class="bi bi-file-earmark-plus"></i>
                                        </button> --}}
                                        <button type="button" class="badge text-bg-warning me-2 getData"
                                            value="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ asset("/admin/daftar-barang/$item->id") }}" method="post">
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
                            <th>Pemilik Barang</th>
                            <th>Kategori Barang</th>
                            <th>Harga Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Foto Barang</th>
                            <th>Status Pelelangan</th>
                            <th>Proses Pelelangan</th>
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
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label">Nama Pemilik</label>
                                        <input type="text" name="nama_user"
                                            class="form-control @error('nama_user') is-invalid  @enderror" id="edit_nama_user"
                                            placeholder="Masukan Nama Pemilik" value="{{ old('nama_user') }}">
                                        @error('nama_user')
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
                                            class="form-control @error('harga_barang') is-invalid  @enderror"
                                            id="edit_harga_barang" placeholder="Masukan Harga Barang"
                                            value="{{ old('harga_barang') }}">
                                        @error('harga_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                                        <textarea name="deskripsi_barang" class="form-control @error('deskripsi_barang') is-invalid  @enderror"
                                            id="edit_deskripsi_barang" placeholder="Masukan Deskripsi Barang" aria-valuetext="{{ old('deskripsi_barang') }}"
                                            rows="4"></textarea>
                                        @error('deskripsi_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto Barang</label>
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid  @enderror" id="edit_foto"
                                            placeholder="Masukan Nama Barang" value="{{ old('foto') }}">
                                        @error('foto')
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

            let postLelang = e => {
                console.log(e.currentTarget.value);
                $.ajax({
                    url: `{{ asset('admin/daftar-barang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        $("#post_lelang").attr("action",
                            `{{ asset('admin/daftar-barang/${resp[0].id}') }}`);
                        $("#post_email").val(resp[0].user.email);
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }

            let updateProses = e => {
                console.log(e.currentTarget.value);
                $.ajax({
                    url: `{{ asset('admin/daftar-barang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        $("#update_proses").attr("action",
                            `{{ asset('admin/daftar-barang/${resp[0].id}') }}`);
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }

            let getData = e => {
                $.ajax({
                    url: `{{ asset('admin/daftar-barang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        $("#edit_form").attr("action",
                            `{{ asset('admin/daftar-barang/${resp[0].id}') }}`);
                        $("#edit_nama_barang").val(resp[0].nama_barang);
                        $("#edit_nama_user").val(resp[0].user.nama_lengkap);
                        $("#edit_kategori_id").val(resp[0].kategori_id);
                        $("#edit_harga_barang").val(resp[0].harga_barang);
                        $("#edit_status_lelangan").val(resp[0].status_lelangan);
                        $("#edit_deskripsi_barang").val(resp[0].deskripsi_barang);
                    },
                    error: err => {
                        console.log(err);
                    }
                })
            }

            $(".postLelang").on("click", postLelang);
            $(".updateProses").on("click", updateProses);
            $(".getData").on("click", getData);
        })
    </script>
@endsection
