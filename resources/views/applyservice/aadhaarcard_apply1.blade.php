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
                                    <form class="row g-4" action="{{ url('submitaadhaar') }}" onsubmit="return checkpayment(event)" enctype="multipart/form-data"
                                method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                     @if ($serviceid == 56)
                                <div class="tab-content">

                                    <!-- STEP 1 -->
                                    <div class="tab-pane fade show active" id="step1">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Aadhaar Number</label>
                                                <input required type="text"
                                                    class="form-control border border-dark number" name="aadhaar_no"
                                                    placeholder="Aadhaar Number" maxlength="12">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Mobile Number(Aadhaar
                                                    link)</label>
                                                <input required type="text"
                                                    class="form-control border border-dark number" name="mobile"
                                                    placeholder="Mobile Number" maxlength="10">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Name as per Adhaar/ஆதாரில்
                                                    இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                <input required type="text" class="form-control border border-dark"
                                                    name="name" maxlength="100" placeholder="Applicant Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_proof" class="form-label text-primary">ஏதேனும் அடையாள
                                                    ஆதாரம்</label>
                                                <select class="form-control border border-dark text-dark" id="id_proof"
                                                    name="id_proof">
                                                    <option value="">Select Proof</option>
                                                    {{-- <option value="Aadhaar Card">Aadhaar Card(Front)</option> --}}
                                                    <option value="Bank Passbook">Bank Passbook(With Photo)</option>
                                                    <option value="Smartcard Online Print">Smartcard Online Print</option>
                                                    <option value="Voter Id">Voter Id (Latest)</option>
                                                </select>

                                            </div>
                                            <div class="mb-3 col-md-6">

                                                {{-- <div class="" id="aadhaarhide" style="display: none;">
                                                    <label class="form-label text-primary">Aadhaar Card(Front)</label>
                                                    <input type="file" class="form-control"
                                                        accept="image/jpeg, image/png" name="aadhaar_card">
                                                </div> --}}
                                                <div class="" id="passbookhide" style="display: none;">
                                                    <label class="form-label text-primary">Bank Passbook</label>
                                                    <input type="file" class="form-control"
                                                        accept="image/jpeg, image/png" name="bank_pass_book">
                                                </div>
                                                <div class="" id="smartcardhide" style="display: none;">
                                                    <label class="form-label text-primary">Smartcard Online Print</label>
                                                    <input class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="smartcard_onlineprint">
                                                </div>

                                                <div class="" id="voteridhide" style="display: none;">
                                                    <label class="form-label text-primary">Voter Id (Latest)</label>
                                                    <input class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="voterid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-danger next-btn" data-next="step2">Next
                                                →</button>
                                        </div>
                                    </div>


                                    <!-- STEP 2 -->
                                    <div class="tab-pane fade" id="step2">
                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">House / Building /Apartment </label>
                                                <input required type="text" name="apartment"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">வீடு/ கட்டிடம்/அபார்ட்மெண்ட்</label>
                                                <input required type="text" name="door_no"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Street / Road / Lane</label>
                                                <input type="text" name="street_name"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">தெரு / சாலை / சந்து</label>
                                                <input type="text" name="street_name_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Area / Locality/Sector</label>
                                                <input type="text" name="postal_area_english"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">பகுதி /இடம் / பிரிவு</label>
                                                <input type="text" name="postal_area_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">State</label>
                                                <input required type="text" name="state"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="State">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">மாநிலம்</label>
                                                <input required type="text" name="state_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="மாநிலம்">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">District</label>
                                                <input required type="text" name="district"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="District">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">மாவட்டம்</label>
                                                <input required type="text" name="district_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="மாவட்டம்">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Landmark / Taluka</label>
                                                <input required type="text" name="taluka"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Landmark / Taluka">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">நில எல்லைக்குறி / வட்டம்</label>
                                                <input required type="text" name="taluka_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="நில எல்லைக்குறி / வட்டம்">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Village / Town / City</label>
                                                <input required type="text" name="village"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">கிராமம் / நகரம்/ நகரம்</label>
                                                <input required type="text" name="village_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Enter here">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Post Office</label>
                                                <input required type="text" name="post_office"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="Post Office">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">தபால் அலுவலகம்</label>
                                                <input required type="text" name="post_office_tamil"
                                                    class="form-control border border-dark" maxlength="100"
                                                    placeholder="தபால் அலுவலகம்">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-primary">Pin Code</label>
                                                <input required type="text" name="pin_code"
                                                    class="form-control border border-dark number" maxlength="20"
                                                    placeholder="Pin Code">
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-btn" data-prev="step1">←
                                                Previous</button>
                                            <button type="button" class="btn btn-danger next-btn" data-next="step3">Next
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
                                            <button type="button" class="btn btn-secondary prev-btn" data-prev="step2">←
                                                Previous</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>

                                    </div>

                                </div>
                            @endif
                            <div class="text-center">
                                <p id="nopayment"></p>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary w-100">
                                    Apply Now
                                </button> --}}
                            @if ($serviceid != 56)
                                <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button id="save" type="submit" class="btn btn-success">Apply
                                                Now</button>
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
    </div>
@endsection
@push('page_scripts')
    <script>
document.addEventListener("DOMContentLoaded", function () {

    /* =============================
       NUMBER ONLY INPUT
    ============================= */
    document.querySelectorAll('.number').forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    });

    /* =============================
       VALIDATION
    ============================= */
        const requiredFields = [
        'state',
        'state_tamil',
        'district',
        'district_tamil',
        'taluka',
        'taluka_tamil',
        'village',
        'village_tamil',
        'post_office',
        'post_office_tamil',
        'pin_code'
    ];

    /* =============================
       VALIDATE STEP FUNCTION
    ============================= */
    function validateStep(stepId) {
        let valid = true;
        let step = document.getElementById(stepId);

        // ===== STEP 1 VALIDATION =====
        if (stepId === 'step1') {
            const aadhaarNo = step.querySelector('input[name="aadhaar_no"]');
            const mobile = step.querySelector('input[name="mobile"]');
            const name = step.querySelector('input[name="name"]');
            const idProof = step.querySelector('select[name="id_proof"]');

            // Reset previous invalid classes
            [aadhaarNo, mobile, name, idProof].forEach(f => f.classList.remove('invalid-field'));

            // Aadhaar number (12 digits)
            if (aadhaarNo.value.trim() === '' || !/^\d{12}$/.test(aadhaarNo.value)) {
                aadhaarNo.classList.add('invalid-field');
                valid = false;
            }

            // Mobile number (10 digits)
            if (mobile.value.trim() === '' || !/^\d{10}$/.test(mobile.value)) {
                mobile.classList.add('invalid-field');
                valid = false;
            }

            // Name required
            if (name.value.trim() === '') {
                name.classList.add('invalid-field');
                valid = false;
            }

            // ID Proof required
            if (idProof.value.trim() === '') {
                idProof.classList.add('invalid-field');
                valid = false;
            } else {
                // Conditional file validation
                const fileMap = {
                    'Aadhaar Card': 'aadhaar_card',
                    'Bank Passbook': 'bank_pass_book',
                    'Smartcard Online Print': 'smartcard_onlineprint',
                    'Voter Id': 'voterid'
                };
                const fileInputName = fileMap[idProof.value];
                const fileInput = step.querySelector(`input[name="${fileInputName}"]`);
                if (fileInput && fileInput.files.length === 0) {
                    fileInput.classList.add('invalid-field');
                    valid = false;
                }
            }

            return valid;
        }

        // ===== OTHER STEPS VALIDATION =====
        step.querySelectorAll('input, select, textarea').forEach(field => {

            // Ignore hidden
            if (field.offsetParent === null) return;

            // Ignore disabled
            if (field.disabled) return;

            // Ignore buttons
            if (field.type === "button" || field.type === "submit") return;

            // Reset
            field.classList.remove('invalid-field');

            let name = field.name;

            // Only validate fields in requiredFields
            if (!requiredFields.includes(name)) return;

            // FILE INPUT
            if (field.type === "file") {
                let alreadyUploaded = field.dataset.exists === "1";
                if (field.files.length === 0 && !alreadyUploaded) {
                    field.classList.add('invalid-field');
                    valid = false;
                }
            }

            // TEXT / SELECT
            else {
                if (field.value.trim() === '') {
                    field.classList.add('invalid-field');
                    valid = false;
                }
            }

            // PIN CODE STRICT CHECK
            if (name === 'pin_code' && field.value.trim() !== '') {
                if (!/^[0-9]{6}$/.test(field.value)) {
                    field.classList.add('invalid-field');
                    valid = false;
                }
            }

        });

        return valid;
    }

    /* =============================
       STEP NAVIGATION
    ============================= */
    function showStep(stepId) {
        document.querySelectorAll('.tab-pane').forEach(el => {
            el.classList.remove('show', 'active');
        });

        document.getElementById(stepId).classList.add('show', 'active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let currentStep = this.closest('.tab-pane').id;

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

    /* =============================
       SCROLL TO ERROR
    ============================= */
    function scrollToError(stepId) {
        let step = document.getElementById(stepId);
        let firstError = step.querySelector('.invalid-field');

        if (firstError) {
            firstError.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    }

    /* =============================
       REMOVE ERROR ON INPUT
    ============================= */
    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', function () {
            this.classList.remove('invalid-field');
        });
        el.addEventListener('change', function () {
            this.classList.remove('invalid-field');
        });
    });

    /* =============================
       ADDRESS PREVIEW
    ============================= */
    function updatePreview() {
        function val(name) {
            return document.querySelector(`[name="${name}"]`)?.value || '';
        }

        function format(arr) {
            return arr.filter(v => v.trim() !== '').join(', ');
        }

        let eng = [
            format([val('apartment'), val('street_name'), val('postal_area_english')]),
          format([val('taluka'), val('village')]),
            format([val('post_office'), val('district')]),
            format([val('state'), val('pin_code')])
        ].filter(v => v !== '').join(', ');

        let tam = [
            format([val('door_no'), val('street_name_tamil'), val('postal_area_tamil')]),
           format([val('taluka_tamil'), val('village_tamil')]),
            format([val('post_office_tamil'), val('district_tamil')]),
            format([val('state_tamil'), val('pin_code')])
        ].filter(v => v !== '').join(', ');

        document.getElementById("englishPreview").innerText = eng;
        document.getElementById("tamilPreview").innerText = tam;
    }

    document.querySelectorAll("input, select").forEach(el => {
        el.addEventListener("input", updatePreview);
        el.addEventListener("change", updatePreview);
    });

    updatePreview();

});
/* =============================
   FILE TOGGLE (ID PROOF)
============================= */
$('#id_proof').change(function () {

    $('#aadhaarhide, #passbookhide, #smartcardhide, #voteridhide').hide();
    $('#aadhaar_card, #bank_pass_book, #smartcard_onlineprint, #voterid').prop("required", false);

    if (this.value === 'Aadhaar Card') {
        $('#aadhaarhide').show();
        $('#aadhaar_card').prop("required", true);
    }
    else if (this.value === 'Bank Passbook') {
        $('#passbookhide').show();
        $('#bank_pass_book').prop("required", true);
    }
    else if (this.value === 'Smartcard Online Print') {
        $('#smartcardhide').show();
        $('#smartcard_onlineprint').prop("required", true);
    }
    else if (this.value === 'Voter Id') {
        $('#voteridhide').show();
        $('#voterid').prop("required", true);
    }
});


/* =============================
   FORM SUBMIT BUTTON DISABLE
============================= */
document.getElementById("myForm").addEventListener("submit", function () {
    let btn = document.getElementById("save");
    if (btn) {
        btn.disabled = true;
        btn.innerText = "Submitting...";
    }
});


/* =============================
   WALLET CHECK
============================= */
$(function () {
    let wallet = parseFloat("{{ Auth::user()->wallet }}");
    let amount = parseFloat("{{ $payment }}");

    if (amount > wallet) {
        $('#save').prop("disabled", true);
        $('#nopayment')
            .text("No Fund in Wallet. Please update your wallet.")
            .css({ color: 'red', fontWeight: 'bold' });
    }
});
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
</script>
@endpush
