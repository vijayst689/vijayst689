@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
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
                                    <form class="row g-4" action="{{ url('submitapply_passport') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                            @if ($serviceid == 144)
                                                <div class="mb-3 col-md-6">
                                                    <label for="application_type" class="form-label">Application
                                                        Type</label>
                                                    <select required id="application_type" name="application_type"
                                                        class="form-control">
                                                        <option value="">Select Application Type</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Tatkal">Tatkal</option>
                                                    </select>
                                                    <label for="name" class="form-label">Name</label>
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Name" maxlength="30" />
                                                    <label for="surname" class="form-label">Surname</label>
                                                    <input required type="text" class="form-control" name="surname"
                                                        placeholder="Surname" maxlength="30" />
                                                    <label for="dob" class="form-label">DOB</label>
                                                    <input required type="date" maxlength="10" class="form-control"
                                                        name="dob" placeholder="DOB" />
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select required id="gender" name="gender" class="form-control">
                                                        <option value="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <label for="place_of_birth" class="form-label">Place Of Birth</label>
                                                    <input required type="text" class="form-control"
                                                        name="place_of_birth" placeholder="Place Of Birth" maxlength="30" />
                                                    <label for="district_of_birth" class="form-label">District Of
                                                        Birth</label>
                                                    <input required type="text" class="form-control"
                                                        name="district_of_birth" placeholder="District Of Birth"
                                                        maxlength="30" />
                                                    <label for="qualification" class="form-label">Educational
                                                        Qualification</label>
                                                    <input required type="text" class="form-control"
                                                        name="qualification" placeholder="Educational Qualification"
                                                        maxlength="30" />
                                                    <label for="email_id" class="form-label">Email Id</label>
                                                    <input required type="email" class="form-control" name="email_id"
                                                        placeholder="Email Id" maxlength="30" />
                                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                    <input required type="text" maxlength="12" class="form-control"
                                                        name="aadhaar_no" placeholder="Aadhaar Number" />
                                                    <label for="age_id_proof" class="form-label">Age Id Proof</label>
                                                    <select required id="age_id_proof" name="age_id_proof"
                                                        class="form-control">
                                                        <option value="">Select Age Id Proof</option>
                                                        <option value="School Tc">School Tc</option>
                                                        <option value="Marksheet">Marksheet</option>
                                                        <option value="Birth Certificate">Birth Certificate</option>
                                                        <option value="Pan Card">Pan Card</option>
                                                        <option value="Voter Id">Voter Id</option>
                                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                                        <option value="Driving Licence">Driving Licence</option>
                                                        <option value="Lic Policy Bond">Lic Policy Bond</option>
                                                        <option value="Service Record Extract">Service Record Extract
                                                        </option>
                                                    </select>
                                                    <div class="" id="school_tchide" style="display: none;">
                                                        <label>School Tc</label>
                                                        <input id="school_tc" class="form-control" type="file"
                                                            name="school_tc">
                                                    </div>
                                                    <div class="" id="marksheethide" style="display: none;">
                                                        <label>Marksheet</label>
                                                        <input id="marksheet" class="form-control" type="file"
                                                            name="marksheet">
                                                    </div>
                                                    <div class="" id="birth_certificatehide"
                                                        style="display: none;">
                                                        <label>Birth Certificate</label>
                                                        <input id="birth_certificate" class="form-control" type="file"
                                                            name="birth_certificate">
                                                    </div>
                                                    <div class="" id="pan_cardhide" style="display: none;">
                                                        <label>Pan Card</label>
                                                        <input id="pan_card" class="form-control" type="file"
                                                            name="pan_card">
                                                    </div>
                                                    <div class="" id="voter_idhide" style="display: none;">
                                                        <label>Voter Id</label>
                                                        <input id="voter_id" class="form-control" type="file"
                                                            name="voter_id">
                                                    </div>
                                                    <div class="" id="aadhaar_cardhide" style="display: none;">
                                                        <label>Aadhaar Card</label>
                                                        <input id="aadhaar_card" class="form-control" type="file"
                                                            name="aadhaar_card">
                                                    </div>
                                                    <div class="" id="driving_licencehide" style="display: none;">
                                                        <label>Driving Licence</label>
                                                        <input id="driving_licence" class="form-control" type="file"
                                                            name="driving_licence">
                                                    </div>
                                                    <div class="" id="lic_policy_bondhide" style="display: none;">
                                                        <label>Lic Policy Bond</label>
                                                        <input id="lic_policy_bond" class="form-control" type="file"
                                                            name="lic_policy_bond">
                                                    </div>
                                                    <div class="" id="service_record_extracthide"
                                                        style="display: none;">
                                                        <label>Service Record Extract</label>
                                                        <input id="service_record_extract" class="form-control"
                                                            type="file" name="service_record_extract">
                                                    </div>

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select required id="type" name="type" class="form-control">
                                                        <option value="">Select Type</option>
                                                        <option value="Normal">Major</option>
                                                        <option value="Tatkal">Minor</option>
                                                    </select>
                                                    <label for="no_of_pages" class="form-label">No Of Pages</label>
                                                    <select required id="no_of_pages" name="no_of_pages"
                                                        class="form-control">
                                                        <option value="">Select No Of Pages</option>
                                                        <option value="36 Pages">36 Pages</option>
                                                        <option value="60 Pages">60 Pages</option>
                                                    </select>

                                                    <label for="father_name" class="form-label">Father Name</label>
                                                    <input required type="text" class="form-control"
                                                        name="father_name" placeholder="Father Name" maxlength="30" />
                                                    <label for="mother_name" class="form-label">Mother Name</label>
                                                    <input required type="text" class="form-control"
                                                        name="mother_name" placeholder="Mother Name" maxlength="30" />
                                                    <label for="validity" class="form-label">Validity</label>
                                                    <input required type="text" maxlength="30" class="form-control"
                                                        name="validity" placeholder="Validity" />
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input required type="text" maxlength="10"
                                                        class="form-control number" name="mobile"
                                                        placeholder="Mobile Number" />
                                                    <label for="state_of_birth" class="form-label">State Of Birth</label>
                                                    <input required type="text" class="form-control"
                                                        name="state_of_birth" placeholder="State Of Birth"
                                                        maxlength="30" />
                                                    <label for="address" class="form-label">Full
                                                        Address(Permanent)</label>
                                                    <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address"
                                                        placeholder="Full Address"></textarea>
                                                    <label for="employee_type" class="form-label">Employement Type</label>
                                                    <select required id="employee_type" name="employee_type"
                                                        class="form-control">
                                                        <option value="">Select Employement Type</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Self Employed">Self Employed</option>
                                                        <option value="House Wife">House Wife</option>
                                                        <option value="Retired Government Employee">Retired Government
                                                            Employee</option>
                                                        <option value="Private">Private</option>
                                                        <option value="Central Government Employee">Central Government
                                                            Employee</option>
                                                        <option value="State Government Employee">State Government Employee
                                                        </option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <label for="area_police_station_name" class="form-label">Your Area
                                                        Police Station Name</label>
                                                    <input required type="text" class="form-control"
                                                        name="area_police_station_name"
                                                        placeholder="Your Area Police Station Name" maxlength="30" />
                                                    <label for="address_proof" class="form-label">Address Proof</label>
                                                    <select required id="address_proof" name="address_proof"
                                                        class="form-control">
                                                        <option value="">Select Address Proof</option>
                                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                                        <option value="Voter Id">Voter Id</option>
                                                        <option value="Bank Statement">Bank Statement</option>
                                                        <option value="Old Passport Copy">Old Passport Copy</option>
                                                        <option value="Electric">Electric</option>
                                                        <option value="Gas Connection Proof">Gas Connection Proof</option>
                                                        <option value="Rent Agreement">Rent Agreement</option>
                                                        <option value="Certificate From Employer">Certificate From Employer
                                                        </option>
                                                        <option value="Parent Passport">Parent Passport</option>
                                                        <option value="Income Tax Assessment">Income Tax Assessment
                                                        </option>
                                                    </select>
                                                    <div class="" id="aadhaarcardhide" style="display: none;">
                                                        <label>Aadhaar Card</label>
                                                        <input id="aadhaar_card" class="form-control" type="file"
                                                            name="aadhaar_card">
                                                    </div>
                                                    <div class="" id="voteridhide" style="display: none;">
                                                        <label>Voter Id</label>
                                                        <input id="voter_id" class="form-control" type="file"
                                                            name="voter_id">
                                                    </div>
                                                    <div class="" id="bank_statementhide" style="display: none;">
                                                        <label>Bank Statement</label>
                                                        <input id="bank_statement" class="form-control" type="file"
                                                            name="bank_statement">
                                                    </div>
                                                    <div class="" id="old_passport_copyhide"
                                                        style="display: none;">
                                                        <label>Old Passport Copy</label>
                                                        <input id="old_passport_copy" class="form-control" type="file"
                                                            name="old_passport_copy">
                                                    </div>
                                                    <div class="" id="electrichide" style="display: none;">
                                                        <label>Electric</label>
                                                        <input id="electric" class="form-control" type="file"
                                                            name="electric">
                                                    </div>
                                                    <div class="" id="gas_connection_proofhide"
                                                        style="display: none;">
                                                        <label>Gas Connection Proof</label>
                                                        <input id="gas_connection_proof" class="form-control"
                                                            type="file" name="gas_connection_proof">
                                                    </div>
                                                    <div class="" id="rent_agreementhide" style="display: none;">
                                                        <label>Rent Agreement</label>
                                                        <input id="rent_agreement" class="form-control" type="file"
                                                            name="rent_agreement">
                                                    </div>
                                                    <div class="" id="certificate_from_employerhide"
                                                        style="display: none;">
                                                        <label>Certificate From Employer</label>
                                                        <input id="certificate_from_employer" class="form-control"
                                                            type="file" name="certificate_from_employer">
                                                    </div>
                                                    <div class="" id="parent_passporthide" style="display: none;">
                                                        <label>Parent Passport</label>
                                                        <input id="parent_passport" class="form-control" type="file"
                                                            name="parent_passport">
                                                    </div>
                                                    <div class="" id="income_tax_assesssmenthide"
                                                        style="display: none;">
                                                        <label>Income Tax Assessment</label>
                                                        <input id="income_tax_assesssment" class="form-control"
                                                            type="file" name="income_tax_assesssment">
                                                    </div>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <p id="nopayment"></p>
                                        </div>
                                        <div class="text-center">
                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <button id="save" type="submit"
                                                        class="btn btn-primary">Apply</button>
                                                </div>
                                            </div>
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

                    $('#age_id_proof').change(function() {
                        if ($('#age_id_proof').val() == 'School Tc') {
                            $('#school_tchide').show("slow");
                            $('#marksheethide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#marksheet').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#school_tc').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Marksheet') {
                            $('#marksheethide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#marksheet').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Birth Certificate') {
                            $('#birth_certificatehide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#birth_certificate').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Pan Card') {
                            $('#pan_cardhide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#pan_card').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Voter Id') {
                            $('#voter_idhide').show("slow");
                            $('#marksheethide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#voter_id').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Aadhaar Card') {
                            $('#aadhaar_cardhide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#aadhaar_card').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Driving Licence') {
                            $('#driving_licencehide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#driving_licence').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Lic Policy Bond') {
                            $('#lic_policy_bondhide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#lic_policy_bond').prop("required", true);

                        } else if ($('#age_id_proof').val() == 'Service Record Extract') {
                            $('#service_record_extracthide').show("slow");
                            $('#school_tchide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#birth_certificate').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#service_record_extract').prop("required", true);

                        } else {
                            $('#school_tchide').hide("slow");
                            $('#marksheethide').hide("slow");
                            $('#birth_certificatehide').hide("slow");
                            $('#pan_cardhide').hide("slow");
                            $('#voter_idhide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#driving_licencehide').hide("slow");
                            $('#lic_policy_bondhide').hide("slow");
                            $('#service_record_extracthide').hide("slow");
                            $('#school_tc').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#marksheet').prop("required", false);
                            $('#pan_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_licence').prop("required", false);
                            $('#lic_policy_bond').prop("required", false);
                            $('#service_record_extract').prop("required", false);
                            $('#birth_certificate').prop("required", false);

                        }
                    });

                    $('#address_proof').change(function() {
                        if ($('#address_proof').val() == 'Aadhaar Card') {
                            $('#aadhaarcardhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#aadhaar_card').prop("required", true);

                        } else if ($('#address_proof').val() == 'Voter Id') {
                            $('#voteridhide').show("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#voter_id').prop("required", true);

                        } else if ($('#address_proof').val() == 'Bank Statement') {
                            $('#bank_statementhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#bank_statement').prop("required", true);

                        } else if ($('#address_proof').val() == 'Old Passport Copy') {
                            $('#old_passport_copyhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#old_passport_copy').prop("required", true);

                        } else if ($('#address_proof').val() == 'Electric') {
                            $('#electrichide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#electric').prop("required", true);

                        } else if ($('#address_proof').val() == 'Gas Connection Proof') {
                            $('#gas_connection_proofhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#gas_connection_proof').prop("required", true);

                        } else if ($('#address_proof').val() == 'Rent Agreement') {
                            $('#rent_agreementhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#rent_agreement').prop("required", true);

                        } else if ($('#address_proof').val() == 'Certificate From Employer') {
                            $('#certificate_from_employerhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#certificate_from_employer').prop("required", true);

                        } else if ($('#address_proof').val() == 'Parent Passport') {
                            $('#parent_passporthide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);
                            $('#parent_passport').prop("required", true);

                        } else if ($('#address_proof').val() == 'Income Tax Assessment') {
                            $('#income_tax_assesssmenthide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#aadhaarcardhide').hide("slow");
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#aadhaar_card').prop("required", false);
                            $('#income_tax_assesssment').prop("required", true);

                        } else {
                            $('#aadhaarcardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_statementhide').hide("slow");
                            $('#old_passport_copyhide').hide("slow");
                            $('#electrichide').hide("slow");
                            $('#gas_connection_proofhide').hide("slow");
                            $('#rent_agreementhide').hide("slow");
                            $('#certificate_from_employerhide').hide("slow");
                            $('#parent_passporthide').hide("slow");
                            $('#income_tax_assesssmenthide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#voter_id').prop("required", false);
                            $('#bank_statement').prop("required", false);
                            $('#old_passport_copy').prop("required", false);
                            $('#electric').prop("required", false);
                            $('#gas_connection_proof').prop("required", false);
                            $('#rent_agreement').prop("required", false);
                            $('#certificate_from_employer').prop("required", false);
                            $('#parent_passport').prop("required", false);
                            $('#income_tax_assesssment').prop("required", false);

                        }
                    });
                </script>
            @endpush
