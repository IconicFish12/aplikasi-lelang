<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Dashboard</li>

        <li class="nav-item">
            <a class="nav-link " href="/admin">
                <i class="bi bi-speedometer"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Komponen Sistem</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/daftar-barang">
                <i class="bi bi-box2"></i>
                <span>Daftar Barang</span>
            </a>
        </li>

        @if (auth('petugas')->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/admin/kategori">
                    <i class="bi bi-grid"></i>
                    <span>Kategori Barang</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pelelanagn-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journals"></i><span>Komponen Pelelangan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pelelanagn-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/daftar-lelang">
                        <i class="bi bi-circle"></i>
                        <span>Daftar Pelelangan</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/riwayat">
                        <i class="bi bi-circle"></i>
                        <span>Hasil Pelelangan</span>
                    </a>
                </li>
                @if (auth('petugas')->user()->role === 'admin')
                    <li>
                        <a href="/admin/penawaran">
                            <i class="bi bi-circle"></i>
                            <span>Data Penawaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/permohonan-lelang">
                            <i class="bi bi-circle"></i>
                            <span>Data Permohonan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if (auth('petugas')->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i>
                    <span>Pengelolan User</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/petugas-lelang">
                            <i class="bi bi-circle"></i>
                            <span>Daftar Petugas</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/konsumen">
                            <i class="bi bi-circle"></i>
                            <span>Daftar Konsumen</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="/">
                <i class="bi bi-filetype-sql"></i>
                <span>Backup Database</span>
            </a>
        </li>

    </ul>

</aside>
<!-- End Sidebar-->
