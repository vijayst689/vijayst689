@extends('layouts.app')
@section('content')
 <style>
        /* Default radio border color */
        /* Default border color */
        .form-check-input {
            border-color: #dd1181;
            /* blue border */
        }

        /* Checked state */
        .form-check-input:checked {
            background-color: #dd1181;
            border-color: #dd1181;
        }

        /* Focus shadow */
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(238, 4, 82, 0.25);
        }
    </style>
    <style>
        .category-header {
            background: #e0e0e0;
            padding: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .kob-card {
            border: 1px solid #ddd;
            margin-bottom: 8px;
        }

        .kob-header {
            background: #009688;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        .kob-body {
            padding: 10px;
            background: #f9f9f9;
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
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h6 class="card-title">Service Payment : <span
                                        class="text-danger">{{ $payment }}</span></h6>
                                <div class="card-body p-4">
                                      <form class="row g-4" action="{{ url('submitapply_manualpdf') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">

                                   @if ($serviceid == 264)
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_no" placeholder="Aadhaar Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                            <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                                class="form-control" name="aadhaar_card" />
                                        </div>
                                    @elseif ($serviceid == 265)                                      
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Register Cell Number</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Register Cell Number" />
                                        </div>
                                         <div class="mb-3 col-md-6">
                                            <label for="smartcard_no" class="form-label">Smartcard Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="smartcard_no" placeholder="Smartcard Number" />
                                        </div>
                                    @elseif ($serviceid == 266)
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_no" class="form-label">Smartcard Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="smartcard_no" placeholder="Smartcard Number" />
                                        </div>
                                    @elseif ($serviceid == 267)
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label fw-semibold text-dark">
                                                Aadhaar Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control border-primary shadow-sm"
                                                id="aadhaar_no" name="aadhaar_no" maxlength="12"
                                                placeholder="Enter 12-digit Aadhaar Number" required>

                                            <small class="text-muted">
                                                <i class="fa fa-info-circle"></i> Enter your valid 12-digit Aadhaar number.
                                            </small>
                                        </div>
                                         @elseif ($serviceid == 268)
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_no" class="form-label">Smartcard Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="smartcard_no" placeholder="Smartcard Number" />
                                        </div>
                                    @endif


                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
            @push('page_scripts')
               <script>
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        //alert(ramjibalance);
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = {
                {
                    $admin_payment
                }
            };
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#ramjidebit_amount").val(amount);
                return true;

            }
        }
    </script>
@endpush
