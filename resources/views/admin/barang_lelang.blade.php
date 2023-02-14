@extends('layouts.index')
@section('app')
    <a href="{{ asset('/admin/daftar-lelang') }}" class="text-decoration-none btn btn-primary">
        <i class='bx bx-left-arrow-alt bx-fw bx-sm'></i>
        <span>Kembail</span>
    </a>
    @if ($dataArr->count())
        <section>
            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($dataArr as $item)
                            <div class="col">
                                <div class="card shadow-sm" >
                                    <img src="{{ asset($item->barang->foto) }}" alt="Gambar">
                                    <div class="card-body">
                                        <div class="card-title">
                                            {{ $item->barang->nama_barang }}
                                        </div>
                                        <div class="card-subtitle mb-2 text-muted">
                                            @money($item->barang->harga_barang)
                                        </div>
                                        <p class="card-text">
                                            {{ $item->barang->deskripsi_barang }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary getData"
                                                    value="{{ $item->barang->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Penawaran</button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small
                                                class="text-muted">{{ $item->barang->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Data Penawaran</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="flush-headingOne">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseOne"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapseOne">
                                                                        Accordion Item #1
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapseOne"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-headingOne"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <form action="" method="post">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <label class="form-label"
                                                                                        for="barang_id">Nama
                                                                                        Barang</label>
                                                                                    <input type="text" name="barang_id"
                                                                                        id="barang_id" class="form-control"
                                                                                        placeholder="Nama Barang"
                                                                                        aria-label="Nama Barang">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label class="form-label"
                                                                                        for="user_id">Nama
                                                                                        Pengguna</label>
                                                                                    <input type="text" name="user_id"
                                                                                        id="pengguna_id"
                                                                                        class="form-control"
                                                                                        placeholder="Nama pengguna"
                                                                                        aria-label="Nama Pengguna">
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="harga_penawaran"
                                                                                    class="form-label">Harga
                                                                                    Penawaran</label>
                                                                                <input type="number"class="form-control"
                                                                                    placeholder="Harga Penawaran"
                                                                                    aria-label="Harga Penawaran"
                                                                                    name="harga_penawaran"
                                                                                    id="harga_penawaran">
                                                                            </div>
                                                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                                                <button class="btn btn-primary"
                                                                                    type="submit">Button</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="flush-headingOne">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseTwo"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapseTwo">
                                                                        Accordion Item #1
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapseTwo"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-headingOne"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <form action="" method="post">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <label class="form-label"
                                                                                        for="barang_id">Nama
                                                                                        Barang</label>
                                                                                    <input type="text" name="barang_id"
                                                                                        id="barang_id" class="form-control"
                                                                                        placeholder="Nama Barang"
                                                                                        aria-label="Nama Barang">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label class="form-label"
                                                                                        for="user_id">Nama
                                                                                        Pengguna</label>
                                                                                    <input type="text" name="user_id"
                                                                                        id="pengguna_id"
                                                                                        class="form-control"
                                                                                        placeholder="Nama pengguna"
                                                                                        aria-label="Nama Pengguna">
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="harga_penawaran"
                                                                                    class="form-label">Harga
                                                                                    Penawaran</label>
                                                                                <input type="number"class="form-control"
                                                                                    placeholder="Harga Penawaran"
                                                                                    aria-label="Harga Penawaran"
                                                                                    name="harga_penawaran"
                                                                                    id="harga_penawaran">
                                                                            </div>
                                                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                                                <button class="btn btn-primary"
                                                                                    type="submit">Button</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
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
                console.log(e.currentTarget.value);
                $.ajax({
                    url: `{{ asset('admin/daftar-lelang/barang') }}`,
                    method: "GET",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        console.log(resp);
                        let text = "";

                        resp.forEach(v => {
                            text +=
                        });

                        // $("#edit_form").attr("action",
                        //     `{{ asset('admin/daftar-barang/${resp.id}') }}`);
                        // $("#edit_nama_barang").val(resp.nama_barang);
                        // $("#edit_kategori_id").val(resp.kategori_id);
                        // $("#edit_tgl_pelelangan").val(resp.tgl_pelelangan);
                        // $("#edit_harga_barang").val(resp.harga_barang);
                        // $("#edit_status_lelangan").val(resp.status_lelangan);
                        // $("#edit_deskripsi_barang").val(resp.deskripsi_barang);
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
