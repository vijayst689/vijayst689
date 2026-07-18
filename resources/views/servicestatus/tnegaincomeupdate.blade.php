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
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submittnegacommunityupdate') }}"
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
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="prevStep()">
                                                ← Previous
                                            </button>

                                            <button type="button" class="btn btn-primary btn-sm px-5"
                                                onclick="nextStep()">
                                                Next →
                                            </button>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
                <div id="step2" style="display:none;">

                    <h4 class="text-center card-header bg-success text-white mb-4">
                        Community Details
                    </h4>

                    <div class="row">

                        <!-- Father's Community -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Father's Community</label>
                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif required name="father_community"
                                id="father_community" class="form-control">

                                <option value="">Select Father's Community</option>
                                <option @if ($services->father_community == 'BC') selected @endif value="BC">BC</option>
                                <option @if ($services->father_community == 'BC Muslim') selected @endif value="BC Muslim">BC Muslim
                                </option>
                                <option @if ($services->father_community == 'OC') selected @endif value="OC">OC</option>
                                <option @if ($services->father_community == 'MBC') selected @endif value="MBC">MBC</option>
                                <option @if ($services->father_community == 'DNC/DNT') selected @endif value="DNC/DNT">DNC/DNT
                                </option>
                                <option @if ($services->father_community == 'SC') selected @endif value="SC">SC</option>
                                <option @if ($services->father_community == 'ST') selected @endif value="ST">ST</option>
                                <option @if ($services->father_community == 'SC Arunthathiyar') selected @endif value="SC Arunthathiyar">SC
                                    Arunthathiyar</option>
                            </select>
                        </div>

                        <!-- Mother's Community -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Mother's Community</label>
                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)  @endif required name="mother_community"
                                id="mother_community" class="form-control">

                                <option value="">Select Mother's Community</option>
                                <option @if ($services->mother_community == 'BC') selected @endif value="BC">BC</option>
                                <option @if ($services->mother_community == 'BC Muslim') selected @endif value="BC Muslim">BC Muslim
                                </option>
                                <option @if ($services->mother_community == 'OC') selected @endif value="OC">OC</option>
                                <option @if ($services->mother_community == 'MBC') selected @endif value="MBC">MBC</option>
                                <option @if ($services->mother_community == 'DNC/DNT') selected @endif value="DNC/DNT">DNC/DNT
                                </option>
                                <option @if ($services->mother_community == 'SC') selected @endif value="SC">SC</option>
                                <option @if ($services->mother_community == 'ST') selected @endif value="ST">ST</option>
                                <option @if ($services->mother_community == 'SC Arunthathiyar') selected @endif value="SC Arunthathiyar">SC
                                    Arunthathiyar</option>
                            </select>
                        </div>

                        <!-- Father's Caste -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Father's Caste</label>
                            <input maxlength="50" @if (Auth::user()->id != $apply_user_id) required @endif type="text"
                                class="form-control" name="father_caste" value="{{ $services->father_caste }}">
                        </div>

                        <!-- Mother's Caste -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Mother's Caste</label>
                            <input maxlength="50" @if (Auth::user()->id != $apply_user_id) required @endif type="text"
                                class="form-control" name="mother_caste" value="{{ $services->mother_caste }}">
                        </div>

                        <!-- Requested Community -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Requested Community</label>
                            <input maxlength="50" @if (Auth::user()->id != $apply_user_id) required @endif type="text"
                                class="form-control" name="requested_community"
                                value="{{ $services->requested_community }}">
                        </div>

                        <!-- Requested Caste -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label class="form-label">Requested Caste</label>
                            <input maxlength="50" @if (Auth::user()->id != $apply_user_id) required @endif type="text"
                                class="form-control" name="requeste_caste" value="{{ $services->requeste_caste }}">
                        </div>

                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            ← Previous
                        </button>

                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            Next →
                        </button>
                    </div>

                </div>
                <div id="step3" style="display:none;">

                    <div class="card shadow border-0 mt-4">

                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Community Document Details</h5>
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
                                        <input @if ($services->photo == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="photo">
                                        @if ($services->photo != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                        @endif
                                    @endif

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>2. Adress proof (Adhaar + smart card Attached file) *</label>
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->address_proof != '')
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/address_proof/{{ $services->address_proof }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <input @if ($services->address_proof == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="address_proof">
                                        @if ($services->address_proof != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/address_proof/{{ $services->address_proof }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>3. Signature</label>
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->signature != '')
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <input @if ($services->signature == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="signature">
                                        @if ($services->signature != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>4. Community Certificate of Father / Mother / Siblings *</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control"
                                        id="community" name="community" style="width: 100%;">
                                        <option value="">Select Proof
                                        </option>
                                        <option @if ($services->community == 'Community Certificate of Father') selected @endif
                                            value="Community Certificate of Father">
                                            Community Certificate of Father</option>
                                        <option @if ($services->community == 'Community Certificate of Mother') selected @endif
                                            value="Community Certificate of Mother">Community Certificate of Mother
                                        </option>
                                        <option @if ($services->community == 'Community Certificate of Siblings') selected @endif
                                            value="Community Certificate of Siblings">Community Certificate of Siblings
                                        </option>

                                    </select>
                                </div>

                                <div class="" id="community_certificate_fatherhide" style="display: none;">
                                    <label class="form-label">5. Community Certificate of Father *</label>
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->community != '')
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <input @if ($services->community_certificate == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" id="community_certificate_father" name="community_certificate">
                                        @if ($services->community != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                                <div class="" id="community_certificate_motherhide" style="display: none;">
                                    <label class="form-label">5. Community Certificate of Mother *</label>
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->community != '')
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <input @if ($services->community == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" id="community_certificate_mother" name="community_certificate">
                                        @if ($services->community != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                                <div class="" id="community_certificate_siblingshide" style="display: none;">
                                    <label class="form-label">5. Community Certificate of Siblings *</label>
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->community != '')
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <input @if ($services->community_certificate == '')  @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="community_certificate" id="community_certificate_siblings">
                                        @if ($services->community != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">

                                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                                    ← Previous
                                </button>
                            </div>

                        </div>

                    </div>
                    <div class="row">
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
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
    <script>
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var candetails = "{{ $services->can_details }}";
            var ageproof = "{{ $services->age_proof }}";
            var job_type = "{{ $services->job_type }}";
            var relationship = "{{ $services->relationship }}";
            var community = "{{ $services->community }}";

            if (job_type == "Govt") {
                $('#incomecertgovthide').show("slow");
            }

            if (ageproof == "Tc/Community Certificate") {
                $('#tc_community_certificatehide').show("slow");
            } else if (ageproof == "Marksheet") {
                $('#marksheethide').show("slow");
            } else if (ageproof == "Voter Id") {
                $('#voteridhide').show("slow");
            } else if (ageproof == "Birth Certificate") {
                $('#birth_certificatehide').show("slow");
            } else if (ageproof == "Licence") {
                $('#driving_licensehide').show("slow");
            }

             if (community == "Community Certificate of Father") {
                $('#community_certificate_fatherhide').show("slow");
            } else if (community == "Community Certificate of Mother") {
                $('#community_certificate_motherhide').show("slow");
            } else if (community == "Community Certificate of Siblings") {
                $('#community_certificate_siblingshide').show("slow");
            }

            if (relationship == "Father") {
                $('#tc').show("slow");
                $('#self').show("slow");
                $('#affidavithide').hide("slow");
            } else if (relationship == "Mother") {
                $('#tc').show("slow");
                $('#self').show("slow");
                $('#affidavithide').show("slow");
            } else if (relationship == "Brother") {
                $('#tc').show("slow");
                $('#self').show("slow");
                $('#affidavithide').show("slow");
            } else if (relationship == "Sister") {
                $('#tc').show("slow");
                $('#self').show("slow");
                $('#affidavithide').show("slow");
            }

            if (candetails == "Yes") {
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", true);
            } else if (candetails == "No") {
                $('#dobhide').hide("slow");
            }

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

        $('#incomeyearly').on('input', function() {
            var yearly = parseInt($('#incomeyearly').val());
            $('#incomemonthly').val((yearly / 12 ? yearly / 12 : 0).toFixed(2));
        });
        $('#can_details').change(function() {
            if ($('#can_details').val() == 'Yes') {
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", true);
                $('#dobhide').hide("slow");
            } else if ($('#can_details').val() == 'No') {
                window.location.href = "{{ url('applyservice') }}/" + 60;

            } else if ($('#can_details').val() == 'Find') {
                window.location.href = "{{ url('applyservice') }}/" + 121;
            } else {
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
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

        $('#relation').change(function() {
            //alert("oh");
            if ($('#relation').val() == 'Father' || $('#relation').val() == '') {
                $('#affidavithide').hide("slow");
                $('#affidavit').prop("required", false);
            } else {
                $('#affidavithide').show("slow");
                $('#affidavit').prop("required", true);
            }
        });

        $('#job_type').change(function() {
            if ($('#job_type').val() == 'Govt') {
                $('#incomecertgovthide').show("slow");
                $('#salary_slip').prop("required", true);
                $('#pancard').prop("required", true);
            } else {
                $('#incomecertgovthide').hide("slow");
                $('#salary_slip').prop("required", false);
                $('#pancard').prop("required", false);
            }
        });

        $('#age_proof').change(function() {
            if ($('#age_proof').val() == 'Tc/Community Certificate') {
                $('#tc_community_certificatehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#tc_community_certificate').prop("required", true);

            } else if ($('#age_proof').val() == 'Marksheet') {
                $('#marksheethide').show("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#marksheet').prop("required", true);

            } else if ($('#age_proof').val() == 'Voter Id') {
                $('#voteridhide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#age_proof').val() == 'Birth Certificate') {
                $('#birth_certificatehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#birth_certificate').prop("required", true);

            } else if ($('#age_proof').val() == 'Licence') {
                $('#driving_licensehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", true);

            } else {
                $('#voteridhide').hide("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);

            }
        });

$(document).ready(function () {

    $('#community').change(function () {

        if ($(this).val() == 'Community Certificate of Father') {

            $('#community_certificate_fatherhide').show("slow");
            $('#community_certificate_motherhide').hide("slow");
            $('#community_certificate_siblingshide').hide("slow");

            $('#community_certificate_father').prop("required", true);
            $('#community_certificate_mother').prop("required", false);
            $('#community_certificate_siblings').prop("required", false);

        } else if ($(this).val() == 'Community Certificate of Mother') {

            $('#community_certificate_motherhide').show("slow");
            $('#community_certificate_fatherhide').hide("slow");
            $('#community_certificate_siblingshide').hide("slow");

            $('#community_certificate_father').prop("required", false);
            $('#community_certificate_mother').prop("required", true);
            $('#community_certificate_siblings').prop("required", false);

        } else if ($(this).val() == 'Community Certificate of Siblings') {

            $('#community_certificate_siblingshide').show("slow");
            $('#community_certificate_fatherhide').hide("slow");
            $('#community_certificate_motherhide').hide("slow");

            $('#community_certificate_father').prop("required", false);
            $('#community_certificate_mother').prop("required", false);
            $('#community_certificate_siblings').prop("required", true);

        } else {

            $('#community_certificate_fatherhide').hide("slow");
            $('#community_certificate_motherhide').hide("slow");
            $('#community_certificate_siblingshide').hide("slow");

            $('#community_certificate_father').prop("required", false);
            $('#community_certificate_mother').prop("required", false);
            $('#community_certificate_siblings').prop("required", false);
        }

    });

    // Update page load ஆனதும் selected valueக்கு ஏற்ப show செய்யும்
    $('#community').trigger('change');

});
        
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
    <script>
        let currentStep = 1;

        function showStep(step) {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';

            document.getElementById('step' + step).style.display = 'block';
        }

        function nextStep() {
            if (currentStep < 3) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
        });
    </script>
@endpush


