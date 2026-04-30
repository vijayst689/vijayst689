@extends('layouts.app')
@section('content')
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
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h6 class="card-title">Service Payment : <span
                                        class="text-danger">{{ $payment }}</span></h6>
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('submitsmartcardapply1') }}"
                                        onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                                        id="myForm">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            @if ($serviceid == 77)
                                                <div class="mb-3 col-md-6">
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />
                                                </div>
                                            @elseif($serviceid == 78)
                                                <div class="mb-3 col-md-6">

                                                    <label for="aadhaar_card" class="form-label">Adhaar Card (குடும்ப
                                                        தலைவர்)</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />

                                                </div>
                                                <div class="mb-3 col-md-6">

                                                    <label for="smart_card" class="form-label">Smart Card</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="smart_card" />

                                                </div>
                                            @elseif($serviceid == 79)
                                                <div class="mb-3 col-md-6">

                                                    <label for="applicant_reciept" class="form-label">Application
                                                        Receipt</label>
                                                    <input required type="file" class="form-control"
                                                        name="applicant_reciept" placeholder="Name" />

                                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />

                                                </div>
                                                <div class="mb-3 col-md-6">

                                                    <label for="photo" class="form-label">Photo</label>
                                                    <input required type="file" class="form-control" name="photo" />

                                                    <label for="aadhaar_card" class="form-label">Family members
                                                        adhaar</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />

                                                </div>
                                            @elseif($serviceid == 80)
                                                <div class="mb-3 col-md-6">
                                                    <label for="mobile" class="form-label">Mobile Number (Adhaar
                                                        Link)</label>
                                                    <input required maxlength="10" type="text"
                                                        class="form-control number" name="mobile"
                                                        placeholder="Mobile Number (Adhaar Link)" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="smart_mobile" class="form-label">Mobile Number (Smart Card
                                                        Link)</label>
                                                    <input required maxlength="10" type="text"
                                                        class="form-control number" name="smart_mobile"
                                                        placeholder="Mobile Number (Smart Card Link)" />
                                                </div>
                                            @elseif($serviceid == 81)
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label">Photo (குடும்ப
                                                        தலைவர்)</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="photo" />

                                                    <label class="form-label">Change Type</label>
                                                    <select required name="change_cardtype" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="NPHH to PHH">NPHH to PHH</option>
                                                        <option value="NPHH to AAY">NPHH to AAY</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">

                                                    <label for="smartcard_online" class="form-label">Smart Card (online
                                                        Print)</label>
                                                    <input accept="image/jpeg, image/png, application/pdf" type="file"
                                                        class="form-control" name="smartcard_online" />

                                                </div>
                                            @elseif($serviceid == 82)
                                                <div class="mb-3 col-md-6">

                                                    <label>Aadhaar Card</label>
                                                    <input required id="aadhaar_card" class="form-control" type="file"
                                                        name="aadhaar_card">

                                                    <label for="mobile" class="form-label number">Mobile Number (Adhaar
                                                        Link)</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />
                                                </div>
                                                <div class="mb-3 col-md-6">

                                                    <label for="smart_card" class="form-label">Smart card</label>
                                                    <input accept="image/jpeg, image/png" required type="file"
                                                        class="form-control" name="smart_card" />

                                                </div>
                                                <div class="row">
                                                @elseif($serviceid == 83)
                                                    <div class="mb-3 col-md-6">

                                                        <label>Aadhaar Card</label>
                                                        <input required id="aadhaar_card" class="form-control"
                                                            type="file" name="aadhaar_card">

                                                    </div>
                                                    <div class="mb-3 col-md-6">

                                                        <label for="mobile" class="form-label number">Mobile Number
                                                            (Smart Card
                                                            Linked)</label>
                                                        <input required type="text" maxlength="10"
                                                            class="form-control" name="mobile"
                                                            placeholder="Mobile Number" />
                                                    </div>
                                                @elseif($serviceid == 84)
                                                    <div class="mb-3 col-md-6">

                                                        <label for="smartcard_online" class="form-label">Smart Card
                                                            (online
                                                            Print)</label>
                                                        <input accept="image/jpeg, image/png, application/pdf" required
                                                            type="file" class="form-control"
                                                            name="smartcard_online" />

                                                    </div>
                                                    <div class="mb-3 col-md-6">

                                                        <label for="smart_card" class="form-label">Smart Card (Xerox or
                                                            original)</label>
                                                        <input accept="image/jpeg, image/png" required type="file"
                                                            class="form-control" name="smart_card" />

                                                    </div>
                                            @endif
                                            <div class="text-center">
                                                <p id="nopayment"></p>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary me-2">Apply</button>
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
                        $("#acc_number, #confirmacc_number").keyup(checkAccountNumberMatch);
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


                    $('#any_document').change(function() {
                        if ($('#any_document').val() == 'ஆதார் அட்டை') {
                            $('#aadhaar_cardhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#aadhaar_card').prop("required", true);

                        } else if ($('#any_document').val() == 'வாகாளர் அடையாள அட்டை') {
                            $('#voteridhide').show("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#voterid').prop("required", true);

                        } else if ($('#any_document').val() == 'பாஸ்போர்ட்') {
                            $('#passporthide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#passport').prop("required", true);

                        } else if ($('#any_document').val() == 'மின்சார கட்டணம் ரசீது') {
                            $('#electricity_bill_receipthide').show("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", true);

                        } else if ($('#any_document').val() == 'தொலைபேசி கட்டணம்') {
                            $('#telephone_chargeshide').show("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required");
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required");
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#telephone_charges').prop("required", true);

                        } else if ($('#any_document').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                            $('#gas_cylinder_receipthide').show("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required");
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", true);

                        } else if ($('#any_document').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                            $('#property_tax_applicant_owns_househide').show("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required");
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required");
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", true);

                        } else if ($('#any_document').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                            $('#lease_deedhide').show("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#lease_deed').prop("required", true);

                        } else if ($('#any_document').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                            $('#allotment_rder_of_slum_replacement_boardhide').show("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", true);

                        } else if ($('#any_document').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                            $('#bond_leave_proofhide').show("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $$('#aadhaar_card').prop("required");
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#bond_leave_proof').prop("required", true);

                        } else if ($('#any_document').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                            $('#first_page_of_bank_account_bookhide').show("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required");
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", true);

                        } else {
                            $('#aadhaar_cardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#passporthide').hide("slow");
                            $('#electricity_bill_receipthide').hide("slow");
                            $('#telephone_chargeshide').hide("slow");
                            $('#gas_cylinder_receipthide').hide("slow");
                            $('#property_tax_applicant_owns_househide').hide("slow");
                            $('#lease_deedhide').hide("slow");
                            $('#first_page_of_bank_account_bookhide').hide("slow");
                            $('#bond_leave_proofhide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);

                        }
                    });
                    $('#residence_proof').change(function() {
                        if ($('#residence_proof').val() == 'ஆதார் அட்டை') {
                            $('#aadhaar_card').show("slow");
                            $('#voterid').hide("slow");
                            $('#passport').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#aadhaar_card').prop("required", true);

                        } else if ($('#residence_proof').val() == 'வாக்காளர் அடையாள அட்டை') {
                            $('#voterid').show("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#passport').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#voterid').prop("required", true);

                        } else if ($('#residence_proof').val() == 'பாஸ்போர்ட்') {
                            $('#passport').show("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#passport').prop("required", true);

                        } else if ($('#residence_proof').val() == 'மின்சார கட்டணம் ரசீது') {
                            $('#electricity_bill_receipt').show("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", true);

                        } else if ($('#residence_proof').val() == 'தொலைபேசி கட்டணம்') {
                            $('#telephone_charges').show("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#telephone_charges').prop("required", true);

                        } else if ($('#residence_proof').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                            $('#gas_cylinder_receipt').show("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required");
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", true);

                        } else if ($('#residence_proof').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                            $('#property_tax_applicant_owns_house').show("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", true);

                        } else if ($('#residence_proof').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                            $('#lease_deed').show("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receip').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#lease_deed').prop("required", true);

                        } else if ($('#residence_proof').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                            $('#allotment_rder_of_slum_replacement_board').show("slow");
                            $('#lease_deed').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required");
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", true);

                        } else if ($('#residence_proof').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                            $('#bond_leave_proof').show("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                            $('#bond_leave_proof').prop("required", true);

                        } else if ($('#residence_proof').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                            $('#first_page_of_bank_account_book').show("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#allotment_rder_of_slum_replacement_board').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#passport').hide("slow");
                            $('#voterid').hide("slow");
                            $('#aadhaar_card').hide("slow");
                            $$('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", true);

                        } else {
                            $('#aadhaar_card').hide("slow");
                            $('#voterid').hide("slow");
                            $('#passport').hide("slow");
                            $('#electricity_bill_receipt').hide("slow");
                            $('#telephone_charges').hide("slow");
                            $('#gas_cylinder_receipt').hide("slow");
                            $('#property_tax_applicant_owns_house').hide("slow");
                            $('#lease_deed').hide("slow");
                            $('#first_page_of_bank_account_book').hide("slow");
                            $('#bond_leave_proof').hide("slow");
                            $('#driving_license').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#passport').prop("required", false);
                            $('#electricity_bill_receipt').prop("required", false);
                            $('#telephone_charges').prop("required", false);
                            $('#gas_cylinder_receipt').prop("required", false);
                            $('#property_tax_applicant_owns_house').prop("required", false);
                            $('#lease_deed').prop("required", false);
                            $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                            $('#bond_leave_proof').prop("required", false);
                            $('#first_page_of_bank_account_book').prop("required", false);
                        }
                    });

                    $('#any_proof').change(function() {
                        if ($('#any_proof').val() == 'இறப்பு சான்றிதழ்') {
                            $('#death_hide').show("slow");
                            $('#death').prop("required", true);
                            $('#maraige_hide').hide("slow");
                            $('#maraige').prop("required", false);
                            $('#invite_hide').hide("slow");
                            $('#invite').prop("required", false);
                        } else if ($('#any_proof').val() == 'திருமண சான்று') {
                            $('#maraige_hide').show("slow");
                            $('#maraige').prop("required", true);
                            $('#death_hide').hide("slow");
                            $('#death').prop("required", false);
                            $('#invite_hide').hide("slow");
                            $('#invite').prop("required", false);
                        } else if ($('#any_proof').val() == 'திருமண பத்திரிக்கை') {
                            $('#invite_hide').show("slow");
                            $('#invite').prop("required", true);
                            $('#death_hide').hide("slow");
                            $('#death').prop("required", false);
                            $('#maraige_hide').hide("slow");
                            $('#maraige').prop("required", false);
                        }
                    });

                    $('#new_proof').change(function() {
                        if ($('#new_proof').val() == 'ஆதார் அட்டை') {
                            $('#adh_hide').show("slow");
                            $('#adhar').prop("required", true);
                            $('#born_hide').hide("slow");
                            $('#born').prop("required", false);
                            $('#voterhide').hide("slow");
                            $('#voter').prop("required", false);
                        } else if ($('#new_proof').val() == 'பிறப்பு சான்றிதழ்') {
                            $('#born_hide').show("slow");
                            $('#born').prop("required", true);
                            $('#adh_hide').hide("slow");
                            $('#adhar').prop("required", false);
                            $('#voterhide').hide("slow");
                            $('#voter').prop("required", false);
                        } else if ($('#new_proof').val() == 'வாக்காளர் அட்டை') {
                            $('#voterhide').show("slow");
                            $('#voter').prop("required", true);
                            $('#adh_hide').hide("slow");
                            $('#adhar').prop("required", false);
                            $('#born_hide').hide("slow");
                            $('#born').prop("required", false);
                        }
                    });

                    $("#pricetable").on('click', '.btnDelete', function() {
                        $(this).closest('tr').remove();
                    });

                    function addnewrow() {
                        $("#pricetable tbody").append(
                            "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Mother'>தாய்</option><option value='Father'>தந்தை</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Father In Law'>மாமனார்</option><option value='Mother In Law'>மாமியார்</option><option value='Son In Law'>மருமகன்</option><option value='Daughter In Law'>மருமகள்</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'><td><input class='form-control' required type='date' name='relation_dob[]'></td><td><select required name='maritial_status[]' class='form-control alive_or_dead'><option value=''>Select</option><option value='Married'>Married</option><option value='Single'>Single</option><option value='Divorced'>Divorced</option></select></td><td><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='bx bx-trash'></i></a></td></tr>"
                        );
                    }
                </script>
            @endpush
