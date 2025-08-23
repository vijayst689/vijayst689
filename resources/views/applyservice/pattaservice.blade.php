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
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h6 class="card-title">Service Payment : <span
                                        class="text-danger">{{ $payment }}</span></h6>
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('submitapply_patta') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                            @if ($serviceid == 213 || $serviceid == 214 || $serviceid == 215)
                                                <div class="mb-3 col-md-6">
                                                    <label for="can_no" class="form-label">Can Number</label>
                                                    <input required type="text" class="form-control" name="can_no"
                                                        placeholder="Can Number" maxlength="15" />

                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select required name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                    <label for="reg_office" class="form-label">Register Office</label>
                                                    <input required type="text" class="form-control" name="reg_office"
                                                        placeholder="Register Office" maxlength="50" />
                                                    <label for="subdivision_no" class="form-label">Subdivision No</label>
                                                    <input required type="text" class="form-control"
                                                        name="subdivision_no" placeholder="Subdivision No" maxlength="30" />
                                                    <label for="bond_doc" class="form-label">Bond/பத்திரம் Documents</label>
                                                    <input required type="file" class="form-control" name="bond_doc"
                                                        placeholder="Bond/பத்திரம் Documents" maxlength="20" />

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select required name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="rev_village" class="form-label">Revenue Village</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="rev_village" placeholder="Revenue Village" />
                                                    <label for="survey_no" class="form-label">Survey No</label>
                                                    <input required type="text" maxlength="30" class="form-control"
                                                        name="survey_no" placeholder="Survey No" />
                                                    <label for="transacted_area" class="form-label">Transacted
                                                        Area</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="transacted_area" placeholder="Transacted Area" />
                                                    <label for="ec" class="form-label">EC</label>
                                                    <input required type="file" class="form-control" name="ec"
                                                        placeholder="EC" maxlength="20" />

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
