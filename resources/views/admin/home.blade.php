@extends('layouts.index')
@section('app')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <!-- Left side columns -->
        <div class="">
            <div class="row d-flex">

                <!-- Sales Card -->
                <div class="col-xl-3 col-md-6 mt-3">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Barang Lelang</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box2"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $barang }} Barang</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Sales Card -->

                <!-- Customers Card -->
                <div class="col-xl-3 col-md-6 mt-3">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Lelang Aktif</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-archive"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $lelang }} Data</h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End Customers Card -->

                <!-- Revenue Card -->
                <div class="col-xl-3 col-md-6 mt-3">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Total Lelang <span>|  Keseluruhan</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-break">@money($hasil)</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xl-3 col-md-6 mt-3">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Customer</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $costumer }} User</h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End Customers Card -->
            </div>
        </div>
        <!-- End Left side columns -->
    </section>
@endsection
