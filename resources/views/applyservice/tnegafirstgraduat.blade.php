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
                            <form class="row g-4" action="{{ url('submittnegagraduate') }}" enctype="multipart/form-data"
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
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0 text-success">
                                                    <i class="fa fa-graduation-cap"></i> Graduation Details
                                                </h6>
                                            </div>

                                            <div class="card-body">

                                                <div class="row align-items-center mb-4">
                                                    <div class="col-md-7">
                                                        <label class="fw-bold">
                                                            If any other person pursuing / Completed Graduation from Family.
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="d-flex gap-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="family_graduation" value="Yes"
                                                                    id="family_yes">
                                                                <label class="form-check-label" for="family_yes">
                                                                    Yes
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="family_graduation" value="No" checked
                                                                    id="family_no">
                                                                <label class="form-check-label" for="family_no">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row align-items-center">
                                                    <div class="col-md-7">
                                                        <label class="fw-bold">
                                                            If any applicant's sibling is pursuing / drop out graduation.
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="d-flex gap-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sibling_graduation" value="Yes"
                                                                    id="sibling_yes">
                                                                <label class="form-check-label" for="sibling_yes">
                                                                    Yes
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="sibling_graduation" value="No" checked
                                                                    id="sibling_no">
                                                                <label class="form-check-label" for="sibling_no">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Previous & Next Buttons -->
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

                                        <div class="card border-0 shadow-lg mt-4">

                                            <div class="card-header bg-primary text-white py-3">
                                                <h6 class="mb-0">
                                                    <i class="fa fa-graduation-cap me-2"></i>
                                                    Course Details / Self
                                                </h6>
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
                                                        <select id="course_complete" name="course_complete"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="SSLC">SSLC</option>
                                                            <option value="Higher Secondary">Higher Secondary</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="Graduate">Graduate</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            <i class="fa fa-calendar text-success"></i>
                                                            Year Of Passing
                                                        </label>
                                                        <input class="form-control" type="text" name="year_of_passing"
                                                            placeholder="Enter Year Of Passing">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            <i class="fa fa-university text-primary"></i>
                                                            Current Course
                                                        </label>
                                                        <select id="current_course" name="current_course"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="SSLC">SSLC</option>
                                                            <option value="Higher Secondary">Higher Secondary</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="Graduate">Graduate</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            <i class="fa fa-calendar-check text-success"></i>
                                                            Current Academic Year
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            name="current_academy_yr" placeholder="Current Academic Year">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            <i class="fa fa-university text-primary"></i>
                                                            Applicant Transfer Certificate
                                                        </label>
                                                        <input class="form-control" type="file" name="applicant_tc">
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                <h6 class="text-primary mb-3">
                                                    <i class="fa fa-building"></i>
                                                    Institution Details
                                                </h6>

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            நிறுவனத்தின் பெயர் தமிழில்
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            name="institute_name_tamil">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            Institute Name In English
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            name="institute_name_english">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            நிறுவனத்தின் முகவரி தமிழில்
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            name="institute_address_tamil">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">
                                                            Institute Address In English
                                                        </label>
                                                        <input class="form-control" type="text"
                                                            name="institute_address_english">
                                                    </div>

                                                </div>

                                                <hr class="my-4">
                                            </div>

                                            <div class="d-flex justify-content-between mt-5">

                                                <button type="button" class="btn btn-secondary px-4"
                                                    onclick="prevStep(3)">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Previous
                                                </button>
                                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                                    Next →
                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div id="step4" style="display:none;">

                                    <div class="card border-0 shadow-lg mt-0">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0">
                                                <i class="fa fa-users"></i>
                                                Important Details
                                            </h6>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="card shadow-lg border-0 mt-4">
                                                    <div class="card-body">

                                                        <div class="table-responsive">

                                                            <table
                                                                class="table table-bordered table-hover align-middle text-center"
                                                                id="familytable">

                                                                <thead>

                                                                    <tr>

                                                                        <th>Relationship</th>

                                                                        <th>Tamil Name</th>

                                                                        <th>English Name</th>

                                                                        <th>Age</th>

                                                                        <th>Sex</th>

                                                                        <th>Living Status</th>

                                                                        <th>Education</th>

                                                                        <th>Document</th>

                                                                        <th>Action</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>
                                                      
                                                                </tbody>

                                                            </table>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">Relationship</label>

                                                    <select name="relationship[]" id="relationship" class="form-control">
                                                        <option value="">SELECT</option>
                                                        <option value="தந்தை">தந்தை</option>
                                                        <option value="தந்தையின் தந்தை">தந்தையின் தந்தை</option>
                                                        <option value="தந்தையின் தாய்">தந்தையின் தாய்</option>
                                                        <option value="தாய்">தாய்</option>
                                                        <option value="தாயின் தந்தை">தாயின் தந்தை</option>
                                                        <option value="தாயின் தாய்">தாயின் தாய்</option>
                                                    </select>

                                                </div>

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">பெயர் தமிழில்</label>

                                                    <input type="text" class="form-control" name="tamil_name[]">

                                                </div>

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">Name In English</label>

                                                    <input type="text" class="form-control" name="english_name[]">

                                                </div>

                                            </div>


                                            <!-- Row 2 -->

                                            <div class="row">

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">Age</label>

                                                    <input type="text" class="form-control number" maxlength="2"
                                                        name="age[]">

                                                </div>

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">Sex</label>

                                                    <select name="sex[]" class="form-control">

                                                        <option value="">SELECT</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Not Stated">Not Stated</option>
                                                        <option value="Transgender">Transgender</option>

                                                    </select>

                                                </div>

                                                <div class="col-md-4 mb-3">

                                                    <label class="form-label">Living Status</label>

                                                    <select name="livingstatus[]" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Alive">Alive</option>
                                                        <option value="Dead">Dead</option>

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

                                                                <select name="education_type" id="education_type"
                                                                    class="form-control">

                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Right Side Section -->
                                                    <div class="col-md-8">

                                                        <!-- Declaration -->
                                                        <div id="declarationSection" style="display:none;">

                                                            <label>Download Declaration</label>

                                                            @foreach ($declar as $d)
                                                                <a href="{{ url('/') }}/upload/declaration/{{ $d->declaration_form }}"
                                                                    download class="btn btn-primary">

                                                                    Download

                                                                </a>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                    <div class="text-center mt-4">

                                                        <button id="addRelationBtn" type="button"
                                                            class="btn btn-success">

                                                            Add

                                                        </button>

                                                    </div>
                                                    <!-- Row 3 -->



                                                </div>
                                                <div class="d-flex justify-content-between mt-5">

                                                    <button type="button" class="btn btn-secondary px-4"
                                                        onclick="prevStep(4)">
                                                        <i class="fa fa-arrow-left"></i>
                                                        Previous
                                                    </button>
                                                    <button id="nextBtn" type="button" class="btn btn-primary"
                                                        onclick="nextStep(4)">
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
                                            <h6 class="mb-0">
                                                <i class="fa fa-graduation-cap me-2"></i>
                                                Family Details
                                            </h6>
                                        </div>
                                        <div class="row align-items-center justify-content-center mb-4">

                                            <div class="col-md-4 text-end">
                                                <label class="fw-bold">
                                                    Total number of family members
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" id="family_count" name="family_count"
                                                    class="form-control number" required>
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
                                                </tr>

                                            </thead>

                                            <tbody id="familytbody">
                                                <tr>
                                                    <td> <select name="relationship_add2[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Elder Brother">Elder Brother</option>
                                                            <option value="Younger Brother">Younger Brother
                                                            </option>
                                                            <option value="Younger Sister">Younger Sister</option>
                                                            <option value="Elder Sister">Elder Sister</option>
                                                        </select></td>
                                                    <td><input class="form-control" type="text"
                                                            name="name_tamil_add2[]" maxlength="100"></td>
                                                    <td><input class="form-control" type="text"
                                                            name="name_english_add2[]" maxlength="100"></td>
                                                    <td><input class="form-control" type="text" name="age_add2[]"
                                                            maxlength="2"></td>
                                                    <td><select name="living_status_add2[]"
                                                            class="form-control alive_or_dead">
                                                            <option value="">Select</option>
                                                            <option value="Alive">Alive</option>
                                                            <option value="Dead">Dead</option>

                                                        </select></td>
                                                    <td> <select name="education_type_add[]"
        class="form-control education_document_add">
                                                            <option value="">Select Education Type</option>
                                                            <option value="Non Literate">Non Literate</option>
                                                            <option value="Drop Out">Drop Out</option>
                                                            <option value="Upto 5 Standard">Upto 5 Standard
                                                            </option>
                                                            <option value="Less than 10th Standard">Less than 10th
                                                                Standard</option>
                                                            <option value="Less than 12th Standard">Less than 12th
                                                                Standard</option>
                                                            <option value="10th Or 12th Standard">10th Or 12th
                                                                Standard
                                                            </option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="Degree Completed">Degree Completed
                                                            </option>
                                                            <option value="Post Graduate">Post Graduate</option>
                                                            <option value="Pursing Degree">Pursing Degree</option>
                                                        </select></td>
                                                    <td>
                                                        <p class="docadd mb-1"></p>

                                                        <input style="display:none;" class="form-control edu_file_add"
                                                            type="file" name="doc2[]" accept=".pdf,.jpg,.jpeg,.png">
                                                    </td>
                                                </tr>
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
                                            <h6 class="mb-0">
                                                <i class="fa fa-graduation-cap me-2"></i>
                                                Document Details
                                            </h6>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>1. Photo *</label>
                                                <input type="file" name="photo" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>2. Adress proof (Adhaar + smart card Attached file) *</label>
                                                <input type="file" name="address_proof" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>3. Applicant Signature</label>
                                                <input type="file" name="signature" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between mt-5">

                                            <button type="button" class="btn btn-secondary px-4" onclick="prevStep(6)">
                                                <i class="fa fa-arrow-left"></i>
                                                Previous
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary">Apply</button>
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
            let relation = $('#relationship').val();
            let tamil = $('input[name="tamil_name[]"]').val();
            let english = $('input[name="english_name[]"]').val();
            let age = $('input[name="age[]"]').val();
            let sex = $('select[name="sex[]"]').val();
            let livingstatus = $('select[name="livingstatus[]"]').val();
            let education = $('#education_type').val();

            if (relation == "") {
                alert("Select Relationship");
                return;
            }

            if (tamil == "") {
                alert("Enter Tamil Name");
                return;
            }

            if (english == "") {
                alert("Enter English Name");
                return;
            }

            if (age == "") {
                alert("Enter Age");
                return;
            }

            if (sex == "") {
                alert("Select Sex");
                return;
            }

            if (livingstatus == "") {
                alert("Select Living Status");
                return;
            }

            if (education == "") {
                alert("Select Education");
                return;
            }

// Document Column
let documentColumn = "";

if (education == "Non Literate") {

    documentColumn = `
        <label class="text-success">
            Declaration
        </label>

        <input type="file"
               name="family_document[]"
               class="form-control mt-2"
               accept=".pdf,.jpg,.jpeg,.png">

        <input type="hidden"
               name="education_type_add1[]"
               value="Non Literate">
    `;

} else {

    documentColumn = `
        <label class="text-primary">
            TC / Bonafied
        </label>

        <input type="file"
               name="family_document[]"
               class="form-control mt-2"
               accept=".pdf,.jpg,.jpeg,.png">

        <input type="hidden"
               name="education_type_add1[]"
               value="${education}">
    `;


            }
            $("#familytable tbody").append(`

        <tr>

            <td>
                ${relation}
                <input type="hidden"
                       name="relationship_add1[]"
                       value="${relation}">
            </td>

            <td>
                ${tamil}
                <input type="hidden"
                       name="tamil_name_add1[]"
                       value="${tamil}">
            </td>

            <td>
                ${english}
                <input type="hidden"
                       name="english_name_add1[]"
                       value="${english}">
            </td>

            <td>
                ${age}
                <input type="hidden"
                       name="age_add1[]"
                       value="${age}">
            </td>

            <td>
                ${sex}
                <input type="hidden"
                       name="sex_add1[]"
                       value="${sex}">
            </td>

            <td>
                ${livingstatus}
                <input type="hidden"
                       name="livingstatus_add1[]"
                       value="${livingstatus}">
            </td>

            <td>
                ${education}
            </td>

            <td>
                ${documentColumn}
            </td>

            <td>
                <button type="button"
                        class="btn btn-danger btn-sm removeRow">
                    Remove
                </button>
            </td>

        </tr>

    `);

            // Remove selected relation
            relations = relations.filter(function(item) {

                return item != relation;

            });

            loadRelationship();

            if (relations.length == 0) {

                $('#nextBtn').prop('disabled', false);

            } else {

                $('#nextBtn').prop('disabled', true);

            }

            // Clear Fields

            $('#relationship').val('');
            $('input[name="tamil_name[]"]').val('');
            $('input[name="english_name[]"]').val('');
            $('input[name="age[]"]').val('');
            $('select[name="sex[]"]').val('');
            $('select[name="livingstatus[]"]').val('');
            $('#education_type').val('').trigger('change');
        });

        // Row Remove 

        $(document).on('click', '.removeRow', function() {

            let row = $(this).closest('tr');

            let relation = row.find('input[name="relationship_add1[]"]').val();

            // Add relation back to dropdown
            relations.push(relation);

            // Sort (optional)
            relations.sort(function(a, b) {
                return a.localeCompare(b, 'ta');
            });

            loadRelationship();

            row.remove();

            if (relations.length == 0) {
                $('#nextBtn').prop('disabled', false);
            } else {
                $('#nextBtn').prop('disabled', true);
            }
        if (education == "Non Literate") {

            if ($('#father_form').val() == "") {
                alert("Please upload Declaration");
                return;
            }

        } else {

            if ($('#education_document').val() == "") {
                alert("Please upload TC / Bonafied");
                return;
            }

        }

        if (education == "") {
            alert("Select Education");
            return;
        }
        });

        // Family details counting number enter panura Script 5th tab

$(document).ready(function () {

    $("#family_count").on("keyup change", function () {

        let count = parseInt($(this).val()) || 0;

        let tbody = $("#familytbody");

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

        tbody.empty();

        for (let i = 0; i < count; i++) {

            tbody.append(`
                <tr>

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
                        <select name="living_status_add2[]"
                                class="form-control">
                            <option value="">Select</option>
                            <option value="Alive">Alive</option>
                            <option value="Dead">Dead</option>
                        </select>
                    </td>

                    <td>
                        <select name="education_type_add2[]"
                                class="form-control education_type_add2">

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

                    <td class="documentArea">

                    </td>

                    <td class="text-center">
                        <button type="button"
                                class="btn btn-danger btnDelete">
                            Delete
                        </button>
                    </td>

                </tr>
            `);

        }

    });


    $(document).on("change", ".education_type_add2", function () {

        let education = $(this).val();

        let documentArea = $(this).closest("tr").find(".documentArea");

        if (education == "Non Literate") {

            documentArea.html(`
                <label class="text-primary">
                    Declaration
                </label>

                <input type="file"
                       name="father_form_add2[]"
                       class="form-control"
                       accept=".pdf,.jpg,.jpeg,.png">
            `);

        } else if (education != "") {

            documentArea.html(`
                <label class="text-success">
                    TC / Bonafide
                </label>

                <input type="file"
                       name="education_document_add2[]"
                       class="form-control"
                       accept=".pdf,.jpg,.jpeg,.png">
            `);

        } else {

            documentArea.html('');

        }

    });


    $(document).on("click", ".btnDelete", function () {

        $(this).closest("tr").remove();

    });

});

// Family Details tabla education select panumpothu ulla script

// Education Change (Step 5)

$(document).on('change', '.education_document_add', function () {

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

        file.attr('name','father_form_add2[]');
        file.show();

    }
    else if (education != "") {

        doc.html(`
            Upload TC / Bonafide
        `);

        file.attr('name','education_document_add2[]');
        file.show();

    }
    else {

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
    </script>
@endpush
