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
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" onsubmit="return checkpayment(event)"
                                action="{{ url('submitapply_pancard') }}" enctype="multipart/form-data" method="post"
                                id="myForm">
                                @csrf

                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <input type="hidden" name="ramjidebit_amount" id="ramjidebit_amount">
                                    @if ($serviceid == 71)
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Card No</label>
                                            <input required type="text" class="form-control number" maxlength="12"
                                                name="aadhaar_no" placeholder="Aadhaar Card No" />
                                        </div>
                                    @elseif($serviceid == 69)
                                        <div class="mb-3 col-md-6">
                                            <label for="mode" class="form-label">Mode</label>
                                            <select required class="form-control" name="mode" style="width: 100%;">
                                                <option value="">Select</option>
                                                <option value="EKYC">EKYC (Pan without Signature)</option>
                                                <option value="ESIGN">ESIGN (Pan with Signature and Photo)</option>
                                            </select>
                                            <label for="mobile" class="form-label">Applicant Mobile Number</label>
                                            <input required class="form-control number" name="mobile" type="text"
                                                maxlength="10" style="width: 100%;" placeholder="Mobile Number">

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required class="form-control" name="name" type="text"
                                                maxlength="30" style="width: 100%;" placeholder="Name">

                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required class="form-control number" name="aadhaar_no" type="text"
                                                maxlength="12" style="width: 100%;" placeholder="Aadhaar Number">

                                        </div>
                                    @elseif($serviceid == 70)
                                        <div class="mb-3 col-md-6">
                                            <label for="mode" class="form-label">Mode</label>
                                            <select required class="form-control" name="mode" style="width: 100%;">
                                                <option value="">Select</option>
                                                <option value="EKYC">EKYC (Pan without Signature)</option>
                                                <option value="ESIGN">ESIGN (Pan with Signature and Photo)</option>
                                            </select>
                                            <label for="mobile" class="form-label">Applicant Mobile Number</label>
                                            <input required class="form-control number" name="mobile" type="text"
                                                maxlength="10" style="width: 100%;" placeholder="Mobile Number">

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required class="form-control" name="name" type="text"
                                                maxlength="30" style="width: 100%;" placeholder="Name">

                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required class="form-control number" name="aadhaar_no" type="text"
                                                maxlength="12" style="width: 100%;" placeholder="Aadhaar Number">

                                        </div>
                                    @elseif($serviceid == 190)
                                        <div class="mb-3 col-md-6">

                                            <label for="panno" class="form-label">PAN NO</label>
                                            <input required class="form-control" name="panno" type="text"
                                                maxlength="10" style="width: 100%;" placeholder="PAN Number">

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
        var serviceid = "{{ $serviceid }}";
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            if (serviceid == 69 || serviceid == 70) {
                var amount = 103;
            } else if (serviceid == 71) {
                var amount = 16;
            }
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


        $('#pancard_type').change(function() {
            if ($(this).val() == "Instant") {
                $('#name').prop("required", true);
                $('#relative_name').prop("required", true);
                $('#email_id').prop("required", true);
                $('#signature').prop("required", true);
                $('#relationship').prop("required", true);
                $('#mobile').prop("required", true);
                $('#aadhaar_card').prop("required", true);
                $('#photo').prop("required", true);
                $('#instantpanhide').show("slow");
                $('#instanthide').show("slow");

            } else {
                $('#namehide').prop("required", false);
                $('#relative_namehide').prop("required", false);
                $('#email_idhide').prop("required", false);
                $('#signaturehide').prop("required", false);
                $('#relationshiphide').prop("required", false);
                $('#mobilehide').prop("required", false);
                $('#aadhaar_cardhide').prop("required", false);
                $('#photohide').prop("required", false);
                $('#instantpanhide').hide();
                $('#instanthide').hide();

            }
        });
    </script>
@endpush
