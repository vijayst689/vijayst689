@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #141e30, #243b55);
        }

        .can-form-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        }

        .can-title {
            background: linear-gradient(135deg, #ff512f, #dd2476);
            color: #fff;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 25px;
        }

        .can-title h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-top: 10px;
        }

        .form-control {
            border: 2px solid #e6e6e6;
            border-radius: 12px;
            padding: 12px;
            transition: all .3s ease;
        }

        .form-control:focus {
            border-color: #ff512f;
            box-shadow: 0 0 15px rgba(255, 81, 47, .25);
        }

        textarea {
            resize: none;
        }

        .btn-next {
            background: linear-gradient(135deg, #ff512f, #dd2476);
            color: #fff;
            border: none;
            padding: 12px 45px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(221, 36, 118, .4);
        }

        .section-head {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 5px solid #ff512f;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: bold;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
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
                    <div class="card-body">
                        <h6 class="card-title">{{ $servicename }}</h6>
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>

                        <div class="row">
                            <form class="row g-4" action="{{ url('submittnegacommunity') }}" enctype="multipart/form-data"
                                method="post" id="myForm" onsubmit="return checkpayment(event)">
                                @csrf


                                <div id="step1">
                                    <h6 class="text-center card-header bg-success text-white">
                                        Can Details
                                    </h6>
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" id="seramt" name="service_amount"
                                            value="{{ $payment }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id ?? '' }}">
                                        {{-- <input type="hidden" name="user_id" value="{{ $customers->id }}"> --}}
                                        <!-- LEFT SIDE -->
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label">Can Number</label>
                                                <input required type="text" maxlength="15" class="form-control number"
                                                    name="can_number" value="{{ $customers->can_number ?? '' }}"
                                                    placeholder="Can Number">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name In English</label>
                                                <input maxlength="100" required type="text"
                                                    value="{{ $customers->name ?? '' }}" class="form-control"
                                                    name="name" placeholder="Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Father Name In English</label>
                                                <input maxlength="100" value="{{ $customers->father_name_english ?? '' }}"
                                                    required type="text" class="form-control" name="father_name_english"
                                                    placeholder="Father Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mother Name In English</label>
                                                <input maxlength="100" value="{{ $customers->mother_name_english ?? '' }}"
                                                    required type="text" class="form-control" name="mother_name_english"
                                                    placeholder="Mother Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Gender</label>
                                                <select required class="form-control" name="gender">
                                                    <option value="">Select</option>
                                                    <option value="Male"
                                                        {{ ($customers->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ ($customers->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">DOB</label>
                                                <input value="{{ $customers->dob ?? '' }}" required type="date"
                                                    class="form-control" name="dob">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">District</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="district_name" value="{{ $customers->district_name ?? '' }}"
                                                    placeholder="District">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">VAO</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="panchayath_name"
                                                    value="{{ $customers->panchayath_name ?? '' }}" placeholder="VAO">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Address English</label>
                                                <textarea maxlength="500" required class="form-control" rows="3" name="address"
                                                    placeholder="Address English">{{ $customers->address ?? '' }}</textarea>
                                            </div>

                                        </div>

                                        <!-- RIGHT SIDE -->
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label">Aadhaar Number</label>
                                                <input maxlength="12" required type="text" maxlength="12"
                                                    class="form-control number"
                                                    value="{{ request('aadhaar_no') ?? ($customers->aadhaar_no ?? '') }}"
                                                    name="aadhaar_no" placeholder="Aadhaar Number">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="name_tamil" placeholder="Name In Tamil"
                                                    value="{{ $customers->name_tamil ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Father Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    value="{{ $customers->father_name_tamil ?? '' }}"
                                                    name="father_name_tamil" placeholder="Father Name In Tamil">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mother Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="mother_name_tamil"
                                                    value="{{ $customers->mother_name_tamil ?? '' }}"
                                                    placeholder="Mother Name In Tamil">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Religion</label>
                                                <select required class="form-control" name="religion">
                                                    <option value="">Select</option>
                                                    <option value="Hindu"
                                                        {{ ($customers->religion ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                        Hindu</option>
                                                    <option value="Christian"
                                                        {{ ($customers->religion ?? '') == 'Christian' ? 'selected' : '' }}>
                                                        Christian</option>
                                                    <option value="Muslim"
                                                        {{ ($customers->religion ?? '') == 'Muslim' ? 'selected' : '' }}>
                                                        Muslim</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Marital Status</label>
                                                <select required class="form-control" name="marital_status">
                                                    <option value="">Select</option>
                                                    <option value="Married"
                                                        {{ ($customers->marital_status ?? '') == 'Married' ? 'selected' : '' }}>
                                                        Married</option>
                                                    <option value="UnMarried"
                                                        {{ ($customers->marital_status ?? '') == 'UnMarried' ? 'selected' : '' }}>
                                                        UnMarried</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Taluk</label>
                                                <input maxlength="50" required type="text" class="form-control"
                                                    name="taluk_name" placeholder="Taluk Name"
                                                    value="{{ $customers->taluk_name ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control number"
                                                    name="mobile" placeholder="Mobile Number"
                                                    value="{{ $customers->mobile ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Address Tamil</label>
                                                <textarea maxlength="500" required class="form-control" rows="3" name="address_tamil"
                                                    placeholder="Address Tamil">{{ $customers->address_tamil ?? '' }}</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary px-5" onclick="nextStep(1)">
                                            Next →
                                        </button>
                                    </div>

                                </div>

                                <div class="row">
                                    <!-- STEP 2 -->
                                    <div id="step2" style="display:none;">

                                        <div class="card shadow border-0 mt-4">

                                            <div class="card-header bg-success text-white">
                                                <h6 class="mb-0">Form Details</h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Father's Community</label>
                                                        <select name="father_community" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option value="BC">BC</option>
                                                            <option value="BC Muslim">BC Muslim</option>
                                                            <option value="OC">OC</option>
                                                            <option value="MBC">MBC</option>
                                                            <option value="DNC/DNT">DNC/DNT</option>
                                                            <option value="SC">SC</option>
                                                            <option value="ST">ST</option>
                                                        </select>

                                                        <label class="form-label mt-2">Father's Caste</label>
                                                        <input maxlength="100" type="text" name="father_caste"
                                                            class="form-control" required>

                                                        <label class="form-label mt-2">Requested Community</label>
                                                        <input maxlength="100" type="text" name="requested_community"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Mother's Community</label>
                                                        <select name="mother_community" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option value="BC">BC</option>
                                                            <option value="BC Muslim">BC Muslim</option>
                                                            <option value="OC">OC</option>
                                                            <option value="MBC">MBC</option>
                                                            <option value="DNC/DNT">DNC/DNT</option>
                                                            <option value="SC">SC</option>
                                                            <option value="ST">ST</option>
                                                        </select>

                                                        <label class="form-label mt-2">Mother's Caste</label>
                                                        <input maxlength="100" type="text" name="mother_caste"
                                                            class="form-control" required>

                                                        <label class="form-label mt-2">Requested Caste</label>
                                                        <input maxlength="100" type="text" name="requeste_caste"
                                                            class="form-control" required>
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(2)">
                                                        ← Previous
                                                    </button>

                                                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                                        Next →
                                                    </button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- STEP 3 -->
                                    <div id="step3" style="display:none;">

                                        <div class="card shadow border-0 mt-4">

                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0">Community Document Details</h5>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>1. Photo *</label>
                                                        <input type="file" name="photo" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>2. Adress proof (Adhaar + smart card Attached file) *</label>
                                                        <input type="file" name="address_proof" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>3. Applicant Signature</label>
                                                        <input type="file" name="signature" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>4. Community Certificate of Father / Mother /
                                                            Siblings *</label>
                                                        <select name="community" id="community" class="form-control"
                                                            required>
                                                            <option value="">Select</option>
                                                            <option value="Community Certificate of Father">Community
                                                                Certificate of Father</option>
                                                            <option value="Community Certificate of Mother">Community
                                                                Certificate of Mother</option>
                                                            <option value="Community Certificate of Siblings">Community
                                                                Certificate of Siblings</option>
                                                        </select>
                                                    </div>

                                                    <div class="" id="community_certificate_fatherhide"
                                                        style="display: none;">
                                                        <label class="form-label">5. Community Certificate of Father
                                                            *</label>
                                                        <input type="file" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf" name="father_community_certificate"
                                                            id="community_certificate_father">
                                                    </div>
                                                    <div class="" id="community_certificate_motherhide"
                                                        style="display: none;">
                                                        <label class="form-label">5. Community Certificate of Mother
                                                            *</label>
                                                        <input class="form-control" type="file"
                                                            accept=".jpg,.jpeg,.png,.pdf" name="mother_community_certificate"
                                                            id="community_certificate_mother">
                                                    </div>

                                                    <div class="" id="community_certificate_siblingshide"
                                                        style="display: none;">
                                                        <label class="form-label">5. Community Certificate of Siblings
                                                            *</label>
                                                        <input class="form-control" type="file"
                                                            accept=".jpg,.jpeg,.png,.pdf" name="siblings_community_certificate"
                                                            id="community_certificate_siblings">
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(3)">
                                                        ← Previous
                                                    </button>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
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
            @endsection
            @push('page_scripts')
                <script>
                    document.getElementById("myForm").addEventListener("submit", function() {
                        const btn = document.getElementById("save");
                        btn.disabled = true;
                        btn.innerText = "Submitting...";
                    });

                    $(function() {
                        if (parseFloat(amount) > parseInt(wallet)) {
                            $('#save').prop("disabled", true);
                            $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                                'color': 'red',
                                'font-size': '150%',
                                'font-weight': 'bold'
                            });
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
                        gettaluk(dist_id);
                        getpanchayath(taluk_id);
                    });


                    $('#incomeyearly').on('input', function() {
                        var yearly = parseInt($('#incomeyearly').val());
                        $('#incomemonthly').val((yearly / 12 ? yearly / 12 : 0).toFixed(2));
                    });
                    var customerid = "{{ $customers->id ?? '' }}";
                    $('#can_details').change(function() {
                        if ($('#can_details').val() == 'Yes') {
                            $('#cannumberhide').show("slow");
                            $('#cannumber').prop("required", true);
                            $('#dobhide').hide("slow");

                        } else if ($('#can_details').val() == 'No') {
                            $('#dobhide').hide("slow");
                            $('#cannumberhide').hide("slow");
                            $('#cannumber').prop("required", false);
                            window.location.href = "{{ url('applyservice') }}/" + 60 + "/" + customerid;

                        } else if ($('#can_details').val() == 'Find') {
                            $('#dobhide').hide("slow");
                            $('#cannumberhide').show("slow");
                            $('#cannumber').prop("required", false);
                            window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
                        } else {
                            $('#dobhide').hide("slow");
                            $('#cannumberhide').hide("slow");
                            $('#cannumber').prop("required", false);
                        }
                    });

                    $('#relation').change(function() {
                        if ($('#relation').val() == 'Father' || $('#relation').val() == '') {
                            $('#affidavithide').hide("slow");
                            $('#affidavit').prop("required", false);
                        } else {
                            $('#affidavithide').show("slow");
                            $('#affidavit').prop("required", true);
                        }
                    });

                    $('#job_type').change(function() {
                        if ($('#job_type').val() == 'Govt') {
                            $('#incomecertgovthide').show("slow");
                            $('#salary_slip').prop("required", true);
                            $('#pancard').prop("required", true);
                        } else {
                            $('#incomecertgovthide').hide("slow");
                            $('#salary_slip').prop("required", false);
                            $('#pancard').prop("required", false);
                        }
                    });

                    $('#age_proof').change(function() {
                        if ($('#age_proof').val() == 'Tc/Community Certificate') {
                            $('#tc_community_certificatehide').show("slow");
                            $('#marksheethide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#marksheet').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#driving_license').prop("required", false);
                            $('#tc_community_certificate').prop("required", true);

                        } else if ($('#age_proof').val() == 'Marksheet') {
                            $('#marksheethide').show("slow");
                            $('#tc_community_certificatehide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#tc_community_certificate').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#driving_license').prop("required", false);
                            $('#marksheet').prop("required", true);

                        } else if ($('#age_proof').val() == 'Voter Id') {
                            $('#voteridhide').show("slow");
                            $('#marksheethide').hide("slow");
                            $('#tc_community_certificatehide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#tc_community_certificate').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#driving_license').prop("required", false);
                            $('#voterid').prop("required", true);

                        } else if ($('#age_proof').val() == 'Birth Certificate') {
                            $('#birth_certificatehide').show("slow");
                            $('#marksheethide').hide("slow");
                            $('#tc_community_certificatehide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#tc_community_certificate').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#driving_license').prop("required", false);
                            $('#birth_certificate').prop("required", true);

                        } else if ($('#age_proof').val() == 'Licence') {
                            $('#driving_licensehide').show("slow");
                            $('#marksheethide').hide("slow");
                            $('#tc_community_certificatehide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#tc_community_certificate').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#driving_license').prop("required", true);

                        } else {
                            $('#voteridhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#tc_community_certificatehide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#tc_community_certificate').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#driving_license').prop("required", false);

                        }
                    });

                    $("#pricetable").on('click', '.btnDelete', function() {
                        $(this).closest('tr').remove();
                    });


                    function addnewrow() {
                        $("#pricetable tbody").append(
                            "<tr><td> <select required name='family_relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Younger Brother'>அண்ணன்</option><option value='Elder Brother'>தம்பி</option><option value='Younger Sister'>அக்கா</option><option value='Elder Sister'>தங்கை</option><option value='Relation'>உறவினர்</option><option value='Self'>தனக்கு</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td><input class='form-control' required type='text' name='relation_name_tamil[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><input class='form-control' required type='text' name='relation_income[]'maxlength='100'></td><td><select required name='occupation[]' class='form-control'><option value=''>Select</option><option value='Student'>Student</option><option value='Home Maker'>Home maker</option><option value='Govt Employee'>Govt employee</option><option value='Private Employee'>Private Employee</option><option value='Daily Wages'>Daily Wages</option><option value='Agriculture'>Agriculture</option><option value='Others'>Others</option></select></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
                        );
                    }

                    $('#community').change(function() {
                        if ($('#community').val() == 'Community Certificate of Father') {
                            $('#community_certificate_fatherhide').show("slow");
                            $('#community_certificate_motherhide').hide("slow");
                            $('#community_certificate_siblingshide').hide("slow");
                            $('#community_certificate_siblings').prop("required", false);
                            $('#community_certificate_mother').prop("required", false);
                            $('#community_certificate_father').prop("required", true);

                        } else if ($('#community').val() == 'Community Certificate of Mother') {
                            $('#community_certificate_motherhide').show("slow");
                            $('#community_certificate_fatherhide').hide("slow");
                            $('#community_certificate_siblingshide').hide("slow");
                            $('#community_certificate_siblings').prop("required", false);
                            $('#community_certificate_father').prop("required", false);
                            $('#community_certificate_mother').prop("required", true);

                        } else if ($('#community').val() == 'Community Certificate of Siblings') {
                            $('#community_certificate_siblingshide').show("slow");
                            $('#community_certificate_fatherhide').hide("slow");
                            $('#community_certificate_motherhide').hide("slow");
                            $('#community_certificate_father').prop("required", false);
                            $('#community_certificate_mother').prop("required", false);
                            $('#community_certificate_siblings').prop("required", true);

                        } else {
                            $('#community_certificate_fatherhide').hide("slow");
                            $('#community_certificate_motherhide').hide("slow");
                            $('#community_certificate_siblingshide').hide("slow");
                            $('#community_certificate_father').prop("required", false);
                            $('#community_certificate_mother').prop("required", false);
                            $('#community_certificate_siblings').prop("required", false);

                        }
                    });
                </script>
                <script>
                    function nextStep(step) {

                        if (step == 1) {
                            document.getElementById('step1').style.display = 'none';
                            document.getElementById('step2').style.display = 'block';
                        }

                        if (step == 2) {
                            document.getElementById('step2').style.display = 'none';
                            document.getElementById('step3').style.display = 'block';
                        }
                    }

                    function prevStep(step) {

                        if (step == 2) {
                            document.getElementById('step2').style.display = 'none';
                            document.getElementById('step1').style.display = 'block';
                        }

                        if (step == 3) {
                            document.getElementById('step3').style.display = 'none';
                            document.getElementById('step2').style.display = 'block';
                        }
                    }
                </script>
            @endpush
