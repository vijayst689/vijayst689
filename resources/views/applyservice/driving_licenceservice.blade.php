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
                            <form class="row g-4" action="{{ url('submitapply_driving_license') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post"
                                id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 150)
                                        <div class="mb-3 col-md-6">
                                            <label for="driving_license_no" class="form-label">Driving License
                                                Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="driving_license_no" placeholder="Driving License Number" />
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="DOB" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="id_proof" class="form-label">ID Proof</label>
                                            <select required class="form-control " id="id_proof" name="id_proof"
                                                style="width: 100%;">
                                                <option value="">Select ID Proof</option>

                                                <option value="Licence">License</option>
                                                <option value="Aadhaar Card">Aadhaar Card(Front&Back)</option>
                                            </select>
                                            <div class="" id="driving_licensehide" style="display: none;">
                                                <label>License</label>
                                                <input id="driving_license" class="form-control" type="file"
                                                    name="driving_license">
                                            </div>
                                            <div class="" id="aadhaar_cardhide" style="display: none;">
                                                <label for="aadhaar_card" class="form-label">Adhaar Card (Front &
                                                    Back)</label>
                                                <input required type="file" class="form-control" name="aadhaar_card"
                                                    placeholder="Adhaar card (Front & Back)" />
                                            </div>

                                        </div>
                                    @elseif($serviceid == 148)
                                        <div class="mb-3 col-md-6">
                                            <label for="rc_number" class="form-label">RC Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="rc_number" placeholder="RC Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="DOB" />
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
        $('#id_proof').change(function() {
            if ($('#id_proof').val() == 'Licence') {
                $('#driving_licensehide').show("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#driving_license').prop("required", true);

            } else if ($('#id_proof').val() == 'Aadhaar Card') {
                $('#aadhaar_cardhide').show("slow");
                $('#driving_licensehide').hide("slow");
                $('#driving_license').prop("required", false);
                $('#aadhaar_card').prop("required", true);
            } else {
                $('#driving_licensehide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#driving_license').prop("required", false);

            }
        });
    </script>
@endpush
