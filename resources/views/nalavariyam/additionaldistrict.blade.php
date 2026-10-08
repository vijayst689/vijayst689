@extends('layouts.app')
@section('content')
<style>
    /* Page Background */
.page-content{
    background:#f4f7fc;
}

/* Main Card */
.card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* Header */
.bg-primary.bg-gradient{
    background:linear-gradient(135deg,#0d6efd,#00bcd4)!important;
}

/* Form Labels */
.form-label{
    font-weight:600;
    color:#344054;
}

/* Inputs */
.form-control,
.form-select{
    border-radius:12px;
    border:1px solid #dbe2ea;
    transition:.3s;
}

.form-control:focus,
.form-select:focus{
    border-color:#0d6efd;
    box-shadow:0 0 0 4px rgba(13,110,253,.15);
}

/* Input Groups */
.input-group-text{
    border-radius:12px 0 0 12px;
}

/* Buttons */
.btn-primary{
    background:linear-gradient(135deg,#0d6efd,#00bcd4);
    border:none;
}

.btn-primary:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(13,110,253,.25);
}

.btn-success{
    border:none;
}

.btn-success:hover{
    transform:translateY(-2px);
}

/* Save Button */
#save{
    min-width:220px;
}

/* District Badges */
.badge.bg-success{
    font-size:13px;
    font-weight:500;
}

/* Verify Button */
#checkotp,
#subotp{
    min-width:140px;
}

/* Alerts */
.alert{
    border:none;
    border-radius:12px;
}

/* Aadhaar Verify Section */
#verifyotphide{
    animation:fadeIn .4s ease;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Mobile */
@media(max-width:768px){

    .card-body{
        padding:20px !important;
    }

    .btn-lg{
        width:100%;
        margin-bottom:10px;
    }

    #checkotp,
    #subotp{
        min-width:auto;
    }
}
</style>    
@php
    use Illuminate\Support\Facades\DB;

    $selectedDistrictIds = [];
    if (!empty(Auth::user()->nalavariyam_dist_id)) {
        $selectedDistrictIds = array_map('intval', explode(',', Auth::user()->nalavariyam_dist_id));
    }

    $selectedDistrictNames = [];
    if (!empty($selectedDistrictIds)) {
        $selectedDistrictNames = DB::table('nalavariyam_district')
            ->whereIn('id', $selectedDistrictIds)
            ->pluck('district_name')
            ->toArray();
    }
@endphp
    <div class="page-wrapper">
        <div class="page-content">
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
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="bg-primary bg-gradient text-white p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h3 class="mb-1 fw-bold">
                                <i class="fas fa-user-check me-2"></i>
                                Nalavariyam Activation
                            </h3>
                            <p class="mb-0 opacity-75">Verify Aadhaar and activate district access</p>
                        </div>
                        <a href="{{ url('/') }}" class="btn btn-light rounded-pill px-4">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form class="row g-4 permissionform"
                          action="{{ url('saveadditionaldistrict') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="userid" name="userid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="activation_amount_hidden" id="act_amount_hidden">

                        <div class="col-md-6">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">District</label>

                                @if(!empty($selectedDistrictNames))
                                    <div class="card bg-light border-0 shadow-sm mb-3">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="fw-bold text-muted">Already Activated Districts</small>
                                                <span class="badge bg-success rounded-pill">{{ count($selectedDistrictNames) }}</span>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($selectedDistrictNames as $districtName)
                                                    <span class="badge rounded-pill bg-success px-3 py-2">
                                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $districtName }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <select required name="nalavariyam_dist_id" id="dist_id" class="form-select form-select-lg shadow-sm">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $d)
                                        @php $isSelected = in_array((int) $d->id, $selectedDistrictIds); @endphp
                                        <option value="{{ $d->id }}" {{ $isSelected ? 'disabled' : '' }}>
                                            {{ $d->district_name }} {{ $isSelected ? '(Already Added)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="aadhaar_no" class="form-label fw-semibold">Aadhaar Number</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <input type="text"
                                           required
                                           maxlength="12"
                                           id="aadhaar_no"
                                           name="aadhaar_no"
                                           class="form-control number"
                                           placeholder="Enter 12 digit Aadhaar number">

                                    <button onclick="return getaadhaar_otpf();"
                                            id="checkotp"
                                            type="button"
                                            class="btn btn-primary px-4">
                                        <i class="fas fa-shield-alt me-1"></i>
                                        Verify
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4" id="verifyotphide" style="display:none;">
                                <label for="otp" class="form-label fw-semibold">OTP Verification</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <input type="text"
                                           id="otp"
                                           name="otp"
                                           maxlength="6"
                                           class="form-control"
                                           placeholder="Enter OTP">

                                    <input type="hidden" id="refid">

                                    <button onclick="return getaadhaar_dataf();"
                                            id="subotp"
                                            type="button"
                                            class="btn btn-success px-4">
                                        <i class="fas fa-check me-1"></i>
                                        Submit OTP
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="act_amount" class="form-label fw-semibold">Activation Payment</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-success text-white">₹</span>
                                    <input type="text"
                                           readonly
                                           required
                                           id="act_amount"
                                           name="activation_amount"
                                           class="form-control bg-light"
                                           placeholder="Auto calculated">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="fullname" class="form-label fw-semibold">Full Name</label>
                                <input type="text"
                                       readonly
                                       required
                                       id="fullname"
                                       name="full_name"
                                       class="form-control form-control-lg bg-light shadow-sm"
                                       placeholder="Name will appear after Aadhaar verification">
                            </div>

                           
                        </div>

                        <div class="col-12">
                            <div id="details" class="text-center"></div>
                            <div id="nopayment" class="text-center"></div>
                        </div>

                        <div class="col-12 text-center pt-2">
                            <button id="save"
                                    type="submit"
                                    class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                                <i class="fas fa-save me-2"></i>
                                Save Activation
                            </button>

                            <a href="{{ url('/') }}"
                               class="btn btn-outline-secondary btn-lg px-5 rounded-pill ms-2">
                                Cancel
                            </a>
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
$(function () {
    $('#save').prop('disabled', true);


    // Set activation amount based on user type
var usertype = "{{ Auth::user()->nalavariyam_usertype }}";
var userTypeId = "{{ Auth::user()->user_type_id }}";
var activationAmount = 0;

if (usertype == '3') {
    activationAmount = 1000;
} else if (usertype == '4') {
    activationAmount = 500;
} else if (userTypeId == '2') {
    activationAmount = 500;
}

    $('#act_amount').val(activationAmount);
    $('#act_amount_hidden').val(activationAmount);

    // Check wallet balance on page load
    checkWalletBalance(activationAmount);
});

/**
 * Check whether logged-in user has enough wallet balance
 */
function checkWalletBalance(requiredAmount) {
    var userid = $('#userid').val();

    $.ajax({
        url: "{{ url('/check-wallet-balance') }}/" + userid + "/" + requiredAmount,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.status === 'success') {
                if (result.has_balance) {
                    // Sufficient balance
                    $('#nopayment').html(
                        '<div class="alert alert-success shadow-sm">' +
                            '<i class="fas fa-wallet me-2"></i>' +
                            'Wallet Balance: ₹' + result.wallet_balance +
                            ' | Required: ₹' + requiredAmount +
                        '</div>'
                    );
                } else {
                    // Insufficient balance
                    $('#nopayment').html(
                        '<div class="alert alert-danger shadow-sm">' +
                            '<i class="fas fa-exclamation-triangle me-2"></i>' +
                            'Insufficient Wallet Balance. ' +
                            'Available: ₹' + result.wallet_balance +
                            ' | Required: ₹' + requiredAmount +
                        '</div>'
                    );

                    $('#checkotp').prop('disabled', true);
                    $('#save').prop('disabled', true);
                    $('#aadhaar_no').prop('disabled', true);
                    $('#dist_id').prop('disabled', true);
                }
            } else {
                $('#nopayment').html(
                    '<div class="alert alert-danger shadow-sm">' +
                        result.message +
                    '</div>'
                );

                $('#checkotp').prop('disabled', true);
                $('#save').prop('disabled', true);
            }
        },
        error: function() {
            $('#nopayment').html(
                '<div class="alert alert-danger shadow-sm">' +
                    'Unable to check wallet balance.' +
                '</div>'
            );

            $('#checkotp').prop('disabled', true);
            $('#save').prop('disabled', true);
        }
    });
}

function setVerifiedButton() {
    $('#checkotp')
        .removeClass('btn-primary')
        .addClass('btn-success')
        .html('<i class="fas fa-check-circle me-1"></i> Verified')
        .prop('disabled', true);

    $('#aadhaar_no').prop('readonly', true);
}

function getaadhaar_otpf() {
    var aadhaar = $('#aadhaar_no').val().trim();

    if (aadhaar === '') {
        alert('Please Enter Aadhaar Number');
        $('#aadhaar_no').focus();
        return false;
    }

    if (aadhaar.length < 12) {
        alert('Entered Aadhaar Number is Incorrect');
        $('#aadhaar_no').focus();
        return false;
    }

    $('#checkotp').prop('disabled', true)
                  .html('<span class="spinner-border spinner-border-sm me-1"></span> Sending');

    $.ajax({
        url: "{{ url('/getaadhaar_otpf') }}/" + aadhaar,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.status == 'false') {
                alert(result.message);
                $('#checkotp')
                    .prop('disabled', false)
                    .removeClass('btn-success')
                    .addClass('btn-primary')
                    .html('<i class="fas fa-shield-alt me-1"></i> Verify');
            } else {
                alert(result.message);
                $('#refid').val(result.client_id);
                $('#verifyotphide').slideDown();
                $('#checkotp')
                    .prop('disabled', false)
                    .html('<i class="fas fa-paper-plane me-1"></i> Resend OTP');
            }
        }
    });

    return false;
}

function getaadhaar_dataf() {
    var otp = $('#otp').val().trim();
    var aadhaar = $('#aadhaar_no').val().trim();
    var refid = $('#refid').val().trim();
    var userid = "{{ Auth::user()->id }}";

    if (otp === '') {
        alert('Please Enter OTP');
        $('#otp').focus();
        return false;
    }

    if (otp.length < 6) {
        alert('Entered OTP is Incorrect');
        $('#otp').focus();
        return false;
    }

    $('#subotp').prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm me-1"></span> Verifying');

    $.ajax({
        url: "{{ url('/getaadhaar_dataf') }}/" + otp + '/' + refid + '/' + aadhaar + '/' + userid,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.status == 'false') {
                alert(result.message);
                $('#subotp')
                    .prop('disabled', false)
                    .html('<i class="fas fa-check me-1"></i> Submit OTP');
            } else {
                $('#fullname').val(result.name || '');

                $('#verifyotphide').slideUp();
                $('#save').prop('disabled', false);

                // Change Verify button to Verified
                setVerifiedButton();
            }
        }
    });

    return false;
}
</script>
    @endpush
