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
        border: 2px solid #cbd5e1 !important; /* Visible light grey-blue border */
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    /* Input Focus Styling - Light Blue Glow */
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
    
    /* Category Selection Cards with Light Blue Styling */
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
        {{-- Full Width col-12 Container --}}
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                
                {{-- Light Blue Gradient Header --}}
                <div class="card-header bg-custom-header text-white p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h3 class="h4 mb-1 fw-bold text-white"><i class="bi bi-card-heading me-2"></i>{{ $servicename }}</h3>
                            <p class="mb-0 text-white-50 small">Ration / Smart Card Correction &amp; Online Print Service</p>
                        </div>
                        <span class="badge badge-fee fs-6 px-3 py-2 rounded-pill shadow-sm fw-bold">Online Smart Card Print</span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    {{-- Alert Messages --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($serviceid == 242)
                        <form action="{{ url('submitapply_smartcard_correction') }}" enctype="multipart/form-data" method="post" id="myForm" class="needs-validation">
                            @csrf
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="amount" id="amount" value="{{ $payment ?? '0' }}">
                            <input type="hidden" name="service_amount" id="service_amount" value="{{ $payment ?? '0' }}">

                            {{-- Service Fee Banner (col-12) --}}
                            <div class="col-12 mb-4">
                                <div class="p-3 rounded-3 border style-bordered bg-light d-flex align-items-center justify-content-between flex-wrap gap-2" style="border: 2px solid #bae6fd !important; background-color: #f0f9ff !important;">
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-bold">Service Fee Amount</small>
                                        <span class="fs-4 fw-bold text-light-blue">₹<span id="servicePaymentDisplay">{{ $payment ?? '0.00' }}</span></span>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block text-uppercase fw-bold">Processing Timeline</small>
                                        <span class="fs-6 fw-bold text-secondary"><i class="bi bi-clock-history me-1"></i>4 Working Days</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 1: Smart Card Details & File Upload (col-12) --}}
                            <div class="col-12 mb-5">
                                <label class="form-label text-uppercase fs-7 fw-bold text-secondary tracking-wide mb-3">
                                    Step 1: Smart Card Details &amp; File Upload
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" maxlength="15" class="form-control form-control-lg fw-bold" id="smartcard_number" name="smartcard_number" placeholder="Ration / Smart Card Number" required />
                                            <label for="smartcard_number" class="fw-semibold text-secondary">Ration / Smart Card Number <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border border-2 rounded-3 p-2 bg-white h-100 d-flex flex-column justify-content-center" style="border-color: #cbd5e1 !important;">
                                            <label for="smartcard_file" class="form-label fw-bold text-secondary mb-1 ms-1">Upload Smart Card File <span class="text-danger">*</span></label>
                                            <input accept=".pdf,.jpg,.jpeg,.png" type="file" class="form-control" id="smartcard_file" name="smartcard_file" required />
                                            <small class="text-muted ms-1">Accepted Formats: PDF, JPG, PNG (Max: 2MB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         
                            {{-- Step 2: Main Correction Checkboxes (col-12) --}}
                            <div class="col-12 mb-5">
                                <label class="form-label text-uppercase fs-7 fw-bold text-secondary tracking-wide mb-3">
                                    Step 2: Select Required Corrections
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                            <div class="form-check m-0 d-flex align-items-center">
                                                <input class="form-check-input form-check-input-lg category-checkbox me-3" type="checkbox" name="correction_categories[]" id="chk_member_details" value="Member">
                                                <label class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1" for="chk_member_details">
                                                    Family Member Details
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                            <div class="form-check m-0 d-flex align-items-center">
                                                <input class="form-check-input form-check-input-lg category-checkbox me-3" type="checkbox" name="correction_categories[]" id="chk_address" value="Address">
                                                <label class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1" for="chk_address">
                                                    Address Correction
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-selection rounded-3 p-3 h-100 cursor-pointer">
                                            <div class="form-check m-0 d-flex align-items-center">
                                                <input class="form-check-input form-check-input-lg category-checkbox me-3" type="checkbox" name="correction_categories[]" id="chk_photo" value="Photo">
                                                <label class="form-check-label fw-bold fs-6 text-dark cursor-pointer flex-grow-1" for="chk_photo">
                                                    Head Member Photo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Dynamic Section: Member Details (col-12) --}}
                            <div id="memberSection" class="col-12 mb-5" style="display: none;">
                                <div class="p-4 rounded-4" style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6">
                                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-people-fill text-light-blue me-2"></i>Family Member Corrections</h5>
                                        </div>
                                        <div class="col-md-6 ms-auto">
                                            <div class="form-floating">
                                                <input type="number" min="1" max="10" value="1" class="form-control" id="person_count" name="name_count" placeholder="Number of Persons">
                                                <label for="person_count" class="fw-semibold">Number of Family Members</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="personContainer"></div>
                                </div>
                            </div>

                            {{-- Dynamic Section: Address Fields (English & Tamil) (col-12) --}}
                            <div id="addressSection" class="col-12 mb-5" style="display: none;">
                              
                                <div class="p-4 rounded-4" style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-geo-alt-fill text-light-blue me-2"></i>Address Correction Details</h5>
                                      <P class="fw-bold text-danger mb-2">முகவரி திருத்தம் மட்டுமே. முகவரியில் உள்ள எழுத்து பிழைகளை திருத்தலாம் முகவரியில் மாவட்டம் தாலுகா  மாற்றம் செய்ய முடியாது</P>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="New Address in English" id="address_english" name="address_english" style="height: 110px"></textarea>
                                                <label for="address_english" class="fw-semibold">New Address (English) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="New Address in Tamil" id="address_tamil" name="address_tamil" style="height: 110px"></textarea>
                                                <label for="address_tamil" class="fw-semibold">New Address (Tamil / முகவரி தமிழில்) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Dynamic Section: Head Photo Upload (col-12) --}}
                            <div id="photoSection" class="col-12 mb-5" style="display: none;">
                                <div class="p-4 rounded-4" style="background-color: #f8fafc; border: 2px solid #bae6fd;">
                                    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-camera-fill text-light-blue me-2"></i>New Head Photo</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Upload New Photograph <span class="text-danger">*</span></label>
                                            <input accept="image/jpeg, image/png" type="file" class="form-control form-control-lg" id="additional_photo" name="additional_photo" />
                                            <small class="text-muted">Accepted formats: JPG, PNG (Max: 2MB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Validation Warning Message --}}
                            <div class="col-12 text-center my-3">
                                <p id="nopayment" class="mb-0 fs-6"></p>
                            </div>

                            {{-- Submit Button (col-12) --}}
                            <div class="col-12 d-grid gap-2 col-md-8 mx-auto pt-2">
                                <button id="save" type="submit" class="btn btn-submit-custom btn-lg fw-bold rounded-pill shadow-sm py-3 fs-5">
                                    Generate &amp; Request Smart Card Print
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
    $(document).ready(function () {
        const basePrice = Number("{{ $payment ?? 0 }}");
        const userWallet = Number("{{ Auth::user()->wallet ?? 0 }}");
        
        // Admin wallet balance and required admin payment threshold
        const rawallet = Number("{{ $mainbalance->rawallet ?? 0 }}");
        const adminPayment = Number("{{ $admin_payment ?? 0 }}");

        function updateUIState() {
            let isMemberSelected = $('#chk_member_details').is(':checked');
            let isAddressSelected = $('#chk_address').is(':checked');
            let isPhotoSelected = $('#chk_photo').is(':checked');

            $('.category-checkbox').each(function () {
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
                $('#address_english, #address_tamil').prop('required', true);
            } else {
                $('#addressSection').slideUp();
                $('#address_english, #address_tamil').prop('required', false).val('');
            }

            if (isPhotoSelected) {
                $('#photoSection').slideDown();
                $('#additional_photo').prop('required', true);
            } else {
                $('#photoSection').slideUp();
                $('#additional_photo').prop('required', false).val('');
            }

            let personCount = isMemberSelected ? (parseInt($('#person_count').val()) || 1) : 1;
            let hasAnyCategory = isMemberSelected || isAddressSelected || isPhotoSelected;
            let totalAmount = hasAnyCategory ? (basePrice * personCount) : basePrice;

            $('#servicePaymentDisplay').text(totalAmount.toFixed(2));
            $('#service_amount').val(totalAmount.toFixed(2));
            $('#amount').val(totalAmount.toFixed(2));

            // Calculate total admin payment required if multiplied per person/category
            let totalAdminPayment = hasAnyCategory ? (adminPayment * personCount) : adminPayment;

            // Balance Checks
            if (!hasAnyCategory) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("<i class='bi bi-exclamation-circle-fill me-1'></i> Please select at least one correction category.")
                               .css({'color': '#dc3545', 'font-weight': '600'});
            } else if (rawallet < totalAdminPayment) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("<i class='bi bi-exclamation-triangle-fill me-1'></i> Low balance, contact admin.")
                               .css({'color': '#dc3545', 'font-weight': '600'});
            } else if (userWallet < totalAmount) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("<i class='bi bi-exclamation-circle-fill me-1'></i> Insufficient wallet balance.")
                               .css({'color': '#dc3545', 'font-weight': '600'});
            } else {
                $('#save').prop("disabled", false);
                $('#nopayment').html("");
            }
        }

        function generatePersonCards() {
            let count = parseInt($('#person_count').val()) || 1;
            let container = $('#personContainer');
            
            if (container.children('.person-card').length === count) return;
            
            container.empty();

            for (let i = 1; i <= count; i++) {
                container.append(`
                    <div class="card mb-3 shadow-sm rounded-3 person-card" style="border: 2px solid #cbd5e1;">
                        <div class="card-header bg-white border-bottom fw-bold text-dark py-3" style="border-color: #e2e8f0;">
                            <i class="bi bi-person-fill me-2 text-light-blue"></i> Family Member ${i} Options
                        </div>
                        <div class="card-body">
                            <div class="mb-3 p-3 bg-light rounded" style="border: 2px dashed #cbd5e1;">
                                <div class="form-floating">
                                    <input type="text" name="member_existing_name[]" class="form-control" id="member_existing_name_${i}" placeholder="Existing Name in Card" required>
                                    <label for="member_existing_name_${i}">Existing Name / தற்போதைய பெயர் <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="mb-3 p-3 bg-white rounded" style="border: 2px solid #e2e8f0;">
                                <label class="form-label fw-bold small text-secondary d-block mb-2">Check fields to correct for Member ${i}:</label>
                                <div class="row g-3">
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-lg field-toggle" type="checkbox" data-target="#name_field_${i}" id="chk_p${i}_name">
                                            <label class="form-check-label fw-semibold cursor-pointer" for="chk_p${i}_name">New Name</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-lg field-toggle" type="checkbox" data-target="#dob_field_${i}" id="chk_p${i}_dob">
                                            <label class="form-check-label fw-semibold cursor-pointer" for="chk_p${i}_dob">D.O.B</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-lg field-toggle" type="checkbox" data-target="#gender_field_${i}" id="chk_p${i}_gender">
                                            <label class="form-check-label fw-semibold cursor-pointer" for="chk_p${i}_gender">Gender</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-lg field-toggle" type="checkbox" data-target="#rel_field_${i}" id="chk_p${i}_rel">
                                            <label class="form-check-label fw-semibold cursor-pointer" for="chk_p${i}_rel">Relationship (உறவுமுறை)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-12 person-input-wrapper" id="name_field_${i}" style="display: none;">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="member_name_en[]" class="form-control" id="member_name_en_${i}" placeholder="New Name in English">
                                                <label for="member_name_en_${i}">New Name (English) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="member_name_ta[]" class="form-control" id="member_name_ta_${i}" placeholder="New Name in Tamil">
                                                <label for="member_name_ta_${i}">New Name (Tamil / பெயர்) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 person-input-wrapper" id="dob_field_${i}" style="display: none;">
                                    <div class="form-floating">
                                        <input type="date" name="dob[]" class="form-control" id="dob_${i}" placeholder="D.O.B">
                                        <label for="dob_${i}">D.O.B <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-4 person-input-wrapper" id="gender_field_${i}" style="display: none;">
                                    <div class="form-floating">
                                        <select name="gender[]" class="form-select" id="gender_${i}">
                                            <option value="" disabled selected>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Third Gender">Third Gender</option>
                                        </select>
                                        <label for="gender_${i}">Gender <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-4 person-input-wrapper" id="rel_field_${i}" style="display: none;">
                                    <div class="form-floating">
                                        <select name="relationship[]" class="form-select" id="relationship_${i}">
                                            <option value="" disabled selected>Select / தேர்ந்தெடு</option>
                                            <option value="தந்தை">தந்தை</option>
                                            <option value="தாய்">தாய்</option>
                                            <option value="மகன்">மகன்</option>
                                            <option value="மகள்">மகள்</option>
                                            <option value="கணவர்">கணவர்</option>
                                            <option value="மனைவி">மனைவி</option>
                                            <option value="மாமியார்">மாமியார்</option>
                                            <option value="மாமனார்">மாமனார்</option>
                                            <option value="மருமகன்">மருமகன்</option>
                                            <option value="மருமகள்">மருமகள்</option>
                                            <option value="பேரன்">பேரன்</option>
                                            <option value="பேத்தி">பேத்தி</option>
                                            <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                        </select>
                                        <label for="relationship_${i}">உறவுமுறை / Relationship <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            }
        }

        $(document).on('change', '.field-toggle', function () {
            let targetInput = $($(this).data('target'));
            if ($(this).is(':checked')) {
                targetInput.slideDown().find('input, select').prop('required', true);
            } else {
                targetInput.slideUp().find('input, select').prop('required', false).val('');
            }
        });

        $('.category-checkbox').on('change', updateUIState);
        $('#person_count').on('keyup change', updateUIState);

        $('#myForm').on('submit', function () {
            let $btn = $('#save');
            $btn.prop('disabled', true);
            $btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing Request...');
        });

        updateUIState();
    });
</script>
@endpush