

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
                            <form class="row g-4" action="{{ url('submittneganativity') }}" enctype="multipart/form-data"
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

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h6 class="mb-2 text-success">
                                                    <i class="fa fa-graduation-cap"></i> Nativity Types
                                                </h6>

                                                <div class="marquee-container">
                                                    <div class="marquee-text">
                                                        🔴 Please Provide The Address Details For Above 5 Years 🔴
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card Body -->
                                            <div class="card-body">

                                                <!-- Radio Buttons -->
                                                <div class="mb-4">
                                                    <label class="form-label">
                                                        <b>Select Nativity Type</b>
                                                    </label>
                                                    <br>

                                                    <label class="me-4">
                                                        <input type="radio" name="nativity_type" value="birth"
                                                            checked>
                                                        Nativity Certificate By Birth
                                                    </label>

                                                    <label class="ms-3">
                                                        <input type="radio" name="nativity_type" value="residence">
                                                        Nativity Certificate By Residence
                                                    </label>
                                                </div>

                                                <!-- Birth Section -->
                                                <div id="birthSection">

                                                    <h5 class="text-primary mb-3">
                                                        Nativity Certificate By Birth Documents
                                                    </h5>

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Photo</label>
                                                            <input type="file" class="form-control"
                                                                name="birth_photo">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Aadhaar + Smart Card</label>
                                                            <input type="file" class="form-control"
                                                                name="birth_aadhaar_card">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Birth Certificate</label>
                                                            <input type="file" class="form-control"
                                                                name="birth_certificate">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Signature</label>
                                                            <input type="file" class="form-control"
                                                                name="birth_signature">
                                                        </div>

                                                    </div>

                                                    <!-- Apply Button -->
                                                    <div class="text-center mt-3">
                                                        <button id="save" type="submit" class="btn btn-primary">
                                                            Apply
                                                        </button>
                                                    </div>

                                                </div>

                                                <!-- Residence Section -->
                                                <div id="residenceSection" style="display:none;">

                                                    <h5 class="text-primary mb-3">Address Details</h5>

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>District</label>
                                                            <input type="text" class="form-control"
                                                                name="nativity_district[]" maxlength="50"
                                                                placeholder="District">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Taluk</label>
                                                            <input type="text" class="form-control"
                                                                name="nativity_taluk[]" maxlength="50"
                                                                placeholder="Taluk">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Revenue Village</label>
                                                            <input type="text" class="form-control"
                                                                name="revenue_village[]" maxlength="100"
                                                                placeholder="Revenue Village">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Street Name</label>
                                                            <input type="text" class="form-control"
                                                                name="street_name[]" maxlength="100"
                                                                placeholder="Street Name">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Door No</label>
                                                            <input type="text" class="form-control" name="door_no[]"
                                                                maxlength="50" placeholder="Door No">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Pincode</label>
                                                            <input type="text" class="form-control number"
                                                                name="pin_code[]" maxlength="6" placeholder="Pincode">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>From Date</label>
                                                            <input type="date" class="form-control"
                                                                name="from_date[]">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>To Date</label>
                                                            <input type="date" class="form-control" name="to_date[]">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label>Address Count</label>
                                                            <input type="number" min="1" id="address_count"
                                                                class="form-control" name="address_count"
                                                                placeholder="No of Address">
                                                        </div>

                                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                                            <button type="button" class="btn btn-success"
                                                                onclick="generateAddress()">
                                                                Add
                                                            </button>
                                                        </div>
                                                        <div id="addressContainer"></div>
                                                    </div>

                                                </div>

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
                                                <h6 class="mb-2 text-success">
                                                    <i class="fa fa-graduation-cap"></i>Resisdence Documents
                                                </h6>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <h6 class="text-primary mb-3">Documents</h6>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Aadhaar + Smart Card</label>
                                                        <input type="file" class="form-control" name="aadhaar_card">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Birth Certificate</label>
                                                        <input type="file" class="form-control"
                                                            name="resisdence_birth_certificate">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Signature</label>
                                                        <input type="file" class="form-control" name="signature">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>School Education Proof</label>
                                                        <input type="file" class="form-control" name="school_proof">
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

                // Radio Button Script

                $(document).ready(function() {

                    $("input[name='nativity_type']").change(function() {

                        if ($(this).val() == "birth") {
                            $("#birthSection").show();
                            $("#residenceSection").hide();
                        } else {
                            $("#birthSection").hide();
                            $("#residenceSection").show();
                        }

                    });

                });
            </script>

            {{-- Add Script --}}

            <script>
                function generateAddress() {

                    let count = parseInt($("#address_count").val());

                    if (isNaN(count) || count <= 0) {
                        alert("Enter valid address count");
                        return;
                    }

                    let html = "";

                    $("#addressContainer").html("");

                    for (let i = 1; i <= count; i++) {

                        html += `
        <div class="address-block border rounded p-3 mt-3">

            <div class="text-end mb-2">
                <button type="button"
                        class="btn btn-danger btn-sm remove-address">
                    Remove
                </button>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>District</label>
                    <input type="text"
                        class="form-control"
                        name="nativity_district[]"
                        placeholder="District">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Taluk</label>
                    <input type="text"
                        class="form-control"
                        name="nativity_taluk[]"
                        placeholder="Taluk">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Revenue Village</label>
                    <input type="text"
                        class="form-control"
                        name="revenue_village[]"
                        placeholder="Revenue Village">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Street Name</label>
                    <input type="text"
                        class="form-control"
                        name="street_name[]"
                        placeholder="Street Name">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Door No</label>
                    <input type="text"
                        class="form-control"
                        name="door_no[]"
                        placeholder="Door No">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Pincode</label>
                    <input type="text"
                        class="form-control"
                        name="pin_code[]"
                        maxlength="6"
                        placeholder="Pincode">
                </div>

                <div class="col-md-6 mb-3">
                    <label>From Date</label>
                    <input type="date"
                        class="form-control"
                        name="from_date[]">
                </div>

                <div class="col-md-6 mb-3">
                    <label>To Date</label>
                    <input type="date"
                        class="form-control"
                        name="to_date[]">
                </div>

            </div>

        </div>`;
                    }

                    $("#addressContainer").html(html);
                }

                // Remove Address Block
                $(document).on("click", ".remove-address", function() {
                    $(this).closest(".address-block").remove();
                });


                $(document).ready(function() {

                    function toggleNativity() {

                        var type = $("input[name='nativity_type']:checked").val();

                        if (type == "birth") {

                            $("#birthSection").show();
                            $("#residenceSection").hide();

                        } else {

                            $("#birthSection").hide();
                            $("#residenceSection").show();

                        }
                    }

                    toggleNativity();

                    $("input[name='nativity_type']").change(function() {
                        toggleNativity();
                    });

                });

                $(document).ready(function() {

                    function toggleNativity() {

                        var type = $("input[name='nativity_type']:checked").val();

                        if (type == "birth") {

                            $("#nextBtn").hide(); // Birth -> Hide Next

                        } else {

                            $("#nextBtn").show(); // Residence -> Show Next

                        }
                    }

                    toggleNativity(); // Page load

                    $("input[name='nativity_type']").change(function() {
                        toggleNativity();
                    });

                });
            </script>
        @endpush
