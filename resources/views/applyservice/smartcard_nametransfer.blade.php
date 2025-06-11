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
                            <form class="row g-4" action="{{ url('submitapply_smart_nametransfer') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
    
                                @if ($serviceid == 224)
                                        <div class="mb-3 col-md-6">
                                            <label for="smart_card" class="form-label">பெயர் இணைக்க வேண்டிய குடும்ப
                                                அட்டை</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />
                                        </div>
                                    @elseif($serviceid == 225)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="aadhaar_card" class="form-label">Family Head Adhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />

                                            <label for="mobile" class="form-label"> Mobile Number</label>
                                            <input required type="text" class="form-control number" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />
                                        </div>
                                    @elseif($serviceid == 234)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label>Family Head Photo</label>
                                            <input id="family_head_photo" class="form-control" required type="file"
                                                name="family_head_photo">
                                            <label class="form-label">Member</label>
                                            <select required id="add_member" name="add_member" class="form-control">
                                                <option value="">Select Member</option>
                                                <option value="Add 1 Member">Add 1 Member</option>
                                                <option value="Add 2 Member">Add 2 Member</option>
                                                <option value="Add 3 Member">Add 3 Member</option>
                                                <option value="Add 4 Member">Add 4 Member</option>
                                                <option value="Add 5 Member">Add 5 Member</option>
                                            </select>
                                            <div class="mb-3 row" id="aadhaar_cardhide" style="display: none;">
                                                <label>Aadhaar Card</label>
                                                <input required id="aadhaar_card" class="form-control" type="file"
                                                    name="aadhaar_card">
                                            </div>

                                            <div class="mb-3 row" id="aadhaar_card2hide" style="display: none;">
                                                <label>2nd Member Aadhaar Card</label>
                                                <input required id="aadhaar_card2" class="form-control" type="file"
                                                    name="aadhaar_card2">
                                            </div>

                                            <div class="mb-3 row" id="aadhaar_card3hide" style="display: none;">
                                                <label>3rd Member Aadhaar Card</label>
                                                <input required id="aadhaar_card3" class="form-control" type="file"
                                                    name="aadhaar_card3">
                                            </div>

                                            <div class="mb-3 row" id="aadhaar_card4hide" style="display: none;">
                                                <label>4th Member Aadhaar Card</label>
                                                <input required id="aadhaar_card4" class="form-control" type="file"
                                                    name="aadhaar_card4">
                                            </div>

                                            <div class="mb-3 row" id="aadhaar_card5hide" style="display: none;">
                                                <label>5th Member Aadhaar Card</label>
                                                <input required id="aadhaar_card5" class="form-control" type="file"
                                                    name="aadhaar_card5">
                                            </div>

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />
                                            <label class="form-label">Addres Proof</label>
                                            <select required id="documents" name="documents" class="form-control">
                                                <option value="">Select Addres Proof</option>
                                                <option value="EB Bill">EB Bill</option>
                                                <option value="Patta">Patta</option>
                                                <option value="Rental Agreement">Rental Agreement</option>
                                                <option value="Gas Bill">Gas Bill</option>
                                            </select>
                                            <div class="" id="electricity_bill_receipthide" style="display: none;">
                                                <label class="form-label text-danger">EB Bill</label>
                                                <input required id="electricity_bill_receipt"
                                                    class="form-control text-danger" type="file"
                                                    name="electricity_bill_receipt">
                                            </div>
                                            <div class="" id="pattahide" style="display: none;">
                                                <label class="form-label text-danger">Patta</label>
                                                <input required id="patta" class="form-control text-danger"
                                                    type="file" name="patta">
                                            </div>
                                            <div class="" id="rental_agreementhide" style="display: none;">
                                                <label class="form-label text-danger">Rental Agreement</label>
                                                <input required id="rental_agreement" class="form-control text-danger"
                                                    type="file" name="rental_agreement">
                                            </div>
                                            <div class="" id="gas_cylinder_receipthide" style="display: none;">
                                                <label class="form-label text-danger">Gas Bill</label>
                                                <input required id="gas_cylinder_receipt" class="form-control text-danger"
                                                    type="file" name="gas_cylinder_receipt">
                                            </div>
                                            <label for="already_applied_application" class="form-label">Already Applied
                                                Application</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="already_applied_application" />
                                        </div>
                                    @elseif($serviceid == 236)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label">Member</label>
                                            <select required id="member" name="member" class="form-control">
                                                <option value="">Select Member</option>
                                                <option value="Add 1 Member">Add 1 Member</option>
                                                <option value="Add 2 Member">Add 2 Member</option>
                                                <option value="Add 3 Member">Add 3 Member</option>
                                                <option value="Add 4 Member">Add 4 Member</option>
                                                <option value="Add 5 Member">Add 5 Member</option>
                                            </select>
                                            <div class="mb-3 col-md-6">
                                                <div class="mb-3 row" id="aadhaarhide" style="display: none;">
                                                    <label>Aadhaar Card</label>
                                                    <input id="aadhaar" class="form-control" type="file"
                                                        name="aadhaar">
                                                </div>

                                                <div class="mb-3 row" id="aadhaar2hide" style="display: none;">
                                                    <label>2nd Member Aadhaar Card</label>
                                                    <input id="aadhaar2" class="form-control" type="file"
                                                        name="aadhaar2">
                                                </div>

                                                <div class="mb-3 row" id="aadhaar3hide" style="display: none;">
                                                    <label>3rd Member Aadhaar Card</label>
                                                    <input id="aadhaar3" class="form-control" type="file"
                                                        name="aadhaar3">
                                                </div>

                                                <div class="mb-3 row" id="aadhaar4hide" style="display: none;">
                                                    <label>4th Member Aadhaar Card</label>
                                                    <input id="aadhaar4" class="form-control" type="file"
                                                        name="aadhaar4">
                                                </div>

                                                <div class="mb-3 row" id="aadhaar5hide" style="display: none;">
                                                    <label>5th Member Aadhaar Card</label>
                                                    <input id="aadhaar5" class="form-control" type="file"
                                                        name="aadhaar5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />
                                        </div>
                                    @elseif($serviceid == 237)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front &
                                                Back)</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />
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

        $('#add_member').change(function() {
            if ($('#add_member').val() == 'Add 1 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#add_member').val() == 'Add 2 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);

            } else if ($('#add_member').val() == 'Add 3 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);

            } else if ($('#add_member').val() == 'Add 4 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);

            } else if ($('#add_member').val() == 'Add 5 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').show("slow");
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);
                $('#aadhaar_card5').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);

            }
        });

        $('#documents').change(function() {
            if ($('#documents').val() == 'EB Bill') {
                $('#electricity_bill_receipthide').show("slow");
                $('#pattahide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#documents').val() == 'Patta') {
                $('#pattahide').show("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#patta').prop("required", true);

            } else if ($('#documents').val() == 'Rental Agreement') {
                $('#rental_agreementhide').show("slow");
                $('#electricity_bill_receipt').prop("required", false);
                $('#electricity_bill_receipthide').hide("slow");
                $('#pattahide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreement').prop("required", true);

            } else if ($('#documents').val() == 'Gas Bill') {
                $('#gas_cylinder_receipthide').show("slow");
                $('#pattahide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#electricity_bill_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else {
                $('#gas_cylinder_receipthide').hide("slow");
                $('#pattahide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#electricity_bill_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
            }
        });

        $('#member').change(function() {
            if ($('#member').val() == 'Add 1 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);

            } else if ($('#member').val() == 'Add 2 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);

            } else if ($('#member').val() == 'Add 3 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);

            } else if ($('#member').val() == 'Add 4 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);

            } else if ($('#member').val() == 'Add 5 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);

            } else {
                $('#aadhaarhide').hide("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar').prop("required", false);
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);

            }
        });
    </script>
@endpush
