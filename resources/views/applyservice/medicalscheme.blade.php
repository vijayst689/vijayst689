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
                                            class="text-danger">{{ $payment }}</span></h6>
                                    <form class="row g-4" action="{{ url('submitapply_medicalscheme') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">

                                            <div class="row">
                                                @if ($serviceid == 179)
                                                    <div class="mb-3 col-md-6">
                                                        <label for="" class="form-label text-dark">VAO
                                                            Certificate</label><br>
                                                        <a download class="btn btn-sm btn-info"
                                                            href="{{ URL::to('/') }}/upload/vao_certificate/EnrolmentForm2024.pdf">Download</a><br>

                                                        <label for="family_head_name" class="form-label text-dark">Family
                                                            Head
                                                            Name</label>
                                                        <input required type="text" class="form-control"
                                                            name="family_head_name" maxlength="30"
                                                            placeholder="Family Head Name" />

                                                        <label for="father_name" class="form-label text-dark">Father
                                                            Name</label>
                                                        <input required type="text" class="form-control"
                                                            name="father_name" maxlength="100" placeholder="Father Name" />

                                                        <label for="smartcard_no" class="form-label text-dark">Smartcard
                                                            Number</label>
                                                        <input required type="text" class="form-control"
                                                            name="smartcard_no" maxlength="15"
                                                            placeholder="Smartcard Number" />

                                                        <label for="aadhaar_no" class="form-label text-dark">Aadhaar
                                                            Number</label>
                                                        <input required type="text" class="form-control"
                                                            name="aadhaar_no" maxlength="12" placeholder="Aadhaar Number" />

                                                        <label for="passportsize_photo"
                                                            class="form-label text-dark">Passport Size
                                                            Photo</label>
                                                        <input required accept="image/jpeg" type="file"
                                                            class="form-control" name="passportsize_photo" />

                                                        <label for="pin_code" class="form-label text-dark">Pin Code</label>
                                                        <input required type="text" maxlength="6"
                                                            class="form-control number" name="pin_code"
                                                            placeholder="Pin Code" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="vao_or_income_certificate"
                                                            class="form-label text-dark">VAO
                                                            Certificate/Income Certificate(1,20,000)</label>
                                                        <input required accept="application/pdf" type="file"
                                                            class="form-control" name="vao_or_income_certificate" />

                                                        <label for="mobile" class="form-label text-dark">Cell Number
                                                        </label>
                                                        <input required type="text" class="form-control number"
                                                            name="mobile" maxlength="10" placeholder="Cell Number " />

                                                        <label for="husband_name" class="form-label text-dark">Husband
                                                            Name</label>
                                                        <input required type="text" class="form-control"
                                                            name="husband_name" maxlength="100"
                                                            placeholder="Husband Name" />

                                                        <label for="smartcard_onlineprint"
                                                            class="form-label text-dark">Smart card
                                                            (Online
                                                            print)</label>
                                                        <input required accept="application/pdf" type="file"
                                                            class="form-control" name="smartcard_onlineprint" />

                                                        <label for="live_photo" class="form-label text-dark">Live
                                                            Photo</label>
                                                        <input required accept="image/jpeg" type="file"
                                                            class="form-control" name="photo" />

                                                        <label for="marital_status" class="form-label text-dark">Marital
                                                            Status</label>
                                                        <select name="marital_status" class="form-control" required>
                                                            <option value="">Select Status</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Divorced">Divorced</option>
                                                            <option value="Widowed">Widowed</option>
                                                        </select>
                                                    </div>
                                                @elseif ($serviceid == 180)
                                                    <div class="mb-3 col-md-6">
                                                        <label for="mobile" class="form-label">Adhaar link cell
                                                            Number</label>
                                                        <input required type="text" class="form-control number"
                                                            name="mobile" maxlength="10"
                                                            placeholder="Adhaar link cell Number" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="aadhaar_card" class="form-label">Adhaar Card (Front &
                                                            Back)</label>
                                                        <input required type="file" class="form-control"
                                                            name="aadhaar_card"
                                                            placeholder="Adhaar card (Front & Back)" />
                                                    </div>
                                                @endif
                                            </div>
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

                    $('#member').change(function() {
                        if ($('#member').val() == 'Add 1 Member') {
                            $('#aadhaarhide').show("slow");
                            $('#aadhaar2hide').hide("slow");
                            $('#aadhaar3hide').hide("slow");
                            $('#aadhaar4hide').hide("slow");
                            $('#aadhaar5hide').hide("slow");
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar2').prop("required", false);
                            $('#aadhaar3').prop("required", false);
                            $('#aadhaar4').prop("required", false);
                            $('#aadhaar5').prop("required", false);
                            $('#aadhaar6').prop("required", false);
                            $('#aadhaar').prop("required", true);

                        } else if ($('#member').val() == 'Add 2 Member') {
                            $('#aadhaarhide').show("slow");
                            $('#aadhaar2hide').show("slow");
                            $('#aadhaar3hide').hide("slow");
                            $('#aadhaar4hide').hide("slow");
                            $('#aadhaar5hide').hide("slow");
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar3').prop("required", false);
                            $('#aadhaar4').prop("required", false);
                            $('#aadhaar5').prop("required", false);
                            $('#aadhaar6').prop("required", false);
                            $('#aadhaar').prop("required", true);
                            $('#aadhaar2').prop("required", true);

                        } else if ($('#member').val() == 'Add 3 Member') {
                            $('#aadhaarhide').show("slow");
                            $('#aadhaar2hide').show("slow");
                            $('#aadhaar3hide').show("slow");
                            $('#aadhaar4hide').hide("slow");
                            $('#aadhaar5hide').hide("slow");
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar4').prop("required", false);
                            $('#aadhaar5').prop("required", false);
                            $('#aadhaar6').prop("required", false);
                            $('#aadhaar').prop("required", true);
                            $('#aadhaar2').prop("required", true);
                            $('#aadhaar3').prop("required", true);

                        } else if ($('#member').val() == 'Add 4 Member') {
                            $('#aadhaarhide').show("slow");
                            $('#aadhaar2hide').show("slow");
                            $('#aadhaar3hide').show("slow");
                            $('#aadhaar4hide').show("slow");
                            $('#aadhaar5hide').hide("slow");
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar5').prop("required", false);
                            $('#aadhaar6').prop("required", false);
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
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar6').prop("required", false);
                            $('#aadhaar').prop("required", true);
                            $('#aadhaar2').prop("required", true);
                            $('#aadhaar3').prop("required", true);
                            $('#aadhaar4').prop("required", true);
                            $('#aadhaar5').prop("required", true);

                        } else if ($('#member').val() == 'Add 6 Member') {
                            $('#aadhaarhide').show("slow");
                            $('#aadhaar2hide').show("slow");
                            $('#aadhaar3hide').show("slow");
                            $('#aadhaar4hide').show("slow");
                            $('#aadhaar5hide').show("slow");
                            $('#aadhaar6hide').show("slow");
                            $('#aadhaar').prop("required", true);
                            $('#aadhaar2').prop("required", true);
                            $('#aadhaar3').prop("required", true);
                            $('#aadhaar4').prop("required", true);
                            $('#aadhaar5').prop("required", true);
                            $('#aadhaar6').prop("required", true);

                        } else {
                            $('#aadhaarhide').hide("slow");
                            $('#aadhaar2hide').hide("slow");
                            $('#aadhaar3hide').hide("slow");
                            $('#aadhaar4hide').hide("slow");
                            $('#aadhaar5hide').hide("slow");
                            $('#aadhaar6hide').hide("slow");
                            $('#aadhaar').prop("required", false);
                            $('#aadhaar2').prop("required", false);
                            $('#aadhaar3').prop("required", false);
                            $('#aadhaar4').prop("required", false);
                            $('#aadhaar5').prop("required", false);
                            $('#aadhaar6').prop("required", false);

                        }
                    });
                </script>
            @endpush
