<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? 'Aplikasi Lelang' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/components/img/favicon.png" rel="icon">
    <link href="/components/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/components/vendor/aos/aos.css" rel="stylesheet">
    <link href="/components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/components/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/components/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/components/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/components/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/components/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="/components/css/style.css" rel="stylesheet">

    {{-- BoxIcon Component --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ asset('/') }}">Aplikasi Lelang</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="/components/img/logo.png" alt="" class="img-fluid"></a>-->


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link " href="/">Home</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    @auth('web')
                        <li><a class="nav-link" href="/permohonan-lelang">Permohonan Lelang</a></li>
                        <li class="dropdown">
                            <a href="#">
                                <i class="bi bi-chevron-down"></i>
                                <span>{{ Auth::user()->nama_lengkap }}</span>
                            </a>
                            <ul>
                                <li><a href="#">My Profile</a></li>
                                <li><a href="/riwayat-saya">Riwayat Lelang</a></li>
                                <li><a href="{{ asset('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a class="nav-link" href="{{ asset('auth') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ asset('register') }}">Register</a></li>
                    @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>solusi tepat untuk melelang barang anda</h1>
                    <h2>Aplikasi Kami Terpercaya untuk Melelang barang anda</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="/components/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->


    <main>

        @yield('web')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container footer-bottom clearfix ">
            <div class="copyright">
                &copy; Copyright <strong><span>Aplikasi Lelang</span></strong>. All Rights Reserved
            </div>
            {{-- <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div> --}}
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/components/vendor/aos/aos.js"></script>
    <script src="/components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/components/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/components/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/components/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/components/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="/components/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/components/js/main.js"></script>
    @yield('script')

</body>

</html>
