@extends('layouts.app')
@section('content')
    <style>
        .sliding-text-container {
            width: 100%;
            /* or a fixed width if needed */
            overflow: hidden;
            /* hides the text when it goes outside */
            white-space: nowrap;
            /* prevents text wrapping */
            position: relative;
        }

        .sliding-text {
            display: inline-block;
            overflow: hidden;
            padding-left: 100%;
            /* Start from the right */
            animation: slide-left 70s linear infinite;
        }

        @keyframes slide-left {
            0% {
                transform: translateX(100%);
            }

            1% {
                transform: translateX(0%);
            }

            100% {
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
                                        <h4 class="my-1 text-white">{{ $retailer }}</h4>
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
                        @foreach ($notify as $n)
                            <h5 class="sliding-text text-danger">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
                        @endforeach
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
                        $sitecount = DB::table('sitepayment')
                        ->where('payment_status', 'UNPAID')
                        ->count();
                        @endphp
                        @if($sitecount > 0)
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
                                        <a href="{{ url('/retailers') }}">
                                            <p class="mb-0 text-white">Retailler</p>
                                        </a>
                                        <h4 class="my-1 text-white">{{ $retailer }}</h4>
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
                        @foreach ($notify as $n)
                            <h5 class="sliding-text text-danger">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
                        @endforeach
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
                                        <h4 class="my-1 text-white">{{ $retailer }}</h4>
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
                        @foreach ($notify as $n)
                            <h5 class="sliding-text text-danger">{{ $n->notify }}&nbsp;&nbsp;|&nbsp;&nbsp;</h5>
                        @endforeach
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
@endpush
