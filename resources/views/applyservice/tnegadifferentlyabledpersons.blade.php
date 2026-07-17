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
                            <form class="row g-4" action="{{ url('submittnegahandicap') }}" enctype="multipart/form-data"
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

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <label>
                                                                Category of Differently Abled
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select name="category_disability" class="form-control"
                                                                required>
                                                                <option value="">SELECT</option>

                                                                <option
                                                                    value="Severely affected Differently Abled Person (SD)">
                                                                    Severely affected Differently Abled Person (SD) -
                                                                    கடுமையாக பாதிக்கப்பட்ட மாற்றுத்திறனாளி
                                                                </option>

                                                                <option
                                                                    value="Persons affected with Muscular Dystrophy (MD)">
                                                                    Persons affected with Muscular Dystrophy (MD) - தசை
                                                                    சிதைவு நோயால் பாதிக்கப்பட்டோர்
                                                                </option>

                                                                <option
                                                                    value="Persons affected with Intellectual Disability">
                                                                    Persons affected with Intellectual Disability -
                                                                    மனவளர்ச்சி குறைபாடுடையோர்
                                                                </option>

                                                                <option value="Person affected with Leprosy (LC)">
                                                                    Person affected with Leprosy (LC) - தொழுநோயால்
                                                                    பாதிக்கப்பட்டோர்
                                                                </option>

                                                                <option
                                                                    value="Chronic Neurological Disorders / Spinal Cord Injury / Parkinson's Disease">
                                                                    Chronic Neurological Disorders / Spinal Cord Injury /
                                                                    Parkinson's Disease - நரம்பியல் / முதுகுத்தண்டு காயம் /
                                                                    பார்கின்சன் நோயால் பாதிக்கப்பட்டோர்
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>
                                                                Differently Abled Type
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select name="differently_abled_type" class="form-control">
                                                                <option value="">SELECT</option>
                                                                <option value="Orthopaedic">Orthopaedic - உடல் இயக்கக்
                                                                    குறைபாடு</option>
                                                                <option value="Visual">Visual - பார்வைக் குறைபாடு</option>
                                                                <option value="Hearing">Hearing - காது கேளாமை</option>
                                                                <option value="Speech">Speech - பேச்சுக் குறைபாடு</option>
                                                                <option value="Mental Retardation">Mental Retardation -
                                                                    அறிவுசார் குறைபாடு</option>
                                                                <option value="Mental Illness">Mental Illness - மனநலக்
                                                                    குறைபாடு</option>
                                                                <option value="Multiple Disability">Multiple Disability -
                                                                    பல்வேறு மாற்றுத்திறன்</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Percentage of Differently Abled / மாற்றுத்திறனின் சதவீதம்
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select name="percentage" id="percentage"
                                                                class="form-control" required>
                                                                <option value="">SELECT / தேர்ந்தெடுக்கவும்</option>

                                                                @for ($i = 40; $i <= 100; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ old('percentage') == $i ? 'selected' : '' }}>
                                                                        {{ $i }}%
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>
                                                                Types of Differently Abled (As Per NIDC)
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input name="nidc_disability_type" class="form-control" placeholder="Types of Differently Abled (As Per NIDC)" maxlength="200">
                                                        </div>


                                                        <div class="col-md-6 mb-3">
                                                            <label>National ID Card Number <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="national_idcardno"
                                                                class="form-control number" required maxlength="20"
                                                                placeholder="National ID Card Number">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Temporary / Permanent ID Card</label>
                                                            <select name="id_card_type" class="form-control">
                                                                <option>Select</option>
                                                                <option value="Temporary">Temporary</option>
                                                                <option value="Permanent">Permanent</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Temporary ID Card Valid Till</label>
                                                            <input type="date" name="temporary_valid_till"
                                                                class="form-control">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Already Availed Any Schemes?</label><br>

                                                            <label>
                                                                <input type="radio" name="scheme" value="Yes"> Yes
                                                            </label>

                                                            <label class="ms-3">
                                                                <input type="radio" name="scheme" value="No"> No
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>State ID Card Number</label>
                                                            <input type="text" name="state_id_card" placeholder="State ID Card Number" maxlength="20"
                                                                class="form-control number" >
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>UDID Number</label>
                                                            <input type="text" name="udid_number"
                                                                class="form-control number" maxlength="20" placeholder="UDID Number">
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

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h6 class="mb-2 text-success">
                                                    <i class="fa fa-graduation-cap"></i>Bank Details
                                                </h6>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Bank Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="bank_name" class="form-control"
                                                            required maxlength="200" placeholder="Bank Name">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>District <span class="text-danger">*</span></label>
                                                        <input type="text" name="bank_district" class="form-control"
                                                            required maxlength="100" placeholder="District Name">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Branch Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="branch_name" class="form-control"
                                                            required maxlength="100" placeholder="Branch Name">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>IFSC Code <span class="text-danger">*</span></label>
                                                        <input type="text" name="ifsc_code" class="form-control"
                                                            required maxlength="15" placeholder="Ifsc Code">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Account Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="account_number"
                                                            class="form-control number" required maxlength="20"
                                                            placeholder="Account Number">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>MICR Number</label>
                                                        <input type="text" name="micr_number" class="form-control"
                                                            maxlength="15" placeholder="Micr No">
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
                                                    <button type="button" class="btn btn-primary" id="nextBtn"
                                                        onclick="nextStep(3)">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <!-- STEP 3 -->
                                    <div id="step4" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Body -->
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h6 class="mb-0">Supporting Documents</h6>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Aadhaar Card <span class="text-danger">*</span></label>
                                                            <input type="file" name="aadhaar_card"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Any ID Proof of Parents / Guardian <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="parent_guardian_id"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Bank Pass Book (Front Page) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="bank_passbook"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Family Card (Ration Card) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="ration_card" class="form-control"
                                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Differently Abled Certificate / National Identity Card
                                                                <span class="text-danger">*</span></label>
                                                            <input type="file" name="disability_certificate"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                                                required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Photo of Applicant <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="photo"
                                                                class="form-control" accept=".jpg,.jpeg,.png" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Photo of Parent / Guardian <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" name="parent_photo"
                                                                class="form-control" accept=".jpg,.jpeg,.png" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>UDID</label>
                                                            <input type="file" name="udid" class="form-control"
                                                                accept=".jpg,.jpeg,.png,.pdf">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer bg-white">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(4)">
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


