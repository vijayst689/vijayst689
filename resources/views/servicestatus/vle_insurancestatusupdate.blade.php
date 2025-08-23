@extends('layouts.app')
@section('content')
     <div class="page-wrapper">
        <div class="page-content">
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
                        <div class="card-body p-4">
                            <form action="{{ url('/vleinsurance_update') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
                                <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                @php
                                    $apply_user_id = 0;
                                    if ($services->retailer_id == 0) {
                                        $apply_user_id = $services->distributor_id;
                                    } elseif ($services->distributor_id == 0) {
                                        $apply_user_id = $services->retailer_id;
                                    }
                                @endphp
                                <div class="mb-3 col-md-6">
                                    <label for="csc_id_number" class="form-label">CSC ID Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->csc_id_number }}"  class="form-control"
                                    name="csc_id_number" maxlength="20" placeholder="CSC ID Number"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                  <label for="csc_password" class="form-label">CSC Password</label>
                                  <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->csc_password }}"  class="form-control"
                                  name="csc_password" maxlength="15" placeholder="CSC Password"/>
                               </div>
                               <div class="mb-3 col-md-6">
                               <label for="aadhaar_card" class="form-label">Aadhaar Card (Front & Back)</label>
                              @if($customers->aadhaar_file == "")
                              <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                              @else
                              <br><a target="_blank" href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}" class="btn btn-primary me-2">View</a><br>
                              @endif
                              </div>

                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                    <div class="mb-3 col-md-6">
                                        <label for="service_name" class="form-label">Service Status</label>
                                        <select required class="form-control" name="status" id="service_status">
                                            <option value="">Select</option>
                                            <option @if ($services->status == 'Pending') selected @endif
                                                value="Pending">
                                                Pending
                                            </option>
                                            <option @if ($services->status == 'Resubmit') selected @endif
                                                value="Resubmit">
                                                Resubmit
                                            </option>
                                            <option @if ($services->status == 'Processing') selected @endif
                                                value="Processing">
                                                Processing</option>
                                            @if ($services->status == 'Processing' || $services->status == 'Approved')
                                                <option @if ($services->status == 'Approved') selected @endif
                                                    value="Approved">
                                                    Approved</option>
                                            @endif
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
                                            type="text" maxlength="20" name="application_no"
                                            id="application_no" />
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
                                @if ($services->status == 'Resubmit' && ($services->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id))
                                    <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                @elseif($services->status == 'Approved')
                                    <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                @else
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
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
            var any_proof = "{{ $services->any_proof }}";
            var new_proof = "{{ $services->new_proof }}";


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
                if (acknowledgement == "") {
                    $('#certificate').prop("required", true);
                }
            }
        });


        var status = "{{ $services->status }}";
        var any_document = "{{ $services->any_document }}";

        if (any_document = "ஆதார் அட்டை") {
            $('#aadhaar_cardhide').show("slow");
        } else if (any_document == "வாக்காளர் அடையாள அட்டை") {
            $('#voteridhide').show("slow");
        } else if (any_document == "பாஸ்போர்ட்") {
            $('#passporthide').show("slow");
        } else if (any_document == "மின்சார கட்டணம் ரசீது") {
            $('#electricity_bill_receipthide').show("slow");
        } else if (any_document == "தொலைபேசி கட்டணம்") {
            $('#telephone_chargeshide').show("slow");
        } else if (any_document == "எரிவாயு சிலிண்டர் ரசீது") {
            $('#gas_cylinder_receipthide').show("slow");
        } else if (any_document == "விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி") {
            $('#property_tax_applicant_owns_househide').show("slow");
        } else if (any_document == "வாடகை ஒப்பந்த பத்திரம்") {
            $('#lease_deedhide').show("slow");
        } else if (any_document == "குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை") {
            $('#allotment_rder_of_slum_replacement_boardhide').show("slow");
        } else if (any_document == "கொத்தடிமை விடுப்பு சான்று") {
            $('#bond_leave_proofhide').show("slow");
        } else if (any_document == "வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்") {
            $('#first_page_of_bank_account_bookhide').show("slow");
        }


        if (any_proof = "இறப்பு சான்றிதழ்") {
            $('#death_hide').show("slow");
        }
        if (any_proof == "திருமண சான்று") {
            $('#maraige_hide').show("slow");
        }
        if (any_proof == "திருமண பத்திரிக்கை") {
            $('#invite_hide').show("slow");
        }

        if (new_proof = "ஆதார் அட்டை") {
            $('#adh_hide').show("slow");
        }
        if (new_proof == "பிறப்பு சான்றிதழ்") {
            $('#born_hide').show("slow");
        }
        if (new_proof == "வாக்காளர் அட்டை") {
            $('#born_hide').show("slow");
        }

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
            } else if ($('#service_status').val() == 'Processing') {
                $('#acknowledgementhide').show("slow");
                $('#acknowledgement').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
            } else if ($('#service_status').val() == 'Approved') {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').show("slow");
                $('#certificate').prop("required", true);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
            } else {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
            }
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

            } else if ($('#any_document').val() == 'வாக்காளர் அடையாள அட்டை') {
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

            } else if ($('#residence_proof').val() == 'வாகாளர் அடையாள அட்டை') {
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
    </script>
@endpush
