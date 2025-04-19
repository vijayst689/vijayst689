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

                                    @if ($serviceid == 204)
                        
                                    <div class="mb-3 col-md-6">
                                        <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                        <input required type="text" class="form-control"
                                        name="can_number" placeholder="Can Number" maxlength="15" />
                                        <label style="color:#23e156" for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" class="form-control"
                                        name="mobile" placeholder="Mobile Number" maxlength="10" />
                                    </div>
                                    <div class="mb-3 col-md-6">  
                                        <label style="color:#23e156" for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்"/>
                                        <label style="color:#23e156" for="name_english" class="form-label">Name In English</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name In English"/>    
                                        <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front & Back) </label>
                                        <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                                        name="aadhaar_card" />                   
                                    </div>
            
                                    @elseif($serviceid == 205)
                                    <div class="mb-3 col-md-6">
                                        <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                        <input required type="text" class="form-control"
                                        name="can_number" placeholder="Can Number" maxlength="15" />
                                        <label style="color:#23e156" for="dob" class="form-label">Date Of Birth</label>
                                        <input required type="date" class="form-control"
                                        name="dob" placeholder="DOB" maxlength="10" />
                                    </div>
                                    <div class="mb-3 col-md-6">  
                                        <label style="color:#23e156" for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்"/>
                                        <label style="color:#23e156" for="name_english" class="form-label">Name In English</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name In English"/>    
                                        <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front & Back) </label>
                                        <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                                        name="aadhaar_card" />                   
                                    </div>
                                    @elseif($serviceid == 206)
                                    <div class="mb-3 col-md-6">
                                        <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                        <input required type="text" class="form-control"
                                        name="can_number" placeholder="Can Number" maxlength="15" />
                                        <label style="color:#23e156" for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" class="form-control"
                                        name="mobile" placeholder="Mobile Number" maxlength="10" />
                                    </div>
                                    <div class="mb-3 col-md-6">  
                                        <label style="color:#23e156" for="dob" class="form-label">Date Of Birth</label>
                                        <input required type="date" class="form-control"
                                        name="dob" placeholder="DOB" maxlength="10" />   
                                        <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front & Back) </label>
                                        <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                                        name="aadhaar_card" />                   
                                    </div>
                                    @elseif($serviceid == 207)
                                    <div class="mb-3 col-md-6">
                                        <label style="color:#23e156" for="can_number" class="form-label">Can Number</label>
                                        <input required type="text" class="form-control"
                                        name="can_number" placeholder="Can Number" maxlength="15" />
                                        <label style="color:#23e156" for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" class="form-control"
                                        name="mobile" placeholder="Mobile Number" maxlength="10" />
                                        <label style="color:#23e156" for="dob" class="form-label">Date Of Birth</label>
                                        <input required type="date" class="form-control"
                                        name="dob" placeholder="DOB" maxlength="10" /> 
                                    </div>
                                    <div class="mb-3 col-md-6">  
                                        <label style="color:#23e156" for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்"/>
                                        <label style="color:#23e156" for="name_english" class="form-label">Name In English</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name In English"/>    
                                        <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front & Back) </label>
                                        <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                                        name="aadhaar_card" />                   
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

    </script>
@endpush
