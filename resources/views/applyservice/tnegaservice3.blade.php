@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                        <div class="card-body p-4">
                            <form class="row g-4" action="{{ url('submitapply_tnegaservices3') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 row">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Do You Have
                                                    Can Number</label>
                                                <div class="col-sm-6">
                                                    <select required name="can_details" id="can_details"
                                                        class="form-control">
                                                        <option value="">Select Can Details</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Find">Find Can</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="cannumber" type="text"
                                                        name="can_number" value="{{ $customers->can_number }}"
                                                        maxlength="15">
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-center"> Basic Details </h4>

                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input value="{{ $customers->name }}" readonly required type="text"
                                                class="form-control" name="name" placeholder="Name" />


                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input value="{{ $customers->aadhaar_no }}" readonly required type="text"
                                                maxlength="12" class="form-control" name="aadhaar_no"
                                                placeholder="Aadhaar Number" />

                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input value="{{ $customers->phone }}" readonly required type="text"
                                                maxlength="10" class="form-control" name="mobile"
                                                placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">District</label>
                                            <select disabled name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $customers->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select disabled name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="panchayath_id" class="form-label">VAO</label>
                                            <select disabled name="panchayath_id" id="panchayath" class="form-control">
                                            </select>

                                            <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                            @if ($customers->aadhaar_file == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif

                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            @if ($customers->smartcard == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/smart_card/{{ $customers->smartcard }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            <label for="signature" class="form-label">Signature</label>
                                            @if ($customers->signature == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/signature/{{ $customers->signature }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            <label for="photo" class="form-label">Photo</label>
                                            @if ($customers->profile == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/profile_photo/{{ $customers->profile }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4 class="text-center"> Additional Details </h4>
                                        @if ($serviceid == 27)
                                            <div class="mb-3 col-md-6">
                                                <label>கணவர் இறப்பு சான்றிதழ்</label>
                                                <input class="form-control required" type="file"
                                                    name="husband_death_certificate">
                                                <label>விதவை சான்றிதழ்</label>
                                                <input class="form-control required" type="file"
                                                    name="widow_certificate">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>வங்கி பாஸ்புக்</label>
                                                <input class="form-control required" type="file"
                                                    name="bank_pass_book">
                                                <label>ஏதேனும் ஐடி ஆதாரம்</label>
                                                <select class="form-control required" id="id_proof" name="id_proof"
                                                    style="width: 100%;">
                                                    <option value="">Select Id Proof</option>

                                                    <option value="Passport">Passport</option>
                                                    <option value="PAN Card">PAN Card</option>
                                                    <option value="Voter Id">Voter Id</option>
                                                    <option value="Driving License">Driving License</option>
                                                </select>

                                                <div class="" id="passport" style="display: none;">
                                                    <label>பாஸ்போர்ட்</label>
                                                    <input id="passport" class="form-control required" type="file"
                                                        name="passport">
                                                </div>
                                                <div class="" id="pancard" style="display: none;">
                                                    <label>PAN கார்டு</label>
                                                    <input id="pancard" class="form-control required" type="file"
                                                        name="pancard">
                                                </div>
                                                <div class="" id="voterid" style="display: none;">
                                                    <label>வாக்காளர் ஐடி</label>
                                                    <input id="voterid" class="form-control required" type="file"
                                                        name="voterid">
                                                </div>
                                                <div class="" id="driving_license" style="display: none;">
                                                    <label>ஓட்டுநர் உரிமம்</label>
                                                    <input id="driving_license" class="form-control required"
                                                        type="file" name="driving_license">
                                                </div>
                                            </div>
                                        @elseif($serviceid == 28)
                                            <div class="mb-3 col-md-6">
                                                <label>கணவன் இறப்பு சான்றிதழ்</label>
                                                <input class="form-control required" type="file"
                                                    name="husband_death_certificate">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>திருமணச் சான்றிதழ்</label>
                                                <select class="form-control required" id="m_certificate"
                                                    name="mrg_docdetails" style="width: 100%;">
                                                    <option value="">Select Certificate</option>

                                                    <option value="Marriage Invitation">திருமண பத்திரிக்கை</option>
                                                    <option value="Marriage Registration Certificate">திருமண பதிவு சான்று
                                                    </option>
                                                    <option value="Marriage Documents">திருமணத்தை உறுதி செய்ய ஏதேனும் ஒரு
                                                        ஆவணம்</option>
                                                </select>

                                                <div class="" id="mrg_invitationhide" style="display: none;">
                                                    <label>திருமண பத்திரிக்கை</label>
                                                    <input id="mrg_invitation" class="form-control" type="file"
                                                        name="mrg_invitation">
                                                </div>
                                                <div class="" id="mrg_registration_certificatehide"
                                                    style="display: none;">
                                                    <label>திருமண பதிவு சான்று</label>
                                                    <input id="mrg_registration_certificate" class="form-control"
                                                        type="file" name="mrg_registration_certificate">
                                                </div>
                                                <div class="" id="mrg_documentshide" style="display: none;">
                                                    <label>திருமணத்தை உறுதி செய்ய ஏதேனும் ஒரு ஆவணம்</label>
                                                    <input id="mrg_documents" class="form-control" type="file"
                                                        name="mrg_documents">
                                                </div>
                                            @elseif($serviceid == 129)
                                                <div class="mb-3 col-md-6">
                                                    <label>Transfer Certificate(TC)</label>
                                                    <input class="form-control required" type="file"
                                                        name="tc_community_certificate">
                                                </div>
                                            </div>
                                        @endif

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
    </main>
@endsection
@push('page_scripts')
    <script>
        var dist_id = "{{ $customers->dist_id }}";
        var taluk_id = "{{ $customers->taluk_id }}";
        var wallet = "{{ Auth::user()->wallet }}";
        var amount = "{{ $payment }}";
        $(function() {
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
            gettaluk(dist_id);
            getpanchayath(taluk_id);
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
                    $("#taluk").val("{{ $customers->taluk_id }}");

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
                    $("#panchayath").val("{{ $customers->panchayath_id }}");

                }
            });
        }


        var customerid = "{{ $customers->id }}";
        $('#can_details').change(function() {
            if ($('#can_details').val() == 'Yes') {
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", true);
            } else if ($('#can_details').val() == 'No') {
                window.location.href = "{{ url('applyservice') }}/" + 60 + "/" + customerid;
            } else if ($('#can_details').val() == 'Find') {
                window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
            } else {
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
            }
        });

        $('#id_proof').change(function() {
            if ($('#id_proof').val() == 'Passport') {
                $('#passport').show("slow");
                $('#pancard').hide("slow");
                $('#voterid').hide("slow");
                $('#driving_license').hide("slow");
                $('#pandcard').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#passport').addClass("required");

            } else if ($('#id_proof').val() == 'PAN Card') {
                $('#pancard').show("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#driving_license').hide("slow");
                $('#passport').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#pancard').addClass("required");

            } else if ($('#id_proof').val() == 'Voter Id') {
                $('#voterid').show("slow");
                $('#passport').hide("slow");
                $('#pancard').hide("slow");
                $('#driving_license').hide("slow");
                $('#passport').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#pancard').removeClass("required");
                $('#voterid').addClass("required");

            } else if ($('#id_proof').val() == 'Driving License') {
                $('#driving_license').show("slow");
                $('#passport').hide("slow");
                $('#pancard').hide("slow");
                $('#voterid').hide("slow");
                $('#passport').removeClass("required");
                $('#voterid').removeClass("required");
                $('#pancard').removeClass("required");
                $('#driving_license').addClass("required");
            } else {
                $('#driving_license').hide("slow");
                $('#passport').hide("slow");
                $('#pancard').hide("slow");
                $('#voterid').hide("slow");
                $('#passport').removeClass("required");
                $('#pancard').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");

            }
        });

        $('#m_certificate').change(function() {
            if ($('#m_certificate').val() == 'Marriage Invitation') {
                $('#mrg_invitationhide').show("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_registration_certificate').removeClass("required");
                $('#mrg_documents').removeClass("required");
                $('#mrg_invitation').addClass("required");

            } else if ($('#m_certificate').val() == 'Marriage Registration Certificate') {
                $('#mrg_registration_certificatehide').show("slow");
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_invitation').removeClass("required");
                $('#mrg_documents').removeClass("required");
                $('#mrg_registration_certificate').addClass("required");

            } else if ($('#m_certificate').val() == 'Marriage Documents') {
                $('#mrg_documentshide').show("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_invitation').removeClass("required");
                $('#mrg_registration_certificate').removeClass("required");
                $('#mrg_documents').addClass("required");

            } else {
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_invitation').removeClass("required");
                $('#mrg_registration_certificate').removeClass("required");
                $('#mrg_documents').removeClass("required");

            }
        });
    </script>
@endpush
