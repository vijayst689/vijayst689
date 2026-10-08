@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_manualpdf') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">

                                   @if ($serviceid == 250)
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
                                    @elseif ($serviceid == 256)                                      
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
                                    @elseif ($serviceid == 257)
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_no" class="form-label">Smartcard Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="smartcard_no" placeholder="Smartcard Number" />
                                        </div>
                                    @elseif ($serviceid == 270)
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
                                         @elseif ($serviceid == 271)
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
