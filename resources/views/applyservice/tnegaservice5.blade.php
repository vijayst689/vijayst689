-@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        {{-- <h5><span class="text-danger" id="cantext"></span></h5>   --}}
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_tnegaservices5') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post"
                                id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" id="seramt" name="service_amount" value="{{ $payment }}">
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
                                            <div class="mb-3">

                                                <div class="row" id="dobhide" style="display: none;">
                                                    <h4 class="text-center">Can Details</h4>
                                                    <div class="mb-3 col-md-4">
                                                        <label style="color:#23e156" for="personalized"
                                                            class="form-label">திரு/திருமதி/செல்வி</label>
                                                        <select id="personalized" name="personalized" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="திரு">திரு.</option>
                                                            <option value="திருமதி">திருமதி.</option>
                                                            <option value="செல்வன்">செல்வன்.</option>
                                                            <option value="செல்வி">செல்வி.</option>
                                                        </select>
                                                        <label style="color:#23e156" for="relationship_1"
                                                            class="form-label">உறவுமுறை</label>
                                                        <select id="relationship_1" name="relationship_1"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="தந்தை">தந்தை.</option>
                                                            <option value="கணவர்">கணவர்.</option>
                                                            <option value="உறவினர்">உறவினர்.</option>

                                                        </select>
                                                        <label style="color:#23e156" for="mother_name_tamil"
                                                            class="form-label">தாயின் பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="100" class="form-control"
                                                            name="mother_name_tamil" placeholder="தாயின் பெயர் தமிழில்" />

                                                        <label style="color:#23e156" for="community"
                                                            class="form-label">Community</label>
                                                        <select name="community" id="community" class="form-control">
                                                            <option value="">Select Community</option>
                                                            <option value="BC">BC</option>
                                                            <option value="OC">OC</option>
                                                            <option value="OBC">OBC</option>
                                                            <option value="MBC">MBC</option>
                                                            <option value="SC">SC</option>
                                                            <option value="ST">ST</option>
                                                            <option value="BC(Muslim)">BC (Muslim)</option>
                                                        </select>
                                                        <label style="color:#23e156" for="door_no"
                                                            class="form-label">Door No</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="door_no" placeholder="Door No" />
                                                        <label style="color:#23e156" for="pin_code"
                                                            class="form-label">Pin Code</label>
                                                        <input type="text" maxlength="10" class="form-control"
                                                            name="pin_code" placeholder="Pin Code" />
                                                    </div>
                                                    <div class="mb-3 col-md-4">

                                                        <label style="color:#e411dd" for="personalized_name_tamil"
                                                            class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="personalized_name_tamil" placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                            class="form-label">பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="relationship_name_tamil_1"
                                                            placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="mother_name_english"
                                                            class="form-label">Mother Name (ENGLISH)</label>
                                                        <input type="text" maxlength="100" class="form-control"
                                                            name="mother_name_english"
                                                            placeholder="Mother Name (ENGLISH)" />
                                                        <label style="color:#e411dd" for="education"
                                                            class="form-label">Education</label>
                                                        <select name="education" id="education" class="form-control">
                                                            <option value="">Select Education</option>
                                                            <option value="Students ">Students </option>
                                                            <option value="No Education">No Education</option>
                                                            <option value="Private Employee">Private Employee
                                                            </option>
                                                            <option value="Govt.Employee">Govt.Employee
                                                            </option>
                                                            <option value="Daily Wages">Daily Wages
                                                            </option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        <label style="color:#e411dd" for="street_name_tamil"
                                                            class="form-label">தெரு பெயர்</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="street_name_tamil" placeholder="தெரு பெயர்" />
                                                        <label style="color:#e411dd" for="postal_area_tamil"
                                                            class="form-label">அஞ்சல் பெயர்</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="postal_area_tamil" placeholder="அஞ்சல் பெயர்" />

                                                    </div>
                                                    <div class="mb-3 col-md-4">

                                                        <label style="color:#23e156" for="personalized_name_english"
                                                            class="form-label">Applicant Name</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="personalized_name_english"
                                                            placeholder="Name In English" />
                                                        <label style="color:#23e156" for="relationship_name_english_1"
                                                            class="form-label">Name In English</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="relationship_name_english_1"
                                                            placeholder="Name In English" />
                                                        <label style="color:#23e156" for="maritial_status"
                                                            class="form-label">Maritial Status</label>
                                                        <select id="maritial_status" name="maritial_status"
                                                            class="form-control">
                                                            <option value="">Select Maritial Status</option>
                                                            <option value="Un Married">Un Married</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widower">Widower</option>
                                                            <option value="Widow">Widow</option>
                                                            <option value="Divorced">Divorced</option>
                                                        </select>

                                                        <label style="color:#23e156" for="religion"
                                                            class="form-label">Religion</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="religion" placeholder="Religion" />

                                                        <label style="color:#23e156" for="street_name"
                                                            class="form-label">Street Name</label>
                                                        <input type="text" maxlength="30" class="form-control"
                                                            name="street_name" placeholder="Street Name" />

                                                        <label style="color:#23e156" for="postal_area_english"
                                                            class="form-label">Postal Area</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="postal_area_english" placeholder="Postal Area" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="text-center"> Basic Details </h4>

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input value="{{ $customers->name }}" readonly required type="text"
                                            class="form-control" name="name" placeholder="Name" />

                                        <label for="dist_id" class="form-label">District</label>
                                        <select disabled name="dist_id" id="dist_id" class="form-control">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $d)
                                                <option @if ($d->id == $customers->dist_id) selected @endif
                                                    value="{{ $d->id }}">{{ $d->district_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="panchayath_id" class="form-label">VAO</label>
                                        <input class="form-control" type="text"
                                            value="{{ $customers->panchayath_name }}" readonly required
                                            name="panchayath_name" maxlength="50" placeholder="VAO">

                                        <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                        <input value="{{ $customers->aadhaar_no }}" readonly required type="text"
                                            maxlength="12" class="form-control" name="aadhaar_no"
                                            placeholder="Aadhaar Number" />
                                        <label for="signature" class="form-label">Signature</label>
                                        @if ($customers->signature == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/signature/{{ $customers->signature }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif

                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label number">Mobile Number</label>
                                        <input value="{{ $customers->phone }}" readonly required type="text"
                                            maxlength="10" class="form-control" name="mobile"
                                            placeholder="Mobile Number" />

                                        <label for="taluk_id" class="form-label">Taluk</label>
                                        <select disabled name="taluk_id" id="taluk" class="form-control">
                                        </select>
                                        <label for="photo" class="form-label">Photo</label>
                                        @if ($customers->profile == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/profile_photo/{{ $customers->profile }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                        <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                        @if ($customers->aadhaar_file == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif

                                        <label for="smart_card" class="form-label">Smart Card</label>
                                        @if ($customers->smartcard == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/smart_card/{{ $customers->smartcard }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif



                                    </div>
                                </div>
                                <div class="row">
                                    <h4 class="text-center"> Additional Details </h4>
                                    @if ($serviceid == 170)
                                        <div class="mb-3 col-md-6">
                                            <label>குடும்ப போட்டோ</label>
                                            <input class="form-control required" type="file" name="family_photo">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>முகவரி சான்று</label>
                                            <input class="form-control required" type="file" name="address_proof">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>குழந்தைகளுக்கான பிறப்பு சான்று</label>
                                            <input class="form-control required" type="file"
                                                name="birth_certificate_children">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>குடும்பக் கட்டுப்பாடு சான்று</label>
                                            <input class="form-control required" type="file"
                                                name="family_plannnig_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                            <input class="form-control required" type="file"
                                                name="self_declaration_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                            <input class="form-control required" type="file"
                                                name="anyothers_certificate">
                                        </div>
                                    @elseif($serviceid == 171)
                                        <div class="mb-3 col-md-6">
                                            <label>UDID (தேசிய அடையாள அட்டை)</label>
                                            <input class="form-control required" type="file" name="udid_card">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>வங்கி பாஸ்புக்</label>
                                            <input class="form-control required" type="file" name="bank_pass_book">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>ஏதேனும் ஐடி ஆதாரம்</label>
                                            <select class="form-control required" id="handicapped_proof"
                                                name="handicapped_proof" style="width: 100%;">
                                                <option value="">Select Handicapped Proof</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Voter Id">Voter Id</option>
                                                <option value="Driving License">Driving License</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="" id="passporthide" style="display: none;">
                                                <label>பாஸ்போர்ட்</label>
                                                <input id="passport" class="form-control required" type="file"
                                                    name="passport">
                                            </div>
                                            <div class="" id="pancardhide" style="display: none;">
                                                <label>PAN கார்டு</label>
                                                <input id="pancard" class="form-control required" type="file"
                                                    name="pancard">
                                            </div>
                                            <div class="" id="voteridhide" style="display: none;">
                                                <label>வாக்காளர் ஐடி</label>
                                                <input id="voterid" class="form-control required" type="file"
                                                    name="voterid">
                                            </div>
                                            <div class="" id="driving_licensehide" style="display: none;">
                                                <label>ஓட்டுநர் உரிமம்</label>
                                                <input id="driving_license" class="form-control required" type="file"
                                                    name="driving_license">
                                            </div>
                                        </div>
                                    @elseif($serviceid == 172)
                                        <div class="mb-3 col-md-6">
                                            <label>வயது சான்று</label>
                                            <input class="form-control required number" type="file" name="age_proof">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>வீ.ஏ.ஓ சான்று</label>
                                            <input class="form-control required" type="file" name="vao_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>சுய வாக்குமூலம்</label>
                                            <input class="form-control required" type="file"
                                                name="self_declaration_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                            <input class="form-control required" type="file" name="other_certificate">
                                        </div>
                                    @elseif($serviceid == 176)
                                        <div class="mb-3 col-md-6">
                                            <label>குடியிருப்பு சான்று</label>
                                            <input class="form-control required" type="file"
                                                name="residential_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>கடனுதவி சான்றிதழ்</label>
                                            <input class="form-control required" type="file"
                                                name="solvency_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>கடை முகவரி ஆதாரம்</label>
                                            <input class="form-control required" type="file"
                                                name="shop_address_proof">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>சொத்து ஆவணச் சான்று அல்லது பட்டா அல்லது சிட்டா
                                            </label>
                                            <input class="form-control required" type="file" name="chitta">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>முந்தைய உரிமம்</label>
                                            <input class="form-control required" type="file" name="previous_licence">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>செலுத்துச் சீட்டு</label>
                                            <input class="form-control required" type="file" name="challan">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>படிவம் ஏ</label>
                                            <input class="form-control required" type="file" name="form_A">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>கட்டிட உரிம ஆவணம்</label>
                                            <input class="form-control required" type="file"
                                                name="building_licence_document">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>பில்டிங் ப்ளூ பிரிண்ட்</label>
                                            <input class="form-control required" type="file"
                                                name="building_blue_print">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>PAN கார்டு</label>
                                            <input class="form-control required" type="file" name="pancard">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>சுய வாக்குமூலம்</label>
                                            <input class="form-control required" type="file"
                                                name="self_declaration_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>குத்தகை ஒப்பந்தம்</label>
                                            <input class="form-control required" type="file" name="lease_agreement">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>IT திரும்ப ஆவணம்</label>
                                            <input class="form-control required" type="file"
                                                name="it_return_document">
                                        </div>
                                    @elseif($serviceid == 177)
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>பதிவு செய்த பத்திரம் (உன்மை நகல்)</label>
                                    <input class="form-control required" type="file" name="registered_deed">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>சிட்டா மற்றும் வில்லங்கம்</label>
                                    <input class="form-control required" type="file" name="chitta_and_villangam">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>சொத்து விவரம் (பட்டா & சிட்டா)</label>
                                    <input class="form-control required" type="file" name="property_details">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>சுய வாக்குமூலம்</label>
                                    <input class="form-control required" type="file"
                                        name="self_declaration_certificate">
                                </div>
                            @elseif($serviceid == 178)
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>குடியிருப்பு சான்று</label>
                            <input class="form-control required" type="file" name="residential_certificate">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>சுய வாக்குமூலம்</label>
                            <input class="form-control required" type="file" name="self_declaration_certificate">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>சேத சான்றிதழ் (ஜெராக்ஸ் நகல்)</label>
                            <input class="form-control required" type="file" name="damage_certificate">
                        </div>
                        @endif
                        <div class="text-center">
                            <p id="nopayment"></p>
                        </div>
                        <div class="text-center">
                            <div class="col-12">
                                <div class="mb-0">
                                    <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                </div>
                            </div>
                        </div>
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
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

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
                $('#dobhide').hide("slow");

            } else if ($('#can_details').val() == 'No') {
                $('#dobhide').hide("slow");
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
                window.location.href = "{{ url('applyservice') }}/" + 60 + "/" + customerid;

            } else if ($('#can_details').val() == 'Find') {
                $('#dobhide').hide("slow");
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", false);
                window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
            } else {
                $('#dobhide').hide("slow");
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
            }
        });


        $('#handicapped_proof').change(function() {
            if ($('#handicapped_proof').val() == 'Passport') {
                $('#passporthide').show("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#pandcard').prop("required", false);
                $('#voterid').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#passport').prop("required", true);

            } else if ($('#handicapped_proof').val() == 'Pan Card') {
                $('#pancardhide').show("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#passport').prop("required", false);
                $('#voterid').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#pancard').prop("required", true);

            } else if ($('#handicapped_proof').val() == 'Voter Id') {
                $('#voteridhide').show("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#passport').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#pancard').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#handicapped_proof').val() == 'Driving License') {
                $('#driving_licensehide').show("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passport').prop("required", false);
                $('#voterid').prop("required", false);
                $('#pancard').prop("required", false);
                $('#driving_license').prop("required", true);
            } else {
                $('#driving_licensehide').hide("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passport').prop("required", false);
                $('#pancard').prop("required", false);
                $('#voterid').prop("required", false);
                $('#driving_license').prop("required", false);

            }
        });

        $('#m_certificate').change(function() {
            if ($('#m_certificate').val() == 'Marriage Invitation') {
                $('#mrg_invitationhide').show("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_registration_certificate').prop("required", false);
                $('#mrg_documents').prop("required", false);
                $('#mrg_invitation').prop("required", true);

            } else if ($('#m_certificate').val() == 'Marriage Registration Certificate') {
                $('#mrg_registration_certificatehide').show("slow");
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_invitation').prop("required", false);
                $('#mrg_documents').prop("required", false);
                $('#mrg_registration_certificate').prop("required", true);

            } else if ($('#m_certificate').val() == 'Marriage Documents') {
                $('#mrg_documentshide').show("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_invitation').prop("required", false);
                $('#mrg_registration_certificate').prop("required", false);
                $('#mrg_documents').prop("required", true);

            } else {
                $('#mrg_invitationhide').hide("slow");
                $('#mrg_registration_certificatehide').hide("slow");
                $('#mrg_documentshide').hide("slow");
                $('#mrg_invitation').prop("required", false);
                $('#mrg_registration_certificate').prop("required", false);
                $('#mrg_documents').prop("required", false);

            }
        });

        $('#handicapped_proof').change(function() {
            if ($('#handicapped_proof').val() == 'Passport') {
                $('#passporthide').show("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#pandcard').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#passport').addClass("required");

            } else if ($('#handicapped_proof').val() == 'Pan Card') {
                $('#pancardhide').show("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#passport').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#pancard').addClass("required");

            } else if ($('#handicapped_proof').val() == 'Voter Id') {
                $('#voteridhide').show("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#passport').removeClass("required");
                $('#driving_license').removeClass("required");
                $('#pancard').removeClass("required");
                $('#voterid').addClass("required");

            } else if ($('#handicapped_proof').val() == 'Driving License') {
                $('#driving_licensehide').show("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passport').removeClass("required");
                $('#voterid').removeClass("required");
                $('#pancard').removeClass("required");
                $('#driving_license').addClass("required");
            } else {
                $('#driving_licensehide').hide("slow");
                $('#passporthide').hide("slow");
                $('#pancardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passport').removeClass("required");
                $('#pancard').removeClass("required");
                $('#voterid').removeClass("required");
                $('#driving_license').removeClass("required");

            }
        });
    </script>
@endpush
