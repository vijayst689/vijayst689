@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
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
                                <form action="{{ url('/tec_csc_update') }}" id="myForm" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                        <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                        <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                        <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
                                        <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                        @php
                                        $apply_user_id = 0;
                                        if ($services->distributor_id == 0 && $services->retailer_id == 0) {
                                        $apply_user_id = $services->user_id;
                                        } elseif ($services->retailer_id == 0) {
                                        $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                        $apply_user_id = $services->retailer_id;
                                        }
                                        @endphp
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->name }}" class="form-control"
                                            name="name" maxlength="30" placeholder="Name"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->mobile }}" class="form-control number"
                                            name="mobile" maxlength="10" placeholder="Mobile Number"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                            <label>Adhaar card (front & Back)</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Adhaar card (front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="shop_name" class="form-label">Shop Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->shop_name }}" class="form-control"
                                            name="shop_name" maxlength="50" placeholder="Shop Name"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="shop_address" class="form-label">Shop Address</label>
                                            <textarea @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                    value="{{ $services->shop_address }}" class="form-control" name="shop_address" maxlength="200" placeholder="Shop Address">{{ $services->shop_address }}
                                </textarea>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->pan_card != '')
                                            <label>Pan Card</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Pan Card</label>
                                            <input @if ($services->pan_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="pan_card">
                                            @if ($services->pan_card != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="door_no" class="form-label">Door No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->door_no }}" class="form-control"
                                            name="door_no" maxlength="15" placeholder="Door No"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="street_name" class="form-label">Street Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->street_name }}" class="form-control" name="street_name" maxlength="30" placeholder="Street Name"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->tec_certificate != '')
                                            <label>Tec certificate</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/tec_certificate/{{ $services->tec_certificate }}" class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Tec certificate</label>
                                            <input @if ($services->tec_certificate == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="tec_certificate">
                                            @if ($services->tec_certificate != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/tec_certificate/{{ $services->tec_certificate }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="postal_name" class="form-label">Postal Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->postal_name }}" class="form-control" name="postal_name" maxlength="30" placeholder="Postal Name"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="village_name" class="form-label">Village Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->village_name }}" class="form-control" name="village_name" maxlength="30" placeholder="Village Name"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->bank_passbook != '')
                                            <label>Bank passbook</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/bank_passbook/{{ $services->bank_passbook }}" class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Bank passbook</label>
                                            <input @if ($services->bank_passbook == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="bank_passbook">
                                            @if ($services->bank_passbook != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/bank_passbook/{{ $services->bank_passbook }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                <option @if ($d->id == $services->dist_id) selected @endif
                                                    value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control"> </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->voterid != '')
                                            <label>Voter Id</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}" class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Voter Id</label>
                                            <input @if ($services->voterid == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="voterid">
                                            @if ($services->voterid != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="panchayath_id" class="form-label">VAO Area</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="panchayath_id"
                                                id="panchayath" class="form-control"></select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="pincode" class="form-label">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->pincode }}" class="form-control" name="pincode" maxlength="10" placeholder="Pin Code"/>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->bc_agent_certificate != '')
                                            <label>Bc Agent Certificate</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/bc_agent_certificate/{{ $services->bc_agent_certificate }}" class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Bc Agent Certificate</label>
                                            <input @if ($services->bc_agent_certificate == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="bc_agent_certificate">
                                            @if ($services->bc_agent_certificate != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/bc_agent_certificate/{{ $services->bc_agent_certificate }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>

                                        @if (Auth::user()->id != $apply_user_id)
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <select class="form-control" name="status" id="service_status">
                                                <option value="">Select</option>
                                                <option @if ($services->status == 'Pending') selected @endif
                                                    value="Pending">
                                                    Pending</option>
                                                <option @if ($services->status == 'Resubmit') selected @endif
                                                    value="Resubmit">
                                                    Resubmit</option>
                                                <option @if ($services->status == 'Processing') selected @endif
                                                    value="Processing">Processing</option>
                                                @if ($services->status != 'Approved')
                                                <option @if ($services->status == 'Rejected') selected @endif
                                                    value="Rejected">
                                                    Rejected</option>
                                                @endif
                                                <option @if ($services->status == 'Approved') selected @endif
                                                    value="Approved">
                                                    Approved</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <input value="{{ $services->remarks }}" class="form-control" type="text"
                                                name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                            <label for="select" class="form-label">Select</label>
                                            <select class="form-control" name="selects" id="select">
                                                <option>select</option>
                                                <option @if ($services->selects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($services->selects == 'File') selected @endif value = "File">
                                                    File</option>
                                            </select>
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
                                        <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                            <label for="selects" class="form-label">Select</label>
                                            <select class="form-control" name="lects" id="selects">
                                                <option>select</option>
                                                <option @if ($services->lects == 'Text') selected @endif
                                                    value = "Text">
                                                    Text</option>
                                                <option @if ($services->lects == 'File') selected @endif
                                                    value = "File">File</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                            <label for="application" class="form-label">Application</label>
                                            <input value="{{ $services->application }}" class="form-control"
                                                type="text" maxlength="150" name="application" id="application" />
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
                                        @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                        @elseif($services->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                        @else
                                        <button id="save" type="submit"
                                            class="btn btn-primary me-2">Submit</button>
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
                $(function() {

                    var dist_id = "{{ $services->dist_id }}";
                    var taluk_id = "{{ $services->taluk_id }}";

                    gettaluk(dist_id);
                    getpanchayath(taluk_id);

                    var status = "{{ $services->status }}";
                    // alert(status);
                    var acknowledgement = "{{ $services->acknowledgement }}";
                    var certificate = "{{ $services->certificate }}";
                    var selects = "{{ $services->selects }}";
                    var lects = "{{ $services->lects }}";

                    if (status == "Resubmit") {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", true);
                    } else if (status == "Processing") {
                        if (selects == "Text") {
                            $('#applicationnohide').show("slow");
                        }
                        if (selects == "File") {
                            $('#acknowledgementhide').show("slow");
                            if (acknowledgement == "") {
                                $('#acknowledgement').prop("required", true);
                            }
                        }
                        $('#selecthide').show("slow");


                    } else if (status == "Approved") {
                        if (lects == "Text") {
                            $('#applicationhide').show("slow");
                        }
                        if (lects == "File") {
                            $('#certhide').show("slow");
                            if (certificate == "") {
                                $('#certificate').prop("required", true);
                            }
                        }
                        $('#selectshide').show("slow")
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
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    } else if ($('#service_status').val() == 'Processing') {
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", true);
                        $('#selecthide').show("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    } else if ($('#service_status').val() == 'Approved') {
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", true);
                        $('#selectshide').show("slow");
                    } else {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#select').prop("required", false);
                        $('#selecthide').hide("slow");
                        $('#selects').prop("required", false);
                        $('#selectshide').hide("slow");
                    }
                });

                $('#select').change(function() {
                    if ($('#select').val() == 'Text') {
                        $('#applicationnohide').show("slow");
                        $('#application_no').prop("required", true);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                    } else if ($('#select').val() == 'File') {
                        $('#acknowledgementhide').show("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                    } else {
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                    }
                });

                $('#selects').change(function() {
                    if ($('#selects').val() == 'Text') {
                        $('#applicationhide').show("slow");
                        $('#application').prop("required", true);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
                    } else if ($('#selects').val() == 'File') {
                        $('#certhide').show("slow");
                        $('#certificate').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                    } else {
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                        $('#certhide').hide("slow");
                        $('#certificate').prop("required", false);
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

                document.getElementById("myForm").addEventListener("submit", function() {
                    const btn = document.getElementById("save");
                    btn.disabled = true;
                    btn.innerText = "Submitting...";
                });
            </script>
            @endpush