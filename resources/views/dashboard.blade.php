@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        @if (Auth::user()->user_type_id == 1)
            <div class="main-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Analysis</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                    <a href="{{ url('paymentrequest') }}" class="btn btn-grd btn-grd-info px-3"><i
                                            class="bi bi-chat me-2"></i>wallet Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xxl-8 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                                class="rounded-circle bg-grd-info p-1" width="60" height="60"
                                                alt="user">
                                            <div class="">
                                                <p class="mb-0 fw-semibold">Welcome back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-5">
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet Request</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">alarm</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Distributor</p>
                                        <h3 class="mb-0">{{ $distributor }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">anchor</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Retailer</p>
                                        <h3 class="mb-0">{{ $retailer }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">handshake</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Customer</p>
                                        <h3 class="mb-0">{{ $customercount }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons">supervisor_account</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Applications</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">file_open</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 2)
            <div class="main-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                    <a href="{{ url('paymentrequest') }}" class="btn btn-grd btn-grd-info px-3"><i
                                            class="bi bi-chat me-2"></i>wallet Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xxl-8 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                                class="rounded-circle bg-grd-info p-1" width="60" height="60"
                                                alt="user">
                                            <div class="">
                                                <p class="mb-0 fw-semibold">Welcome back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">wallet</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet Request</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">alarm</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Distributor</p>
                                        <h3 class="mb-0">{{ $distributor_count }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">anchor</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Retailer</p>
                                        <h3 class="mb-0">{{ $retailer_count }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">handshake</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Customer</p>
                                        <h3 class="mb-0">{{ $customer }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">supervisor_account</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">services</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">manage_accounts</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Applications</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">file_open</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 3)
            <div class="main-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                    <a href="{{ url('wallet') }}" class="btn btn-grd btn-grd-info px-3"><i
                                            class="bi bi-chat me-2"></i>wallet Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xxl-8 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                                class="rounded-circle bg-grd-info p-1" width="60" height="60"
                                                alt="user">
                                            <div class="">
                                                <p class="mb-0 fw-semibold">Welcome back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet Request</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white">alarm</span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Retailer</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">handshake</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Customers</p>
                                        <h3 class="mb-0">{{ $customer }}</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">supervisor_account</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">
                                            Applications</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">file_open</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 4)
            <div class="main-content">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                    <a href="{{ url('wallet') }}" class="btn btn-grd btn-grd-info px-3"><i
                                            class="bi bi-chat me-2"></i>wallet Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xxl-8 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                                class="rounded-circle bg-grd-info p-1" width="60" height="60"
                                                alt="user">
                                            <div class="">
                                                <p class="mb-0 fw-semibold">Welcome back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Customers</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">supervisor_account</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Applications</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">file_open</i></span>
                                    </div>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ( Auth::user()->user_type_id == 5  )
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <div class="col-auto">
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <a href="{{ url('wallet') }}" class="btn btn-grd btn-grd-info px-3"><i
                                        class="bi bi-chat me-2"></i>wallet Request</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xxl-8 d-flex align-items-stretch">
                    <div class="card w-100 overflow-hidden rounded-4">
                        <div class="card-body position-relative p-4">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                            class="rounded-circle bg-grd-info p-1" width="60" height="60"
                                            alt="user">
                                        <div class="">
                                            <p class="mb-0 fw-semibold">Welcome back</p>
                                            <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                <div class="col">
                    <div class="card rounded-4 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="mb-1">Wallet</p>
                                    <h3 class="mb-0">0</h3>
                                </div>
                                <div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height:6px;">
                                <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded-4 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="mb-1">Services</p>
                                    <h3 class="mb-0">0</h3>
                                </div>
                                <div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">manage_accounts</i></span>
                                </div>
                            </div>
                            <div class="progress mb-0" style="height:6px;">
                                <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </main>
@endsection
