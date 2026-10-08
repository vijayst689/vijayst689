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
                        <div class="row">
                            <form class="row g-4" action="{{ url('submittnegaobcdupdate') }}" enctype="multipart/form-data"
                                method="post" id="myForm">
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
                                                    <input maxlength="15" required type="text" class="form-control"
                                                        name="can_number" value="{{ $tncustomers->can_number }}">

                                                    <!-- Name English -->
                                                    <label class="form-label mt-3">Name In English</label>
                                                    <input maxlength="60" required type="text" class="form-control"
                                                        name="name" value="{{ $tncustomers->name }}">

                                                    <!-- Father Name -->
                                                    <label class="form-label mt-3">Father Name In English</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="father_name_english"
                                                        value="{{ $tncustomers->father_name_english }}">

                                                    <!-- Mother Name -->
                                                    <label class="form-label mt-3">Mother Name In English</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="mother_name_english"
                                                        value="{{ $tncustomers->mother_name_english }}">

                                                    <!-- Gender -->
                                                    <label class="form-label mt-3">Gender</label>
                                                    <select required class="form-control" name="gender">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->gender == 'Male') selected @endif
                                                            value="Male">Male</option>
                                                        <option @if ($tncustomers->gender == 'Female') selected @endif
                                                            value="Female">Female</option>
                                                    </select>

                                                    <!-- DOB -->
                                                    <label class="form-label mt-3">DOB</label>
                                                    <input required type="date" class="form-control" name="dob"
                                                        value="{{ $tncustomers->dob }}">

                                                    <!-- District -->
                                                    <label class="form-label mt-3">District</label>
                                                    <input maxlength="50" required type="text" class="form-control"
                                                        name="district_name" value="{{ $tncustomers->district_name }}">

                                                    <!-- VAO -->
                                                    <label class="form-label mt-3">VAO</label>
                                                    <input maxlength="50" required type="text" class="form-control"
                                                        name="panchayath_name" value="{{ $tncustomers->panchayath_name }}">

                                                    <!-- Address -->
                                                    <label class="form-label mt-3">Address English</label>
                                                    <textarea maxlength="500" required class="form-control" rows="4" name="address">{{ $tncustomers->address }}</textarea>

                                                </div>

                                                <!-- RIGHT COLUMN -->
                                                <div class="col-lg-6 col-md-6 col-sm-12">

                                                    <label class="form-label">Aadhaar Number</label>
                                                    <input maxlength="12" readonly required type="text"
                                                        class="form-control number" name="aadhaar_no"
                                                        value="{{ $tncustomers->aadhaar_no }}">

                                                    <label class="form-label mt-3">Name In Tamil</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="name_tamil" value="{{ $tncustomers->name_tamil }}">

                                                    <label class="form-label mt-3">Father Name In Tamil</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="father_name_tamil"
                                                        value="{{ $tncustomers->father_name_tamil }}">

                                                    <label class="form-label mt-3">Mother Name In Tamil</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="mother_name_tamil"
                                                        value="{{ $tncustomers->mother_name_tamil }}">

                                                    <label class="form-label mt-3">Religion</label>
                                                    <select required class="form-control" name="religion">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->religion == 'Hindu') selected @endif
                                                            value="Hindu">Hindu</option>
                                                        <option @if ($tncustomers->religion == 'Christian') selected @endif
                                                            value="Christian">Christian</option>
                                                        <option @if ($tncustomers->religion == 'Muslim') selected @endif
                                                            value="Muslim">Muslim</option>
                                                    </select>

                                                    <label class="form-label mt-3">Marital Status</label>
                                                    <select required class="form-control" name="marital_status">
                                                        <option>Select</option>
                                                        <option @if ($tncustomers->marital_status == 'Married') selected @endif
                                                            value="Married">Married</option>
                                                        <option @if ($tncustomers->marital_status == 'UnMarried') selected @endif
                                                            value="UnMarried">UnMarried</option>
                                                    </select>

                                                    <label class="form-label mt-3">Taluk</label>
                                                    <input maxlength="100" required type="text" class="form-control"
                                                        name="taluk_name" value="{{ $tncustomers->taluk_name }}">

                                                    <label class="form-label mt-3">Mobile Number</label>
                                                    <input maxlength="10" required type="text"
                                                        class="form-control number" name="mobile"
                                                        value="{{ $tncustomers->mobile }}">

                                                    <label class="form-label mt-3">Address Tamil</label>
                                                    <textarea maxlength="500" required class="form-control" rows="4" name="address_tamil">{{ $tncustomers->address_tamil }}</textarea>

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
                                            <div class="card-body">
                                                <!-- Education Details -->
                                                <!-- Personal Details -->
                                                <h5 class="text-primary mb-3">Personal Details</h5>

                                                <div class="row">

                                                    <div class="col-md-4 mb-3">
                                                        <label>Religion <span class="text-danger">*</span></label>

                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            class="form-control" name="tnega_religion" required>

                                                            <option value="">SELECT</option>

                                                            <option value="Hindu"
                                                                {{ $services->tnega_religion == 'Hindu' ? 'selected' : '' }}>
                                                                Hindu
                                                            </option>

                                                            <option value="Muslim"
                                                                {{ $services->tnega_religion == 'Muslim' ? 'selected' : '' }}>
                                                                Muslim
                                                            </option>

                                                            <option value="Christian"
                                                                {{ $services->tnega_religion == 'Christian' ? 'selected' : '' }}>
                                                                Christian
                                                            </option>

                                                            <option value="Others"
                                                                {{ $services->tnega_religion == 'Others' ? 'selected' : '' }}>
                                                                Others
                                                            </option>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Caste <span class="text-danger">*</span></label>

                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            name="caste" id="caste" class="form-control" required>

                                                            <option value="">SELECT</option>

                                                            @foreach ($obc as $row)
                                                                <option value="{{ $row->id }}"
                                                                    data-serial="{{ $row->serial_no }}"
                                                                    @if ($services->caste == $row->id) selected @endif>
                                                                    {{ $row->caste_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>
                                                            Serial Number of the Caste in Central List of OBCs
                                                            <span class="text-danger">*</span>
                                                        </label>

                                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            type="text" name="serial_no" id="serial_no"
                                                            class="form-control" value="{{ $services->serial_no }}"
                                                            readonly>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label>Occupational Group <span
                                                                class="text-danger">*</span></label>

                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            class="form-control" name="graduation" required>

                                                            <option value="">SELECT</option>

                                                            <option value="Student"
                                                                {{ $services->graduation == 'Student' ? 'selected' : '' }}>
                                                                Student
                                                            </option>

                                                            <option value="Service"
                                                                {{ $services->graduation == 'Service' ? 'selected' : '' }}>
                                                                Service
                                                            </option>

                                                            <option value="Business"
                                                                {{ $services->graduation == 'Business' ? 'selected' : '' }}>
                                                                Business
                                                            </option>

                                                            <option value="Agriculture"
                                                                {{ $services->graduation == 'Agriculture' ? 'selected' : '' }}>
                                                                Agriculture
                                                            </option>

                                                            <option value="Others"
                                                                {{ $services->graduation == 'Others' ? 'selected' : '' }}>
                                                                Others
                                                            </option>

                                                        </select>
                                                    </div>

                                                </div>

                                                <hr>

                                                <h5 class="text-primary mb-3">Status of Father / Husband</h5>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Whether Alive? <span
                                                                class="text-danger">*</span></label><br>

                                                        <label class="me-3">
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="radio" name="father_alive" value="Yes"
                                                                {{ $services->father_alive == 'Yes' ? 'checked' : '' }}>
                                                            Yes
                                                        </label>

                                                        <label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="radio" name="father_alive" value="No"
                                                                {{ $services->father_alive == 'No' ? 'checked' : '' }}>
                                                            No
                                                        </label>
                                                    </div>

                                                </div>

                                                <div id="fatherDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Nature of Occupation <span
                                                                    class="text-danger">*</span></label>

                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                class="form-control" name="father_occupation"
                                                                id="father_occupation">

                                                                <option value="">SELECT</option>

                                                                <option value="Employed"
                                                                    {{ $services->father_occupation == 'Employed' ? 'selected' : '' }}>
                                                                    Employed
                                                                </option>

                                                                <option value="Self Employed"
                                                                    {{ $services->father_occupation == 'Self Employed' ? 'selected' : '' }}>
                                                                    Self Employed
                                                                </option>

                                                                <option value="Unemployed"
                                                                    {{ $services->father_occupation == 'Unemployed' ? 'selected' : '' }}>
                                                                    Unemployed
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3" id="father_status_div">
                                                            <label>Status <span class="text-danger">*</span></label>

                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                class="form-control" name="father_status"
                                                                id="father_status" required>

                                                                <option value="">SELECT</option>

                                                                <option value="Constitutional Posts"
                                                                    {{ $services->father_status == 'Constitutional Posts' ? 'selected' : '' }}>
                                                                    Constitutional Posts
                                                                </option>

                                                                <option value="Government Services"
                                                                    {{ $services->father_status == 'Government Services' ? 'selected' : '' }}>
                                                                    Government Services
                                                                </option>

                                                                <option value="International Organization"
                                                                    {{ $services->father_status == 'International Organization' ? 'selected' : '' }}>
                                                                    International Organization
                                                                </option>

                                                                <option value="Death/Permanent Incapacitation"
                                                                    {{ $services->father_status == 'Death/Permanent Incapacitation' ? 'selected' : '' }}>
                                                                    Death/Permanent Incapacitation
                                                                </option>

                                                                <option value="Public Sector Undertakings"
                                                                    {{ $services->father_status == 'Public Sector Undertakings' ? 'selected' : '' }}>
                                                                    Public Sector Undertakings
                                                                </option>

                                                                <option value="Armed Forces/Para Military Forces"
                                                                    {{ $services->father_status == 'Armed Forces/Para Military Forces' ? 'selected' : '' }}>
                                                                    Armed Forces/Para Military Forces
                                                                </option>

                                                                <option value="Professional Class"
                                                                    {{ $services->father_status == 'Professional Class' ? 'selected' : '' }}>
                                                                    Professional Class
                                                                </option>

                                                                <option
                                                                    value="Agricultural Land Holding (Owned by Mother, Father, Minor Child)"
                                                                    {{ $services->father_status == 'Agricultural Land Holding (Owned by Mother, Father, Minor Child)' ? 'selected' : '' }}>
                                                                    Agricultural Land Holding (Owned by Mother, Father,
                                                                    Minor Child)
                                                                </option>

                                                                <option value="Plantation (Property Owners)"
                                                                    {{ $services->father_status == 'Plantation (Property Owners)' ? 'selected' : '' }}>
                                                                    Plantation (Property Owners)
                                                                </option>

                                                                <option
                                                                    value="Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
                                                                    {{ $services->father_status == 'Vacant Land and/or Building in Urban Areas or Urban Agglomeration' ? 'selected' : '' }}>
                                                                    Vacant Land and/or Building in Urban Areas or Urban
                                                                    Agglomeration
                                                                </option>

                                                                <option value="Income/Wealth (Property Owners)"
                                                                    {{ $services->father_status == 'Income/Wealth (Property Owners)' ? 'selected' : '' }}>
                                                                    Income/Wealth (Property Owners)
                                                                </option>

                                                                <option value="Others"
                                                                    {{ $services->father_status == 'Others' ? 'selected' : '' }}>
                                                                    Others
                                                                </option>

                                                            </select>
                                                        </div>
                                                        <div class="row" id="fatherIncomeProofSection"
                                                            style="display:none;">

                                                            <div class="col-md-6 mb-3">
                                                                <label>Proof of Income <span
                                                                        class="text-danger">*</span></label><br>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Payslip"
                                                                        {{ $services->father_income_proof == 'Payslip' ? 'checked' : '' }}>
                                                                    Payslip
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Income Certificate"
                                                                        {{ $services->father_income_proof == 'Income Certificate' ? 'checked' : '' }}>
                                                                    Income Certificate
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="ITR"
                                                                        {{ $services->father_income_proof == 'ITR' ? 'checked' : '' }}>
                                                                    ITR
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Others"
                                                                        {{ $services->father_income_proof == 'Others' ? 'checked' : '' }}>
                                                                    Others
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="fatherIncomeFile"
                                                                style="display:none;">

                                                                <label>Upload Proof <span
                                                                        class="text-danger">*</span></label>

                                                                <input type="file" class="form-control"
                                                                    name="father_income_proof_file">

                                                                @if (!empty($services->father_income_proof_file))
                                                                    <small class="text-success d-block mt-2">
                                                                        <a href="{{ asset('upload/services/father_income_proof_file/' . $services->father_income_proof_file) }}"
                                                                            target="_blank"
                                                                            class="btn btn-info btn-sm mb-2">
                                                                            View
                                                                        </a>
                                                                    </small>
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row" id="fatherCommonDetails" style="display:none;">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Designation <span class="text-danger">*</span></label>
                                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            type="text" class="form-control" name="father_designation"
                                                            value="{{ $services->father_designation }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Pay Scale <span class="text-danger">*</span></label>
                                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            type="text" class="form-control" name="pay_scale"
                                                            value="{{ $services->pay_scale }}">
                                                    </div>

                                                </div>
                                                <div id="fatherLocationDetails" style="display:none;">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Location <span class="text-danger">*</span></label>

                                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            type="text" class="form-control" name="father_location"
                                                            value="{{ $services->father_location }}">
                                                    </div>

                                                </div>
                                                <div id="fatherConstitutional" style="display:none;">

                                                    <div class="row">

                                                    </div>

                                                </div>
                                                <div id="fatherGovernmentService" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Service <span class="text-danger">*</span></label><br>

                                                            <label class="me-3">
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_service" value="Central"
                                                                    {{ $services->father_service == 'Central' ? 'checked' : '' }}>
                                                                Central
                                                            </label>

                                                            <label>
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_service" value="State"
                                                                    {{ $services->father_service == 'State' ? 'checked' : '' }}>
                                                                State
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Scale of Pay, including classification, if any
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_pay_scale"
                                                                value="{{ $services->father_pay_scale }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Appointment of Post
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="date" class="form-control"
                                                                name="father_date_of_appointment"
                                                                value="{{ $services->father_date_of_appointment }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Age at the time of promotion for Class I post (If
                                                                applicable)</label>

                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_promotion_age"
                                                                value="{{ $services->father_promotion_age }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherInternationalOrg" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Name Of The Organization <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="name_organization"
                                                                value="{{ $services->name_organization }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Period Of Service (From Date) <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="date" class="form-control"
                                                                name="service_fromdate"
                                                                value="{{ $services->service_fromdate }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Period Of Service (To Date) <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="date" class="form-control" name="service_todate"
                                                                value="{{ $services->service_todate }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherDeathDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Death/Permanent Incapacitation <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="date" class="form-control"
                                                                name="father_death_date"
                                                                value="{{ $services->father_death_date }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Details of Permanent Incapacitation <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_incapacitation_details"
                                                                value="{{ $services->father_incapacitation_details }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherPSUDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Name of the Organisation <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="name_organization"
                                                                value="{{ $services->name_organization }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Appointment of Post <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="date" class="form-control"
                                                                name="father_psu_appointment_date"
                                                                value="{{ $services->father_psu_appointment_date }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherArmedForcesDetails" style="display:none;">

                                                    <div class="row">

                                                    </div>

                                                </div>
                                                <div id="fatherProfessionalDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Occupation / Profession <span
                                                                    class="text-danger">*</span></label>

                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_profession"
                                                                value="{{ $services->father_profession }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherAgricultureDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Location <span class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_location"
                                                                value="{{ $services->father_location }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Irrigated Land <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_irrigated_land"
                                                                value="{{ $services->father_irrigated_land }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Percentage of Irrigated Land Holding (Statutory
                                                                Ceiling
                                                                Limit under State Land Ceiling Laws)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_irrigated_percentage"
                                                                value="{{ $services->father_irrigated_percentage }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Size of Holding <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_holding_size"
                                                                value="{{ $services->father_holding_size }}">
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label>
                                                                Of land and/or building this both irrigated/un-irrigated
                                                                to
                                                                total land holding on the basis of the conversion
                                                                formula in
                                                                State Land Ceiling Law
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_conversion_formula"
                                                                value="{{ $services->father_conversion_formula }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherPlantationDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Crops/Fruits <span class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_crops_fruits"
                                                                value="{{ $services->father_crops_fruits }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Area of Plantation <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_area_plantation"
                                                                value="{{ $services->father_area_plantation }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Un-irrigated Land (to be certified by District
                                                                Revenue
                                                                Officer not below the rank of Tahsildar)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_unirrigated_land"
                                                                value="{{ $services->father_unirrigated_land }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Location <span class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_location"
                                                                value="{{ $services->father_location }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Size of Holding <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_size_holding"
                                                                value="{{ $services->father_size_holding }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherVacantLandDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Location of the Property <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_location"
                                                                value="{{ $services->father_location }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Use to which it is put <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_property_use"
                                                                value="{{ $services->father_property_use }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Details of the Property <span
                                                                    class="text-danger">*</span></label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_property_details"
                                                                value="{{ $services->father_property_details }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherIncomeWealthDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Annual Family Income from all Sources (Includes salaries
                                                                and
                                                                income from agricultural land)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_annual_income"
                                                                value="{{ $services->father_annual_income }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Whether Tax Payer (If Yes, copy of last three years
                                                                return
                                                                be furnished)
                                                                <span class="text-danger">*</span>
                                                            </label><br>

                                                            <label class="me-3">
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_tax_payer" value="Yes"
                                                                    {{ $services->father_tax_payer == 'Yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>

                                                            <label>
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_tax_payer" value="No"
                                                                    {{ $services->father_tax_payer == 'No' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Whether covered in Wealth Tax Act (If so, furnish
                                                                details)
                                                                <span class="text-danger">*</span>
                                                            </label><br>

                                                            <label class="me-3">
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_wealth_tax"
                                                                    value="Yes"
                                                                    {{ $services->father_wealth_tax == 'Yes' ? 'checked' : '' }}>
                                                                Yes
                                                            </label>

                                                            <label>
                                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                    type="radio" name="father_wealth_tax"
                                                                    value="No"
                                                                    {{ $services->father_wealth_tax == 'No' ? 'checked' : '' }}>
                                                                No
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Wealth Tax Details</label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_wealth_tax_details"
                                                                value="{{ $services->father_wealth_tax_details }}">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Any Other Remarks</label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="text" class="form-control"
                                                                name="father_other_remarks"
                                                                value="{{ $services->father_other_remarks }}">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherOtherDetails" style="display:none;"></div>
                                                <hr>

                                                <h5 class="text-primary mb-3">Status of Mother</h5>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Whether Alive? <span
                                                                class="text-danger">*</span></label><br>

                                                        <label class="me-3">
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="radio" name="mother_alive" value="Yes"
                                                                {{ $services->mother_alive == 'Yes' ? 'checked' : '' }}>
                                                            Yes
                                                        </label>

                                                        <label>
                                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                type="radio" name="mother_alive" value="No"
                                                                {{ $services->mother_alive == 'No' ? 'checked' : '' }}>
                                                            No
                                                        </label>

                                                    </div>

                                                </div>

                                                <div id="motherDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Nature of Occupation <span
                                                                    class="text-danger">*</span></label>

                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                class="form-control" name="mother_occupation"
                                                                id="mother_occupation" required>

                                                                <option value="">SELECT</option>

                                                                <option value="Employed"
                                                                    {{ $services->mother_occupation == 'Employed' ? 'selected' : '' }}>
                                                                    Employed
                                                                </option>

                                                                <option value="Self Employed"
                                                                    {{ $services->mother_occupation == 'Self Employed' ? 'selected' : '' }}>
                                                                    Self Employed
                                                                </option>

                                                                <option value="Unemployed"
                                                                    {{ $services->mother_occupation == 'Unemployed' ? 'selected' : '' }}>
                                                                    Unemployed
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3" id="mother_status_div">
                                                            <label>Status <span class="text-danger">*</span></label>

                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                class="form-control" name="mother_status"
                                                                id="mother_status">

                                                                <option value="">SELECT</option>

                                                                <option value="Constitutional Posts"
                                                                    {{ $services->mother_status == 'Constitutional Posts' ? 'selected' : '' }}>
                                                                    Constitutional Posts
                                                                </option>

                                                                <option value="Government Services"
                                                                    {{ $services->mother_status == 'Government Services' ? 'selected' : '' }}>
                                                                    Government Services
                                                                </option>

                                                                <option value="International Organization"
                                                                    {{ $services->mother_status == 'International Organization' ? 'selected' : '' }}>
                                                                    International Organization
                                                                </option>

                                                                <option value="Death/Permanent Incapacitation"
                                                                    {{ $services->mother_status == 'Death/Permanent Incapacitation' ? 'selected' : '' }}>
                                                                    Death/Permanent Incapacitation
                                                                </option>

                                                                <option value="Public Sector Undertakings"
                                                                    {{ $services->mother_status == 'Public Sector Undertakings' ? 'selected' : '' }}>
                                                                    Public Sector Undertakings
                                                                </option>

                                                                <option value="Armed Forces/Para Military Forces"
                                                                    {{ $services->mother_status == 'Armed Forces/Para Military Forces' ? 'selected' : '' }}>
                                                                    Armed Forces/Para Military Forces
                                                                </option>

                                                                <option value="Professional Class"
                                                                    {{ $services->mother_status == 'Professional Class' ? 'selected' : '' }}>
                                                                    Professional Class
                                                                </option>

                                                                <option
                                                                    value="Agricultural Land Holding (Owned by Mother, Father, Minor Child)"
                                                                    {{ $services->mother_status == 'Agricultural Land Holding (Owned by Mother, Father, Minor Child)' ? 'selected' : '' }}>
                                                                    Agricultural Land Holding (Owned by Mother, Father,
                                                                    Minor Child)
                                                                </option>

                                                                <option value="Plantation (Property Owners)"
                                                                    {{ $services->mother_status == 'Plantation (Property Owners)' ? 'selected' : '' }}>
                                                                    Plantation (Property Owners)
                                                                </option>

                                                                <option
                                                                    value="Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
                                                                    {{ $services->mother_status == 'Vacant Land and/or Building in Urban Areas or Urban Agglomeration' ? 'selected' : '' }}>
                                                                    Vacant Land and/or Building in Urban Areas or Urban
                                                                    Agglomeration
                                                                </option>

                                                                <option value="Income/Wealth (Property Owners)"
                                                                    {{ $services->mother_status == 'Income/Wealth (Property Owners)' ? 'selected' : '' }}>
                                                                    Income/Wealth (Property Owners)
                                                                </option>

                                                                <option value="Others"
                                                                    {{ $services->mother_status == 'Others' ? 'selected' : '' }}>
                                                                    Others
                                                                </option>

                                                            </select>
                                                        </div>
                                                        <div class="row" id="motherIncomeProofSection"
                                                            style="display:none;">

                                                            <div class="col-md-6 mb-3">
                                                                <label>Proof of Income <span
                                                                        class="text-danger">*</span></label><br>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Payslip"
                                                                        {{ $services->mother_income_proof == 'Payslip' ? 'checked' : '' }}>
                                                                    Payslip
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Income Certificate"
                                                                        {{ $services->mother_income_proof == 'Income Certificate' ? 'checked' : '' }}>
                                                                    Income Certificate
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="ITR"
                                                                        {{ $services->mother_income_proof == 'ITR' ? 'checked' : '' }}>
                                                                    ITR
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Others"
                                                                        {{ $services->mother_income_proof == 'Others' ? 'checked' : '' }}>
                                                                    Others
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="motherIncomeFile"
                                                                style="display:none;">

                                                                <label>Upload Proof <span
                                                                        class="text-danger">*</span></label>

                                                                <input type="file" class="form-control"
                                                                    name="mother_income_proof_file">

                                                                @if (!empty($services->mother_income_proof_file))
                                                                    <br>
                                                                    <a href="{{ asset('upload/services/mother_income_proof_file/' . $services->mother_income_proof_file) }}"
                                                                        target="_blank" class="btn btn-info btn-sm mb-2">
                                                                        View
                                                                    </a>
                                                                @endif

                                                            </div>

                                                        </div>
                                                        <div id="motherCommonDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Pay of Scale <span
                                                                            class="text-danger">*</span></label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control number"
                                                                        name="mother_pay_scale"
                                                                        value="{{ $services->mother_pay_scale }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Designation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_designation"
                                                                        value="{{ $services->mother_designation }}">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherLocationDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Location
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_location"
                                                                        value="{{ $services->mother_location }}">
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div id="motherConstitutional" style="display:none;">
                                                        </div>
                                                        <div id="motherGovernmentService" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Service <span
                                                                            class="text-danger">*</span></label><br>

                                                                    <label class="me-3">
                                                                        <input
                                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                            type="radio" name="mother_service"
                                                                            value="Central"
                                                                            {{ $services->mother_service == 'Central' ? 'checked' : '' }}>
                                                                        Central
                                                                    </label>

                                                                    <label>
                                                                        <input
                                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                            type="radio" name="mother_service"
                                                                            value="State"
                                                                            {{ $services->mother_service == 'State' ? 'checked' : '' }}>
                                                                        State
                                                                    </label>
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Designation <span
                                                                            class="text-danger">*</span></label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_gov_designation"
                                                                        value="{{ $services->mother_gov_designation }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Scale of Pay, including classification, if any
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_scale_of_pay"
                                                                        value="{{ $services->mother_scale_of_pay }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Date of Appointment of Post
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="date" class="form-control"
                                                                        name="mother_date_of_appointment"
                                                                        value="{{ $services->mother_date_of_appointment }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Age at the time of promotion for Class I post
                                                                        (If applicable)
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_promotion_age"
                                                                        value="{{ $services->mother_promotion_age }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherInternationalOrg" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Name Of The Organization <span
                                                                            class="text-danger">*</span></label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_name_organization"
                                                                        value="{{ $services->mother_name_organization }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Period Of Service (From Date) <span
                                                                            class="text-danger">*</span></label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="date" class="form-control"
                                                                        name="mother_servicefromdate"
                                                                        value="{{ $services->mother_servicefromdate }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Period Of Service (To Date) <span
                                                                            class="text-danger">*</span></label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="date" class="form-control"
                                                                        name="mother_servicetodate"
                                                                        value="{{ $services->mother_servicetodate }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherDeathDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Date of Death/Permanent Incapacitation
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="date" class="form-control"
                                                                        name="mother_death_date"
                                                                        value="{{ $services->mother_death_date }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Details of Permanent Incapacitation
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_incapacitation_details"
                                                                        value="{{ $services->mother_incapacitation_details }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherPSUDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Name of the Organisation
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_psu_organisation"
                                                                        value="{{ $services->mother_psu_organisation }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Date of Appointment of Post
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="date" class="form-control"
                                                                        name="mother_psu_appointment_date"
                                                                        value="{{ $services->mother_psu_appointment_date }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherArmedForcesDetails" style="display:none;">

                                                            <div class="row">

                                                                {{-- Designation and Pay Scale moved to motherCommonDetails --}}

                                                            </div>

                                                        </div>
                                                        <div id="motherProfessionalDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Occupation / Profession
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_profession"
                                                                        value="{{ $services->mother_profession }}">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherAgricultureDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Irrigated Land
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_irrigated_land"
                                                                        value="{{ $services->mother_irrigated_land }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Percentage of Irrigated Land Holding
                                                                        (Statutory Ceiling Limit under State Land
                                                                        Ceiling
                                                                        Laws)
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_irrigated_percentage"
                                                                        value="{{ $services->mother_irrigated_percentage }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Size of Holding
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_holding_size"
                                                                        value="{{ $services->mother_holding_size }}">
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label>
                                                                        Of land and/or building this both
                                                                        irrigated/un-irrigated
                                                                        to total land holding on the basis of the
                                                                        conversion
                                                                        formula
                                                                        in State Land Ceiling Law
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_conversion_formula"
                                                                        value="{{ $services->mother_conversion_formula }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherPlantationDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Crops/Fruits
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_crops_fruits"
                                                                        value="{{ $services->mother_crops_fruits }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Area of Plantation
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_area_plantation"
                                                                        value="{{ $services->mother_area_plantation }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Un-irrigated Land
                                                                        (to be certified by District Revenue Officer not
                                                                        below the rank of Tahsildar)
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_unirrigated_land"
                                                                        value="{{ $services->mother_unirrigated_land }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Size of Holding
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_holding_size"
                                                                        value="{{ $services->mother_holding_size }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherVacantLandDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Use to which it is put
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_property_use"
                                                                        value="{{ $services->mother_property_use }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Details of the Property
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_property_details"
                                                                        value="{{ $services->mother_property_details }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherIncomeWealthDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Annual Family Income from all Sources
                                                                        (Includes salaries and income from agricultural
                                                                        land)
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_annual_income"
                                                                        value="{{ $services->mother_annual_income }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Whether Tax Payer
                                                                        (If Yes, copy of last three years return be
                                                                        furnished)
                                                                        <span class="text-danger">*</span>
                                                                    </label><br>

                                                                    <label class="me-3">
                                                                        <input type="radio" name="mother_tax_payer"
                                                                            value="Yes"
                                                                            {{ $services->mother_tax_payer == 'Yes' ? 'checked' : '' }}>
                                                                        Yes
                                                                    </label>

                                                                    <label>
                                                                        <input type="radio" name="mother_tax_payer"
                                                                            value="No"
                                                                            {{ $services->mother_tax_payer == 'No' ? 'checked' : '' }}>
                                                                        No
                                                                    </label>
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Whether covered in Wealth Tax Act
                                                                        (If so, furnish details)
                                                                        <span class="text-danger">*</span>
                                                                    </label><br>

                                                                    <label class="me-3">
                                                                        <input type="radio" name="mother_wealth_tax"
                                                                            value="Yes"
                                                                            {{ $services->mother_wealth_tax == 'Yes' ? 'checked' : '' }}>
                                                                        Yes
                                                                    </label>

                                                                    <label>
                                                                        <input type="radio" name="mother_wealth_tax"
                                                                            value="No"
                                                                            {{ $services->mother_wealth_tax == 'No' ? 'checked' : '' }}>
                                                                        No
                                                                    </label>
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Wealth Tax Details</label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_wealth_tax_details"
                                                                        value="{{ $services->mother_wealth_tax_details }}">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Any Other Remarks</label>

                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        type="text" class="form-control"
                                                                        name="mother_other_remarks"
                                                                        value="{{ $services->mother_other_remarks }}">
                                                                </div>


                                                            </div>

                                                        </div>
                                                        <div id="motherOtherDetails" style="display:none;">

                                                            <div class="row">

                                                                {{-- Designation and Pay Scale moved to motherCommonDetails --}}

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <hr>

                                            </div>
                                            <!-- Buttons -->
                                        </div>

                                        <div class="card-footer bg-white">

                                            <div class="d-flex justify-content-between">

                                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                                                    <i class="fa fa-arrow-left"></i> Previous
                                                </button>

                                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                                    Next <i class="fa fa-arrow-right"></i>
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <div id="step3" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0 text-success">
                                                    <i class="fa fa-file"></i> Documents
                                                </h5>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <div class="row">

                                                    <!-- Photo -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo</label><br>

                                                        @if (!empty($services->photo))
                                                            <a href="{{ asset('upload/services/photo/' . $services->photo) }}"
                                                                target="_blank" class="btn btn-info btn-sm mb-2">
                                                                View
                                                            </a>
                                                        @endif

                                                        <input type="file" class="form-control" name="photo">
                                                    </div>

                                                    <!-- Aadhaar -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Aadhaar + Smart Card</label><br>

                                                        @if (!empty($services->aadhaar_card))
                                                            <a href="{{ asset('upload/services/aadhaar_card/' . $services->aadhaar_card) }}"
                                                                target="_blank" class="btn btn-info btn-sm mb-2">
                                                                View
                                                            </a>
                                                        @endif

                                                        <input type="file" class="form-control" name="aadhaar_card">
                                                    </div>

                                                    <!-- Signature -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Signature</label><br>

                                                        @if (!empty($services->signature))
                                                            <a href="{{ asset('upload/services/signature/' . $services->signature) }}"
                                                                target="_blank" class="btn btn-info btn-sm mb-2">
                                                                View
                                                            </a>
                                                        @endif

                                                        <input type="file" class="form-control" name="signature">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Community Certificate</label><br>

                                                        @if (!empty($services->community))
                                                            <a href="{{ asset('upload/services/community_certificate/' . $services->community) }}"
                                                                target="_blank" class="btn btn-info btn-sm mb-2">
                                                                View
                                                            </a>
                                                        @endif

                                                        <input type="file" class="form-control" name="community">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="d-flex justify-content-between mt-5">

                                                <button type="button" class="btn btn-secondary px-3"
                                                    onclick="prevStep(3)">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Previous
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        @if (Auth::user()->id != $apply_user_id)
                                            <div class="mb-3 col-md-6">
                                                <label for="service_name" class="form-label">Service Status</label>
                                                <select class="form-control" name="status" id="service_status">
                                                    <option value="">Select</option>
                                                    <option @if ($services->status == 'Pending') selected @endif
                                                        value="Pending">
                                                        Pending</option>
                                                    <option @if ($services->status == 'Resubmit') selected @endif
                                                        value="Resubmit">
                                                        Resubmit</option>
                                                    <option @if ($services->status == 'Processing') selected @endif
                                                        value="Processing">
                                                        Processing</option>
                                                    @if ($services->status != 'Approved')
                                                        <option @if ($services->status == 'Rejected') selected @endif
                                                            value="Rejected">
                                                            Rejected</option>
                                                    @endif
                                                    <option @if ($services->status == 'Approved') selected @endif
                                                        value="Approved">
                                                        Approved</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                                <label for="remarks" class="form-label">Remarks</label>
                                                <input value="{{ $services->remarks }}" class="form-control"
                                                    type="text" name="remarks" maxlength="100" id="remarks"
                                                    placeholder="Remarks" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                                <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                                <input class="form-control" type="file" name="acknowledgement"
                                                    id="acknowledgement" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                                <label for="application_no" class="form-label">Application No</label>
                                                <input value="{{ $services->application_no }}" class="form-control"
                                                    type="text" maxlength="20" name="application_no"
                                                    id="application_no" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                                <label for="certificate" class="form-label">Certificate</label>
                                                <input class="form-control" type="file" name="certificate"
                                                    id="certificate" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="applicationapprovedhide"
                                                style="display :none;">
                                                <label for="application_no" class="form-label">Application No</label>
                                                <input value="{{ $services->application }}" class="form-control"
                                                    type="text" maxlength="20" name="application" id="application" />
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="service_name" class="form-label">Service
                                                        Status</label>
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
                                                <button type="submit" disabled
                                                    class="btn btn-primary me-2">Resubmit</button>
                                            @elseif($services->status == 'Approved')
                                                <button type="button" disabled
                                                    class="btn btn-primary me-2">Completed</button>
                                            @else
                                                <button id="save" type="submit"
                                                    class="btn btn-primary me-2">Submit</button>
                                            @endif
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection
@push('page_scripts')
    <script>
         $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";

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
    <script>
        // Caste Change Time

        $('#caste').on('change', function() {
            var serial = $(this).find(':selected').data('serial');
            $('#serial_no').val(serial);
        });

        $(document).ready(function() {
            var serial = $('#caste').find(':selected').data('serial');
            if (serial) {
                $('#serial_no').val(serial);
            }
        });
    </script>
    <script>
        // Father Radio Button Script
        $(document).ready(function() {

            function toggleFatherDetails() {
                if ($("input[name='father_alive']:checked").val() == "Yes") {
                    $("#fatherDetails").slideDown();
                } else {
                    $("#fatherDetails").slideUp();
                    $("#fatherDetails").find("select").val("");
                }
            }
            // Mother Radio Button Script
            function toggleMotherDetails() {
                if ($("input[name='mother_alive']:checked").val() == "Yes") {
                    $("#motherDetails").slideDown();
                } else {
                    $("#motherDetails").slideUp();
                    $("#motherDetails").find("select").val("");
                }
            }

            // Page load (Update page)
            toggleFatherDetails();
            toggleMotherDetails();

            // On change
            $("input[name='father_alive']").change(function() {
                toggleFatherDetails();
            });

            $("input[name='mother_alive']").change(function() {
                toggleMotherDetails();
            });

        });
    </script>
    <script>
$(document).ready(function() {

    // 1. Father Occupation Unemployed ஆக இருந்தால் Status Dropdown-ஐ Hide செய்யும் Function
    function checkFatherOccupation() {
        var occupation = $("#father_occupation").val();

        if (occupation === "Unemployed") {
            $("#father_status_div").hide();
            $("#father_status").val("").prop("required", false); // Value clear செய்து Required நீக்குகிறது
        } else {
            $("#father_status_div").show();
            $("#father_status").prop("required", true);
        }
    }

    // 2. Hidden field required remove
    function checkFatherStatus() {

        if ($("#father_status").is(":hidden") || $("#father_status").is(":disabled")) {
            $("#father_status").prop("required", false);
        } else {
            $("#father_status").prop("required", true);
        }

    }

    function toggleFatherSections() {

        // Occupation நிலையை முதலில் சரிபார்க்கிறது
        checkFatherOccupation();

        checkFatherStatus();

        var status = $("#father_status").val();

        // Hide all sections
        $(".father-section").hide();

        // Remove required
        $(".father-section")
            .find("input, select, textarea")
            .prop("required", false);

        // Common Details
        var commonStatus = [
            "Constitutional Posts",
            "Government Services",
            "International Organization",
            "Death/Permanent Incapacitation",
            "Public Sector Undertakings",
            "Armed Forces/Para Military Forces",
            "Professional Class"
        ];

        if (commonStatus.includes(status)) {

            $("#fatherCommonDetails").slideDown();

            $("#fatherCommonDetails")
                .find("input")
                .prop("required", true);
        }

        // Location Details
        var locationStatus = [
            "Agricultural Land Holding (Owned by Mother, Father, Minor Child)",
            "Plantation (Property Owners)",
            "Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
        ];

        if (locationStatus.includes(status)) {

            $("#fatherLocationDetails").slideDown();

            $("#fatherLocationDetails")
                .find("input")
                .prop("required", true);
        }

        switch (status) {

            case "Constitutional Posts":
                $("#fatherConstitutional").slideDown();
                break;

            case "Government Services":
                $("#fatherGovernmentService").slideDown();
                $("#fatherGovernmentService").find("input").prop("required", true);
                break;

            case "International Organization":
                $("#fatherInternationalOrg").slideDown();
                $("#fatherInternationalOrg").find("input").prop("required", true);
                break;

            case "Death/Permanent Incapacitation":
                $("#fatherDeathDetails").slideDown();
                $("#fatherDeathDetails").find("input").prop("required", true);
                break;

            case "Public Sector Undertakings":
                $("#fatherPSUDetails").slideDown();
                $("#fatherPSUDetails").find("input").prop("required", true);
                break;

            case "Armed Forces/Para Military Forces":
                $("#fatherArmedForcesDetails").slideDown();
                $("#fatherArmedForcesDetails").find("input").prop("required", true);
                break;

            case "Professional Class":
                $("#fatherProfessionalDetails").slideDown();
                $("#fatherProfessionalDetails").find("input").prop("required", true);
                break;

            case "Agricultural Land Holding (Owned by Mother, Father, Minor Child)":
                $("#fatherAgricultureDetails").slideDown();
                $("#fatherAgricultureDetails").find("input").prop("required", true);
                break;

            case "Plantation (Property Owners)":
                $("#fatherPlantationDetails").slideDown();
                $("#fatherPlantationDetails").find("input").prop("required", true);
                break;

            case "Vacant Land and/or Building in Urban Areas or Urban Agglomeration":
                $("#fatherVacantLandDetails").slideDown();
                $("#fatherVacantLandDetails").find("input").prop("required", true);
                break;

            case "Income/Wealth (Property Owners)":
                $("#fatherIncomeWealthDetails").slideDown();
                $("#fatherIncomeWealthDetails").find("input").prop("required", true);
                break;

            case "Others":
                $("#fatherOtherDetails").slideDown();
                break;

            case "Unemployed":
                break;
        }

    }

    // Page Load
    toggleFatherSections();

    // Father Occupation Change Event
    $("#father_occupation").on("change", function() {
        toggleFatherSections();
    });

    // Change
    $("#father_status").on("change", function() {
        toggleFatherSections();
    });

    // Submit
    $("form").on("submit", function() {
        checkFatherStatus();
    });

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
    {{-- Mother Script Start --}}
    <script>
$(document).ready(function() {

    // Mother Occupation Unemployed ஆக இருந்தால் Status Dropdown-ஐ Hide செய்யும் Function
    function checkMotherOccupation() {
        var occupation = $("#mother_occupation").val();

        if (occupation === "Unemployed") {
            $("#mother_status_div").hide();
            $("#mother_status").val("").prop("required", false);
        } else {
            $("#mother_status_div").show();
            $("#mother_status").prop("required", true);
        }
    }

    // Hidden Field Validation Check Function
    function checkMotherStatus() {
        if ($("#mother_status").is(":hidden") || $("#mother_status").is(":disabled")) {
            $("#mother_status").prop("required", false);
        } else {
            $("#mother_status").prop("required", true);
        }
    }

    function toggleMotherSections() {

        // Occupation நிலையைச் சரிபார்க்கிறது
        checkMotherOccupation();
        checkMotherStatus();

        var status = $("#mother_status").val();

        // எல்லா sections hide
        $(".mother-section").hide();

        // எல்லா required remove
        $(".mother-section")
            .find("input, select, textarea")
            .prop("required", false);

        // Common Section
        var commonStatus = [
            "Constitutional Posts",
            "Government Services",
            "International Organization",
            "Death/Permanent Incapacitation",
            "Public Sector Undertakings",
            "Armed Forces/Para Military Forces",
            "Professional Class"
        ];

        if (commonStatus.includes(status)) {

            $("#motherCommonDetails").slideDown();

            $("#motherCommonDetails")
                .find("input")
                .prop("required", true);

        } else {

            $("#motherCommonDetails").slideUp();

            $("#motherCommonDetails")
                .find("input")
                .prop("required", false)
                .val("");
        }

        // Location Section
        var locationStatus = [
            "Agricultural Land Holding (Owned by Mother, Father, Minor Child)",
            "Plantation (Property Owners)",
            "Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
        ];

        if (locationStatus.includes(status)) {

            $("#motherLocationDetails").slideDown();

            $("#motherLocationDetails")
                .find("input")
                .prop("required", true);
        }

        switch (status) {

            case "Government Services":

                $("#motherGovernmentService").slideDown();
                $("#motherGovernmentService")
                    .find("input")
                    .prop("required", true);

                break;

            case "International Organization":

                $("#motherInternationalOrg").slideDown();
                $("#motherInternationalOrg")
                    .find("input")
                    .prop("required", true);

                break;

            case "Death/Permanent Incapacitation":

                $("#motherDeathDetails").slideDown();
                $("#motherDeathDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Public Sector Undertakings":

                $("#motherPSUDetails").slideDown();
                $("#motherPSUDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Armed Forces/Para Military Forces":

                $("#motherArmedForcesDetails").slideDown();
                $("#motherArmedForcesDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Professional Class":

                $("#motherProfessionalDetails").slideDown();
                $("#motherProfessionalDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Agricultural Land Holding (Owned by Mother, Father, Minor Child)":

                $("#motherAgricultureDetails").slideDown();
                $("#motherAgricultureDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Plantation (Property Owners)":

                $("#motherPlantationDetails").slideDown();
                $("#motherPlantationDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Vacant Land and/or Building in Urban Areas or Urban Agglomeration":

                $("#motherVacantLandDetails").slideDown();
                $("#motherVacantLandDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Income/Wealth (Property Owners)":

                $("#motherIncomeWealthDetails").slideDown();
                $("#motherIncomeWealthDetails")
                    .find("input")
                    .prop("required", true);

                break;

            case "Others":

                $("#motherOtherDetails").slideDown();

                // No Pay Scale / Designation
                $("#motherCommonDetails").hide();

                break;

            case "Unemployed":

                // Nothing to show

                $("#motherCommonDetails").hide();
                $("#motherLocationDetails").hide();

                break;
        }

    }

    // Initial Load
    toggleMotherSections();

    // Mother Occupation Event Listener
    $("#mother_occupation").on("change", function() {
        toggleMotherSections();
    });

    // Mother Status Change Listener
    $("#mother_status").change(function() {
        toggleMotherSections();
    });

    // Form Submit Event
    $("form").on("submit", function() {
        checkMotherStatus();
    });

});
    </script>
    {{-- Father radio button code --}}
    <script>
        $(document).ready(function() {

            function toggleFatherIncomeProof() {

                let occupation = $("#father_occupation").val();

                if (occupation == "Employed" || occupation == "Self Employed") {

                    $("#fatherIncomeProofSection").show();

                } else {

                    $("#fatherIncomeProofSection").hide();
                    $("#fatherIncomeFile").hide();
                }
            }

            $("#father_occupation").on("change", function() {

                toggleFatherIncomeProof();

                if ($(this).val() != "Employed" && $(this).val() != "Self Employed") {

                    $("input[name='father_income_proof']").prop("checked", false);
                    $("input[name='father_income_proof_file']").val("");

                }

            });

            $("input[name='father_income_proof']").on("change", function() {
                $("#fatherIncomeFile").show();
            });

            // Page Load
            toggleFatherIncomeProof();

            if ($("input[name='father_income_proof']:checked").length > 0) {
                $("#fatherIncomeFile").show();
            }

        });
    </script>
    {{-- Mother radio button code --}}
    <script>
        $(document).ready(function() {

            function toggleMotherIncomeProof() {

                let occupation = $("#mother_occupation").val();

                if (occupation == "Employed" || occupation == "Self Employed") {

                    $("#motherIncomeProofSection").show();

                } else {

                    $("#motherIncomeProofSection").hide();
                    $("#motherIncomeFile").hide();
                }
            }

            $("#mother_occupation").on("change", function() {

                toggleMotherIncomeProof();

                if ($(this).val() != "Employed" && $(this).val() != "Self Employed") {

                    $("input[name='mother_income_proof']").prop("checked", false);
                    $("input[name='mother_income_proof_file']").val("");

                }

            });

            $("input[name='mother_income_proof']").on("change", function() {
                $("#motherIncomeFile").show();
            });

            // Page Load
            toggleMotherIncomeProof();

            if ($("input[name='mother_income_proof']:checked").length > 0) {
                $("#motherIncomeFile").show();
            }

        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
