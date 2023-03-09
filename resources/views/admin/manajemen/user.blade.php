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
                        <form action="{{ asset('/admin/konsumen') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Konsumen</label>
                                <input type="text" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid  @enderror" id="nama_lengkap"
                                    placeholder="Masukan Nama Petugas" value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap')
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
                            <th>Nama Konsumen</th>
                            <th>Email Konsumen</th>
                            <th>Nomor Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telp }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" class="badge text-bg-warning getData"
                                        value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ asset("/admin/konsumen/$item->id") }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge text-bg-danger ms-3">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Konsumen</th>
                            <th>Email Konsumen</th>
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
                                        <label for="nama_lengkap" class="form-label">Nama Konsumen</label>
                                        <input type="text" name="nama_lengkap"
                                            class="form-control @error('nama_lengkap') is-invalid  @enderror"
                                            id="edit_nama_lengkap" placeholder="Masukan Nama Konsumen"
                                            value="{{ old('nama_lengkap') }}">
                                        @error('nama_lengkap')
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
                                            id="edit_password" placeholder="Masukan Password"
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
                    url: `{{ asset('admin/konsumen/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        $("#edit_form").attr("action",
                            `{{ asset('admin/konsumen/${resp.id}') }}`);
                        $("#edit_id").val(resp.id);
                        $("#edit_nama_lengkap").val(resp.nama_lengkap);
                        $("#edit_email").val(resp.email);
                        $("#edit_telp").val(resp.telp);
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
