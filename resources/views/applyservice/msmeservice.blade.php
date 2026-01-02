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
                                    <form class="row g-4" action="{{ url('submitapply_msme') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <h4 class="text-center"> Basic Details </h4>
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input required type="text" class="form-control" name="name"
                                                    placeholder="Name" />

                                                <label for="mobile" class="form-label">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control number"
                                                    name="mobile" placeholder="Mobile Number" />

                                                <label for="cmp_name" class="form-label">Company Name</label>
                                                <input required type="text" class="form-control" name="cmp_name"
                                                    placeholder="Company Name" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="community" class="form-label">Community</label>
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

                                                <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                                <input accept="image/jpeg, image/png" type="file" class="form-control"
                                                    name="aadhaar_card" />

                                                <label for="pan_card" class="form-label">Pan Card</label>
                                                <input accept="image/jpeg, image/png" type="file" class="form-control"
                                                    name="pan_card" />

                                            </div>
                                        </div>
                                        <div class="row">
                                            <h4 class="text-center"> Company Address </h4>

                                            @if ($serviceid == 34)
                                                <div class="mb-3 col-md-6">
                                                    <label for="building_name" class="form-label">Building Name</label>
                                                    <input required type="text" class="form-control"
                                                        name="building_name" placeholder="Building Name" />
                                                    <label for="ward_no" class="form-label">Ward No/Street Name</label>
                                                    <input required type="text" class="form-control" name="ward_no"
                                                        placeholder="Ward No" maxlength="50" />
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input required type="text" class="form-control" name="pin_code"
                                                        placeholder="Pin Code" />
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
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select required name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                    <label for="panchayath_id" class="form-label">VAO</label>
                                                    <select required name="panchayath_id" id="panchayath"
                                                        class="form-control">
                                                    </select>

                                                </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="text-center"> Account Details </h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="account_no" class="form-label">Account Number</label>
                                                <input id="acc_number" required type="text" class="form-control"
                                                    name="account_no" placeholder="Account Number" />

                                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                <input required type="text" class="form-control" name="ifsc_code"
                                                    placeholder="IFSC Code" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="confirm_account_no" class="form-label">Confirm Account
                                                    Number</label>
                                                <input id="confirmacc_number" required type="text"
                                                    class="form-control" name="confirm_account_no"
                                                    placeholder="Confirm Account Number" />
                                                <span id="divCheckMatch"></span><br>


                                                <label for="micr_no" class="form-label">Micr Number</label>
                                                <input required type="text" class="form-control" name="micr_no"
                                                    placeholder="Micr Number" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="text-center"> Number Of Emplyees </h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="male_count" class="form-label">Male Count</label>
                                                <input required type="text" class="form-control number"
                                                    name="male_count" placeholder="Male" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="female_count" class="form-label">Female Count</label>
                                                <input required type="text" class="form-control number"
                                                    name="female_count" placeholder="Female" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="text-center"> Inverstment Of The Company </h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="amount_in_lakhs" class="form-label">Amount In Lakhs</label>
                                                <input required type="text" class="form-control"
                                                    name="amount_in_lakhs" placeholder="Amount In Lakhs" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="text-center"> Additional Details </h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="gst" class="form-label">GST</label>
                                                <select required name="gst" id="gst" class="form-control">
                                                    <option value="">Select Yes/No</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div class="" id="gst_numberhide" class="form-control"
                                                    style="display: none;">
                                                    <label>GST Number</label>
                                                    <input class="form-control" id="gst_number" type="text"
                                                        name="gst_number" placeholder="GST Number">
                                                </div>
                                                <label for="itr" class="form-label">ITR</label>
                                                <select required name="itr" id="itr" class="form-control">
                                                    <option value="">Select Yes/No</option>
                                                    <option value="ITR Yes">Yes</option>
                                                    <option value="ITR No">No</option>
                                                </select>
                                                <div class="" id="itr_formhide" class="form-control"
                                                    style="display: none;">
                                                    <label>ITR Form</label>
                                                    <input class="form-control" id="itr_form" type="file"
                                                        name="itr_form">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="organization" class="form-label">Type Of Organization</label>
                                                <select required name="organization" id="organization"
                                                    class="form-control">
                                                    <option value="">Select Organization</option>
                                                    <option value="Partnership">Partnership</option>
                                                    <option value="Properitor">Properitor</option>
                                                </select>
                                                <label for="category_of_work" class="form-label">Category Of Work</label>
                                                <select required name="category_of_work" id="category_of_work"
                                                    class="form-control">
                                                    <option value="">Select Category</option>
                                                    <option value="Manufacturing">Manufacturing</option>
                                                    <option value="Services">Services</option>
                                                    <option value="Trading">Trading</option>
                                                </select>

                                            </div>
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
                        $("#acc_number, #confirmacc_number").keyup(checkAccountNumberMatch);
                    });

                    function checkAccountNumberMatch() {
                        var accountno = $("#acc_number").val();
                        var confirmaccountno = $("#confirmacc_number").val();

                        if (accountno != "" && confirmaccountno != "") {
                            if (accountno != confirmaccountno) {
                                $("#divCheckMatch").html("Account Number does not match!").css({
                                    'color': 'red',
                                    'font-size': '100%',
                                    'font-weight': 'bold'
                                });
                                $("#save").attr("disabled", true);
                            } else {
                                $("#divCheckMatch").html("Account Number match.").css({
                                    'color': 'green',
                                    'font-size': '100%',
                                    'font-weight': 'bold'
                                });
                                $("#save").removeAttr("disabled");
                            }
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

                    $('#incomeyearly').on('input', function() {
                        var yearly = parseInt($('#incomeyearly').val());
                        $('#incomemonthly').val((yearly / 12 ? yearly / 12 : 0).toFixed(2));
                    });


                    $('#gst').change(function() {
                        if ($('#gst').val() == 'Yes') {
                            $('#gst_numberhide').show("slow");
                            $('#gst_number').prop("required", true);
                        } else {
                            $('#gst_numberhide').hide("slow");
                            $('#gst_number').prop("required", false);
                        }
                    });

                    $('#itr').change(function() {
                        if ($('#itr').val() == 'ITR Yes') {
                            $('#itr_formhide').show("slow");
                            $('#itr_formnumber').prop("required", true);
                        } else {
                            $('#itr_formhide').hide("slow");
                            $('#itr_formnumber').prop("required", false);
                        }
                    });
                </script>
            @endpush
