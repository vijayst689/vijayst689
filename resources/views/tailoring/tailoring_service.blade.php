@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
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
                    <h6 class="card-title">{{ $servicename }}</h6>
                    <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                    <form class="row g-4" action="{{ url('submitapply_tailorshop') }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="row mt-4">
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="service_amount" value="{{ $payment }}">

                            @if ($serviceid == 1)
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" name="name" placeholder="Name"
                                        maxlength="30" />

                                    <label for="door_no" class="form-label">Door No</label>
                                    <input required type="text" maxlength="20" class="form-control" name="door_no"
                                        placeholder="Door No" />


                                    <label for="dist_id" class="form-label">District</label>
                                    <select required name="dist_id" id="dist_id" class="form-control">

                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input required type="text" maxlength="12" class="form-control" name="aadhaar_no"
                                        placeholder="Aadhaar Number" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="significant " class="form-label">Significant </label>
                                    <select required id="significant" name="significant" class="form-control">
                                        <option value="">Select Significant</option>
                                        <option value="S/O">S/O</option>
                                        <option value="D/O">D/O</option>
                                        <option value="W/O">W/O</option>
                                    </select>
                                    <label for="street_name" class="form-label">Street name</label>
                                    <input required type="text" maxlength="30" class="form-control" name="street_name"
                                        placeholder="Street name" />


                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select required name="taluk_id" id="taluk" class="form-control">
                                    </select>
                                    <label for="course_name" class="form-label">Course name</label>
                                    <select required id="course_name" name="course_name" class="form-control">
                                        <option value="">Select Course name</option>
                                        <option value="Tailoring & Embroidering">Tailoring & Embroidering </option>
                                        <option value="Aari work & Designing">Aari work & Designing</option>
                                        <option value="Tailoring">Tailoring</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="father_or_hus_name" class="form-label">Father /Husband Name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="father_or_hus_name" placeholder="Father or Husband Name" />

                                    <label for="postal_area" class="form-label">Postal Area</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="postal_area" placeholder="Postal Area" />
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input required type="text" maxlength="10" class="form-control" name="pincode"
                                        placeholder="Pincode" />

                                    <label for="photo" class="form-label">Photo</label>
                                    <input required type="file" maxlength="20" class="form-control" name="photo" />
                                </div>
                            @elseif($serviceid == 2)
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" name="name"
                                        placeholder="Name" maxlength="30" />
                                    <label for="door_no" class="form-label">Door No</label>
                                    <input required type="text" maxlength="20" class="form-control" name="door_no"
                                        placeholder="Door No" />
                                    <label for="dist_id" class="form-label">District</label>
                                    <select required name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input required type="text" maxlength="12" class="form-control" name="aadhaar_no"
                                        placeholder="Aadhaar Number" />

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="significant " class="form-label">Significant </label>
                                    <select required id="significant" name="significant" class="form-control">
                                        <option value="">Select Significant</option>
                                        <option value="S/O">S/O</option>
                                        <option value="D/O">D/O</option>
                                        <option value="W/O">W/O</option>
                                    </select>
                                    <label for="street_name" class="form-label">Street name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="street_name" placeholder="Street name" />
                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select required name="taluk_id" id="taluk" class="form-control">
                                    </select>
                                    <label for="course_name" class="form-label">Course name</label>
                                    <select required id="course_name" name="course_name" class="form-control">
                                        <option value="">Select Course name</option>
                                        <option value="Tally"> Tally </option>
                                        <option value="C++"> C++ </option>
                                        <option value="JAVA"> JAVA </option>
                                        <option value="PHP"> PHP </option>
                                        <option value="JAVA SCRIPT"> JAVA SCRIPT </option>
                                        <option value="TALLY ERP 9"> TALLY ERP 9 </option>
                                        <option value="DESKTOP PUBLISHING(DTP)"> DESKTOP PUBLISHING(DTP )</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="father_or_hus_name" class="form-label">Father /Husband Name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="father_or_hus_name" placeholder="Father or Husband Name" />
                                    <label for="postal_area" class="form-label">Postal Area</label>
                                    <input required type="text" maxlength="50" class="form-control"
                                        name="postal_area" placeholder="Postal Area" />
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input required type="text" maxlength="10" class="form-control" name="pincode"
                                        placeholder="Pincode" />
                                    <label for="photo" class="form-label">Photo</label>
                                    <input required type="file" maxlength="20" class="form-control" name="photo" />
                                </div>
                            @elseif($serviceid == 3)
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" name="name"
                                        placeholder="Name" maxlength="30" />
                                    <label for="door_no" class="form-label">Door No</label>
                                    <input required type="text" maxlength="20" class="form-control" name="door_no"
                                        placeholder="Door No" />
                                    <label for="dist_id" class="form-label">District</label>
                                    <select required name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input required type="text" maxlength="12" class="form-control" name="aadhaar_no"
                                        placeholder="Aadhaar Number" />

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="significant " class="form-label">Significant </label>
                                    <select required id="significant" name="significant" class="form-control">
                                        <option value="">Select Significant</option>
                                        <option value="S/O">S/O</option>
                                        <option value="D/O">D/O</option>
                                        <option value="W/O">W/O</option>
                                    </select>
                                    <label for="street_name" class="form-label">Street name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="street_name" placeholder="Street name" />
                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select required name="taluk_id" id="taluk" class="form-control">
                                    </select>
                                    <label for="course_name" class="form-label">Course name</label>
                                    <select required id="course_name" name="course_name" class="form-control">
                                        <option value="">Select Course name</option>
                                        <option value="Mehanthi"> Mehanthi </option>
                                        <option value="Facial and hair Dressing"> Facial and hair Dressing</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="father_or_hus_name" class="form-label">Father /Husband Name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="father_or_hus_name" placeholder="Father or Husband Name" />

                                    <label for="postal_area" class="form-label">Postal Area</label>
                                    <input required type="text" maxlength="50" class="form-control"
                                        name="postal_area" placeholder="Postal Area" />
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input required type="text" maxlength="10" class="form-control" name="pincode"
                                        placeholder="Pincode" />
                                    <label for="photo" class="form-label">Photo</label>
                                    <input required type="file" maxlength="20" class="form-control" name="photo" />
                                </div>
                            @elseif($serviceid == 4)
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" name="name"
                                        placeholder="Name" maxlength="30" />
                                    <label for="door_no" class="form-label">Door No</label>
                                    <input required type="text" maxlength="20" class="form-control" name="door_no"
                                        placeholder="Door No" />
                                    <label for="dist_id" class="form-label">District</label>
                                    <select required name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input required type="text" maxlength="12" class="form-control" name="aadhaar_no"
                                        placeholder="Aadhaar Number" />

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="significant " class="form-label">Significant </label>
                                    <select required id="significant" name="significant" class="form-control">
                                        <option value="">Select Significant</option>
                                        <option value="S/O">S/O</option>
                                        <option value="D/O">D/O</option>
                                        <option value="W/O">W/O</option>
                                    </select>
                                    <label for="street_name" class="form-label">Street name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="street_name" placeholder="Street name" />
                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select required name="taluk_id" id="taluk" class="form-control">
                                    </select>
                                    <label for="course_name" class="form-label">Course name</label>
                                    <select required id="course_name" name="course_name" class="form-control">
                                        <option value="">Select Course name</option>
                                        <option value="Mehanthi"> Mehanthi </option>
                                        <option value="Facial and hair Dressing"> Facial and hair Dressing</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="father_or_hus_name" class="form-label">Father /Husband Name</label>
                                    <input required type="text" maxlength="30" class="form-control"
                                        name="father_or_hus_name" placeholder="Father or Husband Name" />

                                    <label for="postal_area" class="form-label">Postal Area</label>
                                    <input required type="text" maxlength="50" class="form-control"
                                        name="postal_area" placeholder="Postal Area" />
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input required type="text" maxlength="10" class="form-control" name="pincode"
                                        placeholder="Pincode" />
                                    <label for="photo" class="form-label">Photo</label>
                                    <input required type="file" maxlength="20" class="form-control" name="photo" />
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
@endsection
@push('page_scripts')
    <script>
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        var amount = "{{ $amount }}";
        ramjibalance = parseFloat(ramjibalance);
        amount = parseInt(amount);

        function checkpayment(e) {
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
                $("#amount").val(amount);
                return true;

            }
        }

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
