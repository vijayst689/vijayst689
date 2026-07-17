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

        .marquee-container {
            width: 100%;
            overflow: hidden;
            background: #dc3545;
            border-radius: 5px;
            padding: 8px 0;
        }

        .marquee-text {
            display: inline-block;
            white-space: nowrap;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            padding-left: 100%;
            animation: scrollText 20s linear infinite;
        }

        @keyframes scrollText {
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
                            <form class="row g-4" action="{{ url('submittnegawidow') }}" enctype="multipart/form-data"
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

                                        <div class="card border-success shadow-sm mb-4">
                                            <!-- Card Body -->
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h6 class="mb-0">Application Details</h6>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row g-3">

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Relationship / உறவு
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select name="relationship"
                                                                class="form-select form-select-lg rounded-3" required>
                                                                <option value="">-- Select Relationship --</option>
                                                                <option value="Husband">Husband / கணவர்</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Father / Husband Name
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="text" name="guardian_name"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="Enter Father / Husband Name" maxlength="100"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                தந்தை / கணவர் பெயர் (தமிழில்)
                                                            </label>

                                                            <input type="text" name="guardian_name_tamil"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="தந்தை / கணவர் பெயர்" maxlength="100">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Spouse Name
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="text" name="spouse_name"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="Enter Spouse Name" maxlength="100" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                கணவரின் பெயர் (தமிழில்)
                                                            </label>

                                                            <input type="text" name="spouse_name_tamil"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="கணவரின் பெயர்" maxlength="200">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Death Certificate Number
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="text" name="death_certificate_no"
                                                                class="form-control form-control-lg rounded-3 number"
                                                                placeholder="Enter Death Certificate Number"
                                                                maxlength="50" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Date of Marriage
                                                            </label>

                                                            <input type="date" name="date_of_marriage"
                                                                class="form-control form-control-lg rounded-3">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Date of Death
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="date" name="date_of_death"
                                                                class="form-control form-control-lg rounded-3" required>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <br>

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

                                            <!-- Body -->
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h6 class="mb-0">Documents</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Photo <span class="text-danger">*</span></label>
                                                            <input type="file" name="photo" class="form-control"
                                                                accept=".jpg,.jpeg,.png" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Any Address Proof <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="address_proof"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Death Certificate of Husband <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="death_certificate_husband"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Marriage Registration Certificate / Marriage Proof
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="file" name="marriage_proof"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>
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

    </script>
    <script>
        function nextStep(step) {

            console.log('Current:', 'step' + step);
            console.log('Next:', 'step' + (step + 1));

            let currentStep = document.getElementById('step' + step);
            let nextStepDiv = document.getElementById('step' + (step + 1));

            console.log(currentStep);
            console.log(nextStepDiv);

            if (currentStep) currentStep.style.display = 'none';
            if (nextStepDiv) nextStepDiv.style.display = 'block';
        }

        function prevStep(step) {

            console.log('Current:', 'step' + step);
            console.log('Previous:', 'step' + (step - 1));

            let currentStep = document.getElementById('step' + step);
            let prevStepDiv = document.getElementById('step' + (step - 1));

            if (currentStep) currentStep.style.display = 'none';
            if (prevStepDiv) prevStepDiv.style.display = 'block';
        }
    </script>
@endpush


