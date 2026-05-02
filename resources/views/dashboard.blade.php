@extends('layouts.app')
@section('content')
    <style>
        .sliding-text-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
        }

        .sliding-text {
            display: inline-block;
            padding-left: 100%;
            font-size: 20px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* 🔥 முக்கிய மாற்றம் */
        .sliding-wrapper {
            display: inline-flex;
            white-space: nowrap;
            animation: slide linear infinite;
            animation-duration: 120s;
            /* speed control */
        }

        /* 🔥 dynamic distance (important) */
        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row col-xl-12">
                @if (Auth::user()->user_type_id == 1)
                    <div class="sliding-text-container">
                        @foreach ($notify as $n)
                            <h5 class="sliding-text text-danger">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
                        @endforeach
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/pending">
                                            <p class="mb-0 text-white">Pending</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $pending }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Processing">
                                            <p class="mb-0 text-white">Inprocess</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $inpro }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Resubmit">
                                            <p class="mb-0 text-white">Resubmit</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $resub }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Rejected">
                                            <p class="mb-0 text-dark">Rejected</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $rerej }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Approved">
                                            <p class="mb-0 text-dark">Approved</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $approve }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/rawallet') }}">
                                            <p class="mb-0 text-white">Ramji Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->rawallet }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/rapaymentrequest') }}">
                                            <p class="mb-0 text-white">Ra Wallet Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $ramjirequestAmount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/distributors') }}">
                                            <p class="mb-0 text-white">Distributor</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $distributor }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/retailers') }}">
                                            <p class="mb-0 text-white">Retailler</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $retailer_count }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/customers') }}">
                                            <p class="mb-0 text-white">Customers</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $customer }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/nalavariyam/request') }}">
                                            <p class="mb-0 text-white">Nalavariyam Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $nalcount }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/view_appointment') }}">
                                            <p class="mb-0 text-dark">Certificate</p>
                                        </a>
                                        <h4 class="my-1 text-dark">.</h4>
                                    </div>
                                    <div id="chart4"></div>
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
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/servicesone', $ser->id) }}">
                                                <p class="mb-0 text-white">Nalavariyam</p>
                                            </a>
                                            <h4 class="my-1 text-white">0</h4>
                                        </div>
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (Auth::user()->user_type_id == 2)
                    <div class="sliding-text-container">
                            <div class="sliding-text" id="ticker">
                                @foreach ($notify as $n)
                                    {{ $n->notify }} &nbsp;&nbsp; | &nbsp;&nbsp;
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
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ohhappiness">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/member') }}">
                                                <p class="mb-0 text-white">Nalavariyam Member</p>
                                            </a>
                                            <h4 class="my-1 text-white">{{ $memcount }}</h4>
                                        </div>
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-kyoto">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/pending">
                                                <p class="mb-0 text-dark">Nalavariyam Pending</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $pendingcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                                <p class="mb-0 text-dark">Nalavariyam Resubmit</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $resubmitcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-cosmic">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/approved">
                                                <p class="mb-0 text-dark">Nalavariyam Approved</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $approvedcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $sitecount = DB::table('sitepayment')->where('payment_status', 'UNPAID')->count();
                    @endphp
                    @if ($sitecount > 0)
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-kyoto">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/sitepayment') }}">
                                                <p class="mb-0 text-dark">SitePayment</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $sitecount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/pending">
                                            <p class="mb-0 text-white">Pending</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $pending }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Processing">
                                            <p class="mb-0 text-white">Inprocess</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $inpro }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Resubmit">
                                            <p class="mb-0 text-white">Resubmit</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $resub }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Rejected">
                                            <p class="mb-0 text-dark">Rejected</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $rerej }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Approved">
                                            <p class="mb-0 text-dark">Approved</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $approve }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/wallet') }}">
                                            <p class="mb-0 text-white">Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->wallet }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/rawallet') }}">
                                            <p class="mb-0 text-white">Ramji Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->rawallet }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/paymentrequest') }}">
                                            <p class="mb-0 text-white">Wallet Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $RequestAmount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/distributors') }}">
                                            <p class="mb-0 text-white">Distributor</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $distributor }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/nalavariyam/wallet') }}">
                                            <p class="mb-0 text-white">Na Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->nalavariyamwallet }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                            <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addMoneyModal">Add Money</button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/nalavariyam/request') }}">
                                            <p class="mb-0 text-white">Nalavariyam Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $nalcount }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/customers') }}">
                                            <p class="mb-0 text-white">Customers</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $customercount }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/viewenquiry') }}">
                                            <p class="mb-0 text-white">Enquiry</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $enquirycount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/welcomenquirys') }}">
                                            <p class="mb-0 text-white">Welcome quiry</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $newenquirycount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/retailers') }}">
                                            <p class="mb-0 text-white">Retailler</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $retailer_count }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-xxl flex-grow-1 container-p-y">
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
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/servicesone', $ser->id) }}">
                                                <p class="mb-0 text-white">Nalavariyam</p>
                                            </a>
                                            <h4 class="my-1 text-white">0</h4>
                                        </div>
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (Auth::user()->user_type_id == 3)
                    <div class="sliding-text-container">
                            <div class="sliding-text" id="ticker">
                                @foreach ($notify as $n)
                                    {{ $n->notify }} &nbsp;&nbsp; | &nbsp;&nbsp;
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
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ohhappiness">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/member') }}">
                                                <p class="mb-0 text-white">Nalavariyam Member</p>
                                            </a>
                                            <h4 class="my-1 text-white">{{ $memcount }}</h4>
                                        </div>
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-kyoto">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/pending">
                                                <p class="mb-0 text-dark">Nalavariyam Pending</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $pendingcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                                <p class="mb-0 text-dark">Nalavariyam Resubmit</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $resubmitcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-cosmic">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/approved">
                                                <p class="mb-0 text-dark">Nalavariyam Approved</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $approvedcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/pending">
                                            <p class="mb-0 text-white">Pending</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $pending }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Processing">
                                            <p class="mb-0 text-white">Inprocess</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $inpro }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Resubmit">
                                            <p class="mb-0 text-white">Resubmit</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $resub }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Rejected">
                                            <p class="mb-0 text-dark">Rejected</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $rerej }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Approved">
                                            <p class="mb-0 text-dark">Approved</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $approve }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/wallet') }}">
                                            <p class="mb-0 text-white">Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->wallet }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/paymentrequest') }}">
                                            <p class="mb-0 text-white">Wallet Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $RequestAmount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/retailers') }}">
                                            <p class="mb-0 text-white">Retailler</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $retailer_count }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/customers') }}">
                                            <p class="mb-0 text-white">Customers</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $customer }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (Auth::user()->user_type_id == 4)
                    <div class="sliding-text-container">
                            <div class="sliding-text" id="ticker">
                                @foreach ($notify as $n)
                                    {{ $n->notify }} &nbsp;&nbsp; | &nbsp;&nbsp;
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
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ohhappiness">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/member') }}">
                                                <p class="mb-0 text-white">Nalavariyam Member</p>
                                            </a>
                                            <h4 class="my-1 text-white">{{ $memcount }}</h4>
                                        </div>
                                        <div id="chart2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-kyoto">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/pending">
                                                <p class="mb-0 text-dark">Nalavariyam Pending</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $pendingcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/resubmit">
                                                <p class="mb-0 text-dark">Nalavariyam Resubmit</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $resubmitcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="card radius-10 bg-gradient-cosmic">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-auto">
                                            <a href="{{ url('/nalavariyam/form') }}/approved">
                                                <p class="mb-0 text-dark">Nalavariyam Approved</p>
                                            </a>
                                            <h4 class="my-1 text-dark">{{ $approvedcount }}</h4>
                                        </div>
                                        <div id="chart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/pending">
                                            <p class="mb-0 text-white">Pending</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $pending }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Processing">
                                            <p class="mb-0 text-white">Inprocess</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $inpro }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Resubmit">
                                            <p class="mb-0 text-white">Resubmit</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $resub }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Rejected">
                                            <p class="mb-0 text-dark">Rejected</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $rerej }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Approved">
                                            <p class="mb-0 text-dark">Approved</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $approve }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/wallet') }}">
                                            <p class="mb-0 text-white">Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->wallet }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/paymentrequest') }}">
                                            <p class="mb-0 text-white">Wallet Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $RequestAmount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/customers') }}">
                                            <p class="mb-0 text-white">Customers</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $customer }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/addenquiry') }}">
                                            <p class="mb-0 text-white">Enquiry</p>
                                        </a>
                                        <h4 class="my-1 text-white">&</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endif
                @if (Auth::user()->user_type_id == 5)
                    <div class="sliding-text-container">
                            <div class="sliding-text" id="ticker">
                                @foreach ($notify as $n)
                                    {{ $n->notify }} &nbsp;&nbsp; | &nbsp;&nbsp;
                                @endforeach
                            </div>
                        </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/pending">
                                            <p class="mb-0 text-white">Pending</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $pending }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ibiza">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Processing">
                                            <p class="mb-0 text-white">Inprocess</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $inpro }}</h4>
                                    </div>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Resubmit">
                                            <p class="mb-0 text-white">Resubmit</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $resub }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Rejected">
                                            <p class="mb-0 text-dark">Rejected</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $rerej }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-kyoto">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/appliedservice') }}/Approved">
                                            <p class="mb-0 text-dark">Approved</p>
                                        </a>
                                        <h4 class="my-1 text-dark">{{ $approve }}</h4>
                                    </div>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/wallet') }}">
                                            <p class="mb-0 text-white">Wallet</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ Auth::user()->wallet }}</h4>
                                    </div>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/paymentrequest') }}">
                                            <p class="mb-0 text-white">Wallet Request</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $RequestAmount }}</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 col-sm-4">
                        <div class="card radius-10 bg-gradient-cosmic">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-auto">
                                        <a href="{{ url('/addenquiry') }}">
                                            <p class="mb-0 text-white">Enquiry</p>
                                        </a>
                                        <h4 class="my-1 text-white">&</h4>
                                    </div>
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endif
            </div><!--end row-->
        </div>
        <div class="modal fade" id="dataaa" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">தொழிற்சங்க விபரம்</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <center>
                            <p><b>தமிழ்நாடு ராம்ஜி கட்டுமானம் மற்றும் அமைப்புசார்ந்த அமைப்புசாரா பொது தொழிலாளர்கள்
                                    நலசங்கம்<br>
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
                        <button class="nav-link active rounded-pill fw-semibold"
                            data-bs-toggle="pill"
                            data-bs-target="#onlineTab">
                            💳 Online Payment
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link rounded-pill fw-semibold"
                            data-bs-toggle="pill"
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
                                placeholder="Enter amount"
                                min="1">
                        </div>

                        <!-- Quick Amount Buttons -->
                        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                            @foreach([50,100,300,500,1000,2000,5000] as $amt)
                            <button type="button"
                                class="btn btn-outline-primary rounded-pill px-4 quick-amount"
                                data-amount="{{ $amt }}">
                                ₹{{ $amt }}
                            </button>
                            @endforeach
                        </div>

                        <form method="POST"
                            action="{{ route('nalavariyamonline.create') }}"
                            class="onlinePaymentForm">
                            @csrf
                            <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                            <input type="hidden" name="amount" class="finalAmount">

                            <button type="submit"
                                class="btn btn-primary btn-lg w-100 rounded-3 payBtn"
                                disabled>
                                <span class="payBtnText">➕ Pay Securely</span>
                                <span class="spinner-border spinner-border-sm d-none payLoader"></span>
                            </button>
                        </form>

                    </div>

                    <!-- ================= MANUAL PAYMENT ================= -->
                    <div class="tab-pane fade" id="manualTab">
<div class="text-center mb-3">
                                    <img src="/upload/qr/qrimgramji.jpeg" alt="QR Code"
                                        class="img-fluid"
                                        style="max-width:300px">
                                </div>

                        <form method="POST"
                            action="{{ url('/nalavariyam/wallet/add') }}"
                            enctype="multipart/form-data"
                            class="mt-3">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="number"
                                        name="amount"
                                        class="form-control rounded-3 border-warning"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Upload Proof</label>
                                    <input type="file"
                                        name="proof"
                                        class="form-control rounded-3"
                                        accept="image/*,application/pdf"
                                        required>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-success btn-lg w-100 rounded-3">
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
        $(document).ready(function() {
            var status = $("#statuscheck").val();
            if (status == "Inactive") {
                $('#myModal').modal("show")({
                    backdrop: 'static',
                    keyboard: false
                });
            } else if (status == "Active") {
                $('#paidstatuscheck').modal("hide")({});
            }
        });

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
@endpush
