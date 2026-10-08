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
                            <form class="row g-4" action="{{ url('submittnegaunemployedupdate') }}"
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
                                        <h4 class="text-center card-header bg-success text-white">
                                            Can Details
                                        </h4>
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
                                                    required type="text" class="form-control" name="father_name_english"
                                                    value="{{ $tncustomers->father_name_english }}">

                                                <!-- Mother Name -->
                                                <label class="form-label mt-3">Mother Name In English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                    required type="text" class="form-control" name="mother_name_english"
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
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                    required type="text" class="form-control" name="name_tamil"
                                                    value="{{ $tncustomers->name_tamil }}">

                                                <label class="form-label mt-3">Father Name In Tamil</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                    required type="text" class="form-control" name="father_name_tamil"
                                                    value="{{ $tncustomers->father_name_tamil }}">

                                                <label class="form-label mt-3">Mother Name In Tamil</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                    required type="text" class="form-control" name="mother_name_tamil"
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
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="100"
                                                    required type="text" class="form-control" name="taluk_name"
                                                    value="{{ $tncustomers->taluk_name }}">

                                                <label class="form-label mt-3">Mobile Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif maxlength="10"
                                                    required type="text" class="form-control number" name="mobile"
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
                                    <div class="card-body">

                                        <hr>

                                        <h5 class="text-primary mb-3">Educational Details</h5>

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Have completed your Graduation <span
                                                        class="text-danger">*</span></label><br>

                                                <label class="me-3">
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        type="radio" name="graduation" value="Yes"
                                                        {{ $services->graduation == 'Yes' ? 'checked' : '' }}>
                                                    Yes
                                                </label>

                                                <label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        type="radio" name="graduation" value="No"
                                                        {{ $services->graduation == 'No' ? 'checked' : '' }}>
                                                    No
                                                </label>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>School / College Name <span class="text-danger">*</span></label>
                                                <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    type="text" class="form-control" name="school_college_name"
                                                    maxlength="100" value="{{ $services->school_college_name }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Year Of Birth <span class="text-danger">*</span></label>
                                                <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    type="date" class="form-control" id="year_of_birth"
                                                    name="year_of_birth" value="{{ $services->year_of_birth }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Year of Completion <span class="text-danger">*</span></label>

                                                <select required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    class="form-control" id="year_of_passing" name="year_of_passing">

                                                    <option value="{{ $services->year_of_passing }}">
                                                        {{ $services->year_of_passing }}
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Highest Educational Qualification</label>

                                                <select required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    class="form-control" name="qualification" id="qualification">

                                                    <option value="">Select</option>

                                                    <option value="Senior Secondary"
                                                        {{ $services->qualification == 'Senior Secondary' ? 'selected' : '' }}
                                                        class="no-option">Senior Secondary</option>

                                                    <option value="Diploma"
                                                        {{ $services->qualification == 'Diploma' ? 'selected' : '' }}
                                                        class="no-option">Diploma</option>

                                                    <option value="Under Graduate"
                                                        {{ $services->qualification == 'Under Graduate' ? 'selected' : '' }}
                                                        class="yes-option">Under Graduate</option>

                                                    <option value="Graduate"
                                                        {{ $services->qualification == 'Graduate' ? 'selected' : '' }}
                                                        class="yes-option">Graduate</option>

                                                    <option value="Post Graduate"
                                                        {{ $services->qualification == 'Post Graduate' ? 'selected' : '' }}
                                                        class="yes-option">Post Graduate</option>

                                                    <option value="M.Phil"
                                                        {{ $services->qualification == 'M.Phil' ? 'selected' : '' }}
                                                        class="yes-option">M.Phil</option>

                                                    <option value="Ph.D"
                                                        {{ $services->qualification == 'Ph.D' ? 'selected' : '' }}
                                                        class="yes-option">Ph.D</option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Affiliated Board / University <span
                                                        class="text-danger">*</span></label>

                                                <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    type="text" class="form-control" name="board_university"
                                                    maxlength="100" value="{{ $services->board_university }}">
                                            </div>

                                        </div>

                                        <hr>

                                        <h5 class="text-primary mb-3">Other Details</h5>

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Unemployment From Date <span class="text-danger">*</span></label>

                                                <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    type="date" class="form-control" name="from_date"
                                                    value="{{ $services->from_date }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Unemployment To Date <span class="text-danger">*</span></label>

                                                <input required @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    type="date" class="form-control" name="to_date"
                                                    value="{{ $services->to_date }}">
                                            </div>

                                        </div>

                                        <hr>

                                    </div>

                                </div>

                                <!-- Footer -->

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

                    </div>
                    <div class="row">

                        <div id="step3" style="display:none;">

                            <div class="card border-success shadow-sm mb-4">

                                <!-- Header -->
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-success">
                                        <i class="fa fa-file"></i>Documents
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
                                            <label>Educational Qualification Proof</label><br>

                                            @if (!empty($services->study_proof))
                                                <a href="{{ asset('upload/services/study_proof/' . $services->study_proof) }}"
                                                    target="_blank" class="btn btn-info btn-sm mb-2">
                                                    View
                                                </a>
                                            @endif

                                            <input type="file" class="form-control" name="study_proof">
                                        </div>

                                        <!-- Transfer Certificate -->
                                        <div class="col-md-6 mb-3">
                                            <label>Transfer Certificate</label><br>

                                            @if (!empty($services->applicant_tc))
                                                <a href="{{ asset('upload/services/applicant_tc/' . $services->applicant_tc) }}"
                                                    target="_blank" class="btn btn-info btn-sm mb-2">
                                                    View
                                                </a>
                                            @endif

                                            <input type="file" class="form-control" name="applicant_tc">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Family Income Certificate</label><br>

                                            @if (!empty($services->income_certificate))
                                                <a href="{{ asset('upload/services/income_certificate/' . $services->income_certificate) }}"
                                                    target="_blank" class="btn btn-info btn-sm mb-2">
                                                    View
                                                </a>
                                            @endif

                                            <input type="file" class="form-control" name="income_certificate">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Employment Card</label><br>

                                            @if (!empty($services->employment_card))
                                                <a href="{{ asset('upload/services/employment_card/' . $services->employment_card) }}"
                                                    target="_blank" class="btn btn-info btn-sm mb-2">
                                                    View
                                                </a>
                                            @endif

                                            <input type="file" class="form-control" name="employment_card">
                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-between mt-5">

                                    <button type="button" class="btn btn-secondary px-3" onclick="prevStep(3)">
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
                                        <option @if ($services->status == 'Processing') selected @endif value="Processing">
                                            Processing</option>
                                        @if ($services->status != 'Approved')
                                            <option @if ($services->status == 'Rejected') selected @endif value="Rejected">
                                                Rejected</option>
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
                                    <input value="{{ $services->application_no }}" class="form-control" type="text"
                                        maxlength="20" name="application_no" id="application_no" />
                                </div>
                                <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                    <label for="certificate" class="form-label">Certificate</label>
                                    <input class="form-control" type="file" name="certificate" id="certificate" />
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
    </script>

    {{-- Add Script --}}

    <script>
        $(document).ready(function() {

            // Qualification Enable/Disable
            function loadQualification() {

                let graduation = $("input[name='graduation']:checked").val();

                $("#qualification option").prop("disabled", true);
                $("#qualification option:first").prop("disabled", false);

                if (graduation == "Yes") {
                    $("#qualification .yes-option").prop("disabled", false);
                } else if (graduation == "No") {
                    $("#qualification .no-option").prop("disabled", false);
                }
            }

            loadQualification();

            $("input[name='graduation']").change(function() {
                $("#qualification").val("");
                loadQualification();
            });


            // Year Of Passing
            function loadPassingYear() {

                let dob = $("#year_of_birth").val();

                if (dob == "") return;

                let selectedYear = "{{ $services->year_of_passing ?? '' }}";

                let birthYear = new Date(dob).getFullYear();
                let startYear = birthYear + 16;
                let currentYear = new Date().getFullYear();

                let options = '<option value="">SELECT</option>';

                for (let year = currentYear; year >= startYear; year--) {

                    let selected = (year == selectedYear) ? "selected" : "";

                    options += '<option value="' + year + '" ' + selected + '>' + year + '</option>';
                }

                $("#year_of_passing").html(options);
            }

            loadPassingYear();

            $("#year_of_birth").change(function() {
                loadPassingYear();
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
@endpush
