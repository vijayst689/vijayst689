@extends('layouts.app')
@section('content')
    <style>
        .service-card {
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 15px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .service-card:hover {
            background-color: #fff9e6;
            /* Light Yellow */
            transform: translateY(-5px);
            box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.15);
        }

        .service-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Centers Image */
            justify-content: center;
            /* Centers vertically */
            text-align: center;
            /* Centers Text */
            height: 100%;
        }

        .service-img {
            width: 100px !important;
            height: 100px !important;
            object-fit: contain;
            /* Prevents distortion */
            margin-bottom: 10px;
        }

        .service-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-top: 8px;
        }

        /* No service card styling */
        .no-service-card {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .no-service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .no-service-title {
            font-size: 22px;
            font-weight: 700;
            color: #333;
        }

        .no-service-subtitle {
            font-size: 16px;
            color: #666;
        }

        /* Modern button */
        .manage-btn {
            background: linear-gradient(135deg, #4f93ff, #006aff);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s ease-in-out;
            border: none;
        }

        .manage-btn:hover {
            background: linear-gradient(135deg, #006aff, #004fc1);
            box-shadow: 0 4px 12px rgba(0, 106, 255, 0.4);
            color: #fff;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            <div class="card">
                <div class="card-body">
                    @if ($serviceid == 6)
                        @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-danger">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/activationmember') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">User Activation</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4>{{ $activecount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-warning">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/member') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Member</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4>{{ $memcount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-success">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href=""><i class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Special Member</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-primary">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/bulkorder') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Bulk Order</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-info">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/bulkorderstatus') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Bulk Order Status</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-warning">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Pending</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4>{{ $pendingcount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-danger">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/nalavariyam/form') }}/resubmit"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Resubmit</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4>{{ $resubmitcount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-warning">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/nalavariyam/form') }}/approved"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Approved</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4>{{ $approvedcount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-info">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/application_status') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Application Status</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-xxl-3">
                                        <div class="card bg-info">
                                            <div class="card-body" data-intro="New Orders">
                                                <div
                                                    class="single-widget d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="widget-icon">
                                                            <a href="{{ url('/nalavariyam_services') }}"><i
                                                                    class="bx bx-mouse-alt"></i></a>
                                                        </div>
                                                        <div class="widget-desc">
                                                            <h5 class="">Service</h5>
                                                        </div>
                                                    </div>
                                                    <div class="progress-report" data-title="progress"
                                                        data-intro="And this is the last step!">
                                                        <h4></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->verified == 1)
                            @if (Auth::user()->user_type_id == 3)
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Pending</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $pendingcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-warning">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/resubmit"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Resubmit</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $resubmitcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-danger">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/approved"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Approved</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $approvedcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('member') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Member</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $memcountref }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-success">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/') }}"><i class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Special Member</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-primary">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/bulkorder') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Bulk Order</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/bulkorders') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Bulk Order Status</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->user_type_id == 4)
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/pending"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Pending</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $pendingcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-warning">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/resubmit"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Resubmit</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $resubmitcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-danger">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/nalavariyam/form') }}/approved"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Approved</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $approvedcount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('member') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Member</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4>{{ $memcountref }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-success">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Special Member</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4 align-self-center">
                                                            <div class="icon-info">
                                                                <a href="{{ url('/') }}"><i
                                                                        class="mdi mdi-account-multiple text-purple"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 align-self-center text-center">
                                                            <div class="ms-2 text-end">
                                                                <p class="mb-1 text-muted font-size-13">Special Member</p>
                                                                <h4 class="mb-1 font-size-20"></h4>
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
                                        </div> -->
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-primary">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/bulkorder') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Bulk Order</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                                            <div class="card bg-info">
                                                <div class="card-body" data-intro="New Orders">
                                                    <div
                                                        class="single-widget d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="widget-icon">
                                                                <a href="{{ url('/bulkorders') }}"><i
                                                                        class="bx bx-mouse-alt"></i></a>
                                                            </div>
                                                            <div class="widget-desc">
                                                                <h5 class="">Bulk Order Status</h5>
                                                            </div>
                                                        </div>
                                                        <div class="progress-report" data-title="progress"
                                                            data-intro="And this is the last step!">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @php
                                $data = DB::table('appointment_reg')
                                    ->where('email', Auth::user()->email)
                                    ->first();
                            @endphp
                            <div class="card">
                                <div class="card-body">
                                    @if (Auth::user()->is_completed == 0 || ($data && $data->status == 'Resubmit'))
                                        <h5 class="card-title">பதவி நியமனச் சான்றிதழ்</h5>
                                        <div class="row">
                                            <form class="row g-4" action="{{ url('add_appointment') }}"
                                                enctype="multipart/form-data" method="post" id="myForm">
                                                @csrf
                                                @if ($data && $data->status == 'Resubmit')
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                @endif
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name" class="form-label text-dark">பெயர்
                                                            தமிழில்</label>
                                                        <input required type="text" class="form-control"
                                                            name="name" placeholder="பெயர்" maxlength="100"
                                                            value="{{ old('name', $data->name ?? '') }}" />

                                                        <label for="district" class="form-label text-dark">மாவட்டம்
                                                            தமிழில்</label>
                                                        <input required type="text" class="form-control"
                                                            name="district" placeholder="மாவட்டம்" maxlength="100"
                                                            value="{{ old('district', $data->district ?? '') }}" />

                                                        <label for="village" class="form-label text-dark">கிராமம்
                                                            தமிழில்</label>
                                                        <input required type="text" class="form-control"
                                                            name="village" placeholder="கிராமம்" maxlength="100"
                                                            value="{{ old('village', $data->village ?? '') }}" />

                                                        <label for="station_name" class="form-label text-dark">சேவை
                                                            நிலையத்தின்
                                                            பெயர்</label>
                                                        <input required type="text" class="form-control"
                                                            name="station_name" placeholder="சேவை நிலையத்தின் பெயர்"
                                                            maxlength="100"
                                                            value="{{ old('station_name', $data->station_name ?? '') }}" />
                                                        @if (!empty($data) && !empty($data->status == 'Resubmit'))
                                                            <label for="remarks"
                                                                class="form-label text-danger">Remarks</label>
                                                            <input required type="text" class="form-control"
                                                                name="remarks" placeholder="remarks" maxlength="100"
                                                                value="{{ old('remarks', $data->remarks ?? '') }}"
                                                                readonly />
                                                        @endif
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="mobile" class="form-label text-dark">செல்
                                                            நம்பர்</label>
                                                        <input required type="text" maxlength="10"
                                                            class="form-control number" name="mobile"
                                                            placeholder="Mobile Number"
                                                            value="{{ old('mobile', $data->mobile ?? '') }}" />

                                                        <label for="taluk" class="form-label text-dark">தாலுகா
                                                            தமிழில்</label>
                                                        <input required type="text" maxlength="100"
                                                            class="form-control" name="taluk" placeholder="தாலுகா"
                                                            value="{{ old('taluk', $data->taluk ?? '') }}" />

                                                        <label for="photo"
                                                            class="form-label text-dark">புகைப்படம்</label>

                                                        @if (!empty($data) && !empty($data->photo))
                                                            {{-- Show existing photo --}}
                                                            <div class="mb-2">
                                                                <img src="{{ asset('upload/nalavariyam_document/photo/' . $data->photo) }}"
                                                                    alt="Photo" class="img-thumbnail"
                                                                    width="100" />
                                                            </div>

                                                            {{-- Optional new upload --}}
                                                            <input type="file" name="photo" class="form-control"
                                                                accept="image/jpeg, image/png" />
                                                            <small class="text-muted">புதிய புகைப்படத்தைப் பதிவேற்ற
                                                                விரும்பினால்
                                                                தேர்ந்தெடுக்கவும்.</small>
                                                        @else
                                                            {{-- Required upload for new record --}}
                                                            <input type="file" name="photo" class="form-control"
                                                                required accept="image/jpeg, image/png" />
                                                        @endif
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="col-12">
                                                            <div class="mb-0">
                                                                <button id="save1" type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                </div>
                            @elseif(Auth::user()->is_completed == 1 && ($data && ($data->status == 'Pending' || $data->status == 'Resubmit')))
                                <h1 class="text-center">Please Wait...</h1>
                            @elseif($data && $data->status == 'Approved')
                                <div class="alert alert-light border d-flex align-items-center justify-content-between">
                                    <div>
                                        <strong>பதவி நியமனச் சான்றிதழ்:</strong>
                                        @if (!empty($data) && !empty($data->certificate))
                                            <span class="text-success ms-1">Available</span>
                                        @else
                                            <span class="text-danger ms-1">Not Uploaded</span>
                                        @endif
                                    </div>
                                    @if (!empty($data) && !empty($data->certificate))
                                        <a href="{{ url('upload/nalavariyam_document/certificate/' . $data->certificate) }}"
                                            download class="btn btn-warning btn-sm">
                                            <i class="bi bi-download"></i> Download
                                        </a>
                                    @endif
                                </div>
                        @endif
                    @else
                        <h4 class="text-center">Please Verify Your ID...</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <form class="row g-4 permissionform"
                                        action="{{ url('updatenalavariyam_activation') }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="userid" value="{{ Auth::user()->id }}" />
                                            <input type="hidden" name="activation_amount_hidden" id="act_amount_hidden"
                                                value="0" />
                                            <input type="hidden" name="admin_amount" id="adminamt" / value="0">
                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->user_type_id != 2)
                                                    <label for="nalavariyam_usertype" class="form-label">User Type</label>
                                                    <select required type="text" class="form-control"
                                                        id="nalavariyam_usertype" name="nalavariyam_usertype">
                                                        <option value="">Select</option>
                                                        <option value="3">பஞ்சாயத்து ஐடி</option>
                                                        <option value="4">கிளை நிர்வாக ஐடி</option>
                                                    </select>
                                                @endif
                                                <label for="nalavariyam_dist_id" class="form-label">District</label>
                                                <select required name="nalavariyam_dist_id" id="dist_id"
                                                    class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option value="{{ $d->id }}">{{ $d->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div class="row mt-1">
                                                    <label for="aadhaar_no" class=""><span
                                                            style="color:red"></span>Aadhaar
                                                        No</label>
                                                    <div class="col-md-8">
                                                        <input required="required" type="text"
                                                            class="form-control number" id="aadhaar_no" maxlength="12"
                                                            name="aadhaar_no" placeholder="Aadhar No">
                                                    </div>
                                                    <div id="verifybtnhide" class="input-group-append col-sm-2">
                                                        <button onclick="getaadhaar_otpf();" id="checkotp"
                                                            type="submit" class="btn btn-primary">Verify</button>
                                                    </div>
                                                    <div class="col-md-12 mt-1" id="verifyotphide" style="display:none;">
                                                        <div class="row">
                                                            <label for="aadhaar_no" class=""><span
                                                                    style="color:red"></span>OTP</label>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <input type="text" name="otp" id="otp"
                                                                        placeholder="Enter OTP" maxlength="6"
                                                                        class="form-control" required="required">
                                                                    <input type="hidden" id="refid">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" id="verifydatabtnhide">
                                                                <button onclick="getaadhaar_dataf();" id="subotp"
                                                                    type="button" class="btn btn-primary">Submit
                                                                    OTP</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->user_type_id != 2)
                                                    <label for="name" class="form-label">Activation Payment</label>
                                                    <input readonly required="required" type="text"
                                                        class="form-control" name="activation_amount" id="act_amount">
                                                @endif
                                                <label for="nalavariyam_taluk_id" class="form-label">Taluk</label>
                                                <select name="nalavariyam_taluk_id" id="taluk" class="form-control">
                                                </select>

                                                <label for="name" class="form-label">Name</label>
                                                <input readonly required="required" type="text" class="form-control"
                                                    name="full_name" id="fullname" maxlength="150"
                                                    placeholder="Full Name">

                                                <label for="address" class="form-label">Address</label>
                                                <textarea required name="address" id="address" class="form-control" placeholder="Address" rows="3"
                                                    maxlength="500"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <div class="mt-2 text-center" id="details"></div>
                                    <div class="mt-2 text-center" id="nopayment"></div>
                                    <div class="col-md-12 text-center">
                                        <button id="save" class="btn btn-info" type="submit">Save</button>
                                        <a href="{{ url('/') }}" class="btn btn-info">Back</a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <strong> {{ session('success') }} </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <strong> {{ session('error') }} </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">Apply Service</h5>
                                    @if ($serviceid == 68)
                                        <div class="d-flex align-items-center gap-2 justify-content-lg-end ">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#agentreg">Agent Register</button>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="row">
                                            <form class="row g-4" action="#" enctype="multipart/form-data"
                                                method="post">
                                                <div class="col-lg-12">
                                                    <div class="mb-3 row">
                                                        {{-- <input type="hidden" id="customerid" name="customerid" value="{{ $talukid }}"> --}}
                                                        @if ($serviceid == 119)
                                                            @foreach ($services as $service)
                                                                <div class="col-sm-4 col-md-6 col-xl-2 mb-2">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <span class="bg-label">
                                                                            <a
                                                                                href="{{ url('/applyservices', $service->id) }}"><img
                                                                                    src="/upload/service/{{ $service->service_image }}"
                                                                                    alt="user-avatar"
                                                                                    style="width: 160px; height: 180px;"
                                                                                    id="uploadedAvatar">
                                                                        </span></a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @elseif($serviceid == 10)
                                                            @foreach ($services as $service)
                                                                <div class="col-md-3 col-lg-2 col-sm-4 mb-2">
                                                                    <div class="text-center">
                                                                        <a
                                                                            href="{{ url('/softwareservices', $service->id) }}">
                                                                            <img src="/upload/sub_service/{{ $service->sub_service_image }}"
                                                                                alt=""
                                                                                class="rounded-circle img-thumbnail avatar-xl"></a>
                                                                        <h5 class="text-danger">
                                                                            {{ $service->service_name }}</h5>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            @elseif($serviceid == 103)
                                                @foreach ($services as $service)
                                                    <div class="col-xl-3 col-md-3 col-sm-6">
                                                        <div class="card mb-0">
                                                            <div class="card-body bg-dark">
                                                                <div class="position-relative">
                                                                    <img src="/upload/sub_service/{{ $service->sub_service_image }}"
                                                                        class="img-fluid rounded"
                                                                        style="width: 200px; height: 150px;"
                                                                        alt="">
                                                                </div>
                                                                <div class="text-center mt-1 pt-1">
                                                                    <p class="mb-0 text-success">
                                                                        <b>{{ $service->service_name }}</b>
                                                                    </p>
                                                                    <hr class="text-black">
                                                                    {{-- <h6 class="mb-2 text-danger">Amount: {{ $service->payment }}</h6> --}}
                                                                </div>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <a href="{{ url('/applyservices', $service->id) }}"
                                                                        class="btn btn-light">Apply</a>
                                                                    <a href="{{ url('/applyservices', $service->id) }}"
                                                                        class="btn btn-primary">List</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="container-fluid mt-1">

                                        <div class="row">
                                            <div class="container-xxl flex-grow-1">
                                                <div id="category_div" class="row text-center">
                                                    @if ($services->isEmpty())
                                                        <div class="d-flex justify-content-center align-items-center py-5">
                                                            <div class="no-service-card text-center p-4">
                                                                <h4 class="no-service-title mb-3">No Services Activated
                                                                </h4>
                                                                <p class="no-service-subtitle mb-4">Please activate
                                                                    services to continue</p>

                                                                <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}"
                                                                    class="btn manage-btn">
                                                                    Manage User Permissions
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @foreach ($services as $ser)
                                                            <div class="col-6 col-md-3 col-lg-2 mb-4 category_data">
                                                                <div class="card service-card h-100">


                                                                    <a href="{{ url('/applyservices', $ser->id) }}"
                                                                        class="service-link">


                                                                        <div class="service-content">
                                                                            <img src="{{ !empty($ser->sub_service_image)
                                                                                ? asset('upload/sub_service/' . $ser->sub_service_image)
                                                                                : asset('upload/service/default.png') }}"
                                                                                class="service-img"
                                                                                style="width: 100px; height: 100px;" />

                                                                            <p class="service-title">
                                                                                {{ $ser->service_name }}
                                                                            </p>
                                                                        </div>

                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
    </div>

    <div class="modal fade" id="agentreg" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center">Agent Id Registeration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/agentregisteration') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control" maxlength="50"
                                    placeholder="User Name">

                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control number" maxlength="10"
                                    placeholder="Mobile Number">

                                <label for="village" class="form-label">Name of Premises/Building/Village</label>
                                <input type="text" name="village" class="form-control" maxlength="50"
                                    placeholder="Name of Premises/Building/Village">
                                <label for="taluk" class="form-label">Area/Locality/Taluk/Sub-Division</label>
                                <input type="text" name="taluk" class="form-control" maxlength="50"
                                    placeholder="Area/Locality/Taluk/Sub-Division">
                                <label for="state" class="form-label">State/Union Territory</label>
                                <input type="text" name="state" class="form-control" maxlength="50"
                                    placeholder="State/Union Territory">

                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email Id</label>
                                <input type="email" name="email" class="form-control" maxlength="30"
                                    placeholder="Email Id">
                                <label for="door_no" class="form-label">Flat/Room/Door/Block No</label>
                                <input type="text" name="door_no" class="form-control" maxlength="20"
                                    placeholder="Flat/Room/Door/Block No">
                                <label for="post_office" class="form-label">Road/Street/Lane/Post Office</label>
                                <input type="text" name="post_office" class="form-control" maxlength="30"
                                    placeholder="Road/Street/Lane/Post Office">

                                <label for="district" class="form-label">Town/City/District</label>
                                <input type="text" name="district" class="form-control" maxlength="30"
                                    placeholder="Town/City/District">

                                <label for="pincode" class="form-label">Pin Code</label>
                                <input type="text" name="pincode" class="form-control" maxlength="20"
                                    placeholder="Pin Code">
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" id="save" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $('#serviceid').on('change', function() {
            var serviceid = this.value;
            // var customerid =  $("#customerid").val();
            window.location.href = "{{ url('applyservices') }}/" + serviceid;

        });
        var ramjibalance = "{{ $rawallet->nalavariyamwallet }}";
        $(".permissionform").submit(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = $("#act_amount_hidden").val();
            var adminamount = $("#adminamt").val();


            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
                return false;
            }

            if (parseInt(adminamount) > parseFloat(ramjibalance)) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            }
            $('#save').prop("disabled", false);
            $('#save').prop("disabled", false);
        });

        $(function() {
            $("#save").attr("disabled", true);
        });
        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
            var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                }
            });
        });

        function getaadhaar_otpf() {
            var aadhaar = $("#aadhaar_no").val().trim();
            if (aadhaar == "") {
                alert("Please Enter Aadhaar Number");
                $("#aadhaar_no").focus();
                return false;
            }
            var aadhaar_length = aadhaar.length;
            if (aadhaar_length < 12) {
                alert("Entered Aadhaar Number is Incorrect");
                $("#aadhaar_no").focus();
                return false;
            }
            $("#checkotp").attr("disabled", true);
            var url = "{{ url('/getaadhaar_otpf') }}/" + aadhaar;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    if (result.status == "false") {
                        alert(result.message);
                        $("#checkotp").attr("disabled", false);
                    } else {
                        var data = result;
                        alert(data.message);
                        $("#refid").val(data.client_id);
                        $("#verifybtnhide").hide();
                        $("#verifyotphide").show();
                        $("#aadhaar_no").attr("readonly", true);
                    }
                }
            });
        }

        function getaadhaar_dataf() {
            var otp = $("#otp").val().trim();
            var aadhaar = $("#aadhaar_no").val().trim();
            var refid = $("#refid").val().trim();
            var userid = "{{ Auth::user()->id }}";
            if (otp == "") {
                alert("Please Enter OTP");
                $("#otp").focus();
                return false;
            }
            var otp_length = otp.length;
            if (otp_length < 6) {
                alert("Entered OTP is Incorrect");
                $("#otp").focus();
                return false;
            }
            $("#subotp").attr("disabled", true);
            var url = "{{ url('/getaadhaar_dataf') }}/" + otp + "/" + refid + "/" + aadhaar + "/" + userid;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    var data = result;
                    //var obj = JSON.parse(data);
                    if (result.status == "false") {
                        alert(result.message);
                        $("#subotp").attr("disabled", false);
                    } else {
                        $("#verifybtnhide").hide();
                        $("#verifyotphide").hide();
                        $("#aadhaar_no").attr("readonly", true);
                        $("#userid").val(result.userid);
                        $("#fullname").val(data.name);
                        $("#address").val(data.address);
                        $("#save").attr("disabled", false);
                    }
                }
            });


        }
        var wallet = "{{ Auth::user()->wallet }}";

        $('#nalavariyam_usertype').on('change', function() {
            var usertypeid = this.value;
            var com = 0;
            //alert(usertypeid);

            $("#act_amount").val("");
            $('#nopayment').html("");
            $('#details').html("");
            $('#verifybtnhide').show();
            var d = "";
            if (usertypeid == 3) {
                d = "ஐடி ஆக்டிவ் கட்டணம் ரூ.3,000/- விண்ணப்ப கட்டணம் ரூ. 75/-";
                com = 1500;
            } else {
                d = "ஐடி ஆக்டிவ் கட்டணம் ரூ.1,000/- விண்ணப்ப கட்டணம் ரூ. 90/-";
                com = 500;

            }
            $('#details').html(d).css({
                'color': 'green',
                'font-size': '150%',
                'font-weight': 'bold'
            });
            var url = "{{ url('nalavariyam/get_activationamount') }}/" + usertypeid;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $("#act_amount").val(result.amount);
                    $("#act_amount_hidden").val(result.amount);
                    $("#adminamt").val(com);
                    if (parseFloat(result.amount) > parseInt(wallet)) {
                        $('#save').prop("disabled", true);
                        $('#verifybtnhide').hide();
                        $('#nopayment').html(
                                "No Fund in Wallet.Please Update Your wallet To Continue the Service")
                            .css({
                                'color': 'red',
                                'font-size': '150%',
                                'font-weight': 'bold'
                            });

                        return false;
                    }

                }
            });

        });
    </script>
@endpush
