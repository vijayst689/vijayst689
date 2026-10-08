@extends('layouts.app')
@section('content')
    <style>
.sliding-text-container {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    background: #0d47a1; /* Dark Blue */
    padding: 10px 0;
}

.sliding-wrapper {
    display: inline-flex;
    align-items: center;
    padding-left: 100%;
    animation: slide 120s linear infinite;
}

.sliding-text {
    color: #0d6efd !important; /* Bootstrap Blue */
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

@keyframes slide {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-200%);
    }
}
    </style>
    <style>
        /* Dashboard Card */
        .card {
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Card Body */
        /* .card-body {
            padding: 18px;
        } */

        /* Icon Circle */
        .icon-info {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.6);
        }

        .icon-info i {
            font-size: 26px;
        }

        /* Title Text */
        .card p {
            font-weight: 600;
            color: #546e7a !important;
            letter-spacing: 0.3px;
        }

        /* Value Number */
        .card h4 {
            font-weight: 700;
            color: #263238;
        }

        /* Progress Bar */
        .progress {
            border-radius: 10px;
            background: #eceff1;
        }

        .progress-bar {
            border-radius: 10px;
        }

        /* Status Color Overrides */
        .text-danger {
            color: #e53935 !important;
        }

        .text-info {
            color: #1e88e5 !important;
        }

        .text-warning {
            color: #fb8c00 !important;
        }

        .text-success {
            color: #43a047 !important;
        }

        .text-secondary {
            color: #757575 !important;
        }

        .text-purple {
            color: #8e24aa !important;
        }

        .bg-danger {
            background: linear-gradient(90deg, #e53935, #ff5252) !important;
        }

        .bg-info {
            background: linear-gradient(90deg, #1e88e5, #64b5f6) !important;
        }

        .bg-warning {
            background: linear-gradient(90deg, #fb8c00, #ffb74d) !important;
        }

        .bg-success {
            background: linear-gradient(90deg, #43a047, #81c784) !important;
        }

        .bg-secondary {
            background: linear-gradient(90deg, #757575, #bdbdbd) !important;
        }

        .bg-purple {
            background: linear-gradient(90deg, #8e24aa, #ce93d8) !important;
        }

        /* Sliding Notification Text */
        .sliding-text-container {
            background: linear-gradient(90deg, #0d47a1, #1976d2);
            padding: 10px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideText {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Dark Section Card */
        .card.bg-dark {
            background: linear-gradient(135deg, #1c1c2b, #2c2c44) !important;
            border-radius: 16px;
        }

        .card.bg-dark .card-title {
            font-weight: 700;
            letter-spacing: 1px;
        }
    </style>
    {{-- /* Meeting List Design */ --}}
     <style>
.sliding-text-container {
    width: 100%;
    overflow: hidden;
    background: #f8f9fa;
    white-space: nowrap;
}

.sliding-wrapper {
    display: inline-flex;
    align-items: center;
    padding-left: 100%;
    animation: slide 120s linear infinite; /* duration */
}

.sliding-text {
    display: inline-block;
    font-size: 18px;
    white-space: nowrap;
}

@keyframes slide {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-200%); /* 🔥 முக்கிய change */
    }
}

.sliding-text-container:hover .sliding-wrapper {
    animation-play-state: paused;
}

        .banner-viewer {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .banner-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80%;
        }

        .banner-close {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #fff;
            font-size: 40px;
            cursor: pointer;
        }
    </style>
    <style>
        .blink-card {
            animation: blinkEffect 1s infinite;
        }

        @keyframes blinkEffect {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        .blink-card {
            animation: glowBlink 1s infinite alternate;
        }

        @keyframes glowBlink {
            from {
                box-shadow: 0 0 5px red;
            }

            to {
                box-shadow: 0 0 20px red;
            }
        }
    </style>
    <style>
        .product-card {
            width: 150px;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            transition: 0.3s;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            height: 120px;
            object-fit: cover;
        }

        .product-card h6 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .product-card p {
            font-size: 14px;
            font-weight: bold;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 28px;
            height: 28px;
            background: #ff6a00;
            border-radius: 50%;
            color: #fff;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 12px;
            font-weight: bold;
        }

        .swiper-button-next,
        .swiper-button-prev {
            top: 45%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-more {
            background: linear-gradient(45deg, #ff512f, #dd2476);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-more:hover {
            background: linear-gradient(45deg, #36d1dc, #5b86e5);
            color: #fff;
            transform: scale(1.05);
        }
    </style>
    <style>
        /* Outer glow */
        @keyframes outerGlow {
            0% {
                box-shadow: 0 0 5px rgba(168, 85, 247, 0.3);
            }

            50% {
                box-shadow: 0 0 25px rgba(168, 85, 247, 0.8);
            }

            100% {
                box-shadow: 0 0 5px rgba(168, 85, 247, 0.3);
            }
        }

        /* Inner background + text */
        @keyframes innerPulse {
            0% {
                background-color: #ffffff;
                color: #333;
            }

            50% {
                background-color: rgba(139, 92, 246, 0.35);
                color: #6b21a8;
            }

            100% {
                background-color: #ffffff;
                color: #333;
            }
        }

        /* Apply to card */
        .inprocess-card {
            animation: outerGlow 1.5s infinite;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Apply inside */
        .inprocess-card .card-body {
            animation: innerPulse 1.5s infinite;
            padding: 30px 10px;
        }

        /* Text style */
        .aadhaar-text {
            font-size: 18px;
            font-weight: 600;
        }
    </style>
    <style>
        @keyframes blinkColor {
            0% {
                color: red;
            }

            25% {
                color: green;
            }

            50% {
                color: blue;
            }

            75% {
                color: orange;
            }

            100% {
                color: red;
            }
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Dashboard</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    @if (Auth::user()->user_type_id == 1)
                        <div class="sliding-text-container">
                            @foreach ($notify as $n)
                                <h5 class="sliding-text text-danger">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
                            @endforeach
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="mdi mdi-diamond text-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Inprocess</p>
                                                <h4 class="mb-1 font-size-20">{{ $inpro }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-info" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Resubmit</p>
                                                <h4 class="mb-1 font-size-20">{{ $resub }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Rejected"><i
                                                        class="mdi mdi-diamond text-secondary"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Rejected</p>
                                                <h4 class="mb-1 font-size-20">{{ $rerej }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-secondary" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="mdi mdi-playlist-check text-success"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Approved</p>
                                                <h4 class="mb-1 font-size-20">{{ $approve }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="12" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/rawallet') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Ramji Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->rawallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/rapaymentrequest') }}"> <i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">RaWallet Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $ramjirequestAmount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/othersite_request') }}"> <i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">OtherSite Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $othersite_count }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/distributors') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Distributor</p>
                                                <h4 class="mb-1 font-size-20">{{ $distributor }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/retailers') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Retailler</p>
                                                <h4 class="mb-1 font-size-20">{{ $retailer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/customers') }}"><i
                                                        class="mdi mdi-account-multiple text-purple"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Customer</p>
                                                <h4 class="mb-1 font-size-20">{{ $customercount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-purple" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/nalavariyam/request') }}"><i
                                                        class="mdi mdi-account-multiple text-purple"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Nalavariyam Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $nalcount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-purple" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/view_appointment') }}"><i
                                                        class="mdi mdi-account-multiple text-purple"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Certificate</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-purple" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-xxl flex-grow-1 container-p-y bg-light">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card bg-dark">
                                        <div class="card-header">
                                            <button type="button" class="btn btn-md btn-success text-white"
                                                style="float:right;"><i class='bx bxs-plus-alt'></i>
                                                Nalavariyam</button>
                                            <h4 class="card-title text-white">Nalavariyam</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($ourservice as $ser)
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <div class="icon-info">
                                                    <a href="{{ url('/servicesone', $ser->id) }}"><i
                                                            class="mdi mdi-diamond text-success"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-center">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam</p>
                                                    <h4 class="mb-1 font-size-20"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
 <div class="row">
                    @if (Auth::user()->user_type_id == 2)
<div class="sliding-text-container">
    <div class="sliding-wrapper">
        @foreach ($notify as $n)
            <h5 class="sliding-text">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
        @endforeach
    </div>
</div>

                         <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/othersite_request') }}"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">OtherSite Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $othersite_count }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Nalavariyam Pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pendingcount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="mdi mdi-playlist-check text-success"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Approved</p>
                                                <h4 class="mb-1 font-size-20">{{ $approve }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="12" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/paymentrequest') }}"> <i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $RequestAmount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/distributors') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Distributor</p>
                                                <h4 class="mb-1 font-size-20">{{ $distributor }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/retailers') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Retailler</p>
                                                <h4 class="mb-1 font-size-20">{{ $retailer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="mdi mdi-diamond text-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Inprocess</p>
                                                <h4 class="mb-1 font-size-20">{{ $inpro }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-info" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->verified == 1)
                            @foreach ($ourservice as $ser)
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <div class="icon-info">
                                                     <a href="{{ url('/servicesone', 6) }}"><img
                                                        src="{{ asset('upload/nalavariyam.jpg') }}" style="width:50px; height:50px; object-fit:contain;"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-center">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam</p>
                                                    <h4 class="mb-1 font-size-20"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                               <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <div class="icon-info">
                                                                                               <a href="{{ url('/customers') }}">
        <img src="{{ asset('upload/tnega.png') }}" style="width:50px; height:50px; object-fit:contain;"
             alt="TNEGA"
             class="rounded-circle"
             style="width:50px; height:50px; object-fit:cover;" >
    </a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-center">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">TNEGA</p>
                                                    <h4 class="mb-1 font-size-20"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <div class="icon-info">
                                                <a href="{{ url('/allservices') }}"> <img
                                                        src="{{ asset('upload/allservice.png') }}" style="width:50px; height:50px; object-fit:contain;"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-center">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Services</p>
                                                    <h4 class="mb-1 font-size-20"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        @if (Auth::user()->verified == 1)
                               <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <div class="icon-info">
                                                <a href="{{ url('/nalavariyam/wallet') }}"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-center">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Na Wallet</p>
                                                    <h4 class="mb-1 font-size-20">{{ Auth::user()->nalavariyamwallet }}</h4>
                                                </div>
                                            </div>
                                             <button type="button" class="btn-sm btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addMoneyModal">Add
                                                Money</button>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/application_status') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Application Status</p>
                                                <h4 class="mb-1 font-size-20">0</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/wallet') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->wallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/rawallet') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Ramji Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->rawallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (Auth::user()->user_type_id == 3)
<div class="sliding-text-container">
    <div class="sliding-wrapper">
        @foreach ($notify as $n)
            <h5 class="sliding-text">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
        @endforeach
    </div>
</div>
                        @if (Auth::user()->verified == 1)
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card bg-dark">
                                            <div class="card-header">
                                                <button onclick="NalavariyamData()" type="button"
                                                    class="btn btn-md btn-success text-white" style="float:right;"><i
                                                        class='bx bxs-plus-alt'></i>Click Me</button>
                                                <h4 class="card-title text-white">தொழிற்சங்க விபரம்</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->verified == 1)
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-warning text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/member') }}"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Member</p>
                                                    <h4 class="mb-1 font-size-20">{{ $memcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated bg-warning" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-warning text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Pending</p>
                                                    <h4 class="mb-1 font-size-20">{{ $pendingcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated bg-info" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-danger text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/resubmit"><i
                                                            class="mdi mdi-diamond text-white"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Resubmit</p>
                                                    <h4 class="mb-1 font-size-20">{{ $resubmitcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-success text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/approved"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Approved</p>
                                                    <h4 class="mb-1 font-size-20">{{ $approvedcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55"
                                                aria-valuemin="0"aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="mdi mdi-playlist-check text-success"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Approved</p>
                                                <h4 class="mb-1 font-size-20">{{ $approve }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="12" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="mdi mdi-diamond text-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Inprocess</p>
                                                <h4 class="mb-1 font-size-20">{{ $inpro }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-info" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Resubmit</p>
                                                <h4 class="mb-1 font-size-20">{{ $resub }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/allservices') }}"> <img
                                                        src="{{ asset('upload/allservice.png') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Services</p>
                                                <h4 class="mb-1 font-size-20"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/servicesone', 6) }}"><img
                                                        src="{{ asset('upload/nalavariyam.jpg') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Nalavariyam</p>
                                                <h4 class="mb-1 font-size-20"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/customers') }}"><img
                                                        src="{{ asset('upload/tnega.png') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>

                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">TNEGA</p>
                                                <h4 class="mb-1 font-size-20">{{ $customer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/wallet') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->wallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/paymentrequest') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $RequestAmount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/customers') }}"><i
                                                        class="mdi mdi-diamond text-purple"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Customer</p>
                                                <h4 class="mb-1 font-size-20">{{ $customer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-purple" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Rejected"><i
                                                        class="mdi mdi-diamond text-secondary"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Rejected</p>
                                                <h4 class="mb-1 font-size-20">{{ $rerej }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-secondary" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (Auth::user()->user_type_id == 4)
<div class="sliding-text-container">
    <div class="sliding-wrapper">
        @foreach ($notify as $n)
            <h5 class="sliding-text">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
        @endforeach
    </div>
</div>
                        @if (Auth::user()->verified == 1)
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card bg-dark">
                                            <div class="card-header">
                                                <button onclick="NalavariyamData()" type="button"
                                                    class="btn btn-md btn-success text-white" style="float:right;"><i
                                                        class='bx bxs-plus-alt'></i>Click Me</button>
                                                <h4 class="card-title text-white">தொழிற்சங்க விபரம்</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->verified == 1)
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-warning text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/member') }}"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Member</p>
                                                    <h4 class="mb-1 font-size-20">{{ $memcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated bg-warning" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-warning text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Pending</p>
                                                    <h4 class="mb-1 font-size-20">{{ $pendingcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated bg-info" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-danger text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/resubmit"><i
                                                            class="mdi mdi-diamond text-white"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Resubmit</p>
                                                    <h4 class="mb-1 font-size-20">{{ $resubmitcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="p-3 mb-2 bg-success text-white">
                                                <div class="icon-info">
                                                    <a href="{{ url('/nalavariyam/form') }}/approved"><i
                                                            class="mdi mdi-account-multiple text-dark"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-8 align-self-center text-dark">
                                                <div class="ms-2 text-end">
                                                    <p class="mb-1 text-muted font-size-13">Nalavariyam Approved</p>
                                                    <h4 class="mb-1 font-size-20">{{ $approvedcount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height:3px;">
                                            <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                                style="max-width: 55%;" aria-valuenow="55"
                                                aria-valuemin="0"aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="mdi mdi-playlist-check text-success"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Approved</p>
                                                <h4 class="mb-1 font-size-20">{{ $approve }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="12" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="mdi mdi-diamond text-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Inprocess</p>
                                                <h4 class="mb-1 font-size-20">{{ $inpro }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-info" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Resubmit</p>
                                                <h4 class="mb-1 font-size-20">{{ $resub }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/allservices') }}"> <img
                                                        src="{{ asset('upload/allservice.png') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Services</p>
                                                <h4 class="mb-1 font-size-20"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/servicesone', 6) }}"><img
                                                        src="{{ asset('upload/nalavariyam.jpg') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Nalavariyam</p>
                                                <h4 class="mb-1 font-size-20"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/customers') }}"><img
                                                        src="{{ asset('upload/tnega.png') }}"
                                                        class="img-fluid rounded-circle"
                                                        style="width:45px; height:45px;"></a>
                                            </div>

                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">TNEGA</p>
                                                <h4 class="mb-1 font-size-20">{{ $customer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/wallet') }}"> <i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->wallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/paymentrequest') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $RequestAmount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/customers') }}"><i
                                                        class="mdi mdi-diamond text-purple"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Customer</p>
                                                <h4 class="mb-1 font-size-20">{{ $customer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-purple" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Rejected"><i
                                                        class="mdi mdi-diamond text-secondary"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Rejected</p>
                                                <h4 class="mb-1 font-size-20">{{ $rerej }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-secondary" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (Auth::user()->user_type_id == 5)
<div class="sliding-text-container">
    <div class="sliding-wrapper">
        @foreach ($notify as $n)
            <h5 class="sliding-text">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
        @endforeach
    </div>
</div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="mdi mdi-diamond text-danger"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Pending</p>
                                                <h4 class="mb-1 font-size-20">{{ $pending }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-danger" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="mdi mdi-diamond text-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Inprocess</p>
                                                <h4 class="mb-1 font-size-20">{{ $inpro }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-info" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Resubmit</p>
                                                <h4 class="mb-1 font-size-20">{{ $resub }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Rejected"><i
                                                        class="mdi mdi-diamond text-secondary"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Rejected</p>
                                                <h4 class="mb-1 font-size-20">{{ $rerej }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-secondary" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="mdi mdi-playlist-check text-success"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Approved</p>
                                                <h4 class="mb-1 font-size-20">{{ $approve }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-success" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="12" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/wallet') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet</p>
                                                <h4 class="mb-1 font-size-20">{{ Auth::user()->wallet }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 align-self-center">
                                            <div class="icon-info">
                                                <a href="{{ url('/paymentrequest') }}"><i
                                                        class="mdi mdi-diamond text-warning"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-8 align-self-center text-center">
                                            <div class="ms-2 text-end">
                                                <p class="mb-1 text-muted font-size-13">Wallet Request</p>
                                                <h4 class="mb-1 font-size-20">{{ $RequestAmount }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height:3px;">
                                        <div class="progress-bar progress-animated  bg-warning" role="progressbar"
                                            style="max-width: 55%;" aria-valuenow="55" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dataaa" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">தொழிற்சங்க விபரம்</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <center>
                        <p><b>தமிழ்நாடு ராம்ஜி கட்டுமானம் மற்றும் அமைப்புசார்ந்த அமைப்புசாரா பொது தொழிலாளர்கள் நலசங்கம்<br>
                                பதிவு எண் : 713/KKM </b></p>
                        <div class="form-group row">
                            <span><b> இபடிவம் தேதி : <span id="edate" class="text-danger"></span> </b></span>
                            <span id="ename"><b> </b></span>
                            <span id="ephone"><b> </b></span>
                        </div>

                    </center>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    @if ($meeting)
        <!-- Meeting Modal -->
        <div class="modal fade" id="meetingModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">{{ $meeting->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($meeting->meetingdate)->format('d M Y') }}</p>
                        <p><strong>Place:</strong> {{ $meeting->place }}</p>
                        <p><strong>Training Fee:</strong> ₹{{ $meeting->amount }}</p>
                        <hr>
                        <div class="alert alert-info mt-3 d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Note:</strong> Please register for the meeting before the scheduled date..!
                            </div>

                            @if ($meeting->meetingbanner)
                                <button class="btn btn-sm btn-warning" id="openBanner">
                                    View Banner
                                </button>

                                <div id="bannerViewer" class="banner-viewer">
                                    <span class="banner-close">&times;</span>
                                    <img class="banner-content"
                                        src="{{ asset('storage/' . $meeting->meetingbanner) }}">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ url('meeting/register/' . $meeting->id) }}" class="btn btn-success">
                            Register Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="addMoneyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">
                        💰 Add Money to Wallet
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 pb-4">

                    <!-- Wallet Info Card -->
                    <div class="bg-light rounded-4 p-3 mb-4 d-flex justify-content-between align-items-center shadow-sm">
                        <div>
                            <small class="text-muted">Current Balance</small>
                            <h3 class="fw-bold text-success mb-0">
                                ₹ {{ Auth::user()->nalavariyamwallet ?? 0 }}
                            </h3>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">Welcome</small><br>
                            <strong>{{ Auth::user()->name }}</strong>
                        </div>
                    </div>

                    <!-- Trouble Alert -->
                    <div class="alert alert-warning border-0 rounded-3 text-center py-2 small">
                        ⚠️ Facing issues with online payment?
                        <a href="#" class="fw-bold text-danger text-decoration-none switchToManual">
                            Switch to Manual Payment
                        </a>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-pills nav-justified mb-4 bg-light rounded-pill p-1">
                        <li class="nav-item">
                            <button class="nav-link active rounded-pill fw-semibold" data-bs-toggle="pill"
                                data-bs-target="#onlineTab">
                                💳 Online Payment
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-pill fw-semibold" data-bs-toggle="pill"
                                data-bs-target="#manualTab">
                                📸 Manual Payment
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <!-- ================= ONLINE PAYMENT ================= -->
                        <div class="tab-pane fade show active" id="onlineTab">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Enter Amount</label>
                                <input type="number"
                                    class="form-control form-control-lg rounded-3 border-warning amountInput"
                                    placeholder="Enter amount" min="1">
                            </div>

                            <!-- Quick Amount Buttons -->
                            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                                @foreach ([50, 100, 300, 500, 1000, 2000, 5000] as $amt)
                                    <button type="button"
                                        class="btn btn-outline-primary rounded-pill px-4 quick-amount"
                                        data-amount="{{ $amt }}">
                                        ₹{{ $amt }}
                                    </button>
                                @endforeach
                            </div>

                            <form method="POST" action="{{ route('nalavariyamonline.create') }}"
                                class="onlinePaymentForm">
                                @csrf
                                <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                                <input type="hidden" name="amount" class="finalAmount">

                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 payBtn" disabled>
                                    <span class="payBtnText">➕ Pay Securely</span>
                                    <span class="spinner-border spinner-border-sm d-none payLoader"></span>
                                </button>
                            </form>

                        </div>

                        <!-- ================= MANUAL PAYMENT ================= -->
                        <div class="tab-pane fade" id="manualTab">


                            <form method="POST" action="{{ url('/nalavariyam/wallet/add') }}"
                                enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="/upload/qr/nala.jpeg" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Amount</label>
                                        <input type="number" name="amount"
                                            class="form-control rounded-3 border-warning" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Upload Proof</label>
                                        <input type="file" name="proof" class="form-control rounded-3"
                                            accept="image/*,application/pdf" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg w-100 rounded-3">
                                    📤 Submit Manual Request
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
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
                    if (data.message == "Success") {
                        $("#dataaa").modal("show");
                        $("#edate").html(data.e_form_date);
                        $("#ename").html(data.full_name);
                        $("#ephone").html(data.phone);
                    } else {
                        alert("Please Try Again ....");
                    }

                }
            });
        }
        var viewer = document.getElementById("bannerViewer");
        var btn = document.getElementById("openBanner");
        var closeBtn = document.querySelector(".banner-close");

        btn.onclick = function() {
            viewer.style.display = "block";
        }

        closeBtn.onclick = function() {
            viewer.style.display = "none";
        }
    </script>
    @if ($meeting)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let modal = new bootstrap.Modal(document.getElementById('meetingModal'));
                modal.show();
            });
        </script>
        <script>
        window.onload = function() {
            const el = document.getElementById("ticker");

            let distance = el.scrollWidth; // full text width
            let speed = 50; // 👈 increase = slower

            let duration = distance / speed;

            el.style.animation = `marquee ${duration}s linear infinite`;
        };
    </script>
    @endif

@endpush
