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
                            <form class="row g-4" action="{{ url('submittnegaunemployed') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    {{-- <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="service_amount" value="{{ $payment }}"> --}}

                                   <div id="step1">
                                    <h4 class="text-center card-header bg-success text-white">
                                        Can Details
                                    </h4>
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" id="seramt" name="service_amount"
                                            value="{{ $payment }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id ?? '' }}">
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

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <!-- Education Details -->
                                                <h5 class="text-primary mb-3">Education Details</h5>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Have completed your Graduation <span
                                                                class="text-danger">*</span></label><br>

                                                        <label class="me-3">
                                                            <input type="radio" name="graduation" value="Yes"> Yes
                                                        </label>

                                                        <label>
                                                            <input type="radio" name="graduation" value="No"> No
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>School / College Name <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="school_college_name" maxlength="100">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Year Of Birth <span class="text-danger">*</span></label>
                                                        <input required type="date" class="form-control"
                                                            id="year_of_birth" name="year_of_birth">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Year of Completion <span
                                                                class="text-danger">*</span></label>
                                                        <select required class="form-control" id="year_of_passing"
                                                            name="year_of_passing">
                                                            <option value="">SELECT</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Highest Educational Qualification</label>

                                                        <select required class="form-control" name="qualification"
                                                            id="qualification">
                                                            <option value="">Select</option>

                                                            <option value="Senior Secondary" class="no-option">Senior
                                                                Secondary</option>
                                                            <option value="Diploma" class="no-option">Diploma</option>

                                                            <option value="Under Graduate" class="yes-option">Under
                                                                Graduate</option>
                                                            <option value="Graduate" class="yes-option">Graduate</option>
                                                            <option value="Post Graduate" class="yes-option">Post Graduate
                                                            </option>
                                                            <option value="M.Phil" class="yes-option">M.Phil</option>
                                                            <option value="Ph.D" class="yes-option">Ph.D</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Affiliated Board / University <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control"
                                                            name="board_university" maxlength="100">
                                                    </div>

                                                </div>

                                                <hr>

                                                <!-- Other Details -->
                                                <h5 class="text-primary mb-3">Other Details</h5>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Unemployment From Date <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="date" class="form-control"
                                                            name="from_date">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Unemployment To Date <span
                                                                class="text-danger">*</span></label>
                                                        <input required type="date" class="form-control"
                                                            name="to_date">
                                                    </div>

                                                </div>

                                                <hr>

                                            </div>

                                            <!-- Buttons -->
                                            <div class="card-footer bg-white">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(2)">
                                                        <i class="fa fa-arrow-left"></i> Previous
                                                    </button>

                                                    <button type="button" class="btn btn-primary" id="nextBtn"
                                                        onclick="nextStep(2)">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <!-- STEP 3 -->
                                    <div id="step3" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h5 class="mb-2 text-success">
                                                    <i class="fa fa-graduation-cap"></i>Documents
                                                </h5>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo</label>
                                                        <input required type="file" class="form-control"
                                                            name="photo">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Aadhaar + Smart Card</label>
                                                        <input required type="file" class="form-control"
                                                            name="aadhaar_card">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Educational Qualification Proof</label>
                                                        <input required type="file" class="form-control"
                                                            name="study_proof">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Transfer Certificate</label>
                                                        <input required type="file" class="form-control"
                                                            name="applicant_tc">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Family Income Certificate</label>
                                                        <input required type="file" class="form-control"
                                                            name="income_certificate">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Signature</label>
                                                        <input required type="file" class="form-control"
                                                            name="signature">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Employment Card<small
                                                                class="text-muted">(Optional)</small></label>
                                                        <input type="file" class="form-control"
                                                            name="employment_card">
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer bg-white">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(3)">
                                                        <i class="fa fa-arrow-left"></i> Previous
                                                    </button>

                                                    <div class="text-center">
                                                        <div class="col-12">
                                                            <div class="mb-0">
                                                                <button id="save" type="submit"
                                                                    class="btn btn-primary">Apply</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p id="nopayment"></p>
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
<script>
    function nextStep(step) {

        // STEP 1 -> STEP 2
        if (step == 1) {

            let step1 = document.getElementById('step1');

            // Check all required fields in Step 1
            let fields = step1.querySelectorAll(
                'input[required], select[required], textarea[required]'
            );

            let valid = true;

            fields.forEach(function(field) {

                // Remove old validation
                field.classList.remove('is-invalid');

                if (!field.value || field.value.trim() === '') {
                    valid = false;
                    field.classList.add('is-invalid');
                }
            });

            // If any field is empty
            if (!valid) {
                alert('Please fill all Step 1 details.');
                return;
            }

            // All fields filled
            step1.style.display = 'none';
            document.getElementById('step2').style.display = 'block';
        }


        // STEP 2 -> STEP 3
        if (step == 2) {

            let step2 = document.getElementById('step2');

            let fields = step2.querySelectorAll(
                'input[required], select[required], textarea[required]'
            );

            let valid = true;

            fields.forEach(function(field) {

                field.classList.remove('is-invalid');

                if (!field.value || field.value.trim() === '') {
                    valid = false;
                    field.classList.add('is-invalid');
                }
            });

            if (!valid) {
                alert('Please fill all Step 2 details.');
                return;
            }

            step2.style.display = 'none';
            document.getElementById('step3').style.display = 'block';
        }
    }


    function prevStep(step) {

        // STEP 2 -> STEP 1
        if (step == 2) {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
        }

        // STEP 3 -> STEP 2
        if (step == 3) {
            document.getElementById('step3').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
        }
    }
</script>

    {{-- Add Script --}}

    <script>
        $(document).ready(function() {

            $("#qualification option").prop("disabled", true);
            $("#qualification option:first").prop("disabled", false);

            $("input[name='graduation']").change(function() {

                let value = $(this).val();

                $("#qualification").val("");

                $("#qualification option").prop("disabled", true);
                $("#qualification option:first").prop("disabled", false);

                if (value == "Yes") {
                    $("#qualification .yes-option").prop("disabled", false);
                } else {
                    $("#qualification .no-option").prop("disabled", false);
                }
            });

        });

        // Date of birth select panura calculation

$(document).ready(function () {

    $("#year_of_birth").on("change", function () {

        console.log("Changed");

        let dob = $(this).val();
        console.log(dob);

        if (!dob) return;

        let birthYear = new Date(dob).getFullYear();
        let startYear = birthYear + 16;
        let currentYear = new Date().getFullYear();

        let options = '<option value="">SELECT</option>';

        for (let year = currentYear; year >= startYear; year--) {
            options += `<option value="${year}">${year}</option>`;
        }

        $("#year_of_passing").html(options);
    });

});
    </script>
@endpush
