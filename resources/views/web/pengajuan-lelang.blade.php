@extends('layouts.main')
@section('web')
    <section>
        <div class="container">
            <div class="section-title">
                <h2>{{ $header }}</h2>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            <i class='bx bx-plus bx-fw bx-sm'></i>
                            <span>Tambah Pengajuan</span>
                        </button>
                        <div class="modal fade" id="createModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Buat Data Permohonan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ asset('/permohonan-lelang') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                                <input type="text" name="nama_pemilik"
                                                    class="form-control @error('nama_pemilik') is-invalid  @enderror"
                                                    id="nama_pemilik" placeholder="Masukan Nama Kategori Barang"
                                                    value="{{ auth('web')->user()->nama_lengkap, old('nama_pemilik') }}">
                                                @error('nama_pemilik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                <label for="harga_lelang" class="form-label">Perkiraan Harga Lelang</label>
                                                <input type="number" name="harga_lelang"
                                                    class="form-control @error('harga_lelang') is-invalid  @enderror" id="harga_lelang"
                                                    placeholder="Masukan Harga Perkiraan dilelang" value="{{ old('harga_lelang') }}">
                                                @error('harga_lelang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tgl_mulai" class="form-label">Tanggal Mulai Dilelang</label>
                                                <input type="date" name="tgl_mulai"
                                                    class="form-control @error('tgl_mulai') is-invalid  @enderror" id="tgl_mulai"
                                                    placeholder="Masukan Harga Barang" value="{{ old('tgl_mulai') }}">
                                                @error('tgl_mulai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tgl_akhir" class="form-label">Tanggal Terakhir Dilelang</label>
                                                <input type="date" name="tgl_akhir"
                                                    class="form-control @error('tgl_akhir') is-invalid  @enderror" id="tgl_akhir"
                                                    placeholder="Masukan Harga Barang" value="{{ old('tgl_akhir') }}">
                                                @error('tgl_akhir')
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
                        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Arsip Pengajuan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false">Pengajuan Saya</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                @if ($arsip->count())
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
                                                </tr>
                                            </thead>
                                            @foreach ($arsip as $item)
                                                <tbody>
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
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        {{ $arsip->links() }}
                                    </div>
                                @else
                                    <div class="alert alert-danger my-3" role="alert">
                                        Data Belum Tersedia
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">
                                @if ($data_baru->count())
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
                                                </tr>
                                            </thead>
                                            @foreach ($data_baru as $item)
                                                <tbody>
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
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        {{ $data_baru->links() }}
                                    </div>
                                @else
                                    <div class="alert alert-danger my-3" role="alert">
                                        Data Belum Tersedia
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
