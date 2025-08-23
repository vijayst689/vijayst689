@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="card mt-4">
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
                    <h5 class="card-title">{{ $servicename }}</h5>
                    <h5 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h5>
                    <form class="row g-4" action="{{ url('submitapply_canedit') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <div class="row mt-4">
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                            {{-- <input type="hidden" name="user_id" value="{{ $customers->id }}"> --}}

                            <div class="mb-3 col-md-4">
                                <label style="color:#23e156" for="personalized"
                                    class="form-label">திரு/திருமதி/செல்வி</label>
                                <select required id="personalized" name="personalized" class="form-control">
                                    <option value="">Select</option>
                                    <option value="திரு">திரு.</option>
                                    <option value="திருமதி">திருமதி.</option>
                                    <option value="செல்வன்">செல்வன்.</option>
                                    <option value="செல்வி">செல்வி.</option>
                                </select>
                                <label style="color:#23e156" for="relationship_1" class="form-label">உறவுமுறை</label>
                                <select id="relationship_1" name="relationship_1" class="form-control">
                                    <option value="">Select</option>
                                    <option value="தந்தை">தந்தை.</option>
                                    <option value="கணவர்">கணவர்.</option>
                                    <option value="உறவினர்">உறவினர்.</option>
                                </select>

                                <label style="color:#23e156" for="mother_name_tamil" class="form-label">தாயின் பெயர்
                                    தமிழில்</label>
                                <input required type="text" maxlength="100" class="form-control" name="mother_name_tamil"
                                    placeholder="தாயின் பெயர் தமிழில்" />
                                <label style="color:#23e156" for="dob" class="form-label">DOB</label>
                                <input required type="date" maxlength="10" class="form-control" name="dob"
                                    placeholder="DOB" />
                                <label style="color:#23e156" for="religion" class="form-label">Religion</label>
                                <input required type="text" maxlength="20" class="form-control" name="religion"
                                    placeholder="Religion" />
                                <label style="color:#23e156" for="community" class="form-label">Community</label>
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
                                <label style="color:#23e156" for="door_no" class="form-label">Door No</label>
                                <input required type="text" maxlength="20" class="form-control" name="door_no"
                                    placeholder="Door No" />
                                <label style="color:#23e156" for="pin_code" class="form-label">Pin Code</label>
                                <input required type="text" maxlength="6" class="form-control number"
                                    name="pin_code" placeholder="Pin Code" />
                                <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                <select name="dist_id" id="dist_id" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $d)
                                        <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label style="color:#e411dd" for="personalized_name_tamil"
                                    class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                <input required type="text" maxlength="100" class="form-control"
                                    name="personalized_name_tamil" placeholder="பெயர் தமிழில்" />
                                <label style="color:#e411dd" for="relationship_name_tamil_1" class="form-label">பெயர்
                                    தமிழில்</label>
                                <input required type="text" maxlength="100" class="form-control"
                                    name="relationship_name_tamil_1" placeholder="பெயர் தமிழில்" />
                                <label style="color:#e411dd" for="mother_name_english" class="form-label">Mother
                                    Name (ENGLISH)</label>
                                <input required type="text" maxlength="100" class="form-control"
                                    name="mother_name_english" placeholder="Mother Name (ENGLISH)" />
                                <label style="color:#e411dd" for="mobile" class="form-label"> Mobile
                                    Number</label>
                                <input required type="text" class="form-control number" name="mobile"
                                    placeholder="Mobile Number" maxlength="10" />
                                <label style="color:#e411dd" for="aadhaar_number" class="form-label"> Aadhaar
                                    Number</label>
                                <input required type="text" class="form-control number" name="aadhaar_number"
                                    placeholder="Aadhaar Number" maxlength="12" />
                                <label style="color:#e411dd" for="smartcard_number" class="form-label">Smart
                                    Number</label>
                                <input required type="text" class="form-control" name="smartcard_number"
                                    placeholder="Smart Number" maxlength="15" />
                                <label style="color:#e411dd" for="street_name_tamil" class="form-label">தெரு
                                    பெயர்</label>
                                <input required type="text" maxlength="50" class="form-control"
                                    name="street_name_tamil" placeholder="தெரு பெயர்" />
                                <label style="color:#e411dd" for="postal_area_tamil" class="form-label">அஞ்சல்
                                    பெயர்</label>
                                <input required type="text" maxlength="50" class="form-control"
                                    name="postal_area_tamil" placeholder="அஞ்சல் பெயர்" />

                                <label style="color:#e411dd" for="taluk_id" class="form-label">Taluk</label>
                                <select name="taluk_id" id="taluk" class="form-control">
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label style="color:#23e156" for="personalized_name_english" class="form-label">Applicant
                                    Name</label>
                                <input required type="text" maxlength="100" class="form-control"
                                    name="personalized_name_english" placeholder="Name In English" />
                                <label style="color:#23e156" for="relationship_name_english_1" class="form-label">Name In
                                    English</label>
                                <input required type="text" maxlength="100" class="form-control"
                                    name="relationship_name_english_1" placeholder="Name In English" />
                                <label style="color:#23e156" for="maritial_status" class="form-label">Maritial
                                    Status</label>
                                <select id="maritial_status" name="maritial_status" class="form-control">
                                    <option value="">Select Maritial Status</option>
                                    <option value="Un Married">Un Married</option>
                                    <option value="Married">Married</option>
                                    <option value="Widower">Widower</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Divorced">Divorced</option>
                                </select>

                                <label style="color:#23e156" for="education" class="form-label">Education</label>
                                <select required name="education" id="education" class="form-control">
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
                                <label style="color:#23e156" for="aadhaar_card" class="form-label">Adhaar card
                                    (front & Back)</label>
                                <input required type="file" class="form-control" name="aadhaar_card"
                                    placeholder="Adhaar card (front & Back)" />
                                <label style="color:#23e156" for="smart_card" class="form-label">Smart
                                    Card</label>
                                <input required type="file" class="form-control" name="smart_card"
                                    placeholder="Smart Card" />

                                <label style="color:#23e156" for="street_name" class="form-label">Street
                                    Name</label>
                                <input required type="text" maxlength="50" class="form-control" name="street_name"
                                    placeholder="Street Name" />
                                <label style="color:#23e156" for="postal_area_english" class="form-label">Postal
                                    Area</label>
                                <input required type="text" maxlength="50" class="form-control"
                                    name="postal_area_english" placeholder="Postal Area" />
                                <label style="color:#23e156" for="vao_area" class="form-label">கிராம நிர்வாக
                                    பகுதி</label>
                                <input required type="text" maxlength="50" class="form-control" name="vao_area"
                                    placeholder="கிராம நிர்வாக பகுதி" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label style="color:#e411dd" for="aadhaar_number" class="form-label"> Aadhaar
                                    Number</label>
                                <input required type="text" class="form-control number" name="aadhaar_number"
                                    placeholder="Aadhaar Number" maxlength="12" />
                            </div>
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
    </main>
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
    </script>
@endpush
