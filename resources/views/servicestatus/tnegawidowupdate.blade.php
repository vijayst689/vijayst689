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
                            <form class="row g-4" action="{{ url('submittnegawidowupdate') }}" enctype="multipart/form-data"
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

                                                    <div class="row g-3">

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Relationship / உறவு
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <select required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                name="relationship"
                                                                class="form-select form-select-lg rounded-3">

                                                                <option value="">-- Select Relationship --</option>

                                                                <option value="Husband"
                                                                    {{ $services->relationship == 'Husband' ? 'selected' : '' }}>
                                                                    Husband / கணவர்
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Father / Husband / Guardian Name
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" name="guardian_name"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="Enter Father / Husband / Guardian Name"
                                                                maxlength="100" value="{{ $services->guardian_name }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                தந்தை / கணவர் / பாதுகாவலர் பெயர் (தமிழில்)
                                                            </label>

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" name="guardian_name_tamil"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="தந்தை / கணவர் / பாதுகாவலர் பெயர்"
                                                                maxlength="100"
                                                                value="{{ $services->guardian_name_tamil }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Spouse Name
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" name="spouse_name"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="Enter Spouse Name" maxlength="100"
                                                                value="{{ $services->spouse_name }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                கணவரின் பெயர் (தமிழில்)
                                                            </label>

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" name="spouse_name_tamil"
                                                                class="form-control form-control-lg rounded-3"
                                                                placeholder="கணவரின் பெயர்" maxlength="200"
                                                                value="{{ $services->spouse_name_tamil }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Date of Marriage
                                                            </label>

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="date" name="date_of_marriage"
                                                                class="form-control form-control-lg rounded-3"
                                                                value="{{ $services->date_of_marriage }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Date of Death
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="date" name="date_of_death"
                                                                class="form-control form-control-lg rounded-3"
                                                                value="{{ $services->date_of_death }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                Death Certificate Number
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input required
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" name="death_certificate_no"
                                                                class="form-control form-control-lg rounded-3 number"
                                                                placeholder="Enter Death Certificate Number"
                                                                maxlength="50"
                                                                value="{{ $services->death_certificate_no }}">
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

                                                        {{-- Photo --}}
                                                        <div class="col-md-6 mb-3">
                                                            <label>Photo <span class="text-danger">*</span></label>

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

                                                        {{-- Address Proof --}}
                                                        <div class="col-md-6 mb-3">
                                                            <label>Any Address Proof <span
                                                                    class="text-danger">*</span></label>

                                                            @if (!empty($services->address_proof))
                                                                <p>
                                                                    <a href="{{ asset('upload/services/address_proof/' . $services->address_proof) }}"
                                                                        target="_blank" class="btn btn-sm btn-success">
                                                                        View
                                                                    </a>
                                                                </p>
                                                            @endif

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="file" name="address_proof" class="form-control"
                                                                accept=".jpg,.jpeg,.png,.pdf">
                                                        </div>

                                                        {{-- Death Certificate --}}
                                                        <div class="col-md-6 mb-3">
                                                            <label>Death Certificate of Husband
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            @if (!empty($services->death_certificate_husband))
                                                                <p>
                                                                    <a href="{{ asset('upload/services/death_certificate_husband/' . $services->death_certificate_husband) }}"
                                                                        target="_blank" class="btn btn-sm btn-success">
                                                                        View
                                                                    </a>
                                                                </p>
                                                            @endif

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="file" name="death_certificate_husband"
                                                                class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                                                        </div>

                                                        {{-- Marriage Proof --}}
                                                        <div class="col-md-6 mb-3">
                                                            <label>Marriage Registration Certificate / Marriage Proof
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            @if (!empty($services->marriage_proof))
                                                                <p>
                                                                    <a href="{{ asset('upload/services/marriage_proof/' . $services->marriage_proof) }}"
                                                                        target="_blank" class="btn btn-sm btn-success">
                                                                        View
                                                                    </a>
                                                                </p>
                                                            @endif

                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="file" name="marriage_proof" class="form-control"
                                                                accept=".jpg,.jpeg,.png,.pdf">
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
                                                <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                                    <label for="select" class="form-label">Select</label>
                                                    <select class="form-control" name="selects" id="select">
                                                        <option>select</option>
                                                        <option @if ($services->selects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->selects == 'File') selected @endif
                                                            value = "File">
                                                            File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="acknowledgementhide"
                                                    style="display :none;">
                                                    <label for="acknowledgement"
                                                        class="form-label">Acknowledgement</label>
                                                    <input class="form-control" type="file" name="acknowledgement"
                                                        id="acknowledgement" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                                    <label for="application_no" class="form-label">Application No</label>
                                                    <input value="{{ $services->application_no }}" class="form-control"
                                                        type="text" maxlength="20" name="application_no"
                                                        id="application_no" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                                    <label for="selects" class="form-label">Select</label>
                                                    <select class="form-control" name="lects" id="selects">
                                                        <option>select</option>
                                                        <option @if ($services->lects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->lects == 'File') selected @endif
                                                            value = "File">
                                                            File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                                    <label for="application" class="form-label">Application</label>
                                                    <input value="{{ $services->application }}" class="form-control"
                                                        type="text" maxlength="150" name="application"
                                                        id="application" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                                    <label for="certificate" class="form-label">Certificate</label>
                                                    <input class="form-control" type="file" name="certificate"
                                                        id="certificate" />
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
                    var selects = "{{ $services->selects }}";
                    var lects = "{{ $services->lects }}";

                    var dist_id = "{{ $services->dist_id }}";
                    var taluk_id = "{{ $services->taluk_id }}";
                    gettaluk(dist_id);
                    getpanchayath(taluk_id);

                    if (status == "Resubmit") {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", true);

                    } else if (status == "Processing") {
                        if (selects == "Text") {
                            $('#applicationnohide').show("slow");
                        }
                        if (selects == "File") {
                            $('#acknowledgementhide').show("slow");
                            if (acknowledgement == "") {
                                $('#acknowledgement').prop("required", true);
                            }
                        }
                        $('#selecthide').show("slow");

                    } else if (status == "Approved") {
                        if (lects == "Text") {
                            $('#applicationhide').show("slow");
                        }
                        if (lects == "File") {
                            $('#certhide').show("slow");
                            if (certificate == "") {
                                $('#certificate').prop("required", true);
                            }
                        }
                        $('#selectshide').show("slow")
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
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    } else if ($('#service_status').val() == 'Processing') {
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", true);
                        $('#selecthide').show("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    } else if ($('#service_status').val() == 'Approved') {
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", true);
                        $('#selectshide').show("slow");
                    } else {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    }
                });

                $('#select').change(function() {
                    if ($('#select').val() == 'Text') {
                        $('#applicationnohide').show("slow");
                        $('#application_no').prop("required", true);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                    } else if ($('#select').val() == 'File') {
                        $('#acknowledgementhide').show("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                    } else {
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                    }
                });

                $('#selects').change(function() {
                    if ($('#selects').val() == 'Text') {
                        $('#applicationhide').show("slow");
                        $('#application').prop("required", true);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                    } else if ($('#selects').val() == 'File') {
                        $('#certhide').show("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                    } else {
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
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


