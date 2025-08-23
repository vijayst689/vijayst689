@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
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
                            <form action="{{ url('/submit_statusupdate_msme') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <h4 class="text-center"> Basic Details </h4>
                                <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
                                <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                @php
                                    $apply_user_id = 0;
                                    if ($services->retailer_id == 0) {
                                        $apply_user_id = $services->distributor_id;
                                    } elseif ($services->distributor_id == 0) {
                                        $apply_user_id = $services->retailer_id;
                                    }
                                @endphp
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->name }}" class="form-control" name="name"
                                        placeholder="Name" />

                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        maxlength="10" value="{{ $services->mobile }}" class="form-control number"
                                        name="mobile" placeholder="Mobile Number" />

                                    <label for="cmp_name" class="form-label">Company Name</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                        type="text"value=" {{ $services->cmp_name }}" class="form-control"
                                        name="cmp_name" placeholder="Company Name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="community" class="form-label">Community</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required name="community"
                                        id="community" class="form-control">
                                        <option value="">Select Community</option>
                                        <option @if ($services->community == 'BC') selected @endif value="BC">
                                            BC</option>
                                        <option @if ($services->community == 'OC') selected @endif value="OC">
                                            OC</option>
                                        <option @if ($services->community == 'OBC') selected @endif value="OBC">OBC
                                        </option>
                                        <option @if ($services->community == 'MBC') selected @endif value="MBC">MBC
                                        </option>
                                        <option @if ($services->community == 'SC') selected @endif value="SC">SC
                                        </option>
                                        <option @if ($services->community == 'ST') selected @endif value="ST">ST
                                        </option>
                                        <option @if ($services->community == 'BC(Muslim)') selected @endif value="BC(Muslim)">
                                            BC (Muslim)</option>
                                        <option @if ($services->community == 'Others') selected @endif value="Others">
                                            Others</option>
                                    </select>

                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->aadhaar_card != '')
                                            <label>Aadhaar Card</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Aadhaar Card</label>
                                        <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                            type="file" name="aadhaar_card">
                                        @if ($services->aadhaar_card != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                        @endif
                                    @endif

                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->pan_card != '')
                                            <label>Pan Card</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Pan Card</label>
                                        <input @if ($services->pan_card == '') required @endif class="form-control"
                                            type="file" name="pan_card">
                                        @if ($services->pan_card != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <h4 class="text-center"> Company Address </h4>
                                <div class="mb-3 col-md-6">
                                    <label for="building_name" class="form-label">Building Name</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->building_name }}" class="form-control"
                                        name="building_name" placeholder="Building Name" />
                                 <label for="ward_no" class="form-label">Ward No</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->ward_no }}" class="form-control" name="ward_no"
                                        placeholder="Ward No" />
                                    <label for="pin_code" class="form-label">Pin Code</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->pin_code }}" class="form-control" name="pin_code"
                                        placeholder="Pin Code" />

                                </div>

                                <div class="mb-3 col-md-6">
                                     <label for="dist_id" class="form-label">District</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="dist_id"
                                        id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="taluk_id"
                                        id="taluk" class="form-control">
                                    </select>
                                    <label for="panchayath_id" class="form-label">VAO</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="panchayath_id"
                                        id="panchayath" class="form-control">
                                    </select>


                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center"> Account Details </h4>

                                <div class="mb-3 col-md-6">
                                    <label for="account_no" class="form-label">Account Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="acc_number"
                                        type="text" value=" {{ $services->account_no }}"
                                        class="form-control number" name="account_no" placeholder="Account Number" />
                                    <label for="confirm_account_no" class="form-label">Confirm Account Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                        id="confirmacc_number" type="text"
                                        value=" {{ $services->confirm_account_no }}" class="form-control number"
                                        name="confirm_account_no" placeholder="Confirm Account Number" />
                                    <span id="divCheckMatch"></span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->ifsc_code }}" class="form-control" name="ifsc_code"
                                        placeholder="IFSC Code" />
                                    <label for="micr_no" class="form-label">Micr Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->micr_no }}" class="form-control" name="micr_no"
                                        placeholder="Micr Number" />
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-center"> Number Of Emplyees </h4>
                                <div class="mb-3 col-md-6">
                                    <label for="male_count" class="form-label">Male Count</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->male_count }}" class="form-control number"
                                        name="male_count" placeholder="Male" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="female_count" class="form-label">Female Count</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->female_count }}" class="form-control number"
                                        name="female_count" placeholder="Female" />
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-center"> Inverstment Of The Company </h4>
                                <div class="mb-3 col-md-6">
                                    <label for="amount_in_lakhs" class="form-label">Amount In Lakhs</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value=" {{ $services->amount_in_lakhs }}" class="form-control"
                                        name="amount_in_lakhs" placeholder="Amount In Lakhs" />
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-center"> Additional Details </h4>
                                <div class="mb-3 col-md-6">
                                    <label for="gst" class="form-label">GST</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required name="gst"
                                        id="gst" class="form-control">
                                        <option value="">Select Yes/No</option>
                                        <option @if ($services->gst == 'Yes') selected @endif value="Yes">
                                            Yes</option>
                                        <option @if ($services->gst == 'No') selected @endif value="No">
                                            No</option>

                                    </select>
                                    <div class="" id="gst_numberhide" class="form-control"
                                        style="display: none;">
                                        <label for="gst_number" class="form-label">GST Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                            type="text" value=" {{ $services->gst_number }}" class="form-control"
                                            name="gst_number" placeholder="GST Number" />
                                    </div>
                                    <label for="itr" class="form-label">ITR</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required name="itr"
                                        id="itr" class="form-control">
                                        <option value="">Select ITR</option>
                                        <option @if ($services->itr == 'ITR Yes') selected @endif value="ITR Yes">
                                            Yes</option>
                                        <option @if ($services->itr == 'ITR No') selected @endif value="ITR No">
                                            No</option>

                                    </select>


                                    <div class="" id="itr_formhide" class="form-control"
                                        style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->itr_form != '')
                                                <label>ITR Form</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/itr_form/{{ $services->itr_form }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>ITR Form</label>
                                            <input @if ($services->itr_form == '') required @endif
                                                class="form-control" type="file" name="itr_form">
                                            @if ($services->itr_form != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/itr_form/{{ $services->itr_form }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Type Of Organization</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                        name="organization" id="organization" class="form-control">
                                        <option value="">Select Organization</option>
                                        <option @if ($services->organization == 'Partnership') selected @endif
                                            value="Partnership">
                                            Partnership</option>
                                        <option @if ($services->organization == 'Properitor') selected @endif value="Properitor">
                                            Properitor</option>

                                    </select>

                                    <label for="category_of_work" class="form-label">Category Of Work</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                        name="category_of_work" id="category_of_work" class="form-control">
                                        <option value="">Select Category</option>
                                        <option @if ($services->category_of_work == 'Manufacturing') selected @endif
                                            value="Manufacturing">
                                            Manufacturing</option>
                                        <option @if ($services->category_of_work == 'Services') selected @endif value="Services">
                                            Services</option>
                                        <option @if ($services->category_of_work == 'Trading') selected @endif value="Trading">
                                            Trading</option>
                                    </select>

                                </div>
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                    <div class="mb-3 col-md-6">
                                        <label for="service_name" class="form-label">Service Status</label>
                                        <select class="form-control" name="status" id="service_status">
                                            <option value="">Select</option>
                                            <option @if ($services->status == 'Pending') selected @endif
                                                value="Pending">Pending</option>
                                            <option @if ($services->status == 'Resubmit') selected @endif
                                                value="Resubmit">Resubmit</option>
                                            <option @if ($services->status == 'Processing') selected @endif
                                                value="Processing">Processing</option>
                                            @if ($services->status == 'Processing' || $services->status == 'Approved')
                                            <option @if ($services->status == 'Approved') selected @endif
                                                    value="Approved">Approved</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input value="{{ $services->remarks }}" class="form-control" type="text"
                                            name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                        <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                        <input class="form-control" type="file" name="acknowledgement"
                                            id="acknowledgement" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                        <label for="application_no" class="form-label">Application No</label>
                                        <input value="{{ $services->application_no }}" class="form-control"
                                            type="text" maxlength="20" name="application_no"
                                            id="application_no" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                        <label for="certificate" class="form-label">Certificate</label>
                                        <input class="form-control" type="file" name="certificate"
                                            id="certificate" />
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <input disabled value="{{ $services->status }}" class="form-control"
                                                type="text" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $services->remarks }}</textarea>
                                        </div>

                                    </div>
                                @endif

                            </div>




                            <div class="mt-2 text-center">
                                @if ($services->status == 'Resubmit' && ($services->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id))
                                    <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                @elseif($services->status == 'Approved')
                                    <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                @else
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                @endif
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
        var dist_id = "{{ $services->dist_id }}";
        var taluk_id = "{{ $services->taluk_id }}";
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var gst = "{{ $services->gst }}";
            var itr = "{{ $services->itr }}";
            if (gst == 'Yes') {
                $('#gst_numberhide').show("slow");
                $('#gst_number').prop("required", true);
            }

            if ($('#itr').val() == 'ITR Yes') {
                $('#itr_formhide').show("slow");
                $('#itr_formnumber').prop("required", true);
            }

            if (status == "Resubmit") {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
            } else if (status == "Processing") {
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
                $('#acknowledgementhide').show("slow");
                if (acknowledgement == "") {
                    $('#acknowledgement').prop("required", true);
                }
            } else if (status == "Approved") {
                $('#certhide').show("slow");
                if (acknowledgement == "") {
                    $('#certificate').prop("required", true);
                }
            }
            gettaluk(dist_id);
            getpanchayath(taluk_id);
            $("#acc_number, #confirmacc_number").keyup(checkAccountNumberMatch);
        });

        function checkAccountNumberMatch() {
            var accountno = $("#acc_number").val();
            var confirmaccountno = $("#confirmacc_number").val();
            if (accountno != confirmaccountno) {
                $("#divCheckMatch").html("Account Number does not match!").css({
                    'color': 'red',
                    'font-size': '80%',
                    'font-weight': 'bold'
                });
                $("#save").attr("disabled", true);
            } else {
                $("#divCheckMatch").html("Account Number match.").css({
                    'color': 'green',
                    'font-size': '80%',
                    'font-weight': 'bold'
                });
                $("#save").removeAttr("disabled");
            }
        }

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

        $('#service_status').change(function() {
            if ($('#service_status').val() == 'Resubmit') {
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
            } else if ($('#service_status').val() == 'Processing') {
                $('#acknowledgementhide').show("slow");
                $('#acknowledgement').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
            } else if ($('#service_status').val() == 'Approved') {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').show("slow");
                $('#certificate').prop("required", true);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
            } else {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
            }
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
                    $("#taluk").val("{{ $services->taluk_id }}");

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
                    $("#panchayath").val("{{ $services->panchayath_id }}");

                }
            });
        }
    </script>
@endpush
