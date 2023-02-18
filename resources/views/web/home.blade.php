@extends('layouts.main')
@section('web')
    @if ($dataArr->count())
        <section>
            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($dataArr as $item)
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
                                            @if (Auth::guard('web')->check())
                                                <button type="button" class="btn btn-sm btn-outline-secondary getData"
                                                    value="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Penawaran</button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="" method="post" id="show_form"
                                                                class="needs-validation" novalidate>
                                                                @csrf
                                                                <input type="hidden" name="barang_id" id="show_barang">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth('web')->user()->id }}">
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="harga_penawaran"
                                                                            class="form-label">Harga
                                                                            Penawaran</label>
                                                                        <input
                                                                            type="number"class="form-control @error('harga_penawaran') is-invalid @enderror"
                                                                            placeholder="Harga Penawaran"
                                                                            aria-label="Harga Penawaran"
                                                                            name="harga_penawaran" id="harga_penawaran">
                                                                        @error('harga_penawaran')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Tawar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <small
                                                class="text-muted">{{ $item->barang->created_at->diffForHumans() }}</small>
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
        <div class="mt-4 col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid text-center fs-3">
                        Data Not available
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                            frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>
    <!-- End Contact Section -->
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
                    url: `{{ asset('penawaran/show') }}`,
                    method: "POST",
                    data: {
                        getData: true,
                        data: e.currentTarget.value
                    },
                    dataType: "json",
                    success: resp => {
                        // console.log(resp);
                        $("#show_form").attr("action",
                            `{{ asset('penawaran/action') }}`);
                        $("#show_barang").val(resp.id);
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
