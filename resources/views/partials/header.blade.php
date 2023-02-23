<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/admin" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block mx-2">pAplikasi Lelang</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="ms-3">
        <script>
            function display_ct7() {
                var x = new Date()
                var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
                hours = x.getHours() % 12;
                hours = hours ? hours : 12;
                hours = hours.toString().length == 1 ? 0 + hours.toString() : hours;

                var minutes = x.getMinutes().toString()
                minutes = minutes.length == 1 ? 0 + minutes : minutes;

                var seconds = x.getSeconds().toString()
                seconds = seconds.length == 1 ? 0 + seconds : seconds;

                var x1 = " - " + hours + ":" + minutes + ":" + seconds + " " + ampm;
                document.getElementById('ct7').innerHTML = x1;
                display_c7();
            }

            function display_c7() {
                var refresh = 1000; // Refresh rate in milli seconds
                mytime = setTimeout('display_ct7()', refresh)
            }
            display_c7()
        </script>
        <div onload="display_c7()">
            @inject('carbon', 'Carbon\Carbon')
            {{ $carbon->format('l jS \of F Y ') }} <span id="ct7"></span>
        </div>
    </div>


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('petugas')->user()->nama_petugas }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::guard('petugas')->user()->nama_petugas }}</h6>
                        <span>{{ Auth::guard('petugas')->user()->level->level }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ asset('/admin/me') }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ asset('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>
<!-- End Header -->
