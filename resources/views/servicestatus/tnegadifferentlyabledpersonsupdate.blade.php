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
                        <h6 class="card-title">{{ $servicename }}</h6>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submittnegahandicapupdate') }}"
                                enctype="multipart/form-data" method="post" id="myForm">
                                @csrf


                                <div id="step1">
                                    <h4 class="text-center card-header bg-success text-white">
                                        Can Details
                                    </h4>
                                    <div class="row">
                                        <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                        <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                        <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                        <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
                                        <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                        @php
                                            $apply_user_id = 0;
                                            if ($services->distributor_id == 0 && $services->retailer_id == 0) {
                                                $apply_user_id = $services->user_id;
                                            } elseif ($services->retailer_id == 0) {
                                                $apply_user_id = $services->distributor_id;
                                            } elseif ($services->distributor_id == 0) {
                                                $apply_user_id = $services->retailer_id;
                                            }
                                        @endphp
                                        <div id="step1">

                                            <div class="row">

                                                <!-- LEFT COLUMN -->
                                                <div class="col-lg-6 col-md-6 col-sm-12">

                                                    <!-- Can Number -->
                                                    <label class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="15"
                                                        required type="text" class="form-control" name="can_number"
                                                        value="{{ $tncustomers->can_number }}">

                                                    <!-- Name English -->
                                                    <label class="form-label mt-3">Name In English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="60"
                                                        required type="text" class="form-control" name="name"
                                                        value="{{ $tncustomers->name }}">

                                                    <!-- Father Name -->
                                                    <label class="form-label mt-3">Father Name In English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                        required type="text" class="form-control"
                                                        name="father_name_english"
                                                        value="{{ $tncustomers->father_name_english }}">

                                                    <!-- Mother Name -->
                                                    <label class="form-label mt-3">Mother Name In English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                        required type="text" class="form-control"
                                                        name="mother_name_english"
                                                        value="{{ $tncustomers->mother_name_english }}">

                                                    <!-- Gender -->
                                                    <label class="form-label mt-3">Gender</label>
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        class="form-control" name="gender">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->gender == 'Male') selected @endif
                                                            value="Male">Male</option>
                                                        <option @if ($tncustomers->gender == 'Female') selected @endif
                                                            value="Female">Female</option>
                                                    </select>

                                                    <!-- DOB -->
                                                    <label class="form-label mt-3">DOB</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="date" class="form-control" name="dob"
                                                        value="{{ $tncustomers->dob }}">

                                                    <!-- District -->
                                                    <label class="form-label mt-3">District</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="50"
                                                        required type="text" class="form-control" name="district_name"
                                                        value="{{ $tncustomers->district_name }}">

                                                    <!-- VAO -->
                                                    <label class="form-label mt-3">VAO</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="50"
                                                        required type="text" class="form-control" name="panchayath_name"
                                                        value="{{ $tncustomers->panchayath_name }}">

                                                    <!-- Address -->
                                                    <label class="form-label mt-3">Address English</label>
                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="500" required class="form-control"
                                                        rows="4" name="address">{{ $tncustomers->address }}</textarea>

                                                </div>

                                                <!-- RIGHT COLUMN -->
                                                <div class="col-lg-6 col-md-6 col-sm-12">

                                                    <label class="form-label">Aadhaar Number</label>
                                                    <input maxlength="12" readonly required type="text"
                                                        class="form-control number" name="aadhaar_no"
                                                        value="{{ $tncustomers->aadhaar_no }}">

                                                    <label class="form-label mt-3">Name In Tamil</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        maxlength="100" required type="text" class="form-control"
                                                        name="name_tamil" value="{{ $tncustomers->name_tamil }}">

                                                    <label class="form-label mt-3">Father Name In Tamil</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        maxlength="100" required type="text" class="form-control"
                                                        name="father_name_tamil"
                                                        value="{{ $tncustomers->father_name_tamil }}">

                                                    <label class="form-label mt-3">Mother Name In Tamil</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        maxlength="100" required type="text" class="form-control"
                                                        name="mother_name_tamil"
                                                        value="{{ $tncustomers->mother_name_tamil }}">

                                                    <label class="form-label mt-3">Religion</label>
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        class="form-control" name="religion">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->religion == 'Hindu') selected @endif
                                                            value="Hindu">Hindu</option>
                                                        <option @if ($tncustomers->religion == 'Christian') selected @endif
                                                            value="Christian">Christian</option>
                                                        <option @if ($tncustomers->religion == 'Muslim') selected @endif
                                                            value="Muslim">Muslim</option>
                                                    </select>

                                                    <label class="form-label mt-3">Marital Status</label>
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        class="form-control" name="marital_status">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->marital_status == 'Married') selected @endif
                                                            value="Married">Married</option>
                                                        <option @if ($tncustomers->marital_status == 'UnMarried') selected @endif
                                                            value="UnMarried">UnMarried</option>
                                                    </select>

                                                    <label class="form-label mt-3">Taluk</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        maxlength="100" required type="text" class="form-control"
                                                        name="taluk_name" value="{{ $tncustomers->taluk_name }}">

                                                    <label class="form-label mt-3">Mobile Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        maxlength="10" required type="text"
                                                        class="form-control number" name="mobile"
                                                        value="{{ $tncustomers->mobile }}">

                                                    <label class="form-label mt-3">Address Tamil</label>
                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="500" required class="form-control"
                                                        rows="4" name="address_tamil">{{ $tncustomers->address_tamil }}</textarea>

                                                </div>

                                            </div>

                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-primary btn-sm px-5"
                                                    onclick="nextStep(1)">
                                                    Next →
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <!-- STEP 2 -->
                                    <div id="step2" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">
                                            <!-- Card Body -->
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0">Application Details</h5>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Category of Differently Abled
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                name="category_disability" class="form-control">

                                                                <option value="">SELECT</option>

                                                                <option
                                                                    value="Severely affected Differently Abled Person (SD)"
                                                                    {{ $services->category_disability == 'Severely affected Differently Abled Person (SD)' ? 'selected' : '' }}>
                                                                    Severely affected Differently Abled Person (SD) -
                                                                    கடுமையாக பாதிக்கப்பட்ட மாற்றுத்திறனாளி
                                                                </option>

                                                                <option
                                                                    value="Persons affected with Muscular Dystrophy (MD)"
                                                                    {{ $services->category_disability == 'Persons affected with Muscular Dystrophy (MD)' ? 'selected' : '' }}>
                                                                    Persons affected with Muscular Dystrophy (MD) - தசை
                                                                    சிதைவு நோயால் பாதிக்கப்பட்டோர்
                                                                </option>

                                                                <option
                                                                    value="Persons affected with Intellectual Disability"
                                                                    {{ $services->category_disability == 'Persons affected with Intellectual Disability' ? 'selected' : '' }}>
                                                                    Persons affected with Intellectual Disability -
                                                                    மனவளர்ச்சி குறைபாடுடையோர்
                                                                </option>

                                                                <option value="Person affected with Leprosy (LC)"
                                                                    {{ $services->category_disability == 'Person affected with Leprosy (LC)' ? 'selected' : '' }}>
                                                                    Person affected with Leprosy (LC) - தொழுநோயால்
                                                                    பாதிக்கப்பட்டோர்
                                                                </option>

                                                                <option
                                                                    value="Chronic Neurological Disorders / Spinal Cord Injury / Parkinson's Disease"
                                                                    {{ $services->category_disability == 'Chronic Neurological Disorders / Spinal Cord Injury / Parkinson\'s Disease' ? 'selected' : '' }}>
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

                                                            <div class="col-md-6 mb-3">
                                                                <label>
                                                                    Differently Abled Type
                                                                    <span class="text-danger">*</span>
                                                                </label>

                                                                <select required
                                                                    @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    name="differently_abled_type" class="form-control">

                                                                    <option value="">SELECT</option>

                                                                    <option value="Orthopaedic"
                                                                        {{ $services->differently_abled_type == 'Orthopaedic' ? 'selected' : '' }}>
                                                                        Orthopaedic - உடல் இயக்கக் குறைபாடு
                                                                    </option>

                                                                    <option value="Visual"
                                                                        {{ $services->differently_abled_type == 'Visual' ? 'selected' : '' }}>
                                                                        Visual - பார்வைக் குறைபாடு
                                                                    </option>

                                                                    <option value="Hearing"
                                                                        {{ $services->differently_abled_type == 'Hearing' ? 'selected' : '' }}>
                                                                        Hearing - காது கேளாமை
                                                                    </option>

                                                                    <option value="Speech"
                                                                        {{ $services->differently_abled_type == 'Speech' ? 'selected' : '' }}>
                                                                        Speech - பேச்சுக் குறைபாடு
                                                                    </option>

                                                                    <option value="Mental Retardation"
                                                                        {{ $services->differently_abled_type == 'Mental Retardation' ? 'selected' : '' }}>
                                                                        Mental Retardation - அறிவுசார் குறைபாடு
                                                                    </option>

                                                                    <option value="Mental Illness"
                                                                        {{ $services->differently_abled_type == 'Mental Illness' ? 'selected' : '' }}>
                                                                        Mental Illness - மனநலக் குறைபாடு
                                                                    </option>

                                                                    <option value="Multiple Disability"
                                                                        {{ $services->differently_abled_type == 'Multiple Disability' ? 'selected' : '' }}>
                                                                        Multiple Disability - பல்வேறு மாற்றுத்திறன்
                                                                    </option>

                                                                </select>
                                                            </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label>
                                                                    Percentage of Differently Abled / மாற்றுத்திறனின்
                                                                    சதவீதம்
                                                                    <span class="text-danger">*</span>
                                                                </label>

                                                                <select required
                                                                    @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    name="percentage" id="percentage"
                                                                    class="form-control">

                                                                    <option value="">SELECT / தேர்ந்தெடுக்கவும்
                                                                    </option>

                                                                    @for ($i = 40; $i <= 100; $i++)
                                                                        <option value="{{ $i }}"
                                                                            {{ $services->percentage == $i ? 'selected' : '' }}>
                                                                            {{ $i }}%
                                                                        </option>
                                                                    @endfor

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label>
                                                                    Types of Differently Abled (As Per NIDC)
                                                                    <span class="text-danger">*</span>
                                                                </label>

                                                                <input required
                                                                    @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text" name="nidc_disability_type"
                                                                    class="form-control" maxlength="200"
                                                                    placeholder="Types of Differently Abled (As Per NIDC)"
                                                                    value="{{ $services->nidc_disability_type }}">
                                                            </div>


                                                            <div class="col-md-6 mb-3">
                                                                <label>National ID Card Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input required
                                                                    @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text" name="national_idcardno"
                                                                    class="form-control number" maxlength="20"
                                                                    placeholder="National ID Card Number"
                                                                    value="{{ $services->national_idcardno }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Temporary / Permanent ID Card</label>

                                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    name="id_card_type" class="form-control">

                                                                    <option value="">Select</option>

                                                                    <option value="Temporary"
                                                                        {{ $services->id_card_type == 'Temporary' ? 'selected' : '' }}>
                                                                        Temporary
                                                                    </option>

                                                                    <option value="Permanent"
                                                                        {{ $services->id_card_type == 'Permanent' ? 'selected' : '' }}>
                                                                        Permanent
                                                                    </option>

                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Temporary ID Card Valid Till</label>

                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="date" name="temporary_valid_till"
                                                                    class="form-control"
                                                                    value="{{ $services->temporary_valid_till }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Already Availed Any Schemes?</label><br>

                                                                <label class="me-3">
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        type="radio" name="scheme" value="Yes"
                                                                        {{ $services->scheme == 'Yes' ? 'checked' : '' }}>
                                                                    Yes
                                                                </label>

                                                                <label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        type="radio" name="scheme" value="No"
                                                                        {{ $services->scheme == 'No' ? 'checked' : '' }}>
                                                                    No
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>State ID Card Number</label>

                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text" name="state_id_card"
                                                                    class="form-control number" maxlength="20"
                                                                    placeholder="State ID Card Number"
                                                                    value="{{ $services->state_id_card }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>UDID Number</label>

                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text" name="udid_number"
                                                                    class="form-control number" maxlength="20"
                                                                    placeholder="UDID Number"
                                                                    value="{{ $services->udid_number }}">
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

                                </div>
                                <div class="row">

                                    <!-- STEP 3 -->
                                    <div id="step3" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h5 class="mb-2 text-success">
                                                    <i class="fa fa-university"></i> Bank Details
                                                </h5>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Bank Name <span class="text-danger">*</span></label>
                                                        <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="bank_name" class="form-control"
                                                            maxlength="200" placeholder="Bank Name"
                                                            value="{{ $services->bank_name }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>District <span class="text-danger">*</span></label>
                                                        <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="bank_district" class="form-control"
                                                            maxlength="100" placeholder="District Name"
                                                            value="{{ $services->bank_district }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Branch Name <span class="text-danger">*</span></label>
                                                        <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="branch_name" class="form-control"
                                                            maxlength="100" placeholder="Branch Name"
                                                            value="{{ $services->branch_name }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>IFSC Code <span class="text-danger">*</span></label>
                                                        <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="ifsc_code" class="form-control"
                                                            maxlength="15" placeholder="IFSC Code"
                                                            value="{{ $services->ifsc_code }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Account Number <span class="text-danger">*</span></label>
                                                        <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="account_number"
                                                            class="form-control number" maxlength="20"
                                                            placeholder="Account Number"
                                                            value="{{ $services->account_number }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>MICR Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="micr_number" class="form-control"
                                                            maxlength="15" placeholder="MICR No"
                                                            value="{{ $services->micr_number }}">
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

                                    <div id="step4" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0 text-success">
                                                    <i class="fa fa-file"></i>Supporting Documents
                                                </h5>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Aadhaar Card <span class="text-danger">*</span></label>

                                                        @if (!empty($services->aadhaar_card))
                                                            <p>
                                                                <a href="{{ asset('upload/services/aadhaar_card/' . $services->aadhaar_card) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="aadhaar_card" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Any ID Proof of Parents / Guardian <span
                                                                class="text-danger">*</span></label>

                                                        @if (!empty($services->parent_guardian_id))
                                                            <p>
                                                                <a href="{{ asset('upload/services/parent_guardian_id/' . $services->parent_guardian_id) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="parent_guardian_id" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Bank Pass Book (Front Page) <span
                                                                class="text-danger">*</span></label>

                                                        @if (!empty($services->bank_passbook))
                                                            <p>
                                                                <a href="{{ asset('upload/services/bank_passbook/' . $services->bank_passbook) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="bank_passbook" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Family Card (Ration Card) <span
                                                                class="text-danger">*</span></label>

                                                        @if (!empty($services->ration_card))
                                                            <p>
                                                                <a href="{{ asset('upload/services/ration_card/' . $services->ration_card) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="ration_card" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Differently Abled Certificate / National Identity Card
                                                            <span class="text-danger">*</span></label>

                                                        @if (!empty($services->disability_certificate))
                                                            <p>
                                                                <a href="{{ asset('upload/services/disability_certificate/' . $services->disability_certificate) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="disability_certificate"
                                                            class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo of Applicant <span
                                                                class="text-danger">*</span></label>

                                                        @if (!empty($services->photo))
                                                            <p>
                                                                <a href="{{ asset('upload/services/photo/' . $services->photo) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="photo" class="form-control"
                                                            accept=".jpg,.jpeg,.png">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo of Parent / Guardian <span
                                                                class="text-danger">*</span></label>

                                                        @if (!empty($services->parent_photo))
                                                            <p>
                                                                <a href="{{ asset('upload/services/parent_photo/' . $services->parent_photo) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="parent_photo" class="form-control"
                                                            accept=".jpg,.jpeg,.png">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>UDID</label>

                                                        @if (!empty($services->udid))
                                                            <p>
                                                                <a href="{{ asset('upload/services/udid/' . $services->udid) }}"
                                                                    target="_blank" class="btn btn-sm btn-success">
                                                                    View
                                                                </a>
                                                            </p>
                                                        @endif

                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="file" name="udid" class="form-control"
                                                            accept=".jpg,.jpeg,.png,.pdf">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-5">

                                                <button type="button" class="btn btn-secondary px-3"
                                                    onclick="prevStep(4)">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Previous
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        @if (Auth::user()->id != $apply_user_id)
                                            <div class="mb-3 col-md-6">
                                                 <label for="service_name" class="form-label">Service Status</label>
                                <select class="form-control" name="status" id="service_status">
                                    <option value="">Select</option>
                                    <option @if ($services->status == 'Pending') selected @endif value="Pending">
                                        Pending</option>
                                    <option @if ($services->status == 'Resubmit') selected @endif value="Resubmit">
                                        Resubmit</option>
                                    <option @if ($services->status == 'Processing') selected @endif
                                        value="Processing">Processing</option>
                                    @if ($services->status != 'Approved')
                                    <option @if ($services->status == 'Rejected') selected @endif
                                        value="Rejected">Rejected</option>
                                    @endif
                                    <option @if ($services->status == 'Approved') selected @endif value="Approved">
                                        Approved</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input value="{{ $services->remarks }}" class="form-control" type="text"
                                    name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                            </div>
                            <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                <input class="form-control" type="file" name="acknowledgement"
                                    id="acknowledgement" />
                            </div>
                            <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                <label for="application_no" class="form-label">Application No</label>
                                <input value="{{ $services->application_no }}" class="form-control"
                                    type="text" maxlength="20" name="application_no" id="application_no" />
                            </div>
                            <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                <label for="certificate" class="form-label">Certificate</label>
                                <input class="form-control" type="file" name="certificate"
                                    id="certificate" />
                            </div>
                            <div class="mb-3 col-md-6" id="applicationapprovedhide" style="display :none;">
                                <label for="application_no" class="form-label">Application No</label>
                                <input value="{{ $services->application }}" class="form-control" type="text"
                                    maxlength="20" name="application" id="application" />
                            </div>
                            @else
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="service_name" class="form-label">Service Status</label>
                                    <input disabled value="{{ $services->status }}" class="form-control"
                                        type="text" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $services->remarks }}</textarea>
                                </div>

                            </div>                
                                        @endif
                                                        <div class="mt-2 text-center">
                                    @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                    @elseif($services->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                    @else
                                        <button id="save" type="submit"
                                            class="btn btn-primary me-2">Submit</button>
                                    @endif
                                </div>
                                    </div>

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
    </div>
@endsection
    @push('page_scripts')
        <script>
            $(function() {
                var status = "{{ $services->status }}";
                var acknowledgement = "{{ $services->acknowledgement }}";
                var certificate = "{{ $services->certificate }}";

                var dist_id = "{{ $services->dist_id }}";
                var taluk_id = "{{ $services->taluk_id }}";
                gettaluk(dist_id);
                getpanchayath(taluk_id);

               if (status == "Resubmit") {
            $('#remarkshide').show("slow");
            $('#remarks').prop("required", true);
        } else if (status == "Processing") {
            $('#applicationnohide').show("slow");
            $('#application_no').prop("required", true);
            $('#acknowledgementhide').show("slow");
            if (acknowledgement == "") {
                $('#acknowledgement').prop("required", true);
            }
        } else if (status == "Approved") {
            $('#certhide').show("slow");
            $('#application').prop("required", true);
            $('#applicationapprovedhide').show("slow");
            if (acknowledgement == "") {
                $('#certificate').prop("required", true);
            }
        }
        });

        $('#service_status').change(function() {
        if ($('#service_status').val() == 'Resubmit') {
            $('#acknowledgementhide').hide("slow");
            $('#acknowledgement').prop("required", false);
            $('#applicationnohide').hide("slow");
            $('#application_no').prop("required", false);
            $('#certhide').hide("slow");
            $('#certificate').prop("required", false);
            $('#remarkshide').show("slow");
            $('#remarks').prop("required", true);
            $('#application').prop("required", false);
            $('#applicationapprovedhide').hide("slow");
        } else if ($('#service_status').val() == 'Processing') {
            $('#acknowledgementhide').show("slow");
            $('#acknowledgement').prop("required", true);
            $('#remarkshide').hide("slow");
            $('#remarks').prop("required", false);
            $('#certhide').hide("slow");
            $('#certificate').prop("required", false);
            $('#applicationnohide').show("slow");
            $('#application_no').prop("required", true);
            $('#application').prop("required", false);
            $('#applicationapprovedhide').hide("slow");
        } else if ($('#service_status').val() == 'Approved') {
            $('#remarkshide').hide("slow");
            $('#remarks').prop("required", false);
            $('#acknowledgementhide').hide("slow");
            $('#acknowledgement').prop("required", false);
            $('#certhide').show("slow");
            $('#certificate').prop("required", true);
            $('#applicationnohide').hide("slow");
            $('#application_no').prop("required", false);
            $('#application').prop("required", true);
            $('#applicationapprovedhide').show("slow");
        } else {
            $('#remarkshide').show("slow");
            $('#remarks').prop("required", false);
            $('#acknowledgementhide').hide("slow");
            $('#acknowledgement').prop("required", false);
            $('#certhide').hide("slow");
            $('#certificate').prop("required", false);
            $('#applicationnohide').hide("slow");
            $('#application_no').prop("required", false);
            $('#application').prop("required", false);
            $('#applicationapprovedhide').hide("slow");
        }
    });
        </script>

        {{-- Add Script --}}

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



