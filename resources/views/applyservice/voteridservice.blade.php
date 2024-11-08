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
                            <form class="row g-4" action="{{ url('submitvoterid') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row mt-3">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    @if ($serviceid == 113)

                           <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="name" placeholder="Name"/>
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input required type="text" class="form-control" maxlength="10"
                            name="mobile" placeholder="Mobile Number"/>
                            <label for="relationship" class="form-label">Relationship</label>
                            <select required type="text" class="form-control"
                            name="relationship">
                                <option value="">Select Relationship</option>
                                <option value="Father">Father</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                            </select>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label text-danger">Photo</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                            name="photo" />
                            <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                            name="aadhaar_card" />
                            <label for="voter_id" class="form-label text-danger">Relative Voter Id</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                            name="voter_id" />
                        </div>
                        @elseif ($serviceid == 120)
                        <div class="mb-3 col-md-6">
                            <label for="epic_no" class="form-label">Epic No</label>
                            <input required type="text" class="form-control" maxlength="15"
                            name="epic_no" placeholder="Epic No"/>
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input required type="text" class="form-control" maxlength="10"
                            name="mobile" placeholder="Mobile Number"/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="aadhaar_card" class="form-label text-danger">Old Voter ID/Aadhar Card</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
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

    $('#district_id').on('change', function () {
    var district_id = this.value;
    $("#taluk").html('');
    var url = "{{ url('service/get_taluk') }}/" + district_id;
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
