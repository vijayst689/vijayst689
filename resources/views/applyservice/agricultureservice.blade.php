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
                            <form class="row g-4" action="#" enctype="multipart/form-data" method="post" onsubmit="return checkpayment(event)"
                                id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 row">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Do You Have
                                                    Can Number</label>
                                                <div class="col-sm-6">
                                                    <select required name="can_details" id="can_details"
                                                        class="form-control">
                                                        <option value="">Select Can Details</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Find">Find Can</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="cannumber" type="text"
                                                        name="can_number" value="{{ $customers->can_number }}"
                                                        maxlength="15">
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-center"> Basic Details </h4>

                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />


                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_no" placeholder="Aadhaar Number" />

                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">District</label>
                                            <select disabled name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select disabled name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="panchayath_id" class="form-label">VAO</label>
                                            <select disabled name="panchayath_id" id="panchayath" class="form-control">
                                            </select>

                                            <label for="aadhaar_card" class="form-label">Adhaar card (front &
                                                Back)</label>
                                            <input required type="file" class="form-control" name="aadhaar_card"
                                                placeholder="Adhaar card (front & Back)" />
                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Adhaar card (front & Back)" />
                                            <label for="photo" class="form-label">Photo</label>
                                            <input required type="file" class="form-control" name="photo"
                                                placeholder="Photo" />
                                            <label for="signature" class="form-label">Signature</label>
                                            <input required type="file" class="form-control" name="signature"
                                                placeholder="Signature" />

                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4 class="text-center"> Additional Details </h4>
                                        @if ($serviceid == 32)
                                            <div class="mb-3 col-md-6">
                                                <label for="deed_details" class="form-label">பத்திரம் இருந்தால்</label>
                                                <select required name="deed_details" id="deed_details"
                                                    class="form-control">
                                                    <option value="">Select Yes/No</option>

                                                    <option value="Yes">ஆம்</option>
                                                    <option value="No">இல்லை</option>
                                                </select>
                                                <div class="" id="deedhide" class="form-control"
                                                    style="display: none;">
                                                    <label>பத்திரம்/Deed</label>
                                                    <input class="form-control" id="deed" type="file"
                                                        name="deed">
                                                </div>

                                                <label for="bank_pass_book" class="form-label">வங்கி பாஸ்புக்</label>
                                                <input required type="file" class="form-control"
                                                    name="bank_pass_book" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="property_details" class="form-label">பட்டா & சிட்டா</label>
                                                <select required name="property_details" id="property_details"
                                                    class="form-control">
                                                    <option value="">Select Patta & Chitta Type</option>

                                                    <option value="Personal Strap">தனிப்பட்டா</option>
                                                    <option value="Joint Strap">கூட்டு பட்டா</option>
                                                </select>
                                                <div class="" id="personal_straphide" class="form-control"
                                                    style="display: none;">
                                                    <label>தனிப்பட்டா</label>
                                                    <input class="form-control" id="personal_strap" type="file"
                                                        name="personal_strap">
                                                </div>
                                                <div class="" id="joint_straphide" class="form-control"
                                                    style="display: none;">
                                                    <label>கூட்டு பட்டா</label>
                                                    <input id="joint_strap" class="form-control" type="file"
                                                        name="joint_strap">
                                                </div>
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

        var dist_id = "{{ $customers->dist_id }}";
        var taluk_id = "{{ $customers->taluk_id }}";
        var wallet = "{{ Auth::user()->wallet }}";
        var amount = "{{ $payment }}";
        $(function() {
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
            gettaluk(dist_id);
            getpanchayath(taluk_id);
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

        function gettaluk(dist_id) {
            var url = "{{ url('service/get_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $("#taluk").val("{{ $customers->taluk_id }}");

                }
            });
        }

        function getpanchayath(taluk_id) {
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                    $("#panchayath").val("{{ $customers->panchayath_id }}");

                }
            });
        }


        var customerid = "{{ $customers->id }}";
        $('#can_details').change(function() {
            if ($('#can_details').val() == 'Yes') {
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", true);
            } else if ($('#can_details').val() == 'No') {
                window.location.href = "{{ url('applyservice') }}/" + 60 + "/" + customerid;
            } else if ($('#can_details').val() == 'Find') {
                window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
            } else {
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
            }
        });

        $('#property_details').change(function() {
            if ($('#property_details').val() == 'Personal Strap') {
                $('#personal_straphide').show("slow");
                $('#personal_strap').prop("required", true);
                $('#joint_straphide').hide("slow");
                $('#joint_strap').prop("required", false);
            } else if ($('#property_details').val() == 'Joint Strap') {
                $('#joint_straphide').show("slow");
                $('#joint_strap').prop("required", true);
                $('#personal_strap').prop("required", false);
                $('#personal_straphide').hide("slow");
            } else {
                $('#personal_straphide').hide("slow");
                $('#personal_strap').prop("required", false);
                $('#joint_strap').prop("required", false);
                $('#joint_straphide').hide("slow");
            }
        });

        $('#deed_details').change(function() {
            if ($('#deed_details').val() == 'Yes') {
                $('#deedhide').show("slow");
                $('#deed').prop("required", true);
            } else {
                $('#deedhide').hide("slow");
                $('#deed').prop("required", false);
            }
        });
    </script>
@endpush
