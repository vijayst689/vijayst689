@extends('layouts.app')
@section('content')
 <style>
        .service-56 .form-control,
        .service-56 select,
        .service-56 textarea,
        {
        border: 2px solid transparent;
        /* 👈 normal time-la invisible */
        background-color: #fff;
        box-shadow: none;
        }

        /* ---------------- SERVICE 56 : Pink border on focus ---------------- */
        .service-56 label {
            color: #0d6efd;
            font-weight: 600;
        }

        .service-56 .form-control:focus,
        .service-56 select:focus,
        .service-56 textarea:focus {
            border-color: #f06292;
            /* pink */
            box-shadow: 0 0 6px rgba(248, 180, 200, 0.9);
            outline: none;
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
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
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

                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-0">
                            <h5 class="card-title mt-2">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span>
                            </h6>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form class="row g-4" action="{{ url('submitaadhaar') }}" enctype="multipart/form-data"
                                method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    @if ($serviceid == 56)
                                        <div class="service-56">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Aadhaar Number</label>
                                                    <input required type="text" class="form-control yellow-input"
                                                        name="aadhaar_no" placeholder="Aadhaar Number" maxlength="12" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Mobile Number (Aadhaar
                                                        link)</label>
                                                    <input required type="text" maxlength="10"
                                                        class="form-control yellow-input" name="mobile"
                                                        placeholder="Mobile Number" />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Applicant Name</label>
                                                    <input required type="text" class="form-control yellow-input"
                                                        name="name" placeholder="Applicant Name" maxlength="30" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Door Number</label>
                                                    <input required type="text" class="form-control yellow-input"
                                                        name="door_no" placeholder="Door Number" maxlength="30" />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Address In English</label>
                                                    <textarea required rows="2" maxlength="200" class="form-control yellow-input" name="address_english"
                                                        placeholder="Address In English"></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">முகவரி தமிழில்</label>
                                                    <textarea required rows="2" maxlength="200" class="form-control yellow-input" name="address_tamil"
                                                        placeholder="முகவரி தமிழில்"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">District</label>
                                                    <select name="dist_id" id="dist_id" class="form-control yellow-input">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Taluk</label>
                                                    <select name="taluk_id" id="taluk"
                                                        class="form-control yellow-input">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Postal Area</label>
                                                    <input required type="text" maxlength="500"
                                                        class="form-control yellow-input" name="postal_area_english"
                                                        placeholder="Postal Area" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label yellow-label">Pin code</label>
                                                    <input required type="number" class="form-control yellow-input"
                                                        name="pin_code" placeholder="Pin Code" maxlength="30" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="id_proof" class="form-label yellow-label">ஏதேனும் அடையாள
                                                        ஆதாரம்</label>
                                                    <select id="id_proof" class="form-control yellow-input"
                                                        name="id_proof">
                                                        <option value="">Select proof</option>
                                                        <option value="Bank Passbook">Bank Passbook(With Photo)</option>
                                                        <option value="Smartcard Online Print">Smartcard Online Print
                                                        </option>
                                                        <option value="Voter Id">Voter Id (Latest)</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 col-md-12">
                                                        <div class="" id="passbookhide"
                                                            style="display: none; color:#28a745">
                                                            <label>Bank Passbook</label>
                                                            <input type="file" class="form-control"
                                                                accept="image/jpeg, image/png" name="bank_pass_book">
                                                        </div>
                                                        <div class="" id="smartcardhide"
                                                            style="display: none; color:#28a745">
                                                            <label>Smartcard Online Print</label>
                                                            <input class="form-control" type="file"
                                                                accept="image/jpeg, image/png"
                                                                name="smartcard_onlineprint">
                                                        </div>

                                                        <div class="" id="voteridhide"
                                                            style="display: none; color:#28a745">
                                                            <label>Voter Id (Latest)</label>
                                                            <input class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="voterid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 58)
                                        <div class="step-wrapper">
                                            <div class="step active" id="step1-indicator">
                                                <div class="step-circle">1</div>
                                                <span>Applicant</span>
                                            </div>
                                            <div class="step" id="step2-indicator">
                                                <div class="step-circle">2</div>
                                                <span>Family</span>
                                            </div>
                                            <div class="step" id="step3-indicator">
                                                <div class="step-circle">3</div>
                                                <span>Address</span>
                                            </div>
                                        </div>

                                        <div class="tab-content">

                                            <!-- ================= Applicant ================= -->
                                            <div class="tab-pane fade show active" id="step1">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label>Applicant Name As Per Aadhaar</label>
                                                        <input type="text" class="form-control" name="applicant_name"
                                                            placeholder="Enter Name as per Aadhaar" maxlength="100"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Applicant Aadhaar Number</label>
                                                        <input type="text" id="applicant_aadhaar"
                                                            class="form-control number-input aadhaar-input"
                                                            name="applicant_aadhaar"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required>
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
                                                            required>
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
                                                                        value="aadhaar" class="doc-radio" required>
                                                                    <div>Aadhaar Front</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_aadhaar">
                                                                    <input type="file" name="aadhaar_card"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <!-- School ID -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="school" class="doc-radio">
                                                                    <div>School ID</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_school">
                                                                    <input type="file" name="schl_id_card"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <!-- Birth Certificate -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="birth" class="doc-radio">
                                                                    <div>Birth Certificate</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_birth">
                                                                    <input type="file" name="birth_certificate"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <!-- Photo -->
                                                            <div class="col-md-3">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="applicant_document_type"
                                                                        value="photo" class="doc-radio">
                                                                    <div>Photo</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload"
                                                                    id="applicant_upload_photo">
                                                                    <input type="file" name="photo"
                                                                        class="form-control">
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
                                            <div class="tab-pane fade" id="step2">
                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label>உறவுமுறை</label>
                                                        <select class="form-control relationship" id="relationship"
                                                            name="relationship" required>
                                                            <option value="">Select any</option>
                                                            <option value="Father">Father</option>
                                                            <option value="Mother">Mother</option>
                                                            <option value="Legal Guardian">Legal Guardian</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Name As Per Aadhaar</label>
                                                        <input type="text" id="parent_name" name="parent_name"
                                                            class="form-control parent-name"
                                                            placeholder="Enter Parent Name as per Aadhaar" maxlength="200"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Aadhaar Number</label>
                                                        <input type="text" id="parent_aadhaar" name="parent_aadhaar"
                                                            class="form-control number-input aadhaar-input"
                                                            placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                            minlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                                            required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Parent Aadhaar Linked Mobile</label>
                                                        <input type="text" name="parent_mobile"
                                                            class="form-control number-input mobile-input"
                                                            placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                            minlength="10" pattern="[0-9]{10}" inputmode="numeric"
                                                            required>
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
                                                                        value="aadhaar" class="doc-radio" required>
                                                                    <div>Aadhaar Card Front Page</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_aadhaar">
                                                                    <input type="file" name="parent_aadhaar_front"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <!-- Voter -->
                                                            <div class="col-md-4">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="voter" class="doc-radio">
                                                                    <div>Voter ID (Latest)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_voter">
                                                                    <input type="file" name="voterid"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <!-- Bank -->
                                                            <div class="col-md-4">
                                                                <label class="doc-card w-100 text-center">
                                                                    <input type="radio" name="document_type"
                                                                        value="bank" class="doc-radio">
                                                                    <div>Bank Passbook (With Photo)</div>
                                                                </label>

                                                                <div class="mt-2 d-none doc-upload" id="upload_bank">
                                                                    <input type="file" name="bank_pass_book"
                                                                        class="form-control">
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
                                            <div class="tab-pane fade" id="step3">

                                                <div class="alert alert-warning small">
                                                    தந்தை/தாய்/வாரிசுதாரின் ஆதார் அட்டையில் முகவரி சரியாக இருக்க வேண்டும்
                                                    அல்லது
                                                    தந்தை/தாய் /வாரிசுதாரின் ஆதாரில் முகவரி மாற்றம் செய்த பின்னர் விண்ணப்பம்
                                                    செய்யவும்.
                                                    குழந்தைகள் தந்தை/தாய்/பாதுகாவலரின் முகவரியில் வசிப்பதால் அவர்களது முகவரி
                                                    மற்றும்
                                                    C/O. அவர்களின் பெயருடன் வரும் ஆகவே உறுவினர் யார் என்பதை சரியாக தேர்வு
                                                    செய்து
                                                    அவர்களது முகவரியும் சரிபார்ப்பு செய்யவும்.
                                                </div>

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label>Relative Address in English</label>
                                                        <textarea class="form-control" name="relative_address_english" id="relative_address_english"
                                                            placeholder="Relative Address in English" maxlength="500" rows="3" required></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Address Preview</label>

                                                        <div class="border rounded-3 p-3 bg-light shadow-sm">
                                                            <h6 class="mb-2 fw-bold preview-co" id="preview_co">
                                                                C/O. ..........................
                                                            </h6>

                                                            <p class="mb-0 preview-address" id="preview_address">
                                                                Address, ..........................
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>உறவினர் முகவரி தமிழில்</label>
                                                        <textarea class="form-control" name="relative_address_tamil" id="relative_address_tamil"
                                                            placeholder="உறவினர் முகவரி தமிழில்" maxlength="500" rows="3" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary prev-btn"
                                                        data-prev="step2">
                                                        ← Previous
                                                    </button>
                                                    <div class="text-center">
                                                        <div class="col-12">
                                                            <div class="mb-0">
                                                                <button id="save" type="submit"
                                                                    class="btn btn-primary">Apply Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @elseif ($serviceid == 158)
                                <div class="step-wrapper">
                                    <div class="step active" id="step1-indicator">
                                        <div class="step-circle">1</div>
                                        <span class="text-dark">Applicant</span>
                                    </div>
                                    <div class="step" id="step2-indicator">
                                        <div class="step-circle">2</div>
                                        <span class="text-dark">Family</span>
                                    </div>
                                    <div class="step" id="step3-indicator">
                                        <div class="step-circle">3</div>
                                        <span class="text-dark">Address</span>
                                    </div>
                                </div>

                                <div class="tab-content">

                                    <!-- ================= Applicant ================= -->
                                    <div class="tab-pane fade show active" id="step1">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Applicant Name As Per Aadhaar</label>
                                                <input type="text" class="form-control" name="applicant_name"
                                                    placeholder="Enter Name as per Aadhaar" maxlength="100" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Applicant Aadhaar Number</label>
                                                <input type="text" id="applicant_aadhaar"
                                                    class="form-control number-input aadhaar-input"
                                                    name="applicant_aadhaar" placeholder="Enter 12 Digit Aadhaar Number"
                                                    maxlength="12" minlength="12" pattern="[0-9]{12}"
                                                    inputmode="numeric" required>
                                                <small class="text-danger d-none" id="aadhaar_error">
                                                    Aadhaar must be exactly 12 digits
                                                </small>
                                            </div>

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Aadhaar Linked Mobile</label>
                                                <input type="text" class="form-control number-input mobile-input"
                                                    name="applicant_mobile" placeholder="Enter 10 Digit Mobile Number"
                                                    maxlength="10" minlength="10" pattern="[0-9]{10}"
                                                    inputmode="numeric" required>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <label style="color: #e41a97" class="fw-semibold">Applicant Documents
                                                    (Upload Any
                                                    One)</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <!-- Aadhaar -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="applicant_document_type"
                                                                value="aadhaar" class="doc-radio" required>
                                                            <div>Aadhaar Front</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload" id="applicant_upload_aadhaar">
                                                            <input style="color: #e41a97" type="file"
                                                                name="aadhaar_card" class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Smartcard Online Print -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="applicant_document_type"
                                                                value="smartcard" class="doc-radio">
                                                            <div>Smartcard Online Print</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload"
                                                            id="applicant_upload_smartcard">
                                                            <input style="color: #e41a97" type="file"
                                                                name="smartcard_onlineprint" class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Voter Id -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="applicant_document_type"
                                                                value="voterid" class="doc-radio">
                                                            <div>Voter Id (Latest)</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload" id="applicant_upload_voterid">
                                                            <input style="color: #e41a97" type="file" name="voterid"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="button" class="btn btn-primary next-btn" data-next="step2">
                                                Next →
                                            </button>
                                        </div>
                                    </div>

                                    <!-- ================= Family ================= -->
                                    <div class="tab-pane fade" id="step2">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">உறவுமுறை</label>
                                                <select class="form-control" id="relationship" name="relationship"
                                                    required>
                                                    <option value="">Select Any</option>
                                                    <option value="Child or Ward">Child/Ward</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Legal Guardian">Legal Guardian</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Spouse">Spouse</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Marital Status</label>
                                                <select name="marital_status" class="form-control" required>
                                                    <option value="">Select Marital Status</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Relation Name As Per Aadhaar</label>
                                                <input type="text" id="relation_name" name="relation_name"
                                                    class="form-control relation-name"
                                                    placeholder="Enter Relation Name as per Aadhaar" maxlength="200"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Relation Aadhaar Number</label>
                                                <input type="text" id="relation_aadhaar" name="relation_aadhaar"
                                                    class="form-control number-input aadhaar-input"
                                                    placeholder="Enter 12 Digit Aadhaar Number" maxlength="12"
                                                    minlength="12" pattern="[0-9]{12}" inputmode="numeric" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Relation Aadhaar Linked Mobile</label>
                                                <input type="text" name="relation_mobile"
                                                    class="form-control number-input mobile-input"
                                                    placeholder="Enter 10 Digit Mobile Number" maxlength="10"
                                                    minlength="10" pattern="[0-9]{10}" inputmode="numeric" required>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <label style="color: #e41a97" class="fw-semibold">Documents (Upload Any
                                                    One)</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <!-- Aadhaar -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="document_type" value="aadhaar"
                                                                class="doc-radio" required>
                                                            <div>Aadhaar Card Front Page</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload" id="upload_aadhaar">
                                                            <input style="color: #e41a97" type="file"
                                                                name="parent_aadhaar_front" class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Voter -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="document_type" value="voter"
                                                                class="doc-radio">
                                                            <div>Voter ID (Latest)</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload" id="upload_voter">
                                                            <input style="color: #e41a97" type="file" name="voterid"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Bank -->
                                                    <div class="col-md-4">
                                                        <label style="color: #e41a97" class="doc-card w-100 text-center">
                                                            <input type="radio" name="document_type" value="bank"
                                                                class="doc-radio">
                                                            <div>Bank Passbook (With Photo)</div>
                                                        </label>

                                                        <div class="mt-2 d-none doc-upload" id="upload_bank">
                                                            <input style="color: #e41a97" type="file"
                                                                name="bank_pass_book" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn btn-secondary prev-btn" data-prev="step1">
                                                ← Previous
                                            </button>
                                            <button type="button" class="btn btn-primary next-btn" data-next="step3">
                                                Next →
                                            </button>
                                        </div>
                                    </div>

                                    <!-- ================= Address ================= -->
                                    <div class="tab-pane fade" id="step3">

                                        <div class="alert alert-warning small">
                                            நீங்கள் பதிவு செய்யும் உறவினர் பெயர் மற்றும் முகவரியை சரிபார்க்கவும்
                                            ஆதார் அட்டையில் பெயர் மற்றும் முகவரி சரியாக இருக்க வேண்டும் அல்லது
                                            கணவர்/தந்தை/தாய் /வாரிசுதாரின் ஆதாரில் முகவரி மாற்றம் செய்த பின்னர் விண்ணப்பம்
                                            செய்யவும்.
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label style="color: #e41a97">Relation Address in English</label>
                                                <textarea class="form-control relative-address-english" name="relative_address_english" id="relative_address_english"
                                                    placeholder="Relative Address in English" maxlength="500" rows="3" required></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label style="color: #e41a97" class="form-label fw-semibold">Address
                                                    Preview</label>

                                                <div class="border rounded-3 p-3 bg-light shadow-sm">
                                                    <h6 class="mb-2 fw-bold preview-co" id="preview_co">
                                                        C/O. ..........................
                                                    </h6>

                                                    <p class="mb-0 preview-address" id="preview_address">
                                                        Address, ..........................
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color: #e41a97">உறவினர் முகவரி தமிழில்</label>
                                                <textarea class="form-control" name="relative_address_tamil" id="relative_address_tamil"
                                                    placeholder="உறவினர் முகவரி தமிழில்" maxlength="500" rows="3" required></textarea>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn btn-secondary prev-btn" data-prev="step2">
                                                ← Previous
                                            </button>
                                            <div class="text-center">
                                                <div class="col-12">
                                                    <div class="mb-0">
                                                        <button id="save" type="submit"
                                                            class="btn btn-primary">Apply
                                                            Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @elseif ($serviceid == 159)
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Enrollment slip</label>
                            <input required accept="image/jpeg, image/png,application/pdf" type="file"
                                class="form-control" name="enrollment_slip" />

                            <label for="aadhaar_card" class="form-label">Adhaar card (front &
                                Back)</label>
                            <input required type="file" class="form-control" name="aadhaar_card"
                                placeholder="Adhaar card (front & Back)" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="signature" class="form-label">Correction proof</label>
                            <input required accept="image/jpeg, image/png,application/pdf" type="file"
                                class="form-control" name="correction_proof" />
                        </div>
                    @elseif ($serviceid == 160)
                        <div class="mb-3 col-md-6">
                            <label for="enrollment_type" class="form-label">Enrollment Type</label>
                            <select required type="text" id="enrollment_type" class="form-control"
                                name="enrollment_type">
                                <option value="">Select</option>
                                <option value="Enrollment Slip">Enrollment Slip</option>
                                <option value="Enrollment Number">Enrollment Number</option>
                            </select>

                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="" id="ensliphide" style="display: none;">
                                <label for="enrollment_slip" class="form-label">Enrollment Slip</label>
                                <input required accept="image/jpeg, image/png,application/pdf" type="file"
                                    id="enslip" class="form-control" name="enrollment_slip" />
                            </div>
                            <div class="" id="ennumberhide" style="display: none;">
                                <label for="enrollment_no" class="form-label">Enrollment Number</label>
                                <input required id="ennumber" type="text" maxlength="20" class="form-control number"
                                    name="enrollment_no" placeholder="Enrollment Number" />
                            </div>
                        </div>
                    @elseif ($serviceid == 161)
                        <div class="mb-3 col-md-6">
                            <label for="enrollment_type" class="form-label">Enrollment Type</label>
                            <select required type="text" id="enrollment_type" class="form-control"
                                name="enrollment_type">
                                <option value="">Select</option>
                                <option value="Enrollment Slip">Enrollment Slip</option>
                                <option value="Enrollment Number">Enrollment Number</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="" id="ensliphide" style="display: none;">
                                <label for="enrollment_slip" class="form-label">Enrollment Slip</label>
                                <input required accept="image/jpeg, image/png,application/pdf" type="file"
                                    id="enslip" class="form-control" name="enrollment_slip" />
                            </div>
                            <div class="" id="ennumberhide" style="display: none;">
                                <label for="enrollment_no" class="form-label">Enrollment Number</label>
                                <input required id="ennumber" type="text" maxlength="20" class="form-control number"
                                    name="enrollment_no" placeholder="Enrollment Number" />
                            </div>
                        </div>
                    @elseif ($serviceid == 162)
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name as Per Adhaar</label>
                            <input required type="text" maxlength="30" class="form-control" name="name"
                                placeholder="Name as Per Adhaar" />

                            <label for="mobile" class="form-label">Cell Number</label>
                            <input required type="text" maxlength="10" class="form-control number" name="mobile"
                                placeholder="Cell Number" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                            <input required type="text" class="form-control number" name="aadhaar_no" maxlength="12"
                                placeholder="Aadhaar Number" />
                        </div>
                    @elseif ($serviceid == 163)
                        <div class="mb-3 col-md-6">
                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                            <input required type="text" class="form-control number" name="aadhaar_no" maxlength="12"
                                placeholder="Aadhaar Number" />

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" maxlength="30" class="form-control" name="name"
                                placeholder="Name" />
                        </div>
                        @endif
                        <div class="text-center">
                            <p id="nopayment"></p>
                        </div>
                        @if ($serviceid != 58 && $serviceid != 158)
                            <div class="text-center">
                                <div class="col-12">
                                    <div class="mb-0">
                                        <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
            @push('page_scripts')
               
                <script>
        document.addEventListener("DOMContentLoaded", function() {

            /* ==========================================
               DOCUMENT RADIO TOGGLE (STEP 1 & STEP 2)
            ========================================== */

            document.querySelectorAll('.doc-radio').forEach(radio => {

                radio.addEventListener('change', function() {

                    let step = this.closest('.tab-pane');
                    if (!step) return;

                    // Hide all uploads inside current step
                    step.querySelectorAll('.doc-upload').forEach(div => {
                        div.classList.add('d-none');

                        let input = div.querySelector('input');
                        if (input) {
                            input.required = false;
                            input.value = '';
                        }
                    });

                    // Remove active highlight
                    step.querySelectorAll('.doc-card').forEach(card => {
                        card.classList.remove('active');
                    });

                    // Show selected upload
                    let selectedValue = this.value;
                    let uploadDiv = step.querySelector('#applicant_upload_' + selectedValue) ||
                        step.querySelector('#upload_' + selectedValue);

                    if (uploadDiv) {
                        uploadDiv.classList.remove('d-none');
                        let fileInput = uploadDiv.querySelector('input');
                        if (fileInput) fileInput.required = true;
                    }

                    this.closest('.doc-card').classList.add('active');
                });

            });

            /* ==========================================
               NUMBER ONLY INPUT
            ========================================== */

            document.querySelectorAll('.number-input').forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '');
                });
            });

            /* ==========================================
               VALIDATION FUNCTIONS
            ========================================== */

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
                if (!step) return false;

                let requiredFields = step.querySelectorAll('[required]');

                requiredFields.forEach(field => {

                    // Skip hidden fields
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

                /* RADIO GROUP VALIDATION */
                let radioGroups = {};
                step.querySelectorAll('input[type="radio"][required]').forEach(radio => {
                    radioGroups[radio.name] = true;
                });

                for (let group in radioGroups) {
                    let checked = step.querySelector('input[name="' + group + '"]:checked');
                    if (!checked) {
                        valid = false;
                    }
                }

                return valid;
            }

            /* ==========================================
               STEP NAVIGATION
            ========================================== */

            function showStep(stepId) {

                document.querySelectorAll('.tab-pane').forEach(el => {
                    el.classList.remove('show', 'active');
                });

                let target = document.getElementById(stepId);
                if (target) target.classList.add('show', 'active');

                document.querySelectorAll('.step').forEach(el => {
                    el.classList.remove('active');
                });

                let indicator = document.getElementById(stepId + '-indicator');
                if (indicator) indicator.classList.add('active');

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
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


            document.querySelectorAll('.tab-pane').forEach(step => {

                const relationship = document.querySelector('[name="relationship"]');
                const nameField = document.querySelector('[name="parent_name"], [name="relation_name"]');
                const addressEnglish = document.querySelector('[name="relative_address_english"]');

                const previewCo = document.getElementById('preview_co');
                const previewAddress = document.getElementById('preview_address');

                function updatePreview() {

                    const name = nameField ? nameField.value : "";
                    const address = addressEnglish ? addressEnglish.value : "";

                    if (previewCo) {
                        previewCo.textContent =
                            name ?
                            "C/O. " + name :
                            "C/O. ..........................";
                    }

                    if (previewAddress) {
                        previewAddress.textContent =
                            address ?
                            address :
                            "Address, ..........................";
                    }
                }

                if (relationship) relationship.addEventListener("change", updatePreview);
                if (nameField) nameField.addEventListener("input", updatePreview);
                if (addressEnglish) addressEnglish.addEventListener("input", updatePreview);

            });

        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });


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

        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
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
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
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
                }
            });
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
                $('#mother_name_tamilhide').hide("slow");
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
                $('#mother_name_tamilhide').hide("slow");
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
    </script>
            @endpush
