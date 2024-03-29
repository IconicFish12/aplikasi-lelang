@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>{{ $page_header }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Kategori Barang</li>
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
                        <h5 class="modal-title">Buat Data Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ asset('/admin/petugas-lelang') }}" method="post" novalidate
                            class="needs-validation" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                <input type="text" name="nama_petugas"
                                    class="form-control @error('nama_petugas') is-invalid  @enderror" id="nama_petugas"
                                    placeholder="Masukan Nama Petugas" value="{{ old('nama_petugas') }}">
                                @error('nama_petugas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid  @enderror" id="tgl_lahir"
                                    placeholder="Masukan Nama Petugas" value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid  @enderror" id="email"
                                    placeholder="Masukan Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password"
                                    class="form-control @error('password') is-invalid  @enderror" id="password"
                                    placeholder="Masukan password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Nomer Telepon</label>
                                <input type="text" name="telp"
                                    class="form-control @error('telp') is-invalid  @enderror" id="telp"
                                    placeholder="Masukan Nomor Telepon" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profile</label>
                                <input type="file" name="foto"
                                    class="form-control @error('foto') is-invalid  @enderror" id="foto"
                                    placeholder="Masukan Nama Barang" value="{{ old('foto') }}">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role Pegawai</label>
                                <input type="text" name="role" class="form-control" id="role"
                                    placeholder="Masukan Nama Kategori Barang" value="petugas" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid  @enderror" id="alamat"
                                    placeholder="Masukan Alamat Petugas" value="{{ old('alamat') }}" rows="4"></textarea>
                                @error('alamat')
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
                <form action="{{ asset('admin/petugas-lelang') }}" method="GET" class="d-block mb-2">
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
                            <th>Nama Petugas</th>
                            <th>Tanggal Lahir</th>
                            <th>Email Petugas</th>
                            <th>Alamat</th>
                            <th>Foto Profile</th>
                            <th>Nomor Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_petugas }}</td>
                                <td>{{ \Carbon\Carbon::create($item->tgl_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    @if (!is_null($item->foto) && Storage::disk('public_path')->exists($item->foto))
                                        <img src="{{ asset($item->foto) }}" class="rounded mx-auto d-block"
                                            width="150px">
                                    @else
                                        <i class="bi bi-image"></i>
                                        <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>{{ $item->telp }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="badge text-bg-warning mx-3 getData"
                                            value="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ asset("/admin/petugas-lelang/$item->id") }}" method="post">
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
                            <th>Nama Petugas</th>
                            <th>Tanggal Lahir</th>
                            <th>Email Petugas</th>
                            <th>Alamat</th>
                            <th>Foto Profile</th>
                            <th>Nomor Telepon</th>
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
                            <div class="modal-body">
                                <form action="" method="post" id="edit_form">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id" id="edit_id">
                                    <div class="mb-3">
                                        <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                        <input type="text" name="nama_petugas"
                                            class="form-control @error('nama_petugas') is-invalid  @enderror"
                                            id="edit_nama_petugas" placeholder="Masukan Nama Petugas"
                                            value="{{ old('nama_petugas') }}">
                                        @error('nama_petugas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir"
                                            class="form-control @error('tgl_lahir') is-invalid  @enderror"
                                            id="edit_tgl_lahir" placeholder="Masukan Nama Petugas"
                                            value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid  @enderror" id="edit_email"
                                            placeholder="Masukan Email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" name="password"
                                            class="form-control @error('password') is-invalid  @enderror"
                                            id="edit_password" placeholder="Masukan password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="telp" class="form-label">Nomer Telepon</label>
                                        <input type="text" name="telp"
                                            class="form-control @error('telp') is-invalid  @enderror" id="edit_telp"
                                            placeholder="Masukan Nomor Telepon" value="{{ old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto Profile</label>
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid  @enderror" id="foto"
                                            placeholder="Masukan Nama Barang" value="{{ old('foto') }}">
                                        @error('foto')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role Pegawai</label>
                                        <input type="text" name="role"
                                            class="form-control @error('role') is-invalid  @enderror" id="edit_role"
                                            placeholder="Masukan Nama Kategori Barang"readonly>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid  @enderror" id="edit_alamat"
                                            placeholder="Masukan Alamat" value="{{ old('alamat') }}" rows="4"></textarea>
                                        @error('alamat')
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
                                </form>
                            </div>
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
                    url: `{{ asset('admin/petugas-lelang/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        $("#edit_form").attr("action",
                            `{{ asset('admin/petugas-lelang/${resp.id}') }}`);
                        $("#edit_id").val(resp.id);
                        $("#edit_nama_petugas").val(resp.nama_petugas);
                        $("#edit_tgl_lahir").val(resp.tgl_lahir);
                        $("#edit_email").val(resp.email);
                        $("#edit_telp").val(resp.telp);
                        $("#edit_alamat").val(resp.alamat);
                        $("#edit_role").val(resp.role);
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
