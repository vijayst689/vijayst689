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
                            <form class="row g-4" action="{{ url('submitapply_nalavariyam') }}"
                                onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                                id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 95)
                                        <div class="mb-3 col-md-6">
                                            <label for="register_no" class="form-label">Register Number</label>
                                            <input required type="text" class="form-control" maxlength="20"
                                                name="register_no" placeholder="Register Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required type="text" class="form-control" maxlength="13"
                                                name="aadhaar_no" placeholder="Adhaar Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input required type="text" class="form-control" maxlength="10"
                                                name="mobile" placeholder="Cell Number" />
                                        </div>
                                    @elseif($serviceid == 96)
                                        <div class="mb-3 col-md-6">
                                            <label for="register_no" class="form-label">Register Number</label>
                                            <input required type="text" class="form-control" maxlength="20"
                                                name="register_no" placeholder="Register Number" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Adhaar Number</label>
                                            <input required type="text" class="form-control" maxlength="13"
                                                name="aadhaar_no" placeholder="Adhaar Number" />
                                        </div>
                                    @elseif($serviceid == 97)
                                        <div class="mb-3 col-md-6">
                                            <label for="register_no" class="form-label">Register Number</label>
                                            <input required type="text" class="form-control" maxlength="20"
                                                name="register_no" placeholder="Register Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input required type="text" class="form-control" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="date" class="form-control" maxlength="10"
                                                name="dob" placeholder="DOB" />
                                        </div>
                                    @elseif($serviceid == 98)
                                        <div class="mb-3 col-md-6">
                                            <label for="register_no" class="form-label">Register Number</label>
                                            <input required type="text" class="form-control" maxlength="20"
                                                name="register_no" placeholder="Register Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input required type="text" class="form-control" maxlength="10"
                                                name="mobile" placeholder="Cell Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input required type="file" class="form-control" name="photo"
                                                placeholder="Photo" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="signature" class="form-label">Signature</label>
                                            <input required type="file" class="form-control" name="signature"
                                                placeholder="Adhaar card (Front & Back)" />
                                        </div>
                                    @endif

                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary">Apply</button>
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
            var amount = {{ $admin_payment }};
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
