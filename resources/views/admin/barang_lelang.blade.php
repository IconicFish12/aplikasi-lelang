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
                            {{-- @dd($item->barang != null) --}}
                            @if ($item->barang != null)
                                <div class="col">
                                    <div class="card shadow-sm">
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
                                                        data-bs-target="#exampleModal">Penawaran Tertingi</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary">Lainnya</button>
                                                </div>
                                                <small
                                                    class="text-muted">{{ $item->barang->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Penawaran
                                                                Tertinggi</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form action="" method="post" id="post_penawaran"
                                                                        class="needs-validation mt-3" novalidate>
                                                                        @csrf
                                                                        <input type="hidden" name="lelang_id"
                                                                            id="post_lelang">
                                                                        <input type="hidden" name="user_id" id="post_user">
                                                                        <input type="hidden" name="barang_id"
                                                                            id="post_barang_id">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <label for="nama_user"
                                                                                    class="form-label">Nama
                                                                                    Penawar</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Penawar"
                                                                                    id="post_nama" aria-label="Nama Penawar"
                                                                                    disabled>
                                                                            </div>
                                                                            <div class="col">
                                                                                <label for="harga_penawaran"
                                                                                    class="form-label">Harga
                                                                                    Penawaran</label>
                                                                                <input type="number" class="form-control"
                                                                                    placeholder="Harga Penawaran"
                                                                                    name="harga_penawaran"
                                                                                    aria-label="Harga Penawaran"
                                                                                    id="post_harga" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion my-3" id="accordionExample">
                                                                            <div class="accordion-item">
                                                                                <h2 class="accordion-header"
                                                                                    id="headingOne">
                                                                                    <button class="accordion-button"
                                                                                        type="button"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#collapseOne"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="collapseOne">
                                                                                        Penawaran Tertinggi
                                                                                    </button>
                                                                                </h2>
                                                                                <div id="collapseOne"
                                                                                    class="accordion-collapse collapse show"
                                                                                    aria-labelledby="headingOne"
                                                                                    data-bs-parent="#accordionExample">
                                                                                    <div class="accordion-body">
                                                                                        <div>
                                                                                            <div class="mb-3 row">
                                                                                                <label for="staticEmail"
                                                                                                    class="col-lg-4 col-form-label">Nama
                                                                                                    Penawar</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        id="post_nama_user"
                                                                                                        placeholder="Nama Penawar"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label for="inputPassword"
                                                                                                    class="col-lg-4 col-form-label">Nama
                                                                                                    Barang</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        id="post_barang"
                                                                                                        placeholder="Nama Barang"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label for="inputPassword"
                                                                                                    class="col-lg-4 col-form-label">Kategori
                                                                                                    Barang</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        id="post_kategori"
                                                                                                        placeholder="Kategori Barang"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label for="inputPassword"
                                                                                                    class="col-lg-4 col-form-label">Harga
                                                                                                    Barang</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        id="post_harga_barang"
                                                                                                        placeholder="Harga Barang"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                                                                            <button class="btn btn-primary"
                                                                                type="submit">Lelang</button>
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
                            @else
                            {{ null }}
                            @endif
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
                        // console.log(resp[0] != undefined);
                        if (resp[0] != undefined) {
                            if (resp[0].user != undefined) {
                                // console.log('ada');

                                $("#post_penawaran").attr("action",
                                    `{{ asset('admin/daftar-lelang/action') }}`);
                                $("#post_user").val(resp[0].user.id);
                                $("#post_barang_id").val(resp[0].barang.id);
                                $("#post_lelang").val(resp[1].id);
                                $("#post_nama").val(resp[0].user.nama_lengkap);
                                $("#post_harga").val(resp[0].harga_penawaran);
                                $("#post_nama_user").val(resp[0].user.nama_lengkap);
                                $("#post_barang").val(resp[0].barang.nama_barang);
                                $("#post_kategori").val(resp[0].barang.kategori.nama_kategori);
                                $("#post_harga_barang").val(resp[0].barang.harga_barang);

                                // $("#test").change(function(){
                                //     console.log("berubash");
                                // });

                                resp[2].forEach(element => {
                                    console.log(element);

                                    $("#nama").val(element.user.nama_lengkap);
                                    $("#harga").val(element.harga_penawaran);

                                });

                            } else {
                                // console.log("gak ada");

                                $("#post_penawaran").attr("action",
                                    `{{ asset('admin/daftar-lelang/action') }}`);
                                $("#post_user_id").val(null);
                                $("#post_barang_id").val(null);
                                $("#post_lelang").val(null);
                                $("#post_nama").val(null);
                                $("#post_harga").val(null);
                                $("#post_nama_user").val(null);
                                $("#post_barang").val(null);
                                $("#post_kategori").val(null);
                                $("#post_harga_barang").val(null);

                            }
                        } else {

                            $("#post_penawaran").attr("action",
                                `{{ asset('admin/daftar-lelang/action') }}`);
                            $("#post_user").val(null);
                            $("#post_barang_id").val(null);
                            $("#post_lelang").val(null);
                            $("#post_nama").val(null);
                            $("#post_harga").val(null);
                            $("#post_nama_user").val(null);
                            $("#post_barang").val(null);
                            $("#post_kategori").val(null);
                            $("#post_harga_barang").val(null);

                        }

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
