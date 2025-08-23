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
                                                <p class="mb-0 fw-semibold">Welcome Back</p>
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
                                        <p class="mb-1">Ramji Wallet</p>
                                        <h3 class="mb-0">{{ Auth::user()->rawallet }}</h3>
                                    </div>
                                    <a href="{{ url('/wallet') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Ra Request</p>
                                        <h3 class="mb-0">{{ $ramjirequestAmount }}</h3>
                                    </div>
                                    <a href="{{ url('/rapaymentrequest') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">alarm</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/distributors') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">anchor</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/retailers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">handshake</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/customers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons">supervisor_account</i></span>
                                    </div></a>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($ourservice as $ser)
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Nalavariyam</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <a href="{{ url('/servicesone', $ser->id) }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">file_open</i></span>
                                    </div></a>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 2)
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
                </div>
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
                                                <p class="mb-0 fw-semibold">Welcome Back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->verified == 1)
                     <div class="col-xxl-4 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="">
                                                <p class="mb-1 fw-semibold">தொழிற்சங்க விபரம்</p>
                                                <button class="btn btn-sm btn-info" onclick="NalavariyamData()">Click me</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    @if(Auth::user()->verified == 1)
                     <div class="col">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <p class="mb-1">Nalavariyam Member</p>
                                            <h3 class="mb-0">{{ $memcount }}</h3>
                                        </div>
                                        <a href="{{ url('/member') }}">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons-outlined">alarm</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Pending</p>
                                            <h3 class="mb-0">{{ $pendingcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/pending">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Resubmit</p>
                                            <h3 class="mb-0">{{ $resubmitcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Approved</p>
                                            <h3 class="mb-0">{{ $approvedcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/approved">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="progress mb-0" style="height:6px;">
                                        <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Pending</p>
                                        <h3 class="mb-0">{{ $pending }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Pending"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">pending</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Inprocess</p>
                                        <h3 class="mb-0">{{ $inpro }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Processing"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">processing</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Resubmit</p>
                                        <h3 class="mb-0">{{ $resub }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Resubmit"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">resubmit</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Approved</p>
                                        <h3 class="mb-0">{{ $approve }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Approved"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">approved</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">{{ Auth::user()->wallet }}</h3>
                                    </div>
                                    <a href="{{ url('/wallet') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">wallet</i></span>
                                    </div></a>
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
                                        <p class="mb-1">RaWallet</p>
                                        <h3 class="mb-0">{{ Auth::user()->rawallet }}</h3>
                                    </div>
                                    <a href="{{ url('/rawallet') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">rawallet</i></span>
                                    </div></a>
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
                                        <h3 class="mb-0">{{ $RequestAmount }}</h3>
                                    </div>
                                    <a href="{{ url('/paymentrequest') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">alarm</i></span>
                                    </div></a>
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
                                        <p class="mb-1">RaWallet Request</p>
                                        <h3 class="mb-0">{{ $ramjirequestAmount }}</h3>
                                    </div>
                                    <a href="{{ url('/rapaymentrequest') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">alarm</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/distributors') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">anchor</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/retailers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">handshake</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/customers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">supervisor_account</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Enquiry</p>
                                        <h3 class="mb-0">{{ $enquiry_count }}</h3>
                                    </div>
                                    <a href="{{ url('/viewenquiry') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">supervisor_account</i></span>
                                    </div></a>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($ourservice as $ser)
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Nalavariyam</p>
                                        <h3 class="mb-0">0</h3>
                                    </div>
                                    <a href="{{ url('/servicesone', $ser->id) }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">file_open</i></span>
                                    </div></a>
                                </div>
                                <div class="progress mb-0" style="height:6px;">
                                    <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 3)
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
                </div>

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
                                                <p class="mb-0 fw-semibold">Welcome Back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                     @if(Auth::user()->verified == 1)
                     <div class="col-xxl-4 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="">
                                                <p class="mb-1 fw-semibold">தொழிற்சங்க விபரம்</p>
                                                <button class="btn btn-sm btn-info" onclick="NalavariyamData()">Click me</button>

                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    @if(Auth::user()->verified == 1)
                     <div class="col">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <p class="mb-1">Nalavariyam Member</p>
                                            <h3 class="mb-0">{{ $memcount }}</h3>
                                        </div>
                                        <a href="{{ url('/member') }}">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons-outlined">alarm</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Pending</p>
                                            <h3 class="mb-0">{{ $pendingcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/pending">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Resubmit</p>
                                            <h3 class="mb-0">{{ $resubmitcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Approved</p>
                                            <h3 class="mb-0">{{ $approvedcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/approved">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="progress mb-0" style="height:6px;">
                                        <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Pending</p>
                                        <h3 class="mb-0">{{ $pending }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Pending"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">pending</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Inprocess</p>
                                        <h3 class="mb-0">{{ $inpro }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Processing"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">processing</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Resubmit</p>
                                        <h3 class="mb-0">{{ $resub }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Resubmit"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">resubmit</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Approved</p>
                                        <h3 class="mb-0">{{ $approve }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Approved"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">approved</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">{{ Auth::user()->wallet }}</h3>
                                    </div>
                                    <a href="{{ url('/wallet') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"></span>
                                    </div></a>
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
                                        <h3 class="mb-0">{{ $RequestAmount }}</h3>
                                    </div>
                                    <a href="{{ url('/paymentrequest') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white">alarm</span>
                                    </div></a>
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
                                    <a href="{{ url('/retailers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">handshake</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/customers') }}"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">supervisor_account</i></span>
                                    </div></a>
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
                                                <p class="mb-0 fw-semibold">Welcome Back</p>
                                                <h4 class="fw-semibold mb-0 fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                     @if(Auth::user()->verified == 1)
                     <div class="col-xxl-4 d-flex align-items-stretch">
                        <div class="card w-100 overflow-hidden rounded-4">
                            <div class="card-body position-relative p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-7">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="">
                                                <p class="mb-1 fw-semibold">தொழிற்சங்க விபரம்</p>
                                                <button class="btn btn-sm btn-info" onclick="NalavariyamData()">Click me</button>

                                            </div>
                                        </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    @if(Auth::user()->verified == 1)
                     <div class="col">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <p class="mb-1">Nalavariyam Member</p>
                                            <h3 class="mb-0">{{ $memcount }}</h3>
                                        </div>
                                        <a href="{{ url('/member') }}">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons-outlined">alarm</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Pending</p>
                                            <h3 class="mb-0">{{ $pendingcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/pending">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Resubmit</p>
                                            <h3 class="mb-0">{{ $resubmitcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
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
                                            <p class="mb-1">Nalavariyam Approved</p>
                                            <h3 class="mb-0">{{ $approvedcount }}</h3>
                                        </div>
                                        <a href="{{ url('/nalavariyam/form') }}/approved">
                                            <div
                                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                                <span class="material-icons-outlined fs-5 text-white"><i
                                                        class="material-icons">supervisor_account</i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="progress mb-0" style="height:6px;">
                                        <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div class="col">
                        <div class="card rounded-4 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <p class="mb-1">Pending</p>
                                        <h3 class="mb-0">{{ $pending }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Pending"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">pending</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Inprocess</p>
                                        <h3 class="mb-0">{{ $inpro }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Processing"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">processing</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Resubmit</p>
                                        <h3 class="mb-0">{{ $resub }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Resubmit"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">resubmit</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Approved</p>
                                        <h3 class="mb-0">{{ $approve }}</h3>
                                    </div>
                                    <a href="{{ url('/appliedservice') }}/Approved"><div
                                        class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i
                                            class="material-icons-outlined">approved</i></span>
                                    </div></a>
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
                                        <p class="mb-1">Wallet</p>
                                        <h3 class="mb-0">{{ Auth::user()->wallet }}</h3>
                                    </div>
                                    <a href="{{ url('/wallet') }}"><div class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                    </div></a>
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
                                        <h3 class="mb-0">{{ $RequestAmount }}</h3>
                                    </div>
                                    <a href="{{ url('/paymentrequest') }}">
                                        <div class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">supervisor_account</i></span>
                                    </div></a>
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
                                    <a href="{{ url('/customers') }}">
                                        <div class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                        <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">supervisor_account</i></span>
                                    </div></a>
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
                                            <p class="mb-0 fw-semibold">Welcome Back</p>
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
                                    <p class="mb-1">Pending</p>
                                    <h3 class="mb-0">{{ $pending }}</h3>
                                </div>
                                <a href="{{ url('/appliedservice') }}/Pending"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">pending</i></span>
                                </div></a>
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
                                    <p class="mb-1">Inprocess</p>
                                    <h3 class="mb-0">{{ $inpro }}</h3>
                                </div>
                                <a href="{{ url('/appliedservice') }}/Processing"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">processing</i></span>
                                </div></a>
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
                                    <p class="mb-1">Resubmit</p>
                                    <h3 class="mb-0">{{ $resub }}</h3>
                                </div>
                                <a href="{{ url('/appliedservice') }}/Resubmit"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">resubmit</i></span>
                                </div></a>
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
                                    <p class="mb-1">Approved</p>
                                    <h3 class="mb-0">{{ $approve }}</h3>
                                </div>
                                <a href="{{ url('/appliedservice') }}/Approved"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i
                                        class="material-icons-outlined">approved</i></span>
                                </div></a>
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
                                    <p class="mb-1">Wallet</p>
                                    <h3 class="mb-0">{{ Auth::user()->wallet }}</h3>
                                </div>
                                <a href="{{ url('/wallet') }}"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                </div></a>
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
                                    <h3 class="mb-0">{{ Auth::user()->wallet }}</h3>
                                </div>
                                <a href="{{ url('/wallet') }}"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">wallet</i></span>
                                </div></a>
                            </div>
                            <div class="progress mb-0" style="height:6px;">
                                <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col">
                    <div class="card rounded-4 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="mb-1">Services</p>
                                    <h3 class="mb-0">0</h3>
                                </div>
                                <a href="{{ url('/allservices') }}"><div
                                    class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                                    <span class="material-icons-outlined fs-5 text-white"><i class="material-icons-outlined">manage_accounts</i></span>
                                </div></a>
                            </div>
                            <div class="progress mb-0" style="height:6px;">
                                <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    @endif
    <div class="modal fade" id="dataaa"  tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">தொழிற்சங்க விபரம்</h5>
                         <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
                    </div>
                        <div class="modal-body">
                            <center>
                                <p><b>தமிழ்நாடு ராம்ஜி கட்டுமானம் மற்றும் அமைப்புசார்ந்த அமைப்புசாரா பொது தொழிலாளர்கள் நலசங்கம்<br>
                                    பதிவு எண் : 713/KKM </b></p>
                                <div class="form-group row">
                                    <span><b> இபடிவம் தேதி : <span id="edate" class="text-danger"></span> </b></span>
                                    <span id="ename"><b>  </b></span>
                                    <span id="ephone"><b>  </b></span>
                                </div>

                    </center>
                    <div class="modal-footer justify-content-between">
                        <a></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

@endsection
@push('page_scripts')
    <script type="text/javascript">
        function NalavariyamData() {
            var dist_id = "{{ Auth::user()->nalavariyam_dist_id }}";

            var url = "{{ url('/getnalavariyam_data') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    var data = result;
                    if(data.message == "Success"){
                        $("#dataaa").modal("show");
                        $("#edate").html(data.e_form_date);
                        $("#ename").html(data.full_name);
                        $("#ephone").html(data.phone);
                    }else{
                        alert("Please Try Again ....");
                    }

                }
            });


        }
    </script>
@endpush
