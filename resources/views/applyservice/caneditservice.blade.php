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
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <h6 class="card-title">Service Payment : <span
                                            class="text-danger">{{ $payment }}</span>
                                    </h6>
                                    <form class="row g-4" action="{{ url('submitapply_canedit') }}"
                                        onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                                        id="myForm">
                                        @csrf
                                        <div class="row mt-3">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            @if ($serviceid == 60)
                                                <div class="mb-3 col-md-4">
                                                    <label style="color:#23e156" for="personalized"
                                                        class="form-label">திரு/திருமதி/செல்வி</label>
                                                    <select required id="personalized" name="personalized"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="திரு">திரு.</option>
                                                        <option value="திருமதி">திருமதி.</option>
                                                        <option value="செல்வி">செல்வி.</option>
                                                    </select>
                                                    <label style="color:#23e156" for="relationship_1"
                                                        class="form-label">உறவுமுறை</label>
                                                    <select id="relationship_1" name="relationship_1" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="தந்தை">தந்தை.</option>
                                                    </select>
                                                    <label style="color:#23e156" for="relationship_2"
                                                        class="form-label">உறவுமுறை</label>
                                                    <select id="relationship_2" name="relationship_2" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="தாய்">தாய்.</option>
                                                    </select>
                                                    <label style="color:#23e156" for="relationship_3"
                                                        class="form-label">உறவுமுறை</label>
                                                    <select id="relationship_3" name="relationship_3" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="கணவர்">கணவர்.</option>
                                                        <option value="மனைவி">மனைவி.</option>
                                                        <option value="உறவினர்">உறவினர்.</option>
                                                    </select>
                                                    <label style="color:#23e156" for="dob"
                                                        class="form-label">DOB</label>
                                                    <input required type="date" maxlength="10" class="form-control"
                                                        name="dob" placeholder="DOB" />
                                                    <label style="color:#23e156" for="religion"
                                                        class="form-label">Religion</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="religion" placeholder="Religion" />
                                                    <label style="color:#23e156" for="education"
                                                        class="form-label">Education</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="education" placeholder="Education" />
                                                    <label style="color:#23e156" for="work"
                                                        class="form-label">Work</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="work" placeholder="Work" />
                                                    <label style="color:#23e156" for="door_no" class="form-label">Door
                                                        No</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="door_no" placeholder="Door No" />
                                                    <label style="color:#23e156" for="dist_id"
                                                        class="form-label">District</label>
                                                    <select required name="dist_id" id="district_id"
                                                        class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label style="color:#e411dd" for="taluk_id"
                                                        class="form-label">Taluk</label>
                                                    <select required name="taluk_id" id="taluk" class="form-control">
                                                    </select>

                                                </div>
                                                <div class="mb-3 col-md-4">

                                                    <label style="color:#e411dd" for="personalized_name_tamil"
                                                        class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="personalized_name_tamil" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                        class="form-label">பெயர் தமிழில்</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_tamil_1" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="relationship_name_tamil_2"
                                                        class="form-label">பெயர் தமிழில்</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_tamil_2" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="relationship_name_tamil_3"
                                                        class="form-label">பெயர் தமிழில்</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_tamil_3" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="mobile" class="form-label">
                                                        Mobile
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        name="mobile" placeholder="Mobile Number" maxlength="10" />
                                                    <label style="color:#e411dd" for="community"
                                                        class="form-label">Community</label>
                                                    <select required name="community" id="community"
                                                        class="form-control">
                                                        <option value="">Select Community</option>
                                                        <option value="BC">BC</option>
                                                        <option value="OC">OC</option>
                                                        <option value="OBC">OBC</option>
                                                        <option value="MBC">MBC</option>
                                                        <option value="SC">SC</option>
                                                        <option value="ST">ST</option>
                                                        <option value="BC(Muslim)">BC (Muslim)</option>
                                                    </select>
                                                    <label style="color:#e411dd" for="aadhaar_number" class="form-label">
                                                        Aadhaar
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        name="aadhaar_number" placeholder="Aadhaar Number"
                                                        maxlength="12" />
                                                    <label style="color:#e411dd" for="smartcard_number"
                                                        class="form-label">Smart
                                                        Number</label>
                                                    <input required type="text" class="form-control"
                                                        name="smartcard_number" placeholder="Smart Number"
                                                        maxlength="12" />
                                                    <label style="color:#e411dd" for="street_name_tamil"
                                                        class="form-label">தெரு
                                                        பெயர்</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="street_name_tamil" placeholder="தெரு பெயர்" />
                                                    <label style="color:#e411dd" for="postal_name"
                                                        class="form-label">அஞ்சல்
                                                        பெயர்</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="postal_name" placeholder="அஞ்சல் பெயர்" />
                                                    <label style="color:#23e156" for="panchayath_id"
                                                        class="form-label">கிராம
                                                        நிர்வாக பகுதி</label>
                                                    <select required name="panchayath_id" id="panchayath"
                                                        class="form-control">
                                                    </select>

                                                </div>
                                                <div class="mb-3 col-md-4">

                                                    <label style="color:#23e156" for="personalized_name_english"
                                                        class="form-label">Applicant Name</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="personalized_name_english" placeholder="Name In English" />
                                                    <label style="color:#23e156" for="relationship_name_english_1"
                                                        class="form-label">Name In English</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_english_1"
                                                        placeholder="Name In English" />
                                                    <label style="color:#23e156" for="relationship_name_english_2"
                                                        class="form-label">Name In English</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_english_2"
                                                        placeholder="Name In English" />
                                                    <label style="color:#23e156" for="relationship_name_english_3"
                                                        class="form-label">Name In English</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="relationship_name_english_3"
                                                        placeholder="Name In English" />
                                                    <label style="color:#23e156" for="maritial_status"
                                                        class="form-label">Maritial Status</label>
                                                    <select required id="maritial_status" name="maritial_status"
                                                        class="form-control">
                                                        <option value="">Select Maritial Status</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Divorced">Divorced</option>
                                                    </select>
                                                    <label style="color:#23e156" for="caste"
                                                        class="form-label">Caste</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="caste" placeholder="Caste" />
                                                    <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card
                                                        (Front &
                                                        Back)</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />
                                                    <label for="smart_card" class="form-label text-danger">Smart
                                                        Card</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="smart_card" />
                                                    <label style="color:#23e156" for="street_name"
                                                        class="form-label">Street
                                                        Name</label>
                                                    <input required type="text" maxlength="30" class="form-control"
                                                        name="street_name" placeholder="Street Name" />
                                                    <label style="color:#23e156" for="pin_code" class="form-label">Pin
                                                        Code</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="pin_code" placeholder="Pin Code" />
                                                    <label style="color:#23e156" for="village_administrative_area"
                                                        class="form-label">Postal
                                                        Area</label>
                                                    <input required type="text" maxlength="20" class="form-control"
                                                        name="village_administrative_area" placeholder="Postal Area" />


                                                </div>
                                            @elseif($serviceid == 62)
                                                <div class="mb-3 col-md-6">
                                                    <label style="color:#23e156" for="dist_id"
                                                        class="form-label">District</label>
                                                    <select required name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <label style="color:#23e156" for="select_name"
                                                        class="form-label number">Name</label>
                                                    <select required id="select_name" name="select_name"
                                                        class="form-control">
                                                        <option value="">Select Name</option>
                                                        <option value="Name In Tamil">பெயர் தமிழில்</option>
                                                        <option value="Name In English">Name In English</option>
                                                        <option value="Tamil And English Name">Tamil & English Name
                                                        </option>
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
                                                    <label style="color:#23e156" for="name_tamil"
                                                        class="form-label">பெயர்
                                                        தமிழில்</label>
                                                    <input type="text" maxlength="100" class="form-control"
                                                        name="name_tamil" placeholder="பெயர் தமிழில்" />
                                                </div>

                                                <div class="mb-3 col-md-6" id="name_englishhide" style="display: none;">
                                                    <label style="color:#23e156" for="name_english"
                                                        class="form-label">Name In
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
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <label style="color:#23e156" for="original_dob"
                                                        class="form-label">DOB
                                                        [05041997]</label>
                                                    <input required type="text" class="form-control"
                                                        name="original_dob" placeholder="ddmmyyyy" maxlength="8" />
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
                                                    <label style="color:#23e156" for="new_mobile_no"
                                                        class="form-label number">
                                                        New mobile Number</label>
                                                    <input required type="text" class="form-control"
                                                        name="new_mobile_no" placeholder="New mobile Number"
                                                        maxlength="10" />
                                                </div>
                                            @elseif($serviceid == 66)
                                                <div class="mb-3 col-md-6">
                                                    <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                        Number</label>
                                                    <input required type="text" class="form-control" name="can_number"
                                                        placeholder="Can Number" maxlength="30" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label style="color:#23e156" for="aadhaar_number" class="form-label">
                                                        Aadhaar
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        name="aadhaar_number" placeholder="Aadhaar Number"
                                                        maxlength="12" />
                                                </div>
                                            @elseif($serviceid == 121)
                                                {{-- <div class="mb-3 col-md-6">
                                             <label style="color:#23e156" for="mobile" class="form-label"> Mobile Number</label>
                                             <input required type="text" class="form-control number"
                                              name="mobile" placeholder="Mobile Number" maxlength="10" />
                                         </div> --}}
                                                <div class="mb-3 col-md-6">
                                                    <label style="color:#e411dd" for="aadhaar_number" class="form-label">
                                                        Aadhaar
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        name="aadhaar_number" placeholder="Aadhaar Number"
                                                        maxlength="12" />
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
                    $('#district_id').on('change', function() {
                        var district_id = this.value;
                        $("#taluk").html('');
                        var url = "{{ url('service/get_taluk') }}/" + district_id;
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
                </script>
            @endpush
