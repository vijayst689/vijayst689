@extends('layouts.app')

@section('content')
    <style>
        /* Custom Light Blue Color Palette & Explicit Borders */
        .bg-custom-header {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        }

        /* Strict Border Styling for ALL Inputs & Selects */
        .form-control,
        .form-select,
        .input-bordered {
            border: 2px solid #cbd5e1 !important;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }

        /* Input Focus Styling */
        .form-control:focus,
        .form-select:focus {
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 0.25rem rgba(2, 132, 199, 0.2) !important;
        }

        /* Large Checkbox Styling */
        .form-check-input-lg {
            width: 1.4em !important;
            height: 1.4em !important;
            cursor: pointer;
            border: 2px solid #94a3b8 !important;
        }

        .form-check-input-lg:checked {
            background-color: #0284c7;
            border-color: #0284c7 !important;
        }

        /* Category Selection Cards */
        .card-selection {
            transition: all 0.25s ease-in-out;
            border: 2px solid #cbd5e1 !important;
            background-color: #ffffff;
        }

        .card-selection:hover {
            border-color: #38bdf8 !important;
            background-color: #f0f9ff;
        }

        .card-selection-active {
            border-color: #0284c7 !important;
            background-color: #e0f2fe !important;
            box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.1);
        }

        .badge-fee {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .text-light-blue {
            color: #0284c7 !important;
        }

        /* Custom Light Blue Button */
        .btn-submit-custom {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            color: #ffffff;
        }

        .btn-submit-custom:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            color: #ffffff;
        }
    </style>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header bg-custom-header text-white p-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div>
                                <h3 class="h4 mb-1 fw-bold text-white"><i
                                        class="bi bi-card-heading me-2"></i>{{ $servicename ?? 'Smart Card Correction' }}
                                </h3>
                                <p class="mb-0 text-white-50 small">Ration / Smart Card Correction &amp; Online Print Service
                                </p>
                            </div>
                            <span class="badge badge-fee fs-6 px-3 py-2 rounded-pill shadow-sm fw-bold">Online Smart Card
                                Print</span>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        {{-- Alert Messages --}}
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4"
                                role="alert">
                                <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4"
                                role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                       
                            <form action="{{ url('smartcard_correction_update') }}" enctype="multipart/form-data"
                                method="post" id="myForm" class="needs-validation">
                                @csrf
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

                                    $disabled = Auth::user()->id != $apply_user_id ? 'disabled' : '';

                                    $correctionType = explode(',', $services->correction_type);
                                    $existingNames = !empty($services->existing_name) ? explode(',', $services->existing_name) : [];
    $memberNameEn  = !empty($services->member_name_en) ? explode(',', $services->member_name_en) : [];
    $memberNameTa  = !empty($services->member_name_ta) ? explode(',', $services->member_name_ta) : [];
    $dobs          = !empty($services->dob) ? explode(',', $services->dob) : [];
    $genders       = !empty($services->gender) ? explode(',', $services->gender) : [];
    $relationships = !empty($services->relationship) ? explode(',', $services->relationship) : [];

                                @endphp

                                {{-- Service Fee Banner --}}
                                <div class="col-12 mb-4">
                                    <div class="p-3 rounded-3 border style-bordered bg-light d-flex align-items-center justify-content-between flex-wrap gap-2"
                                        style="border: 2px solid #bae6fd !important; background-color: #f0f9ff !important;">
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold">Service Fee
                                                Amount</small>
                                            <span class="fs-4 fw-bold text-light-blue">₹<span
                                                    id="servicePaymentDisplay">{{ number_format($payment ?? 0, 2) }}</span></span>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block text-uppercase fw-bold">Processing
                                                Timeline</small>
                                            <span class="fs-6 fw-bold text-secondary"><i
                                                    class="bi bi-clock-history me-1"></i>4 Working Days</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Step 1: Details & Upload --}}
                                <div class="col-12 mb-5">
                                    <label class="form-label text-uppercase fs-7 fw-bold text-secondary tracking-wide mb-3">
                                        Step 1: Smart Card Details &amp; File Upload
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-md-6">

                                            <div class="form-floating">

                                                <input type="text" class="form-control form-control-lg fw-bold"
                                                    name="smartcard_number" maxlength="15"
                                                    value="{{ old('smartcard_number', $services->smartcard_number) }}"
                                                    required {{ $disabled }}>

                                                <label>

                                                    Ration / Smart Card Number

                                                </label>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            @if ($services->smartcard_file != '')
                                                <a href="{{ asset('upload/services/smartcard/' . $services->smartcard_file) }}"
                                                    target="_blank" class="btn btn-success btn-sm mb-2">

                                                    View Uploaded Smart Card

                                                </a>
                                            @endif

                                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" name="smartcard_file"
                                                class="form-control" {{ $disabled }}>

                                        </div>
                                    </div>
                                </div>

                                {{-- Step 2: Select Categories --}}
                                <div class="col-12 mb-5">
                                    <label class="form-label text-uppercase fs-7 fw-bold text-secondary tracking-wide mb-3">
                                        Step 2: Select Required Corrections
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                                <div class="form-check m-0 d-flex align-items-center">
                                                    <input class="form-check-input form-check-input-lg category-checkbox"
                                                        type="checkbox" name="correction_categories[]"
                                                        id="chk_member_details" value="Member"
                                                        {{ in_array('Member', $correctionType) ? 'checked' : '' }}
                                                        {{ $disabled }}>
                                                    <label
                                                        class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1"
                                                        for="chk_member_details">
                                                        Family Member Details
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                                <div class="form-check m-0 d-flex align-items-center">
                                                    <input class="form-check-input form-check-input-lg category-checkbox"
                                                        type="checkbox" name="correction_categories[]" id="chk_address"
                                                        value="Address"
                                                        {{ in_array('Address', $correctionType) ? 'checked' : '' }}
                                                        {{ $disabled }}>
                                                    <label
                                                        class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1"
                                                        for="chk_address">
                                                        Address Correction
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                                <div class="form-check m-0 d-flex align-items-center">
                                                    <input class="form-check-input form-check-input-lg category-checkbox"
                                                        type="checkbox" name="correction_categories[]" id="chk_photo"
                                                        value="Photo"
                                                        {{ in_array('Photo', $correctionType) ? 'checked' : '' }}
                                                        {{ $disabled }}>
                                                    <label
                                                        class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1"
                                                        for="chk_photo">
                                                        Head Member Photo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Dynamic Section: Member Details --}}
                                <div id="memberSection" class="col-12 mb-5" style="display: none;">
                                    <div class="p-4 rounded-4"
                                        style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-6">
                                                <h5 class="fw-bold mb-0 text-dark"><i
                                                        class="bi bi-people-fill text-light-blue me-2"></i>Family Member
                                                    Corrections</h5>
                                            </div>
                                            <div class="col-md-6 ms-auto">
                                                <div class="form-floating">
                                                    <input type="number" min="1" max="10"
                                                        class="form-control" id="person_count" name="name_count"
                                                        value="{{ old('name_count', $services->name_count) }}"
                                                        {{ $disabled }}>
                                                    <label for="person_count" class="fw-semibold">Number of Family
                                                        Members</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="personContainer">
                                           

                                            @for ($i = 0; $i < $services->name_count; $i++)
                                                <div class="card mb-3 shadow-sm rounded-3 person-card">

                                                    <div class="card-header bg-white">

                                                        <b>

                                                            Family Member {{ $i + 1 }}

                                                        </b>

                                                    </div>

                                                    <div class="card-body">

                                                        <div class="mb-3">

                                                            <label>

                                                                Existing Name

                                                            </label>

                                                            <input type="text" class="form-control"
                                                                name="member_existing_name[]"
                                                                value="{{ $existingNames[$i] ?? '' }}"
                                                                {{ $disabled }} required>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-3">

                                                                <div class="form-check">

                                                                    <input class="form-check-input field-toggle"
                                                                        type="checkbox"
                                                                        data-target="#name_field_{{ $i }}">

                                                                    <label class ="fw-bold">

                                                                        New Name

                                                                    </label>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-check">

                                                                    <input class="form-check-input field-toggle"
                                                                        type="checkbox"
                                                                        data-target="#dob_field_{{ $i }}">

                                                                    <label>

                                                                        DOB

                                                                    </label>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-check">

                                                                    <input class="form-check-input field-toggle"
                                                                        type="checkbox"
                                                                        data-target="#gender_field_{{ $i }}">

                                                                    <label>

                                                                        Gender

                                                                    </label>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-check">

                                                                    <input class="form-check-input field-toggle"
                                                                        type="checkbox"
                                                                        data-target="#relationship_field_{{ $i }}">

                                                                    <label>

                                                                        Relationship

                                                                    </label>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div id="name_field_{{ $i }}" class="row mt-3">

                                                            <div class="col-md-6">

                                                                <label>

                                                                    English Name

                                                                </label>

                                                                <input type="text" class="form-control"
                                                                    name="member_name_en[]"
                                                                    value="{{ $memberNameEn[$i] ?? '' }}"
                                                                    {{ $disabled }}>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <label>

                                                                    Tamil Name

                                                                </label>

                                                                <input type="text" class="form-control"
                                                                    name="member_name_ta[]"
                                                                    value="{{ $memberNameTa[$i] ?? '' }}"
                                                                    {{ $disabled }}>

                                                            </div>

                                                        </div>

                                                        <div id="dob_field_{{ $i }}" class="mt-3">

                                                            <label>

                                                                DOB

                                                            </label>

                                                            <input type="date" class="form-control" name="dob[]"
                                                                value="{{ $dobs[$i] ?? '' }}" {{ $disabled }}>

                                                        </div>

                                                        <div id="gender_field_{{ $i }}" class="mt-3">

                                                            <label class="fw-bold">

                                                                Gender

                                                            </label>

                                                            <select class="form-select" name="gender[]"
                                                                {{ $disabled }}>

                                                                <option value="">Select</option>

                                                                <option value="Male"
                                                                    {{ ($genders[$i] ?? '') == 'Male' ? 'selected' : '' }}>

                                                                    Male

                                                                </option>

                                                                <option value="Female"
                                                                    {{ ($genders[$i] ?? '') == 'Female' ? 'selected' : '' }}>

                                                                    Female

                                                                </option>

                                                                <option value="Third Gender"
                                                                    {{ ($genders[$i] ?? '') == 'Third Gender' ? 'selected' : '' }}>

                                                                    Third Gender

                                                                </option>

                                                            </select>

                                                        </div>

                                                        <div id="relationship_field_{{ $i }}" class="mt-3">

                                                            <label>

                                                                Relationship

                                                            </label>

                                                            <select class="form-select" name="relationship[]"
                                                                {{ $disabled }}>

                                                                <option value="">Select</option>

                                                                <option value="தந்தை"
                                                                    {{ ($relationships[$i] ?? '') == 'தந்தை' ? 'selected' : '' }}>
                                                                    தந்தை</option>

                                                                <option value="தாய்"
                                                                    {{ ($relationships[$i] ?? '') == 'தாய்' ? 'selected' : '' }}>
                                                                    தாய்</option>

                                                                <option value="மகன்"
                                                                    {{ ($relationships[$i] ?? '') == 'மகன்' ? 'selected' : '' }}>
                                                                    மகன்</option>

                                                                <option value="மகள்"
                                                                    {{ ($relationships[$i] ?? '') == 'மகள்' ? 'selected' : '' }}>
                                                                    மகள்</option>

                                                                <option value="கணவர்"
                                                                    {{ ($relationships[$i] ?? '') == 'கணவர்' ? 'selected' : '' }}>
                                                                    கணவர்</option>

                                                                <option value="மனைவி"
                                                                    {{ ($relationships[$i] ?? '') == 'மனைவி' ? 'selected' : '' }}>
                                                                    மனைவி</option>

                                                                <option value="மற்ற உறவுகள்"
                                                                    {{ ($relationships[$i] ?? '') == 'மற்ற உறவுகள்' ? 'selected' : '' }}>
                                                                    மற்ற உறவுகள்</option>

                                                            </select>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endfor

                                        </div>
                                    </div>
                                </div>

                                {{-- Dynamic Section: Address Details --}}
                                <div id="addressSection" class="col-12 mb-5" style="display: none;">
                                    <div class="p-4 rounded-4"
                                        style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                        <h5 class="fw-bold mb-3 text-dark"><i
                                                class="bi bi-geo-alt-fill text-light-blue me-2"></i>Address Correction
                                            Details</h5>
                                        <p class="fw-bold text-danger mb-2">முகவரி திருத்தம் மட்டுமே. முகவரியில் உள்ள
                                            எழுத்து பிழைகளை திருத்தலாம் முகவரியில் மாவட்டம் தாலுகா மாற்றம் செய்ய முடியாது
                                        </p>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="address_english" id="address_english" style="height:110px"
                                                        {{ $disabled }}>{{ old('address_english', $services->address_english) }}</textarea>
                                                    <label for="address_english" class="fw-semibold">New Address (English)
                                                        <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="address_tamil" id="address_tamil" style="height:110px" {{ $disabled }}>{{ old('address_tamil', $services->address_tamil) }}</textarea>
                                                    <label for="address_tamil" class="fw-semibold">New Address (Tamil /
                                                        முகவரி தமிழில்) <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Dynamic Section: Photo Section --}}
                                <div id="photoSection" class="col-12 mb-5" style="display: none;">
                                    <div class="p-4 rounded-4"
                                        style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                        <h5 class="fw-bold mb-3 text-dark"><i
                                                class="bi bi-camera-fill text-light-blue me-2"></i>New Head Photo</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Upload New Photograph <span
                                                        class="text-danger">*</span></label>
                                                @if ($services->photo != '')
                                                    <img src="{{ asset('upload/services/photo/' . $services->photo) }}"
                                                        width="120" class="img-thumbnail mb-2">
                                                @endif

                                                <input type="file" class="form-control" name="additional_photo"
                                                    {{ $disabled }}>
                                                <small class="text-muted">Accepted formats: JPG, PNG (Max: 2MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                <option @if ($services->selects == 'Text') selected @endif
                                                    value = "Text">
                                                    Text</option>
                                                <option @if ($services->selects == 'File') selected @endif
                                                    value = "File">
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
            var add_member = "{{ $services->add_member }}";
            var documents = "{{ $services->documents }}";

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
        $(document).ready(function() {

            const basePrice = Number("{{ $payment ?? 0 }}");
            const userWallet = Number("{{ Auth::user()->wallet ?? 0 }}");

            var existingNames = @json($existingNames);
            var memberNameEn = @json($memberNameEn);
            var memberNameTa = @json($memberNameTa);
            var dobs = @json($dobs);
            var genders = @json($genders);
            var relationships = @json($relationships);

            function updateUIState() {

                let isMemberSelected = $('#chk_member_details').is(':checked');
                let isAddressSelected = $('#chk_address').is(':checked');
                let isPhotoSelected = $('#chk_photo').is(':checked');

                $('.category-checkbox').each(function() {

                    let card = $(this).closest('.card-selection');

                    if ($(this).is(':checked')) {

                        card.addClass('card-selection-active');

                    } else {

                        card.removeClass('card-selection-active');

                    }

                });

                if (isMemberSelected) {

                    $('#memberSection').slideDown();

                    generatePersonCards();

                } else {

                    $('#memberSection').slideUp();

                    $('#personContainer').empty();

                }

                if (isAddressSelected) {

                    $('#addressSection').slideDown();

                    $('#address_english,#address_tamil').prop('required', true);

                } else {

                    $('#addressSection').slideUp();

                    $('#address_english,#address_tamil').prop('required', false);

                }

                if (isPhotoSelected) {

                    $('#photoSection').slideDown();

                    $('#additional_photo').prop('required', false);

                } else {

                    $('#photoSection').slideUp();

                }

                let personCount = parseInt($('#person_count').val()) || 1;

                let totalAmount = basePrice * personCount;

                $('#servicePaymentDisplay').html(totalAmount.toFixed(2));

                $('#service_amount').val(totalAmount);

                $('#amount').val(totalAmount);

                if (totalAmount > userWallet) {

                    $('#save').prop('disabled', true);

                    $('#nopayment').html("Insufficient Wallet Balance");

                } else {

                    $('#save').prop('disabled', false);

                    $('#nopayment').html("");

                }

            }

            function generatePersonCards() {

                let count = parseInt($('#person_count').val()) || 1;

                let container = $("#personContainer");

                container.html("");

                for (let i = 0; i < count; i++) {

                    let english = memberNameEn[i] ?? "";
                    let tamil = memberNameTa[i] ?? "";
                    let existing = existingNames[i] ?? "";
                    let dob = dobs[i] ?? "";
                    let gender = genders[i] ?? "";
                    let relation = relationships[i] ?? "";

                    container.append(`
            <div class="card mb-3 person-card">

            <div class="card-header">

            <b>Family Member ${i+1}</b>

            </div>

            <div class="card-body">

            <div class="mb-3">

            <label>Existing Name</label>

            <input
            type="text"
            class="form-control"
            name="member_existing_name[]"
            value="${existing}"
            required {{ $disabled }}>

            </div>

            <div class="row">

            <div class="col-md-6">

            <label>English Name</label>

            <input
            type="text"
            class="form-control"
            name="member_name_en[]"
            value="${english}" {{ $disabled }}>

            </div>

            <div class="col-md-6">

            <label>Tamil Name</label>

            <input
            type="text"
            class="form-control"
            name="member_name_ta[]"
            value="${tamil}" {{ $disabled }}>

            </div>

            <div class="col-md-4 mt-3">

            <label>DOB</label>

            <input
            type="date"
            class="form-control"
            name="dob[]"
            value="${dob}" {{ $disabled }}>

            </div>

            <div class="col-md-4 mt-3">

            <label>Gender</label>

            <select
            class="form-select"
            name="gender[]"
            {{ $disabled }}>

            <option value="">Select</option>

            <option value="Male" ${gender=="Male"?"selected":""}>Male</option>

            <option value="Female" ${gender=="Female"?"selected":""}>Female</option>

            <option value="Third Gender" ${gender=="Third Gender"?"selected":""}>Third Gender</option>

            </select>

            </div>

            <div class="col-md-4 mt-3">

            <label>Relationship</label>

            <select
            class="form-select"
            name="relationship[]"
            {{ $disabled }}>

            <option value="">Select</option>

            <option value="தந்தை" ${relation=="தந்தை"?"selected":""}>தந்தை</option>

            <option value="தாய்" ${relation=="தாய்"?"selected":""}>தாய்</option>

            <option value="மகன்" ${relation=="மகன்"?"selected":""}>மகன்</option>

            <option value="மகள்" ${relation=="மகள்"?"selected":""}>மகள்</option>

            <option value="கணவர்" ${relation=="கணவர்"?"selected":""}>கணவர்</option>

            <option value="மனைவி" ${relation=="மனைவி"?"selected":""}>மனைவி</option>

            <option value="மற்ற உறவுகள்" ${relation=="மற்ற உறவுகள்"?"selected":""}>மற்ற உறவுகள்</option>

            </select>

            </div>

            </div>

            </div>

            </div>
            `);

                }

            }

            updateUIState();

            $('.category-checkbox').change(function() {

                updateUIState();

            });

            $('#person_count').on('keyup change', function() {

                generatePersonCards();

                updateUIState();

            });
        });

        $(document).on('change', '.field-toggle', function() {

            let target = $($(this).data('target'));

            if ($(this).is(':checked')) {

                target.slideDown();

                target.find('input,select,textarea')
                    .prop('disabled', false)
                    .prop('required', true);

            } else {

                target.slideUp();

                target.find('input,select,textarea')
                    .prop('required', false)
                    .prop('disabled', true)
                    .val('');

            }

        });


        // ---------- Auto Show Filled Fields ----------
        setTimeout(function() {

            $('#personContainer .person-card').each(function() {

                let card = $(this);

                if (card.find('input[name="member_name_en[]"]').val() != "" ||
                    card.find('input[name="member_name_ta[]"]').val() != "") {

                    card.find('#name_field_' + card.index()).show();

                }

                if (card.find('input[name="dob[]"]').val() != "") {

                    card.find('#dob_field_' + card.index()).show();

                }

                if (card.find('select[name="gender[]"]').val() != "") {

                    card.find('#gender_field_' + card.index()).show();

                }

                if (card.find('select[name="relationship[]"]').val() != "") {

                    card.find('#relationship_field_' + card.index()).show();

                }

            });

        }, 300);


        // ---------- Form Submit ----------
        $('#myForm').submit(function() {

            $('#save').prop('disabled', true);

            $('#save').html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Updating...'
            );

        });


        // ---------- Existing Record ----------
        if ($('#chk_member_details').is(':checked')) {

            $('#memberSection').show();

            generatePersonCards();

        }

        if ($('#chk_address').is(':checked')) {

            $('#addressSection').show();

        }

        if ($('#chk_photo').is(':checked')) {

            $('#photoSection').show();

        }


        // ---------- Trigger Existing ----------
        $('.category-checkbox').trigger('change');


        // ---------- Initial Calculation ----------
        updateUIState();
    </script>
@endpush