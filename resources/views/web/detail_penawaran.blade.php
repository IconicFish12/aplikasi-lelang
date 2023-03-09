@extends('layouts.main')
@section('web')
    <section>
        @if ($dataArr->count())
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title fw-bold fs-3">
                            Penawaran {{ Auth::guard('web')->user()->nama_lengkap }}
                        </div>
                        <div class="d-flex justify-content-between flex-column flex-md-row my-2">
                            <form action="{{ asset('/riwayat-saya') }}" method="GET" class="d-block mb-2">
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
                                        <th>Nama Pembeli</th>
                                        <th>Petugas Pelelang</th>
                                        <th>Tanggal Lelang</th>
                                        <th>Harga Barang</th>
                                        <th>Harga Lelang</th>
                                    </tr>
                                </thead>
                                @foreach ($dataArr as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->user->nama_lengkap }}</td>
                                            <td>{{ $item->petugas->nama_petugas }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_lelang)) }}</td>
                                            <td>@money($item->harga_barang)</td>
                                            <td>@money($item->harga_lelang)</td>
                                            <td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Pembeli</th>
                                        <th>Petugas Pelelang</th>
                                        <th>Tanggal Lelang</th>
                                        <th>Harga Barang</th>
                                        <th>Harga Lelang</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{ $dataArr->links() }}
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
    </section>
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
