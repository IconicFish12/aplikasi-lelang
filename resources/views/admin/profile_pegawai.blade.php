@extends('layouts.index')
@section('app')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        @if (!is_null(auth('petugas')->user()->foto) && Storage::disk('public_path')->exists(auth('petugas')->user()->foto))
                            <img src="{{ asset(auth('petugas')->user()->foto) }}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        @endif
                        <h2>{{ Auth::guard('petugas')->user()->nama_petugas }}</h2>
                        <h3>{{ Auth::guard('petugas')->user()->role }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-4 label ">Nama Petugas</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::guard('petugas')->user()->nama_petugas }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ \Carbon\Carbon::create(Auth::guard('petugas')->user()->tgl_lahir)->format('d-m-Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Posisi</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::guard('petugas')->user()->role }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat Petugas</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ Auth::guard('petugas')->user()->alamat ?? 'Belum Ada Alamat' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::guard('petugas')->user()->telp }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::guard('petugas')->user()->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="post" action="{{ asset('admin/me/update') }}" class="needs-validation"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ Auth::guard('petugas')->user()->id }}"
                                        id="id">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profile</label>
                                        <div class="col-md-6 col-lg-7">
                                            <img src="/assets/img/profile-img.jpg" alt="Profile">
                                            <div class="pt-2 pb-3">
                                                <input type="file" name="foto"
                                                    class="form-control @error('foto') is-invalid  @enderror" id="foto"
                                                    placeholder="Masukan Nama Barang" value="{{ old('foto') }}">
                                                @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_petugas" class="col-md-4 col-lg-3 col-form-label">Nama
                                                Petugas</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_petugas" type="text"
                                                    class="form-control @error('nama_petugas') is-invalid  @enderror"
                                                    id="nama_petugas"
                                                    value="{{ Auth::guard('petugas')->user()->nama_petugas }}">
                                                @error('nama_petugas')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="tgl_lahir" class="col-md-4 col-lg-3 col-form-label">Tanggal
                                                Lahir</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="tgl_lahir" type="date"
                                                    class="form-control @error('tgl_lahir') is-invalid  @enderror"
                                                    id="tgl_lahir" value="{{ Auth::guard('petugas')->user()->tgl_lahir }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid  @enderror" rows="4"
                                                    placeholder="Alamat Petugas">
                                                    @if (Auth::guard('petugas')->user()->alamat != null)
{{ Auth::guard('petugas')->user()->alamat }}
@endif
                                                </textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="telp" class="col-md-4 col-lg-3 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="telp" type="text"
                                                    class="form-control @error('telp') is-invalid  @enderror"
                                                    id="telp" value="{{ Auth::guard('petugas')->user()->telp }}">
                                                @error('telp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid  @enderror"
                                                    id="email`" value="{{ Auth::guard('petugas')->user()->email }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
