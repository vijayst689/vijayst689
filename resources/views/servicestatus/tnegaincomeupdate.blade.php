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
                            <form class="row g-4" action="{{ url('submittnegaincomeupdate') }}"
                                enctype="multipart/form-data" method="post" id="myForm">
                                @csrf
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

                                        <h4 class="text-center card-header bg-pink text-white mb-4">
                                            Can Details
                                        </h4>

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
                                                <input maxlength="10" required type="text" class="form-control number"
                                                    name="mobile" value="{{ $tncustomers->mobile }}">

                                                <label class="form-label mt-3">Address Tamil</label>
                                                <textarea maxlength="500" required class="form-control" rows="4" name="address_tamil">{{ $tncustomers->address_tamil }}</textarea>

                                            </div>

                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-danger" onclick="nextStep(1)">
                                                Next →
                                            </button>
                                        </div>
                                    </div>


                                    <!-- ================= STEP 2 ================= -->
                                    <div id="step2" style="display:none;">

                                        <div class="card shadow border-0 mt-4">

                                            <div class="card-header bg-pink text-white">
                                                <h5 class="mb-0 text-center">Self Details</h5>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <!-- Left Side -->
                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label mt-2">Name In Tamil</label>
                                                        <input type="text"
                                                            @if (Auth::user()->id != $apply_user_id) required @endif
                                                            class="form-control" name="name_tamil" maxlength="100"
                                                            value="{{ $services->name_tamil }}" required>

                                                        <label class="form-label mt-2">Age</label>
                                                        <input type="text"
                                                            @if (Auth::user()->id != $apply_user_id) required @endif
                                                            class="form-control number" name="age" maxlength="2"
                                                            value="{{ $services->age }}" required>

                                                        <label class="form-label mt-2">Profession</label>


                                                        <select name="profession" id="self_profession"
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif class="form-control"
                                                            required>

                                                            <option value="">SELECT</option>

                                                            <option @if ($services->profession == 'Government') selected @endif
                                                                value="Government">
                                                                Government
                                                            </option>

                                                            <option @if ($services->profession == 'Household/Dependent') selected @endif
                                                                value="Household/Dependent">
                                                                Household/Dependent
                                                            </option>

                                                            <option @if ($services->profession == 'Private') selected @endif
                                                                value="Private">
                                                                Private
                                                            </option>

                                                            <option @if ($services->profession == 'Professional') selected @endif
                                                                value="Professional">
                                                                Professional
                                                            </option>

                                                            <option @if ($services->profession == 'Public') selected @endif
                                                                value="Public">
                                                                Public
                                                            </option>

                                                            <option @if ($services->profession == 'Student/Dependent') selected @endif
                                                                value="Student/Dependent">
                                                                Student/Dependent
                                                            </option>

                                                        </select>

                                                    </div>

                                                    <!-- Right Side -->
                                                    <div class="col-md-6 mb-3">

                                                        <label class="form-label mt-2">Name In English</label>

                                                        <input type="text"
                                                            @if (Auth::user()->id != $apply_user_id) required @endif
                                                            class="form-control" name="name_english" maxlength="100"
                                                            value="{{ $services->name_english }}" required>

                                                        <label class="form-label mt-2">Sex</label>

                                                        <select name="sex" @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                            class="form-control" required>

                                                            <option value="">SELECT</option>

                                                            <option @if ($services->sex == 'Female') selected @endif
                                                                value="Female">
                                                                Female
                                                            </option>

                                                            <option @if ($services->sex == 'Male') selected @endif
                                                                value="Male">
                                                                Male
                                                            </option>

                                                            <option @if ($services->sex == 'Not Stated') selected @endif
                                                                value="Not Stated">
                                                                Not Stated
                                                            </option>

                                                            <option @if ($services->sex == 'Transgender') selected @endif
                                                                value="Transgender">
                                                                Transgender
                                                            </option>

                                                        </select>

                                                        <div id="self_income_section">

                                                            <label class="form-label mt-2">
                                                                Source of Income
                                                            </label>

                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                                name="income_source" id="income_source"
                                                                class="form-control">

                                                                <option value="">SELECT</option>

                                                                <option @if ($services->income_source == 'Agriculture and Allied') selected @endif
                                                                    value="Agriculture and Allied">
                                                                    Agriculture and Allied
                                                                </option>

                                                                <option @if ($services->income_source == 'Salary') selected @endif
                                                                    value="Salary">
                                                                    Salary
                                                                </option>

                                                                <option @if ($services->income_source == 'Business') selected @endif
                                                                    value="Business">
                                                                    Business
                                                                </option>

                                                                <option @if ($services->income_source == 'Rent') selected @endif
                                                                    value="Rent">
                                                                    Rent
                                                                </option>

                                                                <option @if ($services->income_source == 'Others') selected @endif
                                                                    value="Others">
                                                                    Others
                                                                </option>

                                                            </select>

                                                            <div id="incomeExtraFields"></div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(2)">
                                                        ← Previous
                                                    </button>

                                                    <button type="button" class="btn btn-danger" onclick="nextStep(2)">
                                                        Next →
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ================= STEP 3 ================= -->
                                    <div id="step3" style="display:none;">

                                        <div class="card shadow border-0 mt-4">

                                            <div class="card-header bg-pink text-white">
                                                <h5 class="mb-0 text-center">Family Details</h5>
                                            </div>

                                            <div class="card-body">

                                                <div class="row justify-content-center">

                                                    <div class="col-md-4 mb-3">
                                                        <label>Total Number Of Family Members</label>
                                                        <input maxlength="2"
                                                            @if (Auth::user()->id != $apply_user_id) required @endif
                                                            type="text" class="form-control number" id="family_count"
                                                            name="family_count" value="{{ $services->family_count }}">
                                                    </div>

                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label>Relationship</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                            class="form-control" id="relationship" name="relation">
                                                            <option value="">SELECT</option>
                                                            <option @if ($services->relationship == 'Father') selected @endif
                                                                value="Father">Father</option>
                                                            <option @if ($services->relationship == 'Mother') selected @endif
                                                                value="Mother">Mother</option>
                                                            <option @if ($services->relationship == 'Husband') selected @endif
                                                                value="Husband">Husband</option>
                                                            <option @if ($services->relationship == 'Wife') selected @endif
                                                                value="Wife">Wife</option>
                                                            <option @if ($services->relationship == 'Son') selected @endif
                                                                value="Son">Son</option>
                                                            <option @if ($services->relationship == 'Daughter') selected @endif
                                                                value="Daughter">Daughter</option>
                                                            <option @if ($services->relationship == 'Elder Brother') selected @endif
                                                                value="Elder Brother">Elder Brother</option>
                                                            <option @if ($services->relationship == 'Younger Brother') selected @endif
                                                                value="Younger Brother">Younger Brother</option>
                                                            <option @if ($services->relationship == 'Elder Sister') selected @endif
                                                                value="Elder Sister">Elder Sister</option>
                                                            <option @if ($services->relationship == 'Younger Sister') selected @endif
                                                                value="Younger Sister">Younger Sister</option>
                                                            <option @if ($services->relationship == 'Guardian') selected @endif
                                                                value="Guardian">Guardian</option>
                                                            <option @if ($services->relationship == 'Parent') selected @endif
                                                                value="Parent">Parent</option>
                                                            <option @if ($services->relationship == 'Father/Husband') selected @endif
                                                                value="Father/Husband">Father/Husband</option>
                                                            <option @if ($services->relationship == 'Single Mother') selected @endif
                                                                value="Single Mother">Single Mother</option>
                                                            <option @if ($services->relationship == 'Others') selected @endif
                                                                value="Others">Others</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Name Tamil</label>
                                                        <input @if (Auth::user()->id != $apply_user_id)  @endif type="text"
                                                            class="form-control" id="member_name_tamil"
                                                            name="relation_name_tamil" maxlength="100"
                                                            value="{{ $services->relation_name_tamil }}">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Name English</label>
                                                        <input @if (Auth::user()->id != $apply_user_id)  @endif type="text"
                                                            class="form-control" id="member_name_english"
                                                            name="relation_name_english" maxlength="100"
                                                            value="{{ $services->relation_name_english }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label>Age</label>
                                                        <input @if (Auth::user()->id != $apply_user_id)  @endif type="text"
                                                            class="form-control number" id="member_age"
                                                            name="relation_age" maxlength="2"
                                                            value="{{ $services->relation_age }}">
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Sex</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                            class="form-control" id="member_sex" name="relation_status">
                                                            <option value="">SELECT</option>
                                                            <option @if ($services->relation_status == 'Male') selected @endif
                                                                value="Male">Male</option>
                                                            <option @if ($services->relation_status == 'Female') selected @endif
                                                                value="Female">Female</option>
                                                            <option @if ($services->relation_status == 'Transgender') selected @endif
                                                                value="Transgender">Transgender</option>
                                                            <option @if ($services->relation_status == 'Not Stated') selected @endif
                                                                value="Not Stated">Not Stated</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Profession</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                            class="form-control" name="family_profession[]"
                                                            id="family_profession" maxlength="50">
                                                            <option value="">SELECT</option>
                                                            <option @if ($services->relation_status == 'Government') selected @endif
                                                                value="Government">Government</option>
                                                            <option @if ($services->relation_status == 'Private') selected @endif
                                                                value="Private">Private</option>
                                                            <option @if ($services->relation_status == 'Professional') selected @endif
                                                                value="Professional">Professional</option>
                                                            <option @if ($services->relation_status == 'Public') selected @endif
                                                                value="Public">Public</option>
                                                            <option @if ($services->relation_status == 'Student/Dependent') selected @endif
                                                                value="Student/Dependent">Student/Dependent</option>
                                                            <option @if ($services->relation_status == 'Household/Dependent') selected @endif
                                                                value="Household/Dependent">Household/Dependent
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Source Of Income</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif
                                                            class="form-control" id="family_income_source"
                                                            name="family_income_source[]">
                                                            <option value="">SELECT</option>
                                                            <option @if ($services->family_income_source == 'Agriculture and Allied') selected @endif
                                                                value="Agriculture and Allied">Agriculture and
                                                                Allied
                                                            </option>
                                                            <option @if ($services->family_income_source == 'Salary') selected @endif
                                                                value="Salary">Salary</option>
                                                            <option @if ($services->family_income_source == 'Business') selected @endif
                                                                value="Business">Business</option>
                                                            <option @if ($services->family_income_source == 'Rent') selected @endif
                                                                value="Rent">Rent</option>
                                                            <option @if ($services->family_income_source == 'Others') selected @endif
                                                                value="Others">Others</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <!-- Dynamic Income Fields -->
                                                <div id="familyIncomeFields"></div>

                                                <div class="text-center mt-3">
                                                    <button type="button" class="btn btn-success" id="addRelationBtn">
                                                        Add Member
                                                    </button>

                                                </div>

                                                <hr>
                                                <h5 class="mb-0 text-center text-danger">திருத்தம் செய்ய வேண்டிய பட்டியலில்
                                                    உள்ள தரவை முதலில் நீக்கி, பின்னர் தேவையான சரியான விவரங்களை மீண்டும்
                                                    பதிவு செய்யவும்</h5>
                                                </br>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="familytable"
                                                        data-total-rows="{{ count($relation) }}">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>Relationship</th>
                                                                <th>Name Tamil</th>
                                                                <th>Name English</th>
                                                                <th>Age</th>
                                                                <th>Sex</th>
                                                                <th>Profession</th>
                                                                <th>Income Source</th>
                                                                <th>Income</th>
                                                                <th>PAN</th>
                                                                <th>Extra Document</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($relation as $key => $member)
                                                                <tr>
                                                                    <td>
                                                                        <input type="hidden"
                                                                            name="old_salary_slip[{{ $key }}]"
                                                                            value="{{ $member->salary_slip }}">
                                                                        <input type="hidden"
                                                                            name="old_land_hold[{{ $key }}]"
                                                                            value="{{ $member->land_hold }}">

                                                                        {{ $member->relationship }}
                                                                        <input type="hidden"
                                                                            name="relation[{{ $key }}]"
                                                                            value="{{ $member->relationship }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->name_tamil }}
                                                                        <input type="hidden"
                                                                            name="relation_name_tamil[{{ $key }}]"
                                                                            value="{{ $member->name_tamil }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->name_english }}
                                                                        <input type="hidden"
                                                                            name="relation_name_english[{{ $key }}]"
                                                                            value="{{ $member->name_english }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->age }}
                                                                        <input type="hidden"
                                                                            name="relation_age[{{ $key }}]"
                                                                            value="{{ $member->age }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->sex }}
                                                                        <input type="hidden"
                                                                            name="relation_status[{{ $key }}]"
                                                                            value="{{ $member->sex }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->profession }}
                                                                        <input type="hidden"
                                                                            name="family_profession[{{ $key }}]"
                                                                            value="{{ $member->profession }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->income_source }}
                                                                        <input type="hidden"
                                                                            name="family_income_source[{{ $key }}]"
                                                                            value="{{ $member->income_source }}">
                                                                    </td>
                                                                    <td>
                                                                        {{ $member->income }}
                                                                        <input type="hidden"
                                                                            name="family_income[{{ $key }}]"
                                                                            value="{{ $member->income }}">
                                                                    </td>
                                                                    <td>
                                                                        @if ($member->family_pan)
                                                                            <a href="{{ asset('upload/services/family_pan/' . $member->family_pan) }}"
                                                                                target="_blank">View</a>
                                                                            <input type="hidden"
                                                                                name="old_family_pan[{{ $key }}]"
                                                                                value="{{ $member->family_pan }}">
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>

                                                                    <td class="extra-file-cell">
                                                                        @if ($member->income_source == 'Others')
                                                                            <!-- Handle Plain Text Work Details -->
                                                                            <div
                                                                                class="d-flex flex-column gap-1 align-items-start">
                                                                                <span
                                                                                    class="badge bg-light text-dark border d-inline-flex align-items-center px-2 py-1"
                                                                                    style="font-size: 0.8rem; font-weight: 500;">
                                                                                    <i class="fas fa-language text-muted me-1"
                                                                                        style="font-size: 0.85rem;"></i>
                                                                                    <small
                                                                                        class="text-muted fw-bold me-1">EN:</small>
                                                                                    {{ $member->family_work_english }}
                                                                                </span>
                                                                                <span
                                                                                    class="badge bg-light text-dark border d-inline-flex align-items-center px-2 py-1"
                                                                                    style="font-size: 0.8rem; font-weight: 500;">
                                                                                    <i class="fas fa-font text-muted me-1"
                                                                                        style="font-size: 0.75rem;"></i>
                                                                                    <small
                                                                                        class="text-muted fw-bold me-1">த:</small>
                                                                                    {{ $member->family_work_tamil }}
                                                                                </span>

                                                                                <input type="hidden"
                                                                                    name="family_work_english[{{ $key }}]"
                                                                                    value="{{ $member->family_work_english }}">
                                                                                <input type="hidden"
                                                                                    name="family_work_tamil[{{ $key }}]"
                                                                                    value="{{ $member->family_work_tamil }}">
                                                                            </div>
                                                                        @elseif($member->income_source == 'Business' || $member->income_source == 'Rent')
                                                                            <!-- Handle Plain Text Data Inputs (TIN/Trade License or House Details) -->
                                                                            <strong>{{ $member->family_extra }}</strong>
                                                                            <input type="hidden"
                                                                                name="family_extra[{{ $key }}]"
                                                                                value="{{ $member->family_extra }}">
                                                                        @elseif($member->income_source == 'Salary' && $member->family_extra)
                                                                            <!-- Handle File Links pointing to the unique Salary directory -->
                                                                            <a href="{{ asset('upload/services/family_salary_slip/' . $member->family_extra) }}"
                                                                                target="_blank"
                                                                                class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-file-pdf"></i> View Salary
                                                                                Slip
                                                                            </a>
                                                                            <input type="hidden"
                                                                                name="old_family_extra[{{ $key }}]"
                                                                                value="{{ $member->family_extra }}">
                                                                        @elseif($member->income_source == 'Agriculture and Allied' && $member->family_extra)
                                                                            <!-- Handle File Links pointing to the common extra document directory -->
                                                                            <a href="{{ asset('upload/services/family_extra/' . $member->family_extra) }}"
                                                                                target="_blank"
                                                                                class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-image"></i> View Land Hold
                                                                                Details
                                                                            </a>
                                                                            <input type="hidden"
                                                                                name="old_family_extra[{{ $key }}]"
                                                                                value="{{ $member->family_extra }}">
                                                                        @else
                                                                            <span class="text-muted">-</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden"
                                                                            name="family_id[{{ $key }}]"
                                                                            value="{{ $member->id }}">
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm removeMember">Delete</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between mt-4">

                                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                                                ← Previous
                                            </button>

                                            <button type="button" class="btn btn-danger" onclick="nextStep(3)">
                                                Next →
                                            </button>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <!-- STEP 4 -->
                                        <div id="step4" style="display:none;">

                                            <div class="card shadow border-0 mt-4">

                                                <div class="card-header bg-pink text-white">
                                                    <h5 class="mb-0 text-center">Documents</h5>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>1. Photo *</label>

                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->photo != '')
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <input @if ($services->photo == '')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="photo">
                                                                @if ($services->photo != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                                @endif
                                                            @endif

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>2. Smart Card *</label>
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->smart_card != '')
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <input @if ($services->smart_card == '')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="smart_card">
                                                                @if ($services->smart_card != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>3. Signature *</label>
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->signature != '')
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <input @if ($services->signature == '')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="signature">
                                                                @if ($services->signature != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>4. Aadhaar Card *</label>
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->aadhaar_card != '')
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <input @if ($services->aadhaar_card == '')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="aadhaar_card">
                                                                @if ($services->aadhaar_card != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(4)">
                                                        ← Previous
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="row">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    <div class="mb-3 col-md-6">
                                                        <label for="service_name" class="form-label">Service
                                                            Status</label>
                                                        <select class="form-control" name="status" id="service_status">
                                                            <option value="">Select</option>
                                                            <option @if ($services->status == 'Pending') selected @endif
                                                                value="Pending">
                                                                Pending</option>
                                                            <option @if ($services->status == 'Resubmit') selected @endif
                                                                value="Resubmit">
                                                                Resubmit</option>
                                                            <option @if ($services->status == 'Processing') selected @endif
                                                                value="Processing">Processing</option>
                                                            @if ($services->status != 'Approved')
                                                                <option @if ($services->status == 'Rejected') selected @endif
                                                                    value="Rejected">Rejected</option>
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
                                                    <div class="mb-3 col-md-6" id="acknowledgementhide"
                                                        style="display :none;">
                                                        <label for="acknowledgement"
                                                            class="form-label">Acknowledgement</label>
                                                        <input class="form-control" type="file" name="acknowledgement"
                                                            id="acknowledgement" />
                                                    </div>
                                                    <div class="mb-3 col-md-6" id="applicationnohide"
                                                        style="display :none;">
                                                        <label for="application_no" class="form-label">Application
                                                            No</label>
                                                        <input value="{{ $services->application_no }}"
                                                            class="form-control" type="text" maxlength="20"
                                                            name="application_no" id="application_no" />
                                                    </div>
                                                    <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                                        <label for="certificate" class="form-label">Certificate</label>
                                                        <input class="form-control" type="file" name="certificate"
                                                            id="certificate" />
                                                    </div>
                                                    <div class="mb-3 col-md-6" id="applicationapprovedhide"
                                                        style="display :none;">
                                                        <label for="application_no" class="form-label">Application
                                                            No</label>
                                                        <input value="{{ $services->application }}" class="form-control"
                                                            type="text" maxlength="20" name="application"
                                                            id="application" />
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="service_name" class="form-label">Service
                                                                Status</label>
                                                            <input disabled value="{{ $services->status }}"
                                                                class="form-control" type="text" />
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
                                            </div>

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

                    function nextStep(step) {

                        if (step == 1) {
                            document.getElementById('step1').style.display = 'none';
                            document.getElementById('step2').style.display = 'block';
                        } else if (step == 2) {
                            document.getElementById('step2').style.display = 'none';
                            document.getElementById('step3').style.display = 'block';

                        } else if (step == 3) {
                            document.getElementById('step3').style.display = 'none';
                            document.getElementById('step4').style.display = 'block';
                        }
                    }


                    function prevStep(step) {

                        if (step == 2) {
                            document.getElementById('step2').style.display = 'none';
                            document.getElementById('step1').style.display = 'block';
                        } else if (step == 3) {
                            document.getElementById('step3').style.display = 'none';
                            document.getElementById('step2').style.display = 'block';
                        } else if (step == 4) {
                            document.getElementById('step4').style.display = 'none';
                            document.getElementById('step3').style.display = 'block';
                        }
                    }

                    // ================= UPDATE - STEP 2 SELF DETAILS =================

                    // Income Source Change
                    $(document).on('change', '#income_source', function() {

                        let value = $(this).val();
                        let html = '';

                        if (value != '') {

                            html += `
        <div class="row mt-2">

    <div class="col-md-4">
        <label>Income</label>
        <input type="text"
               class="form-control"
               name="income"
               value="{{ $services->income ?? '' }}">
    </div>

    <div class="col-md-4">
        <label>PAN Card</label>
        <input type="file"
               class="form-control"
               name="pancard">

        @if (!empty($services->pancard))
            <small class="text-success">
                Existing File :
                <a href="{{ asset('upload/services/pancard/' . $services->pancard) }}" target="_blank">
                    View PAN Card
                </a>
            </small>
        @endif
    </div>
`;

                            if (value == 'Agriculture and Allied') {

                                html += `
            <div class="col-md-4">
                <label>Land Holding Details</label>

                <input type="file"
                       class="form-control"
                       name="land_hold">

                @if (!empty($services->land_hold))
<a href="{{ asset('upload/services/land_hold/' . $services->land_hold) }}" target="_blank">
    View File
</a>
@endif

            </div>`;
                            }

                            if (value == 'Salary') {

                                html += `
            <div class="col-md-4">

                <label>Salary Certificate(Latest Copy)</label>

                <input type="file"
                       class="form-control"
                       name="salary_slip">

               @if (!empty($services->salary_slip))
<a href="{{ asset('upload/services/salary_slip/' . $services->salary_slip) }}" target="_blank">
    View Salary Slip
</a>
@endif

            </div>`;
                            }

                            if (value == 'Business') {

                                html += `
            <div class="col-md-4">

                <label>TIN Number / Trade</label>

                <input type="text"
                       class="form-control"
                       name="tin_number"
                       value="{{ $services->tin_number ?? '' }}">

            </div>`;
                            }

                            if (value == 'Rent') {

                                html += `
            <div class="col-md-4">

                <label>Details of houses owned ward wise</label>

                <input type="text"
                       class="form-control"
                       name="owned_house"
                       value="{{ $services->owned_house ?? '' }}">

            </div>`;
                            }
                            if (value == 'Others') {

                                html += `
            <div class="col-md-4">

                <label>Work In English<span class="text-danger">*</label>
                <input type="text"
                       class="form-control"
                       name="work_english"
                       value="{{ $services->work_english ?? '' }}">

            </div>
            <div class="col-md-4">

                <label>தொழில் பெயர்<span class="text-danger">*</label>
                <input type="text"
                       class="form-control"
                       name="work_tamil"
                       value="{{ $services->work_tamil ?? '' }}">

            </div>`;
                            }

                            html += `</div>`;
                        }

                        $('#incomeExtraFields').html(html);

                    });


                    // Profession Change
                    $(document).on("change", "#self_profession", function() {

                        let profession = $(this).val();

                        if (profession == "Student/Dependent" ||
                            profession == "Household/Dependent") {

                            $("#self_income_section").hide();

                            $("#income_source").val("");

                            $("#incomeExtraFields").html("");

                        } else {

                            $("#self_income_section").show();

                            $("#income_source").trigger("change");

                        }

                    });


                    // Page Load
                    $(document).ready(function() {

                        $("#self_profession").trigger("change");

                        $("#income_source").trigger("change");

                    });
                    var selectedRelations = [];

                    // -------------------------------------------------------------------------
                    // 1. Initial Data Setup (Executes immediately when the page finishes loading)
                    // -------------------------------------------------------------------------
                    $(document).ready(function() {
                        // Read and map existing rows that were generated by Laravel from the DB
                        $("#familytable tbody tr").each(function() {
                            let relation = $(this).find("input[name^='relation[']").val();
                            if (relation && relation !== "") {
                                selectedRelations.push(relation);
                            }
                        });

                        refreshRelationship();
                        checkFamilyCount();

                        // -------------------------------------------------------------------------
                        // 2. Element Input Sanitizers & Event Triggers
                        // -------------------------------------------------------------------------
                        $(document).on("input", "#family_count, #member_age", function() {
                            this.value = this.value.replace(/[^0-9]/g, '');
                            if ($(this).attr('id') == 'family_count') {
                                checkFamilyCount();
                            }
                        });

                        $(document).on("input", "#member_name_tamil, #member_name_english", function() {
                            this.value = this.value.replace(/[0-9]/g, '');
                        });

                        // Handle structural UI updates when shifting between dependent types
                        $(document).on("change", "#family_profession", function() {
                            let profession = $(this).val();
                            if (profession == "Student/Dependent" || profession == "Household/Dependent") {
                                $("#family_income_source").val("");
                                $("#family_income_source").closest(".col-md-3").hide();
                                $("#familyIncomeFields").html("");
                            } else {
                                $("#family_income_source").closest(".col-md-3").show();
                            }
                        });
                    });

                    // -------------------------------------------------------------------------
                    // 3. Dynamic Sub-Form Creation (Income Source Dependent Fields)
                    // -------------------------------------------------------------------------
                    $(document).on("change", "#family_income_source", function() {
                        let value = $(this).val();
                        let html = "";
                        $("#familyIncomeFields").html("");

                        if (value == "") return;

                        html += `<div class="row mt-3">
    <div class="col-md-4 mb-3">
        <label>Income <span class="text-danger">*</span></label>
        <input type="text" class="form-control number" id="family_income" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
    </div>
    <div class="col-md-4 mb-3">
        <label>PAN Card <span class="text-danger">*</span></label>
        <input type="file" class="form-control file-validate" id="family_pan" name="family_pan" accept=".pdf,.jpg,.jpeg,.png">
    </div>`;

                        if (value == "Agriculture and Allied") {
                            html += `<div class="col-md-4 mb-3">
        <label>Land Holding Details <span class="text-danger">*</span></label>
        <input type="file" class="form-control file-validate" id="family_extra" name="family_extra" accept=".pdf,.jpg,.jpeg,.png">
     </div>`;
                        } else if (value == "Salary") {
                            html += `<div class="col-md-4 mb-3">
        <label>Salary Certificate (Latest Copy) <span class="text-danger">*</span></label>
        <input type="file" class="form-control file-validate" id="family_extra" name="family_extra" accept=".pdf,.jpg,.jpeg,.png">
     </div>`;
                        } else if (value == "Business") {
                            html += `<div class="col-md-4 mb-3">
        <label>TIN Number/Trade License <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="family_extra" name="family_extra">
     </div>`;
                        } else if (value == "Rent") {
                            html += `<div class="col-md-4 mb-3">
        <label>House Details <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="family_extra" name="family_extra">
     </div>`;
                        } else if (value == "Others") {
                            html += `<div class="col-md-4 mb-3">
        <label>Work In English <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="work_english" name="family_work_english">
     </div>
     <div class="col-md-4 mb-3">
        <label>தொழில் பெயர் (Tamil) <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="work_tamil" name="family_work_tamil">
     </div>`;
                        }

                        html += `</div>`;
                        $("#familyIncomeFields").html(html);
                    });

                    // File extensions and 2MB max-size checker rule
                    $(document).on("change", ".file-validate", function() {
                        let file = this.files[0];
                        if (!file) return;
                        let ext = file.name.split('.').pop().toLowerCase();
                        if ($.inArray(ext, ["pdf", "jpg", "jpeg", "png"]) == -1) {
                            alert("Only PDF, JPG, JPEG and PNG files are allowed.");
                            $(this).val("");
                            return false;
                        }
                        if (file.size > 2 * 1024 * 1024) {
                            alert("Maximum allowed file size is 2MB.");
                            $(this).val("");
                            return false;
                        }
                    });

                    // -------------------------------------------------------------------------
                    // 4. Verification Framework Utilities
                    // -------------------------------------------------------------------------
                    function refreshRelationship() {
                        $("#relationship option").show();
                        $.each(selectedRelations, function(index, value) {
                            $("#relationship option[value='" + value + "']").show();
                        });
                        $("#relationship").val("");
                    }

                    // FIXED: Consolidated function managing both action states & flow control
                    function checkFamilyCount() {
                        let totalFamily = parseInt($("#family_count").val()) || 0;
                        let addedMembers = $("#familytable tbody tr").length;

                        // IF COUNT IS CLEARED OR ZERO: Lock both buttons
                        if (totalFamily <= 0) {
                            $("#addRelationBtn").prop("disabled", true);
                            $("#familyNextBtn").prop("disabled", true);
                            return; // Exit early
                        }

                        // 1. Control the Add Action Button
                        if (addedMembers >= totalFamily) {
                            $("#addRelationBtn").prop("disabled", true);
                        } else {
                            $("#addRelationBtn").prop("disabled", false);
                        }

                        // 2. Control the Workflow Navigation Step Button
                        if (addedMembers === totalFamily) {
                            $("#familyNextBtn").prop("disabled", false);
                        } else {
                            $("#familyNextBtn").prop("disabled", true);
                        }
                    }

                    // -------------------------------------------------------------------------
                    // 5. Action Handlers: Add Family Member Row
                    // -------------------------------------------------------------------------
                    $(document).off("click", "#addRelationBtn").on("click", "#addRelationBtn", function(e) {
                        e.preventDefault();

                        let total = parseInt($("#family_count").val()) || 0;
                        let added = $("#familytable tbody tr").length;

                        if ($("#family_count").val().trim() == "" || total <= 0) {
                            alert("Please Enter a Valid Total Number of Family Members");
                            $("#family_count").focus();
                            return false;
                        }
                        if (added >= total) {
                            alert("Already Added All Family Members");
                            return false;
                        }
                        if ($("#relationship").val() == "") {
                            alert("Please Select Relationship");
                            return false;
                        }
                        if ($("#member_name_tamil").val().trim() == "") {
                            alert("Please Enter Name Tamil");
                            return false;
                        }
                        if ($("#member_name_english").val().trim() == "") {
                            alert("Please Enter Name English");
                            return false;
                        }
                        if ($("#member_age").val().trim() == "" || parseInt($("#member_age").val()) > 120) {
                            alert("Invalid Age");
                            return false;
                        }
                        if ($("#member_sex").val() == "") {
                            alert("Please Select Sex");
                            return false;
                        }
                        if ($("#family_profession").val() == "") {
                            alert("Please Select Profession");
                            return false;
                        }

                        let incomeSource = $("#family_income_source").val() || "";
                        let profession = $("#family_profession").val();

                        // Data validations handling active wage earners
                        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
                            if (incomeSource == "") {
                                alert("Please Select Source of Income");
                                return false;
                            }
                            if ($("#family_income").val().trim() == "") {
                                alert("Please Enter Income");
                                return false;
                            }
                            if ($("#family_pan")[0].files.length == 0) {
                                alert("Please Upload PAN Card");
                                return false;
                            }
                            if (incomeSource != "Others") {
                                let extraElem = $("#family_extra")[0];
                                if (extraElem.type == "file" && extraElem.files.length == 0) {
                                    alert("Please Upload the Required Extra Document");
                                    return false;
                                }
                                if (extraElem.type == "text" && $(extraElem).val().trim() == "") {
                                    alert("Please Fill the Required Document Details");
                                    return false;
                                }
                            } else {
                                if ($("#work_english").val().trim() == "" || $("#work_tamil").val().trim() == "") {
                                    alert("Please Fill both Tamil and English Work Details");
                                    return false;
                                }
                            }
                        }

                        let relation = $("#relationship").val();
                        if (selectedRelations.includes(relation)) {
                            alert("This Relationship Already Added");
                            return false;
                        }

                        let tamil = $("#member_name_tamil").val().trim();
                        let english = $("#member_name_english").val().trim();
                        let age = $("#member_age").val().trim();
                        let sex = $("#member_sex").val();
                        let income = $("#family_income").val() || "0";

                        // Unique indexing strategy using high-resolution Unix timestamps
                        let index = Date.now();

                        selectedRelations.push(relation);

                        let panName = "-";
                        let extraName = "-";

                        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
                            if ($("#family_pan").length && $("#family_pan")[0].files.length > 0) {
                                panName = $("#family_pan")[0].files[0].name;
                            }
                            if (incomeSource == "Others") {
                                let workEngVal = $("#work_english").val().trim();
                                let workTamVal = $("#work_tamil").val().trim();
                                extraName = `En: ${workEngVal} / த: ${workTamVal}`;
                            } else if ($("#family_extra").length) {
                                let extraElem = $("#family_extra")[0];
                                if (extraElem.type == "file" && extraElem.files.length > 0) {
                                    extraName = extraElem.files[0].name;
                                } else if (extraElem.type == "text" && $(extraElem).val().trim() != "") {
                                    extraName = $(extraElem).val();
                                }
                            }
                        }

                        // Generate HTML Element Row template structured mappings
                        let row = `<tr data-index="${index}">
    <td>
        <input type="hidden" name="old_salary_slip[${index}]" value="">
        <input type="hidden" name="old_land_hold[${index}]" value="">
        ${relation}
        <input type="hidden" name="relation[${index}]" value="${relation}">
    </td>
    <td>${tamil}<input type="hidden" name="relation_name_tamil[${index}]" value="${tamil}"></td>
    <td>${english}<input type="hidden" name="relation_name_english[${index}]" value="${english}"></td>
    <td>${age}<input type="hidden" name="relation_age[${index}]" value="${age}"></td>
    <td>${sex}<input type="hidden" name="relation_status[${index}]" value="${sex}"></td>
    <td>${profession}<input type="hidden" name="family_profession[${index}]" value="${profession}"></td>
    <td>${incomeSource}<input type="hidden" name="family_income_source[${index}]" value="${incomeSource}"></td>
    <td>${income}<input type="hidden" name="family_income[${index}]" value="${income}"></td>
    <td class="pan-file-cell" style="word-break: break-all;">${panName}</td>
    <td class="extra-file-cell" style="word-break: break-all;">${extraName}</td>
    <td>
        <input type="hidden" name="family_id[${index}]" value="NEW">
        <button type="button" class="btn btn-danger btn-sm removeMember">Delete</button>
    </td>
   </tr>`;

                        let $rowHtml = $(row);

                        // Context processing map dynamic temporary uploads directly inside cell DOM branches safely via deep cloning
                        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
                            if ($("#family_pan").length && $("#family_pan")[0].files.length > 0) {
                                let $panInput = $("#family_pan").clone().attr("name", `family_pan[${index}]`).attr("id", "")
                                    .hide();
                                $rowHtml.find(".pan-file-cell").append($panInput);
                            }

                            if (incomeSource == "Others") {
                                if ($("#work_english").val().trim() != "" && $("#work_tamil").val().trim() != "") {
                                    let $workEn = $("#work_english").clone().attr("name", `family_work_english[${index}]`).attr(
                                        "id", "").hide();
                                    let $workTa = $("#work_tamil").clone().attr("name", `family_work_tamil[${index}]`).attr(
                                        "id", "").hide();
                                    $rowHtml.find(".extra-file-cell").append($workEn).append($workTa);
                                }
                            } else if ($("#family_extra").length) {
                                let extraElem = $("#family_extra")[0];
                                if ((extraElem.type == "file" && extraElem.files.length > 0) || (extraElem.type == "text" && $(
                                        extraElem).val().trim() != "")) {
                                    let $extraInput = $("#family_extra").clone().attr("name", `family_extra[${index}]`).attr(
                                        "id", "").hide();
                                    $rowHtml.find(".extra-file-cell").append($extraInput);
                                }
                            }
                        }

                        $("#familytable tbody").append($rowHtml);

                        // UI Field Configuration Cleanups
                        $("#relationship, #member_name_tamil, #member_name_english, #member_age, #member_sex, #family_profession, #family_income_source")
                            .val("");
                        $("#familyIncomeFields").html("");

                        refreshRelationship();
                        checkFamilyCount();
                    });

                    // -------------------------------------------------------------------------
                    // 6. Action Handlers: Remove Family Member Row
                    // -------------------------------------------------------------------------
                    $(document).on("click", ".removeMember", function() {
                        let row = $(this).closest("tr");
                        let relation = row.find("input[name^='relation[']").val();

                        // Remove targeted item from tracker variable state array
                        selectedRelations = $.grep(selectedRelations, function(value) {
                            return value != relation;
                        });

                        row.remove();
                        refreshRelationship();
                        checkFamilyCount();
                    });

                    // -------------------------------------------------------------------------
                    // 7. Global Inputs/Form Events Trackers
                    // -------------------------------------------------------------------------
                    $("#family_count").on("keyup change", function() {
                        checkFamilyCount();
                    });

                    $("form").submit(function() {
                        let totalFamily = parseInt($("#family_count").val()) || 0;
                        let addedMembers = $("#familytable tbody tr").length;

                        if (totalFamily != addedMembers) {
                            alert("Please add all family members matching the specified total count.");
                            return false;
                        }
                        return true;
                    });
                    document.getElementById("myForm").addEventListener("submit", function() {
                        const btn = document.getElementById("save");
                        btn.disabled = true;
                        btn.innerText = "Submitting...";
                    });
                </script>
            @endpush
