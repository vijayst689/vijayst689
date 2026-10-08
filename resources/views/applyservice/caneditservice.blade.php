@extends('layouts.app')
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
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_canedit') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                     @if ($serviceid == 60)
                                        <div class="mb-3 col-md-4">
                                            <label style="color:#23e156" for="aadhaar_number" class="form-label">Aadhaar
                                                Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_number" placeholder="Aadhaar Number" />

                                            <label style="color:#23e156" for="personalized"
                                                class="form-label">Appellation</label>
                                            <select required id="personalized" name="personalized" class="form-control">
                                                <option value="">Select</option>
                                                <option value="டாக்டர்">Dr/டாக்டர்</option>
                                                <option value="செல்வி">Selvi/செல்வி</option>
                                                <option value="ஸ்ரீ">Shri/ஸ்ரீ</option>
                                                <option value="ஸ்ரீமதி">Smt/ஸ்ரீமதி</option>
                                                <option value="திரு">Thiru/திரு</option>
                                                <option value="திருமதி">Tmt/திருமதி</option>
                                                <option value="செல்வன்">Selvan/செல்வன்</option>
                                            </select>
                                            <label style="color:#23e156" for="relationship"
                                                class="form-labe">உறவுமுறை</label>
                                            <select id="relationship" name="relationship" class="form-control">
                                                <option value="">Select உறவுமுறை</option>
                                                <option value="தந்தை பெயர்">தந்தை பெயர்/Father Name</option>
                                                <option value="தாய் பெயர்">தாய் பெயர்/Mother Name</option>
                                                <option value="உறவினர் பெயர்">உறவினர் பெயர்/Guardian Name</option>
                                            </select>

                                            <label style="color:#23e156" for="dob" class="form-label">DOB</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="DOB" />
                                            <label style="color:#23e156" for="religion" class="form-labe">Religion</label>
                                            <select id="religion" name="religion" class="form-control">
                                                <option value="">Please Select</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Muslim">Muslim</option>
                                                <option value="Christian">Christian</option>
                                                <option value="Sikh">Sikh</option>
                                                <option value="Jain">Jain</option>
                                                <option value="Buddhist">Buddhist</option>
                                                <option value="Parsi">Parsi</option>
                                                <option value="Zoroastrian">Zoroastrian</option>
                                                <option value="Others">Others</option>
                                                <option value="Not Stated">Not Stated</option>
                                            </select>

                                            <label style="color:#23e156" for="door_no" class="form-label">Door
                                                No</label>
                                            <input required type="text" maxlength="20" class="form-control"
                                                name="door_no" placeholder="Door No" />

                                            <label style="color:#23e156" for="pin_code" class="form-label">Pin
                                                Code</label>
                                            <input required type="text" maxlength="6" class="form-control number"
                                                name="pin_code" placeholder="Pin Code" />

                                            <label style="color:#23e156" for="vao_area" class="form-label">கிராம நிர்வாக
                                                பகுதி</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="vao_area" placeholder="கிராம நிர்வாக பகுதி" />

                                            <label style="color:#23e156" for="mobile" class="form-label"> Mobile
                                                Number</label>
                                            <input required type="text" class="form-control number" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label style="color:#e411dd" for="doc_type" class="form-label">Document
                                                Type</label>
                                            <select id="doc_type" name="doc_type" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Ration Card No">Ration Card</option>
                                                <option value="EPIC Number">EPIC Number</option>
                                                <option value="PAN Number">PAN Number</option>
                                                <option value="Sri Lanka Ration Card No">Sri Lanka Ration Card</option>
                                            </select>
                                            <label style="color:#e411dd" for="personalized_name_english"
                                                class="form-label">Applicant Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="personalized_name_english" placeholder="Name In English" />

                                            <label style="color:#e411dd" for="name_english" class="form-label">Name In
                                                English</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name_english" placeholder="Name In English" />

                                            <label style="color:#e411dd" for="mother_name_english"
                                                class="form-label">Mother Name (ENGLISH)</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="mother_name_english" placeholder="Mother Name (ENGLISH)" />

                                            <label style="color:#e411dd" for="community"
                                                class="form-label">Community</label>
                                            <select required name="community" id="community" class="form-control">
                                                <option value="">Select Community</option>
                                                <option value="BC">BC</option>
                                                <option value="OC">OC</option>
                                                <option value="OBC">OBC</option>
                                                <option value="MBC">MBC</option>
                                                <option value="SC">SC</option>
                                                <option value="ST">ST</option>
                                                <option value="BC(Muslim)">BC (Muslim)</option>
                                            </select>

                                            <label style="color:#e411dd" for="address_english" class="form-label">Full
                                                Address</label>
                                            <textarea class="form-control" name="address_english" id="address_english" placeholder="Full Address"
                                                maxlength="500" rows="3" required></textarea>

                                            <label style="color:#e411dd" for="dist_id"
                                                class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <div class="" id="ration_nohide" style="display: none;">
                                                <label style="color:#23e156">Ration Card No</label>
                                                <input id="ration_no" class="form-control" maxlength="20" type="text"
                                                    name="ration_no">
                                            </div>
                                            <div class="" id="epic_nohide" style="display: none;">
                                                <label style="color:#23e156">EPIC Number</label>
                                                <input id="epic_no" class="form-control" maxlength="20" type="text"
                                                    name="epic_no">
                                            </div>
                                            <div class="" id="pan_nohide" style="display: none;">
                                                <label style="color:#23e156">PAN Number</label>
                                                <input id="pan_no" class="form-control" maxlength="20" type="text"
                                                    name="pan_no">
                                            </div>
                                            <div class="" id="srilanka_rationcard_nohide" style="display: none;">
                                                <label style="color:#23e156">Sri Lanka Ration Card No</label>
                                                <input id="srilanka_rationcard_no" class="form-control" maxlength="20"
                                                    type="text" name="srilanka_rationcard_no">
                                            </div>


                                            <label style="color:#23e156" for="personalized_name_tamil"
                                                class="form-label">விண்ணப்பதாரர் பெயர்</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="personalized_name_tamil" placeholder="பெயர் தமிழில்" />

                                            <label style="color:#23e156" for="name_tamil" class="form-label">பெயர்
                                                தமிழில்</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name_tamil" placeholder="பெயர் தமிழில்" />

                                            <label style="color:#23e156" for="mother_name_tamil" class="form-label">தாய்
                                                பெயர்</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="mother_name_tamil" placeholder="தாய் பெயர்" />

                                            <label style="color:#23e156" for="maritial_status"
                                                class="form-label">Maritial Status</label>
                                            <select id="maritial_status" name="maritial_status" class="form-control">
                                                <option value="">Select Maritial Status</option>
                                                <option value="Un Married">Un Married</option>
                                                <option value="Married">Married</option>
                                                <option value="Widower">Widower</option>
                                                <option value="Widow">Widow</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>

                                            <label style="color:#23e156" for="address_tamil"
                                                class="form-label">முகவரி</label>
                                            <textarea class="form-control" name="address_tamil" id="address_tamil" placeholder="முகவரி" maxlength="500"
                                                rows="3" required></textarea>

                                            <label style="color:#23e156" for="taluk_id" class="form-label">Taluk</label>
                                            <select name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>
                                    @elseif($serviceid == 62)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="dist_id"
                                                class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            <label style="color:#23e156" for="select_name"
                                                class="form-label number">Name</label>
                                            <select required id="select_name" name="select_name" class="form-control">
                                                <option value="">Select Name</option>
                                                <option value="Name In Tamil">பெயர் தமிழில்</option>
                                                <option value="Name In English">Name In English</option>
                                                <option value="Tamil And English Name">Tamil & English Name</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            {{-- <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card
                                                (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" /> --}}
                                            <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="name_tamilhide" style="display: none;">
                                            <label style="color:#23e156" for="name_tamil" class="form-label">பெயர்
                                                தமிழில்</label>
                                            <input type="text" maxlength="100" class="form-control" name="name_tamil"
                                                placeholder="பெயர் தமிழில்" />
                                        </div>

                                        <div class="mb-3 col-md-6" id="name_englishhide" style="display: none;">
                                            <label style="color:#23e156" for="name_english" class="form-label">Name In
                                                English</label>
                                            <input type="text" maxlength="100" class="form-control"
                                                name="name_english" placeholder="Name In English" />
                                        </div>
                                    @elseif($serviceid == 63)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="dist_id"
                                                class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            <label style="color:#23e156" for="original_dob" class="form-label">DOB
                                                [05041997]</label>
                                            <input required type="text" class="form-control" name="original_dob"
                                                placeholder="ddmmyyyy" maxlength="8" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            {{-- <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card
                                                (Front)</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" /> --}}
                                        </div>
                                    @elseif($serviceid == 64)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="new_mobile_no" class="form-label number">
                                                New mobile Number</label>
                                            <input required type="text" class="form-control" name="new_mobile_no"
                                                placeholder="New mobile Number" maxlength="10" />
                                        </div>
                                    @elseif($serviceid == 121)
                                        {{-- <div class="mb-3 col-md-6">
                        <label style="color:#23e156" for="mobile" class="form-label"> Mobile Number</label>
                        <input required type="text" class="form-control number"
                        name="mobile" placeholder="Mobile Number" maxlength="10" />
                    </div> --}}
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#e411dd" for="aadhaar_number" class="form-label"> Aadhaar
                                                Number</label>
                                            <input required type="text" class="form-control number"
                                                name="aadhaar_number" placeholder="Aadhaar Number" maxlength="12" />
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

        $('#select_name').change(function() {
            if ($('#select_name').val() == 'Name In Tamil') {
                $('#name_tamilhide').show("slow");
                $('#name_englishhide').hide("slow");
                $('#birth_certificate').prop("required", false);
                $('#name_tamil').prop("required", true);

            } else if ($('#select_name').val() == 'Name In English') {
                $('#name_englishhide').show("slow");
                $('#name_tamilhide').hide("slow");
                $('#name_tamil').prop("required", false);
                $('#name_english').prop("required", true);

            } else if ($('#select_name').val() == 'Tamil And English Name') {
                $('#name_englishhide').show("slow");
                $('#name_tamilhide').show("slow");
                $('#name_tamil').prop("required", true);
                $('#name_english').prop("required", true);

            } else {
                $('#name_tamilhide').hide("slow");
                $('#name_englishhide').hide("slow");
                $('#name_tamil').prop("required", false);
                $('#name_english').prop("required", false);

            }
        });

                $('#doc_type').change(function() {
            if ($('#doc_type').val() == 'Ration Card No') {
                $('#ration_nohide').show("slow");
                $('#epic_nohide').hide("slow");
                $('#pan_nohide').hide("slow");
                $('#srilanka_rationcard_nohide').hide("slow");
                $('#epic_no').prop("required", false);
                $('#pan_no').prop("required", false);
                $('#srilanka_rationcard_no').prop("required", false);
                $('#ration_no').prop("required", true);

            } else if ($('#doc_type').val() == 'EPIC Number') {
                $('#ration_nohide').hide("slow");
                $('#epic_nohide').show("slow");
                $('#pan_nohide').hide("slow");
                $('#srilanka_rationcard_nohide').hide("slow");
                $('#epic_no').prop("required", true);
                $('#pan_no').prop("required", false);
                $('#srilanka_rationcard_no').prop("required", false);
                $('#ration_no').prop("required", false);

            } else if ($('#doc_type').val() == 'PAN Number') {
                $('#ration_nohide').hide("slow");
                $('#epic_nohide').hide("slow");
                $('#pan_nohide').show("slow");
                $('#srilanka_rationcard_nohide').hide("slow");
                $('#epic_no').prop("required", false);
                $('#pan_no').prop("required", true);
                $('#srilanka_rationcard_no').prop("required", false);
                $('#ration_no').prop("required", false);

            } else if ($('#doc_type').val() == 'Sri Lanka Ration Card No') {
                $('#ration_nohide').hide("slow");
                $('#epic_nohide').hide("slow");
                $('#pan_nohide').hide("slow");
                $('#srilanka_rationcard_nohide').show("slow");
                $('#epic_no').prop("required", false);
                $('#pan_no').prop("required", false);
                $('#srilanka_rationcard_no').prop("required", true);
                $('#ration_no').prop("required", false);

            } else {
                $('#ration_nohide').hide("slow");
                $('#epic_nohide').hide("slow");
                $('#pan_nohide').hide("slow");
                $('#srilanka_rationcard_nohide').hide("slow");
                $('#ration_no').prop("required", false);
                $('#epic_no').prop("required", false);
                $('#pan_no').prop("required", false);
                $('#srilanka_rationcard_no').prop("required", false);

            }
        });
    </script>
@endpush
