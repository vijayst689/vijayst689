@extends('layouts.app')
@section('content')

    <style>
        /* ===== BACKGROUND ===== */
        body {
            background: linear-gradient(135deg, #0abec4, #f8fbff);
        }

        /* ===== FORM WRAPPER ===== */
        .form-wrapper {
            background: #ffffff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(13, 110, 253, 0.12);
            border: 1px solid #d6e0ff;
        }

        /* ===== SECTION SPACING ===== */
        .row.mb-3 {
            margin-bottom: 20px !important;
        }

        /* ===== LABELS ===== */
        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #0d6efd;
            /* Primary Blue */
            margin-bottom: 6px;
        }

        /* ===== INPUTS / SELECT ===== */
        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            border: 1.8px solid #adb5bd;
            background-color: #fdfefe;
            transition: all 0.25s ease-in-out;
        }

        /* ===== INPUT HOVER ===== */
        .form-control:hover {
            border-color: #0d6efd;
        }

        /* ===== INPUT FOCUS ===== */
        .form-control:focus {
            border-color: #0d6efd;
            background-color: #ffffff;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        /* ===== TEXTAREA ===== */
        textarea.form-control {
            resize: none;
        }

        /* ===== PLACEHOLDER ===== */
        ::placeholder {
            color: #6c757d;
            font-size: 13px;
        }

        /* ===== DROPDOWN ===== */
        select.form-control {
            cursor: pointer;
            background-color: #fdfefe;
        }

        /* ===== FILE UPLOAD COLORED CARDS ===== */
        #passbookhide,
        #smartcardhide,
        #voteridhide {
            background: linear-gradient(135deg, #f1f6ff, #ffffff);
            padding: 15px;
            border-radius: 14px;
            border: 2px dashed #0d6efd;
            margin-bottom: 15px;
        }

        /* ===== FILE UPLOAD LABEL ===== */
        #passbookhide label,
        #smartcardhide label,
        #voteridhide label {
            font-weight: 600;
            color: #0d6efd;
        }

        /* ===== FILE INPUT ===== */
        input[type="file"].form-control {
            border: 1px solid #0d6efd;
            background-color: #ffffff;
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 768px) {
            .form-wrapper {
                padding: 20px;
            }
        }

        .step-wrapper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background: #e9ecef;
            top: 18px;
            left: 50%;
            z-index: -1;
        }

        .step:last-child::after {
            display: none;
        }

        .step-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dee2e6;
            line-height: 38px;
            margin: auto;
            color: #fff;
            font-weight: 600;
        }

        .step.active .step-circle {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
        }

        .step.active span {
            font-weight: 600;
            color: #0d6efd;
        }

        .number-input {
            letter-spacing: 2px;
            font-weight: 600;
        }

        .invalid-field {
            border: 2px solid red !important;
        }

        .doc-card {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px 10px;
            cursor: pointer;
            transition: 0.3s ease;
            font-weight: 600;
        }

        .doc-card input[type="radio"] {
            transform: scale(1.3);
            margin-bottom: 8px;
        }

        .doc-card:hover {
            border-color: #0d6efd;
            background: #f4f8ff;
        }

        .doc-card.active {
            border-color: #0d6efd;
            background: #e9f2ff;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
        }
    </style>
    <div class="content-wrapper">
        <div class="container-lg flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>{{ $servicename }}</h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('success') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('error') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('/aadhaarcardupdate') }}" id="formAccountSettings" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                {{ csrf_field() }}
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

                                    @if ($serviceid == 158)

                                        <div class="tab-content">

                                            <!-- STEP 1 -->
                                            <div class="tab-pane fade show active" id="step1">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Aadhaar Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" class="form-control border border-dark number"
                                                            name="aadhaar_no" value="{{ $services->aadhaar_no }}"
                                                            placeholder="Aadhaar Number" maxlength="12">
                                                    </div>                                                    
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Name as per Adhaar/ஆதாரில்
                                                            இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" class="form-control border border-dark"
                                                            name="name" value="{{ $services->name }}" maxlength="100"
                                                            placeholder="Applicant Name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Relationship</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            class="form-control" id="relationship" required name="relationship"
                                                            style="width: 100%;">
                                                            <option value="">Select Any
                                                            </option>
                                                            <option @if ($services->relationship == 'S/O') selected @endif
                                                                value="S/O">S/O தந்தை பெயர்(ஆண்)
                                                            </option>
                                                            <option @if ($services->relationship == 'D/O') selected @endif
                                                                value="D/O">D/O தந்தை பெயர்(பெண்)
                                                            </option>
                                                            <option @if ($services->relationship == 'W/O') selected @endif
                                                                value="W/O">W/O (கணவர் பெயர்)
                                                            </option>                                                          
                                                            <option @if ($services->relationship == 'C/O') selected @endif
                                                               value="C/O">C/O (Legal Gaudrain)</option>
                                                        </select>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">உறவுமுறை</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            class="form-control" id="relationship_tamil" required name="relationship_tamil"
                                                            style="width: 100%;">
                                                            <option value="">Select Any
                                                            </option>
                                                            <option @if ($services->relationship_tamil == 'த/பெ') selected @endif
                                                                value="த/பெ">த/பெ -தந்தை பெயர்
                                                            </option>
                                                            <option @if ($services->relationship_tamil == 'க/பெ') selected @endif
                                                                value="க/பெ">க/பெ - கணவர் பெயர்
                                                            </option>
                                                            <option @if ($services->relationship_tamil == 'உ/பெ') selected @endif
                                                                value="உ/பெ">உ/பெ -உறவினர் பெயர்
                                                            </option>
                                                        </select>
                                                    </div> 
                                                    <div class="col-md-6">
                                                         <label class="form-label text-primary">Name In English</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" required name="relation_name_english"
                                                            value="{{ $services->relation_name_english }}"
                                                            class="form-control border border-dark" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>
                                                     <div class="col-md-6">
                                                    <label class="form-label text-primary">பெயர் தமிழில்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" required name="relation_name_tamil"
                                                            value="{{ $services->relation_name_tamil }}"
                                                            class="form-control border border-dark" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Mobile Number(Aadhaar
                                                            link)</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" class="form-control border border-dark number"
                                                            name="mobile" value="{{ $services->mobile }}"
                                                            placeholder="Mobile Number" maxlength="10">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">ஏதேனும் அடையாள ஆதாரம்</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                            class="form-control" id="id_proof" name="id_proof"
                                                            style="width: 100%;">
                                                            <option value="">Select Proof
                                                            </option>
                                                            {{-- <option @if ($services->id_proof == 'Aadhaar Card') selected @endif
                                                                value="Aadhaar Card">Aadhaar Card(Front)
                                                            </option> --}}
                                                            <option @if ($services->id_proof == 'Bank Passbook') selected @endif
                                                                value="Bank Passbook">Bank Passbook(With Photo)
                                                            </option>
                                                            <option @if ($services->id_proof == 'Smartcard Online Print') selected @endif
                                                                value="Smartcard Online Print">Smartcard Online Print
                                                            </option>
                                                            <option @if ($services->id_proof == 'Voter Id') selected @endif
                                                                value="Voter Id">Voter Id (Latest)</option>

                                                        </select>
                                                    </div>

                                                    <div class="mb-3 col-md-6">

                                                        <div class="" id="aadhaarhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->aadhaar_card != '')
                                                                    <label class="form-label text-primary">Aadhaar Card(Front)</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label class="form-label text-primary">Aadhaar
                                                                    Card(Front)</label>
                                                                <input @if ($services->aadhaar_card == '' && $services->id_proof == 'Aadhaar Card')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="aadhaar_card"
                                                                    id="aadhaar_card" data-exists="{{ $services->aadhaar_card ? 1 : 0 }}">
                                                                @if ($services->aadhaar_card != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="passbookhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->bank_pass_book != '')
                                                                    <label class="form-label text-primary">Bank
                                                                        Passbook(With
                                                                        Photo)</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label class="form-label text-primary">Bank Passbook(With
                                                                    Photo)</label>
                                                                <input @if ($services->bank_pass_book == '' && $services->id_proof == 'Bank Passbook')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="bank_pass_book"
                                                                    id="bank_pass_book" data-exists="{{ $services->bank_pass_book ? 1 : 0 }}">
                                                                @if ($services->bank_pass_book != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="smartcardhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->smartcard_onlineprint != '')
                                                                    <label class="form-label text-primary">Smartcard Online
                                                                        Print</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label class="form-label text-primary">Smartcard Online
                                                                    Print</label>
                                                                <input @if ($services->smartcard_onlineprint == '' && $services->id_proof == 'Smartcard Online Print')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png"
                                                                    name="smartcard_onlineprint"
                                                                    id="smartcard_onlineprint" data-exists="{{ $services->smartcard_onlineprint ? 1 : 0 }}">
                                                                @if ($services->smartcard_onlineprint != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="voteridhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->voterid != '')
                                                                    <label class="form-label text-primary">Voter
                                                                        Id(Latest)</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label class="form-label text-primary">Voter Id
                                                                    (Latest)</label>
                                                                <input @if ($services->voterid == '' && $services->id_proof == 'Voter Id')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="voterid"
                                                                    id="voter_id" data-exists="{{ $services->voterid ? 1 : 0 }}">
                                                                @if ($services->voterid != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-danger next-btn"
                                                        data-next="step2">Next
                                                        →</button>
                                                </div>
                                            </div>


                                            <!-- STEP 2 -->
                                            <div class="tab-pane fade" id="step2">                                              
                                                <div class="row mb-3">                                                     
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">House / Building /Apartment
                                                        </label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="apartment"
                                                            value="{{ $services->apartment }}"
                                                            class="form-control border border-dark" maxlength="30"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">வீடு/
                                                            கட்டிடம்/அபார்ட்மெண்ட்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="door_no"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->door_no }}" maxlength="30"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Street / Road / Lane</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="street_name"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->street_name }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">தெரு / சாலை / சந்து</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="street_name_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->street_name_tamil }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Area /
                                                            Locality/Sector</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="postal_area_english"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->postal_area_english }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">பகுதி /இடம் / பிரிவு</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="postal_area_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->postal_area_tamil }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">State</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="state"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->state }}" maxlength="100"
                                                            placeholder="State">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">மாநிலம்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="state_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->state_tamil }}" maxlength="100"
                                                            placeholder="மாநிலம்">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">District</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="district"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->district }}" maxlength="100"
                                                            placeholder="District">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">மாவட்டம்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="district_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->district_tamil }}" maxlength="100"
                                                            placeholder="மாவட்டம்">
                                                    </div>

                                                     <div class="col-md-6">
                                                        <label class="form-label text-primary">Taluka</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="taluka"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->taluka }}" maxlength="100"
                                                            placeholder="Taluka">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">நில எல்லைக்குறி / வட்டம்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="taluka_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->taluka_tamil }}" maxlength="100"
                                                            placeholder="நில எல்லைக்குறி / வட்டம்">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Village / Town /
                                                            City</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="village"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->village }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">கிராமம் / நகரம்/
                                                            நகரம்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="village_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->village_tamil }}" maxlength="100"
                                                            placeholder="Enter here">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Post Office</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="post_office"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->post_office }}" maxlength="100"
                                                            placeholder="Post Office">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">தபால் அலுவலகம்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" name="post_office_tamil"
                                                            class="form-control border border-dark"
                                                            value="{{ $services->post_office_tamil }}" maxlength="100"
                                                            placeholder="தபால் அலுவலகம்">
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label class="form-label text-primary">Pin Code</label>
                                                        <input type="text" name="pin_code"
                                                            class="form-control border border-dark number"
                                                            value="{{ $services->pin_code }}" maxlength="20"
                                                            placeholder="Pin Code">
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step1">←
                                                        Previous</button>
                                                    <button type="button" class="btn btn-danger next-btn"
                                                        data-next="step3">Next
                                                        →</button>
                                                </div>
                                            </div>

                                            <!-- STEP 4 (PREVIEW) -->
                                            <div class="tab-pane fade" id="step3">

                                                <div class="card">
                                                    <div class="card-body bg-light">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Address:</h6>
                                                                <p id="englishPreview"></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>முகவரி:</h6>
                                                                <p id="tamilPreview"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-3">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step2">←
                                                        Previous</button>
                                                </div>

                                            </div>
                                        </div>                                      
                                    @endif


                                    @if (Auth::user()->id != $apply_user_id)
                                        <div class="row mb=3">
                                            <div class="col-md-6">
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
                                            <div class="col-md-6" id="remarkshide" style="display :none;">
                                                <label for="remarks" class="form-label">Remarks</label>
                                                <input value="{{ $services->remarks }}" class="form-control"
                                                    type="text" name="remarks" maxlength="100" id="remarks"
                                                    placeholder="Remarks" />
                                            </div>
                                            <div class="col-md-6" id="selecthide" style="display :none;">
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
                                            <div class="col-md-6" id="acknowledgementhide" style="display :none;">
                                                <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                                <input class="form-control" type="file" name="acknowledgement"
                                                    id="acknowledgement" />
                                            </div>
                                            <div class="col-md-6" id="applicationnohide" style="display :none;">
                                                <label for="application_no" class="form-label">Application No</label>
                                                <input value="{{ $services->application_no }}" class="form-control"
                                                    type="text" maxlength="20" name="application_no"
                                                    id="application_no" />
                                            </div>
                                            <div class="col-md-6" id="selectshide" style="display :none;">
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
                                            <div class="col-md-6" id="applicationhide" style="display :none;">
                                                <label for="application" class="form-label">Application</label>
                                                <input value="{{ $services->application }}" class="form-control"
                                                    type="text" maxlength="150" name="application"
                                                    id="application" />
                                            </div>
                                            <div class="col-md-6" id="certhide" style="display :none;">
                                                <label for="certificate" class="form-label">Certificate</label>
                                                <input class="form-control" type="file" name="certificate"
                                                    id="certificate" />
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
                                </div>

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

 document.addEventListener('DOMContentLoaded', function () {

    /* ==============================
       STEP NAVIGATION
    ============================== */
    function showStep(stepId) {
        document.querySelectorAll('.tab-pane').forEach(el => {
            el.classList.remove('show', 'active');
        });

        let target = document.getElementById(stepId);
        if (target) target.classList.add('show', 'active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let currentStep = this.closest('.tab-pane');

            if (!validateStep(currentStep)) {
                scrollToError(currentStep);
                return;
            }

            showStep(this.dataset.next);
        });
    });

    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            showStep(this.dataset.prev);
        });
    });

    /* ==============================
       REQUIRED FIELDS
    ============================== */
    const requiredFields = [
        'state','state_tamil','district','district_tamil','taluka','taluka_tamil',
        'village','village_tamil','post_office','post_office_tamil','pin_code',
        'aadhaar_no','mobile','name','id_proof', // Step1 fields
    ];

    /* ==============================
       VALIDATION FUNCTION
    ============================== */
    function validateStep(step) {
        let valid = true;

        step.querySelectorAll('input, select, textarea').forEach(field => {

            // Ignore hidden / disabled / readonly / buttons
            if (field.offsetParent === null || field.disabled || field.hasAttribute('readonly')) return;
            if (field.type === 'button' || field.type === 'submit') return;

            // Reset
            field.classList.remove('is-invalid');

            let name = field.name;

            if (!requiredFields.includes(name)) return;

            // Conditional file input validation (Step 1)
            if (field.type === "file") {
                let alreadyUploaded = field.dataset.exists === "1";
                if (field.files.length === 0 && !alreadyUploaded) {
                    field.classList.add('is-invalid');
                    valid = false;
                }
            }
            // Text / Select validation
            else {
                if (field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    valid = false;
                }

                // Pin code strict check
                if (name === 'pin_code' && field.value.trim() !== '') {
                    if (!/^\d{6}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        valid = false;
                    }
                }

                // Aadhaar / Mobile specific validation
                if (name === 'aadhaar_no' && field.value.trim() !== '') {
                    if (!/^\d{12}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        valid = false;
                    }
                }
                if (name === 'mobile' && field.value.trim() !== '') {
                    if (!/^\d{10}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        valid = false;
                    }
                }
            }
        });

        // Additional Step1 conditional file check based on id_proof
        if (step.id === 'step1') {
            const idProof = step.querySelector('select[name="id_proof"]');
            if (idProof && idProof.value.trim() !== '') {
                const fileMap = {
                    'Aadhaar Card': 'aadhaar_card',
                    'Bank Passbook': 'bank_pass_book',
                    'Smartcard Online Print': 'smartcard_onlineprint',
                    'Voter Id': 'voterid'
                };
                const fileInput = step.querySelector(`input[name="${fileMap[idProof.value]}"]`);
                if (fileInput && fileInput.files.length === 0 && !fileInput.dataset.exists) {
                    fileInput.classList.add('is-invalid');
                    valid = false;
                }
            }
        }

        return valid;
    }

    /* ==============================
       SCROLL TO FIRST ERROR
    ============================== */
    function scrollToError(step) {
        let firstError = step.querySelector('.is-invalid');
        if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    /* ==============================
       REMOVE ERROR ON INPUT/CHANGE
    ============================== */
    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', () => el.classList.remove('is-invalid'));
        el.addEventListener('change', () => el.classList.remove('is-invalid'));
    });

    /* ==============================
       ADDRESS PREVIEW
    ============================== */
   function updatePreview() {
    // Helper to get input/select value safely
    const get = (name) => document.querySelector(`[name="${name}"]`)?.value || '';

    // Helper to join non-empty values
    const format = (arr) => arr.filter(v => v && v.trim() !== '').join(', ');

    // English preview
    const eng = [
        format([get('relationship'), get('apartment'), get('street_name'), get('postal_area_english')]),
        format([get('taluka'), get('village')]),
        format([get('post_office'), get('district')]),
        format([get('state'), get('pin_code')])
    ].filter(Boolean).join(', ');

    // Tamil preview
    const tam = [
        format([get('relationship_tamil'), get('door_no'), get('street_name_tamil'), get('postal_area_tamil')]),
        format([get('taluka_tamil'), get('village_tamil')]),
        format([get('post_office_tamil'), get('district_tamil')]),
        format([get('state_tamil'), get('pin_code')])
    ].filter(Boolean).join(', ');

    // Update the preview elements if they exist
    const engPreview = document.getElementById("englishPreview");
    const tamPreview = document.getElementById("tamilPreview");

    if (engPreview) engPreview.innerText = eng;
    if (tamPreview) tamPreview.innerText = tam;
}

    updatePreview();
    document.querySelectorAll("input, select").forEach(el => {
        el.addEventListener("input", updatePreview);
        el.addEventListener("change", updatePreview);
    });

    /* ==============================
       ID PROOF TOGGLE
    ============================== */
    function toggleIdProof(value) {
        $('#aadhaarhide, #passbookhide, #smartcardhide, #voteridhide').hide();
        if (value === 'Aadhaar Card') $('#aadhaarhide').show();
        if (value === 'Bank Passbook') $('#passbookhide').show();
        if (value === 'Smartcard Online Print') $('#smartcardhide').show();
        if (value === 'Voter Id') $('#voteridhide').show();
    }

    // EDIT MODE: show existing selected ID proof
   let existingIdProof = @json($services->id_proof ?? '');
    if (existingIdProof) toggleIdProof(existingIdProof);
    $('#id_proof').val(existingIdProof);

    // On change
    $('#id_proof').change(function () {
        toggleIdProof(this.value);
    });

});

                    $(function() {
                        var status = "{{ $services->status }}";
                        var acknowledgement = "{{ $services->acknowledgement }}";
                        var certificate = "{{ $services->certificate }}";
                        var selects = "{{ $services->selects }}";
                        var lects = "{{ $services->lects }}";
                        var certificate = "{{ $services->certificate }}";
                        var selects = "{{ $services->selects }}";
                        var lects = "{{ $services->lects }}";
                        var dist_id = "{{ $services->dist_id }}";
                        var taluk_id = "{{ $services->taluk_id }}";
                        var id_proof = "{{ $services->id_proof }}";

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

                    if (id_proof == "Bank Passbook") {
                        $('#passbookhide').show("slow");
                        $('#bank_pass_book').prop("required", true);
                    } else if (id_proof == "Smartcard Online Print") {
                        $('#smartcardhide').show("slow");
                        $('#smartcard_onlineprint').prop("required", true);
                    } else if (id_proof == "Voter Id") {
                        $('#voteridhide').show("slow");
                        $('#voterid').prop("required", true);
                    }

            
                    function gettaluk(dist_id) {
                        var url = "{{ url('service/get_taluk') }}/" + dist_id;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                                $.each(result, function(key, value) {
                                    $("#taluk").append('<option value="' + value
                                        .id + '">' + value.taluk_name + '</option>');
                                });
                                $("#taluk").val("{{ $services->taluk_id }}");

                            }
                        });
                    }


                    $('#enrollment_type').change(function() {
                        if ($('#enrollment_type').val() == 'Enrollment Slip') {
                            $('#ensliphide').show("slow");
                            $('#ennumberhide').hide("slow");
                            $('#enslip').prop("required", true);
                            $('#ennumber').prop("required", false);
                        } else if ($('#enrollment_type').val() == 'Enrollment Number') {
                            $('#ennumberhide').show("slow");
                            $('#ensliphide').hide("slow");
                            $('#enslip').prop("required", false);
                            $('#ennumber').prop("required", true);
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

                    function gettaluk(dist_id) {
                        var url = "{{ url('service/get_taluk') }}/" + dist_id;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                                $.each(result, function(key, value) {
                                    $("#taluk").append('<option value="' + value
                                        .id + '">' + value.taluk_name + '</option>');
                                });
                                $("#taluk").val("{{ $services->taluk_id }}");

                            }
                        });
                    }

                    function getpanchayath(taluk_id) {
                        var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                                $.each(result, function(key, value) {
                                    $("#panchayath").append('<option value="' + value
                                        .id + '">' + value.panchayath_name + '</option>');
                                });
                                $("#panchayath").val("{{ $services->panchayath_id }}");

                            }
                        });
                    }

                    $('#id_proof').change(function() {
                        if ($('#id_proof').val() == 'Bank Passbook') {
                            $('#passbookhide').show("slow");
                            $('#smartcardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#bank_pass_book').prop("required", true);

                        } else if ($('#id_proof').val() == 'Smartcard Online Print') {
                            $('#smartcardhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#passbookhide').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", true);

                        } else if ($('#id_proof').val() == 'Voter Id') {
                            $('#voteridhide').show("slow");
                            $('#smartcardhide').hide("slow");
                            $('#passbookhide').hide("slow");
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#voterid').prop("required", true);

                        } else {
                            $('#passbookhide').hide("slow");
                            $('#smartcardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#voterid').prop("required", false);

                        }
                    });                  

                    document.getElementById("myForm").addEventListener("submit", function() {
                        const btn = document.getElementById("save");
                        btn.disabled = true;
                        btn.innerText = "Submitting...";
                    });
                </script>
            @endpush
