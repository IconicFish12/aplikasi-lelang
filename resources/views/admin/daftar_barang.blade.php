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
                        <h5 class="modal-title">Buat Data Barang</h5>
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
                                <label for="tgl_pelelangan" class="form-label">Tanggal Pelelangan</label>
                                <input type="date" name="tgl_pelelangan"
                                    class="form-control @error('tgl_pelelangan') is-invalid  @enderror" id="tgl_pelelangan"
                                    value="{{ old('tgl_pelelangan') }}">
                                @error('tgl_pelelangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                            <th>Kategori Barang</th>
                            <th>Tanggal Pelelangan</th>
                            <th>Harga Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Foto Barang</th>
                            <th>Status Pelelangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($dataArr as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->tgl_pelelangan }}</td>
                                <td>@money($item->harga_barang)</td>
                                <td>{{ $item->deskripsi_barang }}</td>
                                <td>
                                    @if (Storage::disk('public_path')->exists($item->foto))
                                        <img src="{{ asset($item->foto) }}" class="rounded mx-auto d-block "
                                            width="150px">
                                    @else
                                        <i class="bi bi-image"></i>
                                        <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>{{ $item->status_lelang }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="badge text-bg-warning mx-3 getData"
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
                            <th>Kategori Barang</th>
                            <th>Tanggal Pelelangan</th>
                            <th>Harga Barang</th>
                            <th>Deskripsi Barang</th>
                            <th>Foto Barang</th>
                            <th>Status Pelelangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buat Nama Kategori</h5>
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
                                        <label for="tgl_pelelangan" class="form-label">Tanggal Pelelangan</label>
                                        <input type="date" name="tgl_pelelangan"
                                            class="form-control @error('tgl_pelelangan') is-invalid  @enderror"
                                            id="edit_tgl_pelelangan" value="{{ old('tgl_pelelangan') }}">
                                        @error('tgl_pelelangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                        <label for="status_lelang" class="form-label">Status Pelelangan</label>
                                        <select class="form-select form-control" name="status_lelang"
                                            id="edit_status_lelang" aria-label="Default select example">
                                            <option selected>-- Pilih Status --</option>
                                            <option value="belum">Belum Dilelang</option>
                                            <option value="sedang">Sedang Dilelang</option>
                                            <option value="sudah">Sudah Dilelang</option>
                                        </select>
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
                        // console.log(resp);
                        $("#edit_form").attr("action",
                            `{{ asset('admin/daftar-barang/${resp.id}') }}`);
                        $("#edit_nama_barang").val(resp.nama_barang);
                        $("#edit_kategori_id").val(resp.kategori_id);
                        $("#edit_tgl_pelelangan").val(resp.tgl_pelelangan);
                        $("#edit_harga_barang").val(resp.harga_barang);
                        $("#edit_status_lelangan").val(resp.status_lelangan);
                        $("#edit_deskripsi_barang").val(resp.deskripsi_barang);
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
