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
    <style>
        .form-check-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 16px;
            margin-left: 5px;
            cursor: pointer;
        }

        .card.border-success {
            border: 2px solid #198754 !important;
        }

        .card {
            border-radius: 15px;
        }

        .table th {
            background: #f8f9fa;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }
    </style>
    <style>
        .card {
            border-radius: 12px;
        }

        .form-check {
            padding: 6px 0;
        }

        .form-check-label {
            cursor: pointer;
        }

        #declarationSection {
            min-height: 250px;
        }
    </style>
    <style>
        #familytable thead th {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        #familytable tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        #familytable tbody tr:hover {
            background: #e7f1ff;
            transition: 0.3s;
        }

        #familytable td {
            vertical-align: middle;
            font-size: 14px;
        }

        .family-card {
            border-radius: 15px;
            overflow: hidden;
        }

        #familytabledetails {
            width: 100%;
            table-layout: fixed;
        }

        #familytabledetails th,
        #familytabledetails td {
            vertical-align: middle;
            padding: 8px;
        }

        #familytabledetails .form-control {
            min-width: 120px;
        }

        .docadd span {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 20px;
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
                            <form class="row g-4" action="{{ url('submittnegagraduateupdate') }}"
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

                                        <h4 class="text-center card-header bg-success text-white mb-4">
                                            Can Details
                                        </h4>

                                        <div class="row">

                                            <!-- LEFT COLUMN -->
                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <!-- Can Number -->
                                                <label class="form-label">Can Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="15" required type="text" class="form-control"
                                                    name="can_number" value="{{ $tncustomers->can_number }}">

                                                <!-- Name English -->
                                                <label class="form-label mt-3">Name In English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="60" required type="text" class="form-control"
                                                    name="name" value="{{ $tncustomers->name }}">

                                                <!-- Father Name -->
                                                <label class="form-label mt-3">Father Name In English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="father_name_english"
                                                    value="{{ $tncustomers->father_name_english }}">

                                                <!-- Mother Name -->
                                                <label class="form-label mt-3">Mother Name In English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="mother_name_english"
                                                    value="{{ $tncustomers->mother_name_english }}">

                                                <!-- Gender -->
                                                <label class="form-label mt-3">Gender</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required class="form-control" name="gender">
                                                    <option>Select</option>
                                                    <option @if ($tncustomers->gender == 'Male') selected @endif
                                                        value="Male">Male</option>
                                                    <option @if ($tncustomers->gender == 'Female') selected @endif
                                                        value="Female">Female</option>
                                                </select>

                                                <!-- DOB -->
                                                <label class="form-label mt-3">DOB</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="date" class="form-control" name="dob"
                                                    value="{{ $tncustomers->dob }}">

                                                <!-- District -->
                                                <label class="form-label mt-3">District</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="50" required type="text" class="form-control"
                                                    name="district_name" value="{{ $tncustomers->district_name }}">

                                                <!-- VAO -->
                                                <label class="form-label mt-3">VAO</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="50" required type="text" class="form-control"
                                                    name="panchayath_name" value="{{ $tncustomers->panchayath_name }}">

                                                <!-- Address -->
                                                <label class="form-label mt-3">Address English</label>
                                                <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="500" required class="form-control" rows="4" name="address">{{ $tncustomers->address }}</textarea>

                                            </div>

                                            <!-- RIGHT COLUMN -->
                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <label class="form-label">Aadhaar Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="12" readonly required type="text"
                                                    class="form-control number" name="aadhaar_no"
                                                    value="{{ $tncustomers->aadhaar_no }}">

                                                <label class="form-label mt-3">Name In Tamil</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="name_tamil" value="{{ $tncustomers->name_tamil }}">

                                                <label class="form-label mt-3">Father Name In Tamil</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="father_name_tamil"
                                                    value="{{ $tncustomers->father_name_tamil }}">

                                                <label class="form-label mt-3">Mother Name In Tamil</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="mother_name_tamil"
                                                    value="{{ $tncustomers->mother_name_tamil }}">

                                                <label class="form-label mt-3">Religion</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required class="form-control" name="religion">
                                                    <option>Select</option>
                                                    <option @if ($tncustomers->religion == 'Hindu') selected @endif
                                                        value="Hindu">Hindu</option>
                                                    <option @if ($tncustomers->religion == 'Christian') selected @endif
                                                        value="Christian">Christian</option>
                                                    <option @if ($tncustomers->religion == 'Muslim') selected @endif
                                                        value="Muslim">Muslim</option>
                                                </select>

                                                <label class="form-label mt-3">Marital Status</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required class="form-control" name="marital_status">
                                                    <option>Select</option>
                                                    <option @if ($tncustomers->marital_status == 'Married') selected @endif
                                                        value="Married">Married</option>
                                                    <option @if ($tncustomers->marital_status == 'UnMarried') selected @endif
                                                        value="UnMarried">UnMarried</option>
                                                </select>

                                                <label class="form-label mt-3">Taluk</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100" required type="text" class="form-control"
                                                    name="taluk_name" value="{{ $tncustomers->taluk_name }}">

                                                <label class="form-label mt-3">Mobile Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="10" required type="text" class="form-control number"
                                                    name="mobile" value="{{ $tncustomers->mobile }}">

                                                <label class="form-label mt-3">Address Tamil</label>
                                                <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="500" required class="form-control" rows="4" name="address_tamil">{{ $tncustomers->address_tamil }}</textarea>

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
                    </div>
                </div>
               <div id="step2" style="display:none;">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-center">
                <i class="fa fa-users"></i> Graduation Details
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Family Graduation -->
                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Any Family Member Graduated?
                    </label>

                    <div class="mt-2">

                        <label class="me-4">
                            <input type="radio"
       name="family_graduation"
       value="Yes"
       {{ $services->family_graduation == 'Yes' ? 'checked' : '' }}>
                            Yes
                        </label>

                        <label>
                            <input type="radio"
       name="family_graduation"
       value="No"
       {{ $services->family_graduation == 'No' ? 'checked' : '' }}>
                            No
                        </label>

                    </div>

                </div>


                <!-- Sibling Graduation -->
                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Any Sibling Graduated?
                    </label>

                    <div class="mt-2">

                        <label class="me-4">
                            <input type="radio"
                                   name="sibling_graduation"
                                   value="Yes"
                                   {{ $services->sibling_graduation == 'Yes' ? 'checked' : '' }}>
                            Yes
                        </label>

                        <label>
                            <input type="radio"
                                   name="sibling_graduation"
                                   value="No"
                                   {{ $services->sibling_graduation == 'No' ? 'checked' : '' }}>
                            No
                        </label>

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer bg-white">

            <div class="d-flex justify-content-between">

                <button type="button"
                        class="btn btn-secondary"
                        onclick="prevStep(2)">
                    <i class="fa fa-arrow-left"></i> Previous
                </button>

                <button type="button"
                        class="btn btn-primary"
                        onclick="nextStep(2)">
                    Next <i class="fa fa-arrow-right"></i>
                </button>

            </div>

        </div>

    </div>

</div>
                <div id="step3" style="display:none;">

                    <div class="card border-0 shadow-lg mt-4">

                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">
                                <i class="fa fa-graduation-cap me-2"></i>
                                Course Details / Self
                            </h4>
                        </div>

                        <div class="card-body p-4">

                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i>
                                Please fill all educational and institution details carefully.
                            </div>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-book text-primary"></i>
                                        Course Completed
                                    </label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="course_complete" name="course_complete" class="form-control">

                                        <option value="">Select</option>

                                        <option value="SSLC"
                                            {{ old('course_complete', $services->course_complete ?? '') == 'SSLC' ? 'selected' : '' }}>
                                            SSLC
                                        </option>

                                        <option value="Higher Secondary"
                                            {{ old('course_complete', $services->course_complete ?? '') == 'Higher Secondary' ? 'selected' : '' }}>
                                            Higher Secondary
                                        </option>

                                        <option value="Diploma"
                                            {{ old('course_complete', $services->course_complete ?? '') == 'Diploma' ? 'selected' : '' }}>
                                            Diploma
                                        </option>

                                        <option value="Graduate"
                                            {{ old('course_complete', $services->course_complete ?? '') == 'Graduate' ? 'selected' : '' }}>
                                            Graduate
                                        </option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-calendar text-success"></i>
                                        Year Of Passing
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text" class="form-control" name="year_of_passing"
                                        value="{{ old('year_of_passing', $services->year_of_passing ?? '') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-university text-primary"></i>
                                        Current Course
                                    </label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="current_course" name="current_course" class="form-control">

                                        <option value="">Select</option>

                                        <option value="SSLC"
                                            {{ old('current_course', $services->current_course ?? '') == 'SSLC' ? 'selected' : '' }}>
                                            SSLC
                                        </option>

                                        <option value="Higher Secondary"
                                            {{ old('current_course', $services->current_course ?? '') == 'Higher Secondary' ? 'selected' : '' }}>
                                            Higher Secondary
                                        </option>

                                        <option value="Diploma"
                                            {{ old('current_course', $services->current_course ?? '') == 'Diploma' ? 'selected' : '' }}>
                                            Diploma
                                        </option>

                                        <option value="Graduate"
                                            {{ old('current_course', $services->current_course ?? '') == 'Graduate' ? 'selected' : '' }}>
                                            Graduate
                                        </option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-calendar-check text-success"></i>
                                        Current Academic Year
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="current_academy_yr"
                                        value="{{ old('current_academy_yr', $services->current_academy_yr ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-university text-primary"></i>
                                        Applicant Transfer Certificate
                                    </label>
                                    <input class="form-control" type="file" name="applicant_tc">

                                    @if ($services->applicant_tc)
                                        <div class="mb-2">

                                            <a href="{{ asset('upload/services/applicant_tc/' . $services->applicant_tc) }}"
                                                target="_blank" class="btn btn-success btn-sm">

                                                View Uploaded TC

                                            </a>

                                        </div>
                                    @endif
                                    <input type="hidden" name="old_applicant_tc" value="{{ $services->applicant_tc }}">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="text-primary mb-3">
                                <i class="fa fa-building"></i>
                                Institution Details
                            </h5>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        நிறுவனத்தின் பெயர் தமிழில்
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="institute_name_tamil"
                                        value="{{ old('institute_name_tamil', $services->institute_name_tamil ?? '') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Institute Name In English
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="institute_name_english"
                                        value="{{ old('institute_name_english', $services->institute_name_english ?? '') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        நிறுவனத்தின் முகவரி தமிழில்
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="institute_address_tamil"
                                        value="{{ old('institute_address_tamil', $services->institute_address_tamil ?? '') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Institute Address In English
                                    </label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="institute_address_english"
                                        value="{{ old('institute_address_english', $services->institute_address_english ?? '') }}">
                                </div>

                            </div>

                            <hr class="my-4">
                        </div>

                        <div class="d-flex justify-content-between mt-5">

                            <button type="button" class="btn btn-secondary px-4" onclick="prevStep(3)">
                                <i class="fa fa-arrow-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                Next →
                            </button>

                        </div>

                    </div>
                </div>
                <div id="step4" style="display:none;">

                    <div class="card border-0 shadow-lg mt-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fa fa-users"></i>
                                Important Details
                            </h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="card shadow-lg border-0 mt-4">
                                    <div class="card-body">

                                        <div class="table-responsive">

                                            <table class="table table-bordered table-hover align-middle text-center"
                                                id="familytable">

                                                <thead>
                                                    <tr>
                                                        <th>Relationship</th>
                                                        <th>Name Tamil</th>
                                                        <th>Name English</th>
                                                        <th>Age</th>
                                                        <th>Sex</th>
                                                        <th>Living Status</th>
                                                        <th>Education</th>
                                                        <th>Document</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($importantDetails as $row)
                                                        <tr>
                                                            <input type="hidden" name="family_member_id[]"
                                                                value="{{ $row->id }}">
                                                            <td>
                                                                {{ $row->relation }}
                                                                <input type="hidden" name="relationship_add1[]"
                                                                    value="{{ $row->relation }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->tamil_name }}
                                                                <input type="hidden" name="tamil_name_add1[]"
                                                                    value="{{ $row->tamil_name }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->english_name }}
                                                                <input type="hidden" name="english_name_add1[]"
                                                                    value="{{ $row->english_name }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->relation_age }}
                                                                <input type="hidden" name="age_add1[]"
                                                                    value="{{ $row->relation_age }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->sex }}
                                                                <input type="hidden" name="sex_add1[]"
                                                                    value="{{ $row->sex }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->living_status }}
                                                                <input type="hidden" name="livingstatus_add1[]"
                                                                    value="{{ $row->living_status }}">
                                                            </td>

                                                            <td>
                                                                {{ $row->education }}
                                                                <input type="hidden" name="education_type_add1[]"
                                                                    value="{{ $row->education }}">
                                                            </td>

                                                            <td>

                                                                <input type="hidden" name="old_father_form[]"
                                                                    value="{{ $row->father_form }}">
                                                                <input type="hidden" name="old_education_document[]"
                                                                    value="{{ $row->education_document }}">

                                                                @if ($row->father_form)
                                                                    <a href="{{ asset('upload/services/family/' . $row->father_form) }}"
                                                                        target="_blank" class="btn btn-primary btn-sm">
                                                                        Declaration
                                                                    </a>
                                                                    <br><br>
                                                                @endif

                                                                @if ($row->education_document)
                                                                    <a href="{{ asset('upload/services/family/' . $row->education_document) }}"
                                                                        target="_blank" class="btn btn-success btn-sm">
                                                                        TC
                                                                    </a>
                                                                    <br><br>
                                                                @endif

                                                                @if ($row->education == 'Non Literate')
    <label>Declaration</label>
@else
    <label>TC / Bonafide</label>
@endif

<input type="file" name="family_document_add1[]" class="form-control">

                                                            </td>

                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm removeRow">
                                                                    Delete
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">Relationship</label>

                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="relationship" name="relationship" class="form-control">

                                        <option value="">SELECT</option>

                                        <option value="தந்தை"
                                            {{ old('relationship', $services->relationship ?? '') == 'தந்தை' ? 'selected' : '' }}>
                                            தந்தை
                                        </option>

                                        <option value="தந்தையின் தந்தை"
                                            {{ old('relationship', $services->relationship ?? '') == 'தந்தையின் தந்தை' ? 'selected' : '' }}>
                                            தந்தையின் தந்தை
                                        </option>

                                        <option value="தந்தையின் தாய்"
                                            {{ old('relationship', $services->relationship ?? '') == 'தந்தையின் தாய்' ? 'selected' : '' }}>
                                            தந்தையின் தாய்
                                        </option>

                                        <option value="தாய்"
                                            {{ old('relationship', $services->relationship ?? '') == 'தாய்' ? 'selected' : '' }}>
                                            தாய்
                                        </option>

                                        <option value="தாயின் தந்தை"
                                            {{ old('relationship', $services->relationship ?? '') == 'தாயின் தந்தை' ? 'selected' : '' }}>
                                            தாயின் தந்தை
                                        </option>

                                        <option value="தாயின் தாய்"
                                            {{ old('relationship', $services->relationship ?? '') == 'தாயின் தாய்' ? 'selected' : '' }}>
                                            தாயின் தாய்
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">பெயர் தமிழில்</label>

                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="tamil_name"
                                        value="{{ old('tamil_name', $services->tamil_name ?? '') }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">Name In English</label>

                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" name="english_name"
                                        value="{{ old('english_name', $services->english_name ?? '') }}">

                                </div>

                            </div>


                            <!-- Row 2 -->

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">Age</label>

                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control" type="text" maxlength="2" name="age"
                                        value="{{ old('age', $services->age ?? '') }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">Sex</label>

                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="sex" class="form-control">

                                        <option value="">SELECT</option>

                                        <option value="Male"
                                            {{ old('sex', $services->sex ?? '') == 'Male' ? 'selected' : '' }}>
                                            Male
                                        </option>

                                        <option value="Female"
                                            {{ old('sex', $services->sex ?? '') == 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>

                                        <option value="Not Stated"
                                            {{ old('sex', $services->sex ?? '') == 'Not Stated' ? 'selected' : '' }}>
                                            Not Stated
                                        </option>

                                        <option value="Transgender"
                                            {{ old('sex', $services->sex ?? '') == 'Transgender' ? 'selected' : '' }}>
                                            Transgender
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">Living Status</label>

                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="livingstatus" class="form-control">

                                        <option value="">Select</option>

                                        <option value="Alive"
                                            {{ old('livingstatus', $services->livingstatus ?? '') == 'Alive' ? 'selected' : '' }}>
                                            Alive
                                        </option>

                                        <option value="Dead"
                                            {{ old('livingstatus', $services->livingstatus ?? '') == 'Dead' ? 'selected' : '' }}>
                                            Dead
                                        </option>

                                    </select>
                                </div>
                                <div class="row">

                                    <!-- Education -->
                                    <div class="col-md-4">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0">
                                                    <i class="fa fa-graduation-cap"></i>
                                                    Education
                                                </h6>
                                            </div>

                                            <div class="card-body">

                                                <label class="form-label fw-bold">
                                                    Select Education
                                                </label>

                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="education_type" id="education_type" class="form-control">

                                                    <option value="">Select Education Type</option>

                                                    <option value="Non Literate"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Non Literate' ? 'selected' : '' }}>
                                                        Non Literate
                                                    </option>

                                                    <option value="Drop Out"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Drop Out' ? 'selected' : '' }}>
                                                        Drop Out
                                                    </option>

                                                    <option value="Upto 5 Standard"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Upto 5 Standard' ? 'selected' : '' }}>
                                                        Upto 5 Standard
                                                    </option>

                                                    <option value="Less than 10th Standard"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Less than 10th Standard' ? 'selected' : '' }}>
                                                        Less than 10th Standard
                                                    </option>

                                                    <option value="Less than 12th Standard"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Less than 12th Standard' ? 'selected' : '' }}>
                                                        Less than 12th Standard
                                                    </option>

                                                    <option value="10th Or 12th Standard"
                                                        {{ old('education_type', $services->education_type ?? '') == '10th Or 12th Standard' ? 'selected' : '' }}>
                                                        10th Or 12th Standard
                                                    </option>

                                                    <option value="Diploma"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Diploma' ? 'selected' : '' }}>
                                                        Diploma
                                                    </option>

                                                    <option value="Degree Completed"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Degree Completed' ? 'selected' : '' }}>
                                                        Degree Completed
                                                    </option>

                                                    <option value="Post Graduate"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Post Graduate' ? 'selected' : '' }}>
                                                        Post Graduate
                                                    </option>

                                                    <option value="Pursing Degree"
                                                        {{ old('education_type', $services->education_type ?? '') == 'Pursing Degree' ? 'selected' : '' }}>
                                                        Pursing Degree
                                                    </option>

                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">

                                        <button id="addRelationBtn" type="button" class="btn btn-success">

                                            Add

                                        </button>

                                    </div>
                                    <!-- Row 3 -->
                                </div>
                                <div class="d-flex justify-content-between mt-5">

                                    <button type="button" class="btn btn-secondary px-4" onclick="prevStep(4)">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep(4)">
                                        Next →
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="step5" style="display:none;">

                    <div class="card border-0 shadow-lg mt-4">

                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">
                                <i class="fa fa-graduation-cap me-2"></i>
                                Family Details
                            </h4>
                        </div>
                        <div class="row align-items-center justify-content-center mb-4">

                            <div class="col-md-4 text-end">
                                <label class="fw-bold">
                                    Total number of family members
                                    <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="col-md-3">
                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text" id="family_count" name="family_count" class="form-control number"
                                    value="{{ old('family_count', $services->family_count ?? '') }}">
                            </div>

                        </div>
                        <table id="familytabledetails" class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>உறவுமுறை</th>
                                    <th>பெயர் தமிழில்</th>
                                    <th>Name In English</th>
                                    <th>Age</th>
                                    <th>Living Status</th>
                                    <th>Education</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody id="familytbody">


                                @foreach ($familydetails as $row)
                                    <tr>

                                        <input type="hidden" name="family_id[]" value="{{ $row->id }}">
                                        <td>

                                            <select name="relationship_add2[]" class="form-control">

                                                <option value="">Select</option>

                                                <option value="Elder Brother"
                                                    {{ $row->relation == 'Elder Brother' ? 'selected' : '' }}>
                                                    Elder Brother
                                                </option>

                                                <option value="Younger Brother"
                                                    {{ $row->relation == 'Younger Brother' ? 'selected' : '' }}>
                                                    Younger Brother
                                                </option>

                                                <option value="Younger Sister"
                                                    {{ $row->relation == 'Younger Sister' ? 'selected' : '' }}>
                                                    Younger Sister
                                                </option>

                                                <option value="Elder Sister"
                                                    {{ $row->relation == 'Elder Sister' ? 'selected' : '' }}>
                                                    Elder Sister
                                                </option>

                                            </select>

                                        </td>



                                        <td>
                                            <input type="text" class="form-control" name="name_tamil_add2[]"
                                                value="{{ $row->tamil_name }}">
                                        </td>



                                        <td>
                                            <input type="text" class="form-control" name="name_english_add2[]"
                                                value="{{ $row->english_name }}">
                                        </td>



                                        <td>
                                            <input type="text" class="form-control" name="age_add2[]"
                                                value="{{ $row->relation_age }}">
                                        </td>




                                        <td>

                                            <select name="living_status_add2[]" class="form-control">

                                                <option value="">Select</option>

                                                <option value="Alive"
                                                    {{ $row->living_status == 'Alive' ? 'selected' : '' }}>
                                                    Alive
                                                </option>

                                                <option value="Dead"
                                                    {{ $row->living_status == 'Dead' ? 'selected' : '' }}>
                                                    Dead
                                                </option>


                                            </select>

                                        </td>




                                        <td>


                                            <select name="education_type_add2[]" class="form-control">

                                                <option value="">Select Education Type</option>

                                                <option value="Non Literate"
                                                    {{ $row->education == 'Non Literate' ? 'selected' : '' }}>
                                                    Non Literate
                                                </option>

                                                <option value="Drop Out"
                                                    {{ $row->education == 'Drop Out' ? 'selected' : '' }}>
                                                    Drop Out
                                                </option>

                                                <option value="Upto 5 Standard"
                                                    {{ $row->education == 'Upto 5 Standard' ? 'selected' : '' }}>
                                                    Upto 5 Standard
                                                </option>

                                                <option value="Less than 10th Standard"
                                                    {{ $row->education == 'Less than 10th Standard' ? 'selected' : '' }}>
                                                    Less than 10th Standard
                                                </option>

                                                <option value="Less than 12th Standard"
                                                    {{ $row->education == 'Less than 12th Standard' ? 'selected' : '' }}>
                                                    Less than 12th Standard
                                                </option>

                                                <option value="10th Or 12th Standard"
                                                    {{ $row->education == '10th Or 12th Standard' ? 'selected' : '' }}>
                                                    10th Or 12th Standard
                                                </option>

                                                <option value="Diploma"
                                                    {{ $row->education == 'Diploma' ? 'selected' : '' }}>
                                                    Diploma
                                                </option>

                                                <option value="Degree Completed"
                                                    {{ $row->education == 'Degree Completed' ? 'selected' : '' }}>
                                                    Degree Completed
                                                </option>

                                                <option value="Post Graduate"
                                                    {{ $row->education == 'Post Graduate' ? 'selected' : '' }}>
                                                    Post Graduate
                                                </option>

                                                <option value="Pursing Degree"
                                                    {{ $row->education == 'Pursing Degree' ? 'selected' : '' }}>
                                                    Pursing Degree
                                                </option>

                                            </select>


                                        </td>




                                        <td>

                                            @if ($row->doc)
                                                @foreach (explode(',', $row->doc) as $doc)
                                                    <a href="{{ asset('upload/services/' . $doc) }}" target="_blank"
                                                        class="btn btn-success btn-sm mb-1">

                                                        View Document

                                                    </a>

                                                    <br>
                                                @endforeach
                                            @endif


                                            <input type="file" name="doc2[]" class="form-control mt-2"
                                                accept=".pdf,.jpg,.jpeg,.png">


                                            <input type="hidden" name="old_doc2[]" value="{{ $row->doc }}">


                                        </td>



                                        <td>

                                            <button type="button" class="btn btn-danger btnDelete">

                                                Delete

                                            </button>

                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        <div class="d-flex justify-content-between mt-5">

                            <button type="button" class="btn btn-secondary px-4" onclick="prevStep(5)">
                                <i class="fa fa-arrow-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(5)">
                                Next →
                            </button>
                        </div>
                    </div>
                </div>
                <div id="step6" style="display:none;">

                    <div class="card border-0 shadow-lg mt-4">

                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">
                                <i class="fa fa-graduation-cap me-2"></i>
                                Document Details
                            </h4>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <!-- Photo -->
                                <div class="col-md-6 mb-3">

                                    <label>1. Photo</label>

                                    @if (!empty($services->photo))
                                        <div class="mb-2">
                                            <a href="{{ asset('upload/services/photo/' . $services->photo) }}"
                                                target="_blank" class="btn btn-success btn-sm">
                                                View Photo
                                            </a>
                                        </div>
                                    @endif

                                    <input type="file" name="photo" class="form-control">
                                    <input type="hidden" name="old_photo" value="{{ $services->photo }}">

                                </div>

                                <!-- Address Proof -->
                                <div class="col-md-6 mb-3">

                                    <label>2. Address Proof (Aadhaar + Smart Card)</label>

                                    @if (!empty($services->address_proof))
                                        <div class="mb-2">
                                            <a href="{{ asset('upload/services/address_proof/' . $services->address_proof) }}"
                                                target="_blank" class="btn btn-success btn-sm">
                                                View Address Proof
                                            </a>
                                        </div>
                                    @endif

                                    <input type="file" name="address_proof" class="form-control">
                                    <input type="hidden" name="old_address_proof"
                                        value="{{ $services->address_proof }}">

                                </div>

                                <!-- Signature -->
                                <div class="col-md-6 mb-3">

                                    <label>3. Applicant Signature</label>

                                    @if (!empty($services->signature))
                                        <div class="mb-2">
                                            <a href="{{ asset('upload/services/signature/' . $services->signature) }}"
                                                target="_blank" class="btn btn-success btn-sm">
                                                View Signature
                                            </a>
                                        </div>
                                    @endif

                                    <input type="file" name="signature" class="form-control">
                                    <input type="hidden" name="old_signature" value="{{ $services->signature }}">

                                </div>
                                <div class="d-flex justify-content-between mt-5">

                                    <button type="button" class="btn btn-secondary px-3" onclick="prevStep(6)">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous
                                    </button>
                                </div>
                            </div>

                            <hr>

                            {{-- <div class="row"> --}}
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
                                    <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
                                @endif
                            </div>
                            {{-- </div> --}}

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

        $("#pricetable").on('change', '.education_document', function() {

            if ($(this).val() == "Non Literate") {

                $(this).closest('tr').find('.educationdoc')
                    .text("Upload Document")
                    .css('font-size', '90%');

                $(this).closest('tr').find('.edu_file')
                    .prop('required', true)
                    .show();

            } else {

                $(this).closest('tr').find('.educationdoc').text("");

                $(this).closest('tr').find('.edu_file')
                    .prop('required', false)
                    .hide()
                    .val('');
            }

        });

        $("#familytable").on('change', '.education_document_add', function() {
            if ($(this).val() == "Non Literate" || $(this).val() == "") {
                $(this).closest('tr').find('.docadd').text("");
                $(this).closest('tr').find('.edu_file_add').attr("required", false).css({
                    'display': 'none',
                });
            } else {
                $(this).closest('tr').find('.docadd').text("TC or Marksheet or Bonafide").css({
                    'font-size': '90%',
                });
                $(this).closest('tr').find('.edu_file_add').attr("required", true).css({
                    'display': 'block',
                });
            }
        });

        $("#familytabledetails").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
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
    {{-- Course Select Panumpothu --}}
    <script>
        $(document).ready(function() {

            $('#course_complete').change(function() {

                var selected = $(this).val();

                var options = '<option value="">Select</option>';

                if (selected == 'SSLC') {
                    options += '<option value="Higher Secondary">Higher Secondary</option>';
                    options += '<option value="Diploma">Diploma</option>';
                    options += '<option value="Graduate">Graduate</option>';
                } else if (selected == 'Higher Secondary') {
                    options += '<option value="Diploma">Diploma</option>';
                    options += '<option value="Graduate">Graduate</option>';
                } else if (selected == 'Diploma') {
                    options += '<option value="Graduate">Graduate</option>';
                } else if (selected == 'Graduate') {
                    options += '<option value="Graduate">Graduate</option>';
                }

                $('#current_course').html(options);

            });

        });
    </script>
    {{-- Tc And Declearation Script --}}
    <script>
        $(document).ready(function() {

            $('.education_check').change(function() {

                let education = $(this).val();

                if (education == 'Non Literate') {

                    // Show Declaration
                    $('#declarationSection').slideDown();

                    // Hide TC
                    $('#tcSection').hide();

                    $('#father_form').prop('required', true);
                    $('#education_document').prop('required', false);

                } else {

                    // Hide Declaration
                    $('#declarationSection').hide();

                    // Show TC Upload
                    $('#tcSection').slideDown();

                    $('#father_form').prop('required', false).val('');

                    $('#education_document').prop('required', true);
                }

            });

        });
    </script>

    {{-- Important Details Tabkulla script add button script --}}

    <script>
        var relations = [
            'தந்தை',
            'தந்தையின் தந்தை',
            'தந்தையின் தாய்',
            'தாய்',
            'தாயின் தந்தை',
            'தாயின் தாய்'
        ];

        $(document).ready(function() {

            loadRelationship();

            $('#education_type').change(function() {

                let education = $(this).val();

                if (education == "Non Literate") {

                    $('#declarationSection').show();
                    $('#tcSection').hide();

                    $('#education_document').val('');

                } else if (education != "") {

                    $('#declarationSection').hide();
                    $('#tcSection').show();

                    $('#father_form').val('');

                } else {

                    $('#declarationSection').hide();
                    $('#tcSection').hide();

                    $('#father_form').val('');
                    $('#education_document').val('');
                }

            });

        });

        function loadRelationship() {

            let html = '<option value="">SELECT</option>';

            $.each(relations, function(i, value) {

                html += '<option value="' + value + '">' + value + '</option>';

            });

            $('#relationship').html(html);

        }

        $('#addRelationBtn').click(function() {

            var relationship = $('[name="relationship"]').val();
            var tamil_name = $('[name="tamil_name"]').val();
            var english_name = $('[name="english_name"]').val();
            var age = $('[name="age"]').val();
            var sex = $('[name="sex"]').val();
            var livingstatus = $('[name="livingstatus"]').val();
            var education = $('#education_type').val();

            if (
                relationship == '' ||
                tamil_name == '' ||
                english_name == '' ||
                age == '' ||
                sex == '' ||
                livingstatus == '' ||
                education == ''
            ) {

                alert('Please fill all fields.');
                return;
            }

            if (education == "Non Literate") {

                if ($('#father_form').val() == "") {

                    alert("Please upload Declaration");
                    return;
                }

            } else {

                if ($('#education_document').val() == "") {

                    alert("Please upload TC / Bonafide");
                    return;
                }
            }

            var documentHtml = '';

          if (education == 'Non Literate') {

    documentHtml =
        '<label class="text-primary">Declaration</label>' +
        '<input type="file" name="family_document_add1[]" class="form-control mt-1" required>';

} else {

    documentHtml =
        '<label class="text-success">TC / Bonafide</label>' +
        '<input type="file" name="family_document_add1[]" class="form-control mt-1" required>';

}

            var html = '';

            html += '<tr>';

            html += '<td>' + relationship + '</td>';
            html += '<td>' + tamil_name + '</td>';
            html += '<td>' + english_name + '</td>';
            html += '<td>' + age + '</td>';
            html += '<td>' + sex + '</td>';
            html += '<td>' + livingstatus + '</td>';
            html += '<td>' + education + '</td>';

            html += '<td>';

            html += documentHtml;

            html += '<input type="hidden" name="relationship_add1[]" value="' + relationship + '">';
            html += '<input type="hidden" name="tamil_name_add1[]" value="' + tamil_name + '">';
            html += '<input type="hidden" name="english_name_add1[]" value="' + english_name + '">';
            html += '<input type="hidden" name="age_add1[]" value="' + age + '">';
            html += '<input type="hidden" name="sex_add1[]" value="' + sex + '">';
            html += '<input type="hidden" name="livingstatus_add1[]" value="' + livingstatus + '">';
            html += '<input type="hidden" name="education_type_add1[]" value="' + education + '">';

            html += '</td>';

            html += '<td>';
            html += '<button type="button" class="btn btn-danger btn-sm removeRow">Delete</button>';
            html += '</td>';

            html += '</tr>';

            $('#familytable tbody').append(html);

            // Remove selected relationship from dropdown
            relations = relations.filter(function(item) {
                return item != relationship;
            });

            loadRelationship();

            // Clear fields
            $('[name="relationship"]').val('');
            $('[name="tamil_name"]').val('');
            $('[name="english_name"]').val('');
            $('[name="age"]').val('');
            $('[name="sex"]').val('');
            $('[name="livingstatus"]').val('');
            $('#education_type').val('');

            $('#declarationSection').hide();
            $('#tcSection').hide();

            $('#father_form').val('');
            $('#education_document').val('');

        });

        // Delete Row
        $(document).on('click', '.removeRow', function() {

            let row = $(this).closest('tr');

            let relation = row.find('input[name="relationship_add1[]"]').val();

            if (relation != '') {

                relations.push(relation);

                relations.sort(function(a, b) {

                    return a.localeCompare(b, 'ta');

                });

                loadRelationship();
            }

            row.remove();

        });
        // Family details counting number enter panura Script 5th tab

        $(document).ready(function() {

            $("#family_count").on("change", function() {

                let count = parseInt($(this).val()) || 0;
                let tbody = $("#familytbody");

                // Update page-la already data iruntha skip pannum
                if (tbody.find("tr").length > 0) {
                    return;
                }

                if (count <= 0) {

                    tbody.html(`
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Family member count enter pannunga
                    </td>
                </tr>
            `);

                    return;
                }

                for (let i = 0; i < count; i++) {

                    tbody.append(`
                <tr>
<input type="hidden" name="family_id[]" value="{{ $row->id }}">
                    <td>
                        <select name="relationship_add2[]" class="form-control">
                            <option value="">Select</option>
                            <option value="Elder Brother">Elder Brother</option>
                            <option value="Younger Brother">Younger Brother</option>
                            <option value="Younger Sister">Younger Sister</option>
                            <option value="Elder Sister">Elder Sister</option>
                        </select>
                    </td>

                    <td>
                        <input type="text"
                               class="form-control"
                               name="name_tamil_add2[]">
                    </td>

                    <td>
                        <input type="text"
                               class="form-control"
                               name="name_english_add2[]">
                    </td>

                    <td>
                        <input type="text"
                               maxlength="2"
                               class="form-control"
                               name="age_add2[]">
                    </td>

                    <td>
                        <select name="living_status_add2[]" class="form-control">
                            <option value="">Select</option>
                            <option value="Alive">Alive</option>
                            <option value="Dead">Dead</option>
                        </select>
                    </td>

                    <td>
                        <select name="education_type_add2[]" class="form-control education_type_add2">
                            <option value="">Select Education</option>
                            <option value="Non Literate">Non Literate</option>
                            <option value="Drop Out">Drop Out</option>
                            <option value="Upto 5 Standard">Upto 5 Standard</option>
                            <option value="Less than 10th Standard">Less than 10th Standard</option>
                            <option value="Less than 12th Standard">Less than 12th Standard</option>
                            <option value="10th Or 12th Standard">10th Or 12th Standard</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Degree Completed">Degree Completed</option>
                            <option value="Post Graduate">Post Graduate</option>
                            <option value="Pursing Degree">Pursing Degree</option>
                        </select>
                    </td>

                    <td>
                        <div class="docArea"></div>
                    </td>

                    <td class="text-center">
                        <button type="button" class="btn btn-danger btnDelete">
                            Delete
                        </button>
                    </td>

                </tr>
            `);

                }

            });

        });

        $(document).on("change", ".education_type_add2", function() {

            let education = $(this).val();

            let docArea = $(this).closest("tr").find(".docArea");

            if (education == "Non Literate") {

                docArea.html(`

            <label class="text-primary">
                Declaration
            </label>

            <input
                type="file"
                name="father_form_add2[]"
                class="form-control mt-1">

        `);

            } else if (education != "") {

                docArea.html(`

            <label class="text-success">
                TC / Bonafide
            </label>

            <input
                type="file"
                name="education_document_add2[]"
                class="form-control mt-1">

        `);

            } else {

                docArea.html('');

            }

        });


        $(document).on("click", ".btnDelete", function() {

            $(this).closest("tr").remove();

        });
        // Family Details tabla education select panumpothu ulla script

        // Education Change (Step 5)

        $(document).on('change', '.education_document_add', function() {

            let education = $(this).val();

            let row = $(this).closest('tr');

            let doc = row.find('.docadd');

            let file = row.find('.edu_file_add');

            if (education == "Non Literate") {

                doc.html(`
            <a href="{{ url('/') }}/upload/declaration/{{ $declar[0]->declaration_form }}"
               class="btn btn-primary btn-sm mb-2"
               download>
            Declaration
            </a>
            <br>
            Upload Declaration
        `);

                file.attr('name', 'father_form_add2[]');
                file.show();

            } else if (education != "") {

                doc.html(`
            Upload TC / Bonafide
        `);

                file.attr('name', 'education_document_add2[]');
                file.show();

            } else {

                doc.html('');

                file.hide();

                file.val('');

            }

        });
    </script>

    {{-- Importan Fileds new dropdown scripts --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const educationType = document.getElementById("education_type");
            const declarationSection = document.getElementById("declarationSection");
            const tcSection = document.getElementById("tcSection");

            educationType.addEventListener("change", function() {

                let value = this.value;

                if (value === "Non Literate") {

                    declarationSection.style.display = "block";
                    tcSection.style.display = "none";

                } else if (value !== "") {

                    declarationSection.style.display = "none";
                    tcSection.style.display = "block";

                } else {

                    declarationSection.style.display = "none";
                    tcSection.style.display = "none";

                }

            });

        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
