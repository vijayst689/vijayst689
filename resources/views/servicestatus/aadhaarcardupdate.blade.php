@extends('layouts.app')
@section('content')
    <style>
        .form-label {
            color: #28a745 !important;
            /* green */
            font-weight: 600;
        }
    </style>
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

                                    @if ($serviceid == 56)
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Aadhaar Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->aadhaar_no }}"
                                                    class="form-control border border-dark text-dark" name="aadhaar_no"
                                                    maxlength="12" placeholder="Aadhaar Number" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobile" class="form-label">Mobile Number (Aadhaar
                                                    link)</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->mobile }}"
                                                    class="form-control border border-dark text-dark" name="mobile"
                                                    maxlength="30" placeholder="Mobile Number" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Name as per Adhaar/ஆதாரில்
                                                    இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->name }}"
                                                    class="form-control border border-dark text-dark" name="name"
                                                    maxlength="30" placeholder="Applicant Name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="door_no" class="form-label">Door Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->door_no }}"
                                                    class="form-control border border-dark text-dark" name="door_no"
                                                    maxlength="30" placeholder="Door Number" />
                                            </div>
                                        </div>
                                        <div class="row mb=3">
                                            <div class="col-md-6">
                                                <label for="address_english" class="form-label">Address In English</label>
                                                <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                    value="{{ $services->address_english }}" class="form-control border border-dark text-dark" name="address_english"
                                                    maxlength="200" placeholder="Address In English">{{ $services->address_english }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address_tamil" class="form-label">முகவரி தமிழில்</label>
                                                <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                    value="{{ $services->address_tamil }}" class="form-control border border-dark text-dark" name="address_tamil"
                                                    maxlength="200" placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb=3">
                                            <div class="col-md-6">
                                                <label for="dist_id" class="form-label">District</label>
                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                    id="dist_id" class="form-control border border-dark text-dark">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option @if ($d->id == $services->dist_id) selected @endif
                                                            value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="taluk_id" class="form-label text-primary">Taluk</label>
                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="taluk_id"
                                                    id="taluk" class="form-control border border-dark text-dark">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb=3">
                                            <div class="col-md-6">
                                                <label for="postal_area_english" class="form-label">Postal Area</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->postal_area_english }}"
                                                    class="form-control border border-dark text-dark"
                                                    name="postal_area_english" maxlength="100"
                                                    placeholder="Postal Area" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pin_code" class="form-label">Pin code</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->pin_code }}"
                                                    class="form-control border border-dark text-dark" name="pin_code"
                                                    maxlength="30" placeholder="Enter pin code" />
                                            </div>
                                        </div>
                                        <div class="row mb=3">
                                            <div class="col-md-6">
                                                <label>ஏதேனும் அடையாள ஆதாரம்</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                    class="form-control" id="id_proof" name="id_proof"
                                                    style="width: 100%;">
                                                    <option value="">Select Proof
                                                    </option>
                                                    <option @if ($services->id_proof == 'Bank Passbook') selected @endif
                                                        value="Bank Passbook">Bank Passbook(With Photo)
                                                    </option>
                                                    <option @if ($services->id_proof == 'Smartcard Online Print') selected @endif
                                                        value="Smartcard Online Print">Smartcard Online Print
                                                    </option>
                                                    <option @if ($services->id_proof == 'Voter Id') selected @endif
                                                        value="Voter Id">
                                                        Voter Id</option>

                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <div class="" id="passbookhide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->bank_pass_book != '')
                                                            <label>Bank Passbook(With Photo)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Bank Passbook(With Photo)</label>
                                                        <input @if ($services->bank_pass_book == '' && $services->id_proof == 'Bank Passbook')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="bank_pass_book"
                                                            id="bank_pass_book">
                                                        @if ($services->bank_pass_book != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="smartcardhide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->smartcard_onlineprint != '')
                                                            <label>Smartcard Online Print</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Smartcard Online Print</label>
                                                        <input @if ($services->smartcard_onlineprint == '' && $services->id_proof == 'Smartcard Online Print')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="smartcard_onlineprint"
                                                            id="smartcard_onlineprint">
                                                        @if ($services->smartcard_onlineprint != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="voteridhide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->voterid != '')
                                                            <label>Voter Id (Latest)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Voter Id (Latest)</label>
                                                        <input @if ($services->voterid == '' && $services->id_proof == 'Voter Id')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="voterid" id="voter_id">
                                                        @if ($services->voterid != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 58)
                                        <div class="step-wrapper">
                                            <div class="step active" id="step1-indicator" data-step="1">
                                                <div class="step-circle">1</div>
                                                <span>Applicant</span>
                                            </div>
                                            <div class="step" id="step2-indicator" data-step="2">
                                                <div class="step-circle">2</div>
                                                <span>Family</span>
                                            </div>
                                            <div class="step" id="step3-indicator" data-step="3">
                                                <div class="step-circle">3</div>
                                                <span>Address</span>
                                            </div>
                                        </div>

                                        <div class="tab-content">

                                            <!-- ================= Applicant ================= -->
                                            <div class="tab-pane fade show active" id="step1" data-step="1">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label>Applicant Name As Per Aadhaar</label>
                                                        <input type="text" class="form-control" name="applicant_name"
                                                            placeholder="Enter Name as per Aadhaar" maxlength="100"
                                                            required value="{{ $services->name ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Applicant Aadhaar Number</label>
                                                        <input type="text" id="applicant_aadhaar"
                                                            class="form-control number-input aadhaar-input"
                                                            name="applicant_aadhaar"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required value="{{ $services->aadhaar_no ?? '' }}">
                                                        <small class="text-danger d-none" id="aadhaar_error">
                                                            Aadhaar must be exactly 12 digits
                                                        </small>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Aadhaar Linked Mobile</label>
                                                        <input type="text"
                                                            class="form-control number-input mobile-input"
                                                            name="applicant_mobile"
                                                            placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                            minlength="10" pattern="[0-9]{10}" inputmode="numeric"
                                                            required value="{{ $services->mobile ?? '' }}">
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <label class="fw-semibold">Applicant Documents (Upload Any
                                                            One)</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <!-- Aadhaar -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="aadhaar" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'aadhaar' ? 'checked' : '' }}
                                                                        required>
                                                                    <div>Aadhaar Front</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_aadhaar">
                                                                    <input type="file" name="aadhaar_card"
                                                                        class="form-control">
                                                                    @if (!empty($services->aadhaar_card))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->aadhaar_card) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- School ID -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="school" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'school' ? 'checked' : '' }}>
                                                                    <div>School ID</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_school">
                                                                    <input type="file" name="schl_id_card"
                                                                        class="form-control">
                                                                    @if (!empty($services->schl_id_card))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->schl_id_card) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Birth Certificate -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="birth" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'birth' ? 'checked' : '' }}>
                                                                    <div>Birth Certificate</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_birth">
                                                                    <input type="file" name="birth_certificate"
                                                                        class="form-control">
                                                                    @if (!empty($services->birth_certificate))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->birth_certificate) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Photo -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="photo" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'photo' ? 'checked' : '' }}>
                                                                    <div>Photo</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_photo">
                                                                    <input type="file" name="photo"
                                                                        class="form-control">
                                                                    @if (!empty($services->photo))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->photo) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="text-end mt-4">
                                                    <button type="button" class="btn btn-primary next-btn"
                                                        data-next="step2">
                                                        Next →
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- ================= Family ================= -->
                                            <div class="tab-pane fade" id="step2" data-step="2">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label>உறவுமுறை</label>
                                                        <select class="form-control" id="relationship"
                                                            name="relationship" required>
                                                            <option value="">Select any</option>
                                                            <option
                                                                {{ $services->relationship == 'Father' ? 'selected' : '' }}
                                                                value="Father">Father</option>
                                                            <option
                                                                {{ $services->relationship == 'Mother' ? 'selected' : '' }}
                                                                value="Mother">Mother</option>
                                                            <option
                                                                {{ $services->relationship == 'Legal Guardian' ? 'selected' : '' }}
                                                                value="Legal Guardian">Legal Guardian</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Name As Per Aadhaar</label>
                                                        <input type="text" id="parent_name" name="parent_name"
                                                            class="form-control"
                                                            placeholder="Enter Parent Name as per Aadhaar" maxlength="200"
                                                            required value="{{ $services->parent_name ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Aadhaar Number</label>
                                                        <input type="text" id="parent_aadhaar" name="parent_aadhaar"
                                                            class="form-control number-input aadhaar-input"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required value="{{ $services->parent_aadhaar ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Aadhaar Linked Mobile</label>
                                                        <input type="text" name="parent_mobile"
                                                            class="form-control number-input mobile-input"
                                                            placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                            minlength="10" pattern="[0-9]{10}" inputmode="numeric"
                                                            required value="{{ $services->parent_mobile ?? '' }}">
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <label class="fw-semibold">Documents (Upload Any One)</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <!-- Aadhaar -->
                                                            <div class="col-md-4">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="aadhaar" class="doc-radio"
                                                                        {{ $services->parent_document_type == 'aadhaar' ? 'checked' : '' }}
                                                                        required>
                                                                    <div>Aadhaar Card Front Page</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_aadhaar">
                                                                    <input type="file" name="parent_aadhaar_front"
                                                                        class="form-control">
                                                                    @if (!empty($services->parent_aadhaar_front))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->parent_aadhaar_front) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Voter -->
                                                            <div class="col-md-4">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="voter"
                                                                        {{ $services->parent_document_type == 'voter' ? 'checked' : '' }}
                                                                        class="doc-radio">
                                                                    <div>Voter ID (Latest)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_voter">
                                                                    <input type="file" name="voterid"
                                                                        class="form-control">
                                                                    @if (!empty($services->voterid))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->voterid) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Bank -->
                                                            <div class="col-md-4">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="bank"
                                                                        {{ $services->parent_document_type == 'bank' ? 'checked' : '' }}
                                                                        class="doc-radio">
                                                                    <div>Bank Passbook (With Photo)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_bank">
                                                                    <input type="file" name="bank_pass_book"
                                                                        class="form-control">
                                                                    @if (!empty($services->bank_pass_book))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->bank_pass_book) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step1">
                                                        ← Previous
                                                    </button>
                                                    <button type="button" class="btn btn-primary next-btn"
                                                        data-next="step3">
                                                        Next →
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- ================= Address ================= -->
                                            <div class="tab-pane fade" id="step3" data-step="3">

                                                <div class="alert alert-warning small">
                                                    தந்தை/தாய்/வாரிசுதாரின் ஆதார் அட்டையில் முகவரி சரியாக இருக்க வேண்டும்
                                                    அல்லது தந்தை/தாய் /வாரிசுதாரின் ஆதாரில் முகவரி மாற்றம் செய்த பின்னர்
                                                    விண்ணப்பம் செய்யவும்.
                                                    குழந்தைகள் தந்தை/தாய்/பாதுகாவலரின் முகவரியில் வசிப்பதால் அவர்களது முகவரி
                                                    மற்றும் C/O. அவர்களின் பெயருடன் வரும் ஆகவே உறுவினர் யார் என்பதை சரியாக
                                                    தேர்வு செய்து அவர்களது முகவரியும் சரிபார்ப்பு செய்யவும்
                                                </div>

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label>Relative Address in English</label>
                                                        <textarea class="form-control" name="relative_address_english" id="relative_address_english"
                                                            placeholder="Relative Address in English" maxlength="500" rows="3" required>{{ $services->relative_address_english }}</textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Address Preview</label>
                                                        <div class="border rounded-3 p-3 bg-light shadow-sm">
                                                            <h6 class="mb-2 fw-bold" id="preview_co">
                                                                C/O. ..........................
                                                            </h6>

                                                            <p class="mb-0" id="preview_address">
                                                                Address, ..........................
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>உறவினர் முகவரி தமிழில்</label>
                                                        <textarea class="form-control" name="relative_address_tamil" id="relative_address_tamil"
                                                            placeholder="உறவினர் முகவரி தமிழில்" maxlength="500" rows="3" required>{{ $services->relative_address_tamil }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step2">
                                                        ← Previous
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 158)
                                        <div class="step-wrapper">
                                            <div class="step active" id="step1-indicator" data-step="1">
                                                <div class="step-circle">1</div>
                                                <span style="font-size:20px;" class="text-dark">Applicant</span>
                                            </div>
                                            <div class="step" id="step2-indicator" data-step="2">
                                                <div class="step-circle">2</div>
                                                <span style="font-size:20px;" class="text-dark">Family</span>
                                            </div>
                                            <div class="step" id="step3-indicator" data-step="3">
                                                <div class="step-circle">3</div>
                                                <span style="font-size:20px;" class="text-dark">Address</span>
                                            </div>
                                        </div>

                                        <div class="tab-content">

                                            <!-- ================= Applicant ================= -->
                                            <div class="tab-pane fade show active" id="step1" data-step="1">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Applicant
                                                            Name As Per Aadhaar</label>
                                                        <input type="text" class="form-control text-dark"
                                                            name="applicant_name" placeholder="Enter Name as per Aadhaar"
                                                            maxlength="100" required value="{{ $services->name ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Applicant
                                                            Aadhaar Number</label>
                                                        <input type="text" id="applicant_aadhaar"
                                                            class="form-control number-input aadhaar-input text-dark"
                                                            name="applicant_aadhaar"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required value="{{ $services->aadhaar_no ?? '' }}">
                                                        <small class="text-danger d-none" id="aadhaar_error">
                                                            Aadhaar must be exactly 12 digits
                                                        </small>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Aadhaar
                                                            Linked Mobile</label>
                                                        <input type="text"
                                                            class="form-control number-input mobile-input text-dark"
                                                            name="applicant_mobile"
                                                            placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                            minlength="10" pattern="[0-9]{10}" inputmode="numeric"
                                                            required value="{{ $services->mobile ?? '' }}">
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <label style="color: #c7681b; font-size:16px; font-weight:600;"
                                                            class="fw-semibold">Applicant Documents (Upload Any
                                                            One)</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <!-- Aadhaar -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="aadhaar" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'aadhaar' ? 'checked' : '' }}
                                                                        required>
                                                                    <div>Aadhaar Front</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_aadhaar">
                                                                    <input type="file" name="aadhaar_card"
                                                                        class="form-control">
                                                                    @if (!empty($services->aadhaar_card))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->aadhaar_card) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Smartcard Online Print -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="smartcard" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'smartcard' ? 'checked' : '' }}>
                                                                    <div>Smartcard Online Print</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_smartcard">
                                                                    <input type="file" name="smartcard_onlineprint"
                                                                        class="form-control">
                                                                    @if (!empty($services->smartcard_onlineprint))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->smartcard_onlineprint) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Voter Id -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="voterid" class="doc-radio"
                                                                        {{ $services->applicant_document_type == 'voterid' ? 'checked' : '' }}>
                                                                    <div>Voter Id (Latest)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_voterid">
                                                                    <input type="file" name="voterid"
                                                                        class="form-control">
                                                                    @if (!empty($services->voterid))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/doctype/' . $services->voterid) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="text-end mt-4">
                                                    <button type="button" class="btn btn-purple next-btn"
                                                        data-next="step2">
                                                        Next →
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- ================= Family ================= -->
                                            <div class="tab-pane fade" id="step2" data-step="2">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">உறவுமுறை</label>
                                                        <select class="form-control text-dark" id="relationship"
                                                            name="relationship" required>
                                                            <option value="">Select any</option>
                                                            <option
                                                                {{ $services->relationship == 'Father' ? 'selected' : '' }}
                                                                value="Father">Father</option>
                                                            <option
                                                                {{ $services->relationship == 'Mother' ? 'selected' : '' }}
                                                                value="Mother">Mother</option>
                                                            <option
                                                                {{ $services->relationship == 'Legal Guardian' ? 'selected' : '' }}
                                                                value="Legal Guardian">Legal Guardian</option>
                                                            <option
                                                                {{ $services->relationship == 'Child or Ward' ? 'selected' : '' }}
                                                                value="Child or Ward">Child/Ward</option>
                                                            <option
                                                                {{ $services->relationship == 'Sibling' ? 'selected' : '' }}
                                                                value="Sibling">Sibling</option>
                                                            <option
                                                                {{ $services->relationship == 'Spouse' ? 'selected' : '' }}
                                                                value="Spouse">Spouse</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Marital
                                                            Status</label>
                                                        <select class="form-control text-dark" id="marital_status"
                                                            name="marital_status" required>
                                                            <option value="">Select Marital Status</option>
                                                            <option
                                                                {{ $services->marital_status == 'Married' ? 'selected' : '' }}
                                                                value="Married">Married</option>
                                                            <option
                                                                {{ $services->marital_status == 'Divorced' ? 'selected' : '' }}
                                                                value="Divorced">Divorced</option>
                                                            <option
                                                                {{ $services->marital_status == 'Widowed' ? 'selected' : '' }}
                                                                value="Widowed">Widowed</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Relation
                                                            Name As Per Aadhaar</label>
                                                        <input type="text" id="relation_name" name="relation_name"
                                                            class="form-control text-dark"
                                                            placeholder="Enter Relation Name as per Aadhaar"
                                                            maxlength="200" required
                                                            value="{{ $services->relation_name ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Relation
                                                            Aadhaar Number</label>
                                                        <input type="text" id="relation_aadhaar"
                                                            name="relation_aadhaar"
                                                            class="form-control number-input aadhaar-input text-dark"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required value="{{ $services->relation_aadhaar ?? '' }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Relation
                                                            Aadhaar Linked Mobile</label>
                                                        <input type="text" name="relation_mobile"
                                                            class="form-control number-input mobile-input text-dark"
                                                            placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                            minlength="10" pattern="[0-9]{10}" inputmode="numeric"
                                                            required value="{{ $services->relation_mobile ?? '' }}">
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <label style="color: #c7681b; font-size:16px; font-weight:600;"
                                                            class="fw-semibold">Documents (Upload Any One)</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <!-- Aadhaar -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="aadhaar" class="doc-radio"
                                                                        {{ $services->parent_document_type == 'aadhaar' ? 'checked' : '' }}
                                                                        required>
                                                                    <div>Aadhaar Card Front Page</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_aadhaar">
                                                                    <input type="file" name="parent_aadhaar_front"
                                                                        class="form-control">
                                                                    @if (!empty($services->parent_aadhaar_front))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->parent_aadhaar_front) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Voter -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="voter"
                                                                        {{ $services->parent_document_type == 'voter' ? 'checked' : '' }}
                                                                        class="doc-radio">
                                                                    <div>Voter ID (Latest)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_voter">
                                                                    <input type="file" name="voterid"
                                                                        class="form-control">
                                                                    @if (!empty($services->voterid))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->voterid) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Bank -->
                                                            <div class="col-md-4">
                                                                <label
                                                                    style="color: #c7681b; font-size:16px; font-weight:600;"
                                                                    class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="bank"
                                                                        {{ $services->parent_document_type == 'bank' ? 'checked' : '' }}
                                                                        class="doc-radio">
                                                                    <div>Bank Passbook (With Photo)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_bank">
                                                                    <input type="file" name="bank_pass_book"
                                                                        class="form-control">
                                                                    @if (!empty($services->bank_pass_book))
                                                                        <small class="text-success">
                                                                            Existing:
                                                                            <a href="{{ asset('upload/services/parentdoctype/' . $services->bank_pass_book) }}"
                                                                                target="_blank">
                                                                                View File
                                                                            </a>
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step1">
                                                        ← Previous
                                                    </button>
                                                    <button type="button" class="btn btn-purple next-btn"
                                                        data-next="step3">
                                                        Next →
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- ================= Address ================= -->
                                            <div class="tab-pane fade" id="step3" data-step="3">

                                                <div class="alert alert-warning small">
                                                    நீங்கள் பதிவு செய்யும் உறவினர் பெயர் மற்றும் முகவரியை சரிபார்க்கவும்
                                                    ஆதார் அட்டையில் பெயர் மற்றும் முகவரி சரியாக இருக்க வேண்டும் அல்லது
                                                    கணவர்/தந்தை/தாய் /வாரிசுதாரின் ஆதாரில் முகவரி மாற்றம் செய்த பின்னர்
                                                    விண்ணப்பம் செய்யவும்.
                                                </div>

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">Relative
                                                            Address in English</label>
                                                        <textarea class="form-control text-dark" name="relative_address_english" id="relative_address_english"
                                                            placeholder="Relative Address in English" maxlength="500" rows="3" required>{{ $services->relative_address_english }}</textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label style="color: #c7681b; font-size:16px; font-weight:600;"
                                                            class="form-label fw-semibold">Address Preview</label>
                                                        <div class="border rounded-3 p-3 bg-light shadow-sm">
                                                            <h6 class="mb-2 fw-bold" id="preview_co">
                                                                C/O. ..........................
                                                            </h6>

                                                            <p class="mb-0" id="preview_address">
                                                                Address, ..........................
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label
                                                            style="color: #c7681b; font-size:16px; font-weight:600;">உறவினர்
                                                            முகவரி தமிழில்</label>
                                                        <textarea class="form-control text-dark" name="relative_address_tamil" id="relative_address_tamil"
                                                            placeholder="உறவினர் முகவரி தமிழில்" maxlength="500" rows="3" required>{{ $services->relative_address_tamil }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step2">
                                                        ← Previous
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 159)
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->enrollment_slip != '')
                                                    <label>Enrollment slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/enrollment_slip/{{ $services->enrollment_slip }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Enrollment slip</label>
                                                <input @if ($services->enrollment_slip == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="enrollment_slip">
                                                @if ($services->enrollment_slip != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/enrollment_slip/{{ $services->enrollment_slip }}">Download</a><br>
                                                @endif
                                            @endif
                                            <br>
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card(Front & Back)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card(Front & Back)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->correction_proof != '')
                                                    <label>Correction proof</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/correction_proof/{{ $services->correction_proof }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Correction proof</label>
                                                <input @if ($services->correction_proof == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="correction_proof">
                                                @if ($services->correction_proof != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/correction_proof/{{ $services->correction_proof }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 160 || $serviceid == 161)
                                        <div class="mb-3 col-md-6">
                                            <label for="enrollment_type" class="form-label">Enrollment Type</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="enrollment_type" id="enrollment_type">
                                                <option value="">Select</option>
                                                <option @if ($services->enrollment_type == 'Enrollment Slip') selected @endif
                                                    value="Enrollment Slip">Enrollment Slip
                                                </option>
                                                <option @if ($services->enrollment_type == 'Enrollment Number') selected @endif
                                                    value="Enrollment Number">Enrollment Number
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="" id="ensliphide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->enrollment_slip != '')
                                                        <label>Enrollment Slip</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/enrollment_slip/{{ $services->enrollment_slip }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Enrollment Slip</label>
                                                    <input @if ($services->enrollment_slip == '')  @endif class="form-control"
                                                        id="enslip" type="file" accept="image/jpeg, image/png"
                                                        name="enrollment_slip">
                                                    @if ($services->enrollment_slip != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/enrollment_slip/{{ $services->enrollment_slip }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="ennumberhide" style="display: none;">
                                                <label for="enrollment_no" class="form-label">Enrollment Number</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->enrollment_no }}" class="form-control number"
                                                    name="enrollment_no" id="ennumber" maxlength="20"
                                                    placeholder="Enrollment Number">
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 162)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name as Per Adhaar</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name as Per Adhaar">

                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile">
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->aadhaar_no }}"
                                                class="form-control number" name="aadhaar_no" maxlength="12"
                                                placeholder="Aadhaar Number">

                                        </div>
                                    @elseif ($serviceid == 163)
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->aadhaar_no }}"
                                                class="form-control number" name="aadhaar_no" maxlength="12"
                                                placeholder="Aadhaar Number">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" maxlength="30" value="{{ $services->name }}"
                                                class="form-control" name="name" placeholder="Name" />
                                        </div>

                                    @endif
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
                                            <input value="{{ $services->remarks }}" class="form-control" type="text"
                                                name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                            <label for="select" class="form-label">Select</label>
                                            <select class="form-control" name="selects" id="select">
                                                <option>select</option>
                                                <option @if ($services->selects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($services->selects == 'File') selected @endif value = "File">
                                                    File</option>
                                            </select>
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
                                        <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                            <label for="selects" class="form-label">Select</label>
                                            <select class="form-control" name="lects" id="selects">
                                                <option>select</option>
                                                <option @if ($services->lects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($services->lects == 'File') selected @endif value = "File">
                                                    File</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                            <label for="application" class="form-label">Application</label>
                                            <input value="{{ $services->application }}" class="form-control"
                                                type="text" maxlength="150" name="application" id="application" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="certhide" style="display :none;">
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
        document.addEventListener('DOMContentLoaded', function() {

            /* ==============================
               APPLICANT DOCUMENT (STEP 1)
            ============================== */

            function handleApplicantChange(radio) {

                document.querySelectorAll('#step1 .doc-upload').forEach(div => {
                    div.classList.add('d-none');
                });

                document.querySelectorAll('#step1 .doc-card').forEach(card => {
                    card.classList.remove('active');
                });

                let selected = radio.value;
                let uploadDiv = document.getElementById('applicant_upload_' + selected);

                if (uploadDiv) {
                    uploadDiv.classList.remove('d-none');

                    let fileInput = uploadDiv.querySelector('input[type="file"]');

                    // Required only if no existing file link
                    if (fileInput && !uploadDiv.querySelector('a')) {
                        fileInput.required = true;
                    }
                }

                radio.closest('.doc-card').classList.add('active');
            }

            document.querySelectorAll('input[name="applicant_document_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    handleApplicantChange(this);
                });
            });

            /* AUTO SHOW ON EDIT */
            let checkedApplicant = document.querySelector('input[name="applicant_document_type"]:checked');
            if (checkedApplicant) {
                handleApplicantChange(checkedApplicant);
            }

            /* ==============================
               PARENT DOCUMENT (STEP 2)
            ============================== */

            function handleParentChange(radio) {

                document.querySelectorAll('#step2 .doc-upload').forEach(div => {
                    div.classList.add('d-none');
                });

                document.querySelectorAll('#step2 .doc-card').forEach(card => {
                    card.classList.remove('active');
                });

                let selected = radio.value;
                let uploadDiv = document.getElementById('upload_' + selected);

                if (uploadDiv) {
                    uploadDiv.classList.remove('d-none');

                    let fileInput = uploadDiv.querySelector('input[type="file"]');

                    // Required only if no existing file link
                    if (fileInput && !uploadDiv.querySelector('a')) {
                        fileInput.required = true;
                    }
                }

                radio.closest('.doc-card').classList.add('active');
            }

            document.querySelectorAll('input[name="document_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    handleParentChange(this);
                });
            });

            /* AUTO SHOW ON EDIT */
            let checkedParent = document.querySelector('input[name="document_type"]:checked');
            if (checkedParent) {
                handleParentChange(checkedParent);
            }

            /* ==============================
               NUMBER ONLY INPUT
            ============================== */

            document.querySelectorAll('.number-input').forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '');
                });
            });

            /* ==============================
               VALIDATION FUNCTIONS
            ============================== */

            function validateAadhaar(input) {
                if (input.value.length !== 12) {
                    input.classList.add('invalid-field');
                    return false;
                }
                input.classList.remove('invalid-field');
                return true;
            }

            function validateMobile(input) {
                if (input.value.length !== 10) {
                    input.classList.add('invalid-field');
                    return false;
                }
                input.classList.remove('invalid-field');
                return true;
            }

            function validateStep(stepId) {

                let valid = true;
                let step = document.getElementById(stepId);
                let requiredFields = step.querySelectorAll('[required]');

                requiredFields.forEach(field => {

                    if (field.closest('.d-none')) return;

                    if (field.type !== "radio" && field.type !== "file") {
                        if (field.value.trim() === '') {
                            field.classList.add('invalid-field');
                            valid = false;
                        } else {
                            field.classList.remove('invalid-field');
                        }
                    }

                    if (field.classList.contains('aadhaar-input')) {
                        if (!validateAadhaar(field)) valid = false;
                    }

                    if (field.classList.contains('mobile-input')) {
                        if (!validateMobile(field)) valid = false;
                    }

                    if (field.type === "file" && field.required) {
                        if (field.files.length === 0) {
                            field.classList.add('invalid-field');
                            valid = false;
                        } else {
                            field.classList.remove('invalid-field');
                        }
                    }

                });

                return valid;
            }


            /* ==============================
               STEP NAVIGATION
            ============================== */

            function showStep(stepId) {

                // Hide all tabs
                document.querySelectorAll('.tab-pane').forEach(el => {
                    el.classList.remove('show', 'active');
                });

                // Show selected tab
                let target = document.getElementById(stepId);
                if (target) {
                    target.classList.add('show', 'active');
                }

                // 🔥 Update top step highlight
                document.querySelectorAll('.step').forEach(el => {
                    el.classList.remove('active');
                });

                let stepNumber = stepId.replace('step', '');
                let activeStep = document.querySelector('.step[data-step="' + stepNumber + '"]');

                if (activeStep) {
                    activeStep.classList.add('active');
                }
            }

            document.querySelectorAll('.next-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    let currentStep = this.closest('.tab-pane');
                    let stepId = currentStep.id;

                    if (!validateStep(stepId)) {
                        alert("Please fill all required fields correctly.");
                        return;
                    }

                    showStep(this.dataset.next);
                });
            });

            document.querySelectorAll('.prev-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    showStep(this.dataset.prev);
                });
            });

            /* ==============================
               ADDRESS PREVIEW (FIXED ID)
            ============================== */

            const relationship = document.getElementById("relationship");
            const parentName =
                document.getElementById("parent_name") ||
                document.getElementById("relation_name");

            const addressEnglish = document.getElementById("relative_address_english");

            const previewCo = document.getElementById("preview_co");
            const previewAddress = document.getElementById("preview_address");

            function updatePreview() {

                const relation = relationship ? relationship.value : "";
                const name = parentName ? parentName.value : "";
                const address = addressEnglish ? addressEnglish.value : "";

                previewCo.textContent = (relation && name) ?
                    "C/O. " + " " + name :
                    "C/O. ..........................";

                previewAddress.textContent = address ?
                    address :
                    "Address, ..........................";
            }

            if (relationship) relationship.addEventListener("change", updatePreview);
            if (parentName) parentName.addEventListener("input", updatePreview);
            if (addressEnglish) addressEnglish.addEventListener("input", updatePreview);

            updatePreview(); // Run on page load (edit mode)

        });
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var selects = "{{ $services->selects }}";
            var lects = "{{ $services->lects }}";
            var dist_id = "{{ $services->dist_id }}";
            var taluk_id = "{{ $services->taluk_id }}";
            var enrollment_type = "{{ $services->enrollment_type }}";
            var id_proof = "{{ $services->id_proof }}";

            gettaluk(dist_id);
            gettaluk(dist_id);

            if (enrollment_type = "Enrollment Slip") {
                $('#ensliphide').show("slow");
            } else if (enrollment_type == "Enrollment Number") {
                $('#ennumberhide').show("slow");
            }

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

            // if (enrollment_no != "") {
            //     $('#ennumberhide').show("slow");
            // }else{
            //     $('#enslip').hide("slow");
            // }


            if (proof == "With Proof") {
                $('#proofhide').show("slow");
                $('#with_proof').prop("required", true);
            }

            if (withproof == "Smart Card") {
                $('#smart_cardhide').show("slow");
                $('#smart_card').prop("required", true);
            } else if (withproof == "Community Certificate") {
                $('#community_certificatehide').show("slow");
                $('#community_certificate').prop("required", true);
            } else if (withproof == "TC") {
                $('#tchide').show("slow");
                $('#tc').prop("required", true);

            } else if (withproof == "Marksheet") {
                $('#marksheethide').show("slow");
                $('#marksheet').prop("required", true);
            }

            if (relationship1 == "Father") {
                $('#fatherhide').show("slow");
                $('#father_name_english').show("slow");
            } else if (relationship1 == "Mother") {
                $('#mothertherhide').show("slow");
                $('#mother_name_englishhide').show("slow");
            } else if (relationship1 == "Spouse") {
                $('#spousehide').show("slow");
                $('#spouse_name_englishhide').show("slow");
            } else if (relationship1 == "Legal Gaurdian") {
                $('#legal_gaurdianhide').show("slow");
                $('#legal_gaurdian_name_englishhide').show("slow");
            } else if (relationship1 == "Siblings") {
                $('#siblingshide').show("slow");
                $('#siblings_name_englishhide').show("slow");
            } else if (relationship1 == "Child or Ward") {
                $('#child_wardhide').show("slow");
                $('#child_ward_name_englishhide').show("slow");
            }

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

        $('#proof').change(function() {
            if ($('#proof').val() == 'With Proof') {
                $('#proofhide').show("slow");

            } else if ($('#proof').val() == 'Without Proof') {
                $('#proofhide').hide("slow");
                $('#proof').prop("required", false);

            }
        });

        $('#with_proof').change(function() {
            if ($('#with_proof').val() == 'Smart Card') {
                $('#smart_cardhide').show("slow");
                $('#community_certificatehide').hide("slow");
                $('#tchide').hide("slow");
                $('#marksheethide').hide("slow");
                $('#community_certificate').prop("required", false);
                $('#tc').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#smart_card').prop("required", true);

            } else if ($('#with_proof').val() == 'Community Certificate') {
                $('#community_certificatehide').show("slow");
                $('#smart_cardhide').hide("slow");
                $('#tchide').hide("slow");
                $('#marksheethide').hide("slow");
                $('#tc').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#smart_card').prop("required", false);
                $('#community_certificate').prop("required", true);

            } else if ($('#with_proof').val() == 'TC') {
                $('#tchide').show("slow");
                $('#marksheethide').hide("slow");
                $('#community_certificatehide').hide("slow");
                $('#smart_cardhide').hide("slow");
                $('#community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#smart_card').prop("required", false);
                $('#tc').prop("required", true);

            } else if ($('#with_proof').val() == 'Marksheet') {
                $('#marksheethide').show("slow");
                $('#tchide').hide("slow");
                $('#smart_cardhide').hide("slow");
                $('#community_certificatehide').hide("slow");
                $('#community_certificate').prop("required", false);
                $('#tc').prop("required", false);
                $('#smart_card').prop("required", false);
                $('#marksheet').prop("required", true);

            } else {
                $('#smart_cardhide').hide("slow");
                $('#community_certificatehide').hide("slow");
                $('#tchide').hide("slow");
                $('#marksheethide').hide("slow");
                $('#smart_card').prop("required", false);
                $('#community_certificate').prop("required", false);
                $('#tc').prop("required", false);
                $('#marksheet').prop("required", false);

            }
        });

        $('#relationship1').change(function() {
            if ($('#relationship1').val() == 'Father') {
                $('#fatherhide').show("slow");
                $('#father_name_englishhide').show("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);
                $('#father_name_tamil').prop("required", true);
                $('#father_name_english').prop("required", true);

            } else if ($('#relationship1').val() == 'Mother') {
                $('#mothertherhide').show("slow");
                $('#mother_name_englishhide').show("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#fatherhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", true);
                $('#mother_name_english').prop("required", true);

            } else if ($('#relationship1').val() == 'Spouse') {
                $('#spousehide').show("slow");
                $('#spouse_name_englishhide').show("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#fatherhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", true);
                $('#spouse_name_english').prop("required", true);

            } else if ($('#relationship1').val() == 'Legal Gaurdian') {
                $('#legal_gaurdianhide').show("slow");
                $('#legal_gaurdian_name_englishhide').show("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#fatherhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", true);
                $('#legal_gaurdian_name_english').prop("required", true);

            } else if ($('#relationship1').val() == 'Siblings') {
                $('#siblingshide').show("slow");
                $('#siblings_name_englishhide').show("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#fatherhide').hide("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", true);
                $('#siblings_name_english').prop("required", true);

            } else if ($('#relationship1').val() == 'Child or Ward') {
                $('#child_wardhide').show("slow");
                $('#child_ward_name_englishhide').show("slow");
                $('#fatherhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", true);
                $('#child_ward_name_english').prop("required", true);

            } else {
                $('#fatherhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#mothertherhide').hide("slow");
                $('#mother_name_englishhide').hide("slow");
                $('#spousehide').hide("slow");
                $('#spouse_name_englishhide').hide("slow");
                $('#legal_gaurdianhide').hide("slow");
                $('#legal_gaurdian_name_englishhide').hide("slow");
                $('#siblingshide').hide("slow");
                $('#siblings_name_englishhide').hide("slow");
                $('#child_wardhide').hide("slow");
                $('#child_ward_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#mother_name_tamil').prop("required", false);
                $('#mother_name_english').prop("required", false);
                $('#spouse_name_tamil').prop("required", false);
                $('#spouse_name_english').prop("required", false);
                $('#legal_gaurdian_name_tamil').prop("required", false);
                $('#legal_gaurdian_name_english').prop("required", false);
                $('#siblings_name_tamil').prop("required", false);
                $('#siblings_name_english').prop("required", false);
                $('#child_ward_name_tamil').prop("required", false);
                $('#child_ward_name_english').prop("required", false);

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
