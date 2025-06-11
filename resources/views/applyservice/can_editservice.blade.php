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
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                            <form class="row g-4" action="{{ url('submitapply_canedit') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row mt-3">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                              @if ($serviceid == 208)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="name_tamil" class="form-label">பெயர்
                                                தமிழில்</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_tamil"
                                                placeholder="பெயர் தமிழில்" />
                                            <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="aadhaar_card" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="name_english" class="form-label">Name In
                                                English</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_english"
                                                placeholder="Name In English" />
                                            <label style="color:#23e156" for="mobile" class="form-label number">Mobile
                                                Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />

                                            <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    @elseif($serviceid == 209)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="name_tamil" class="form-label">பெயர்
                                                தமிழில்</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_tamil"
                                                placeholder="பெயர் தமிழில்" />
                                            <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="aadhaar_card" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label style="color:#23e156" for="name_english" class="form-label">Name In
                                                English</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_english"
                                                placeholder="Name In English" />
                                            <label style="color:#23e156" for="dob" class="form-label">Date Of Birth
                                                [05041997]</label>
                                            <input required type="text" class="form-control" name="dob" placeholder="ddmmyyyy"
                                                maxlength="8" />

                                            <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    @elseif($serviceid == 210)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="dob" class="form-label">Date Of Birth</label>
                                            <input required type="text" class="form-control" name="dob" placeholder="ddmmyyyy"
                                                maxlength="8" />

                                            <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="mobile" class="form-label number">Mobile
                                                Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />

                                            <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="aadhaar_card" />
                                        </div>
                                    @elseif($serviceid == 211)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="name_tamil" class="form-label">பெயர்
                                                தமிழில்</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_tamil"
                                                placeholder="பெயர் தமிழில்" />
                                            <label style="color:#23e156" for="dob" class="form-label">Date Of Birth
                                                [05041997]</label>
                                            <input required type="text" class="form-control" name="dob" placeholder="ddmmyyyy"
                                                maxlength="8" />

                                            <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label style="color:#23e156" for="name_english" class="form-label">Name In
                                                English</label>
                                            <input required type="text" maxlength="100" class="form-control" name="name_english"
                                                placeholder="Name In English" />
                                            <label style="color:#23e156" for="mobile" class="form-label number">Mobile
                                                Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />
                                            <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="aadhaar_card" />
                                        </div>
                         @elseif($serviceid == 226)
                        <div class="mb-3 col-md-6">
                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                            <input required type="text" class="form-control"
                            name="can_number" placeholder="Can Number" maxlength="30" />
                            <label style="color:#23e156" class="form-label">Documents</label>
                                <select required id="document" name="document" class="form-control">
                                    <option value="">Select Documents</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    
                                </select>
                         </div>
                          <div class="mb-3 col-md-6">
                                <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front) </label>
                                <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                                name="aadhaar_card" />

                                <div class="" id="save_application_numberhide" style="display: none;">
                                <label class="form-label text-danger">Application Number</label>
                                <input id="save_application_number" class="form-control text-danger" type="text"
                                 name="save_application_number" placeholder="Application Number" maxlength="60">
                                </div>
                                <div class="" id="save_certificatehide" style="display: none;">
                                <label class="form-label text-danger">Certificate Name</label>
                                <input id="save_certificate" class="form-control text-danger" type="text" 
                                name="save_certificate" placeholder="Certificate Name" maxlength="60">
                                </div>
                          </div>
                                                                                                                                                                         
                         @elseif($serviceid == 227)
                           <div class="mb-3 col-md-6">
                            <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                            <input required type="text" class="form-control"
                            name="can_number" placeholder="Can Number" maxlength="30" />
                            <label style="color:#23e156" for="application_name" class="form-label">Application Name</label>
                            <input required type="text" maxlength="100" class="form-control"
                            name="application_name" placeholder="Application Name"/>
                          </div>
                           <div class="mb-3 col-md-6">
                            <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front) </label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                            name="aadhaar_card" /> 
                            <label style="color:#23e156" for="certificate_name" class="form-label">Certificate Name</label>
                            <input required type="text" maxlength="100" class="form-control"
                            name="certificate_name" placeholder="Certificate Name"/>
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

        $('#dist_id').on('change', function () {
    var dist_id = this.value;
    $("#taluk").html('');
    var url = "{{ url('service/get_taluk') }}/" + dist_id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (result) {
                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                $.each(result, function (key, value) {
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

$('#document').change(function() {
            if ($('#document').val() == 'Yes') {
                $('#save_application_numberhide').show("slow");
                $('#save_certificatehide').hide("slow");
                $('#save_certificate').prop("required", false);
                $('#save_application_number').prop("required", true);

            } else if ($('#document').val() == 'No') {
                $('#save_certificatehide').show("slow");
                $('#save_application_numberhide').hide("slow");
                $('#save_application_number').prop("required", false);
                $('#save_certificate').prop("required", true);

            } else {
                $('#save_certificatehide').hide("slow");
                $('#save_application_numberhide').hide("slow");
                $('#save_application_number').prop("required", false);
                $('#save_certificate').prop("required", false);
            }
        });
    </script>
@endpush
