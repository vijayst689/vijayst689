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
                                <form action="{{ url('/medicalscheme_update') }}" id="myForm"
                                    method="POST" enctype="multipart/form-data">
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
                                        @if($serviceid == 179)
                                        <div class="mb-3 col-md-6">
                                            <label for="family_head_name" class="form-label">Family Head Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->family_head_name }}" class="form-control"
                                            name="family_head_name" maxlength="30" placeholder="Family Head Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->mobile }}" class="form-control number"
                                            name="mobile" maxlength="10" placeholder="Cell Mobile" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->family_head_photo != '')
                                            <label for="family_head_photo" class="form-label">Family Head Photo</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label for="family_head_photo" class="form-label">Family Head Photo</label>
                                            <input @if ($services->family_head_photo == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="family_head_photo">
                                            @if ($services->family_head_photo != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->smartcard_onlineprint != '')
                                            <label for="smartcard_onlineprint" class="form-label">Smart card (Online print)</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label for="smartcard_onlineprint" class="form-label">Smart card (Online print)</label>
                                            <input @if ($services->smartcard_onlineprint == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="smartcard_onlineprint">
                                            @if ($services->smartcard_onlineprint != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->allfamily_mem_aadhaarcard != '')
                                            <label for="allfamily_mem_aadhaarcard" class="form-label">All family Members Adhaar card</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/allfamily_mem_aadhaarcard/{{ $services->allfamily_mem_aadhaarcard }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label for="allfamily_mem_aadhaarcard" class="form-label">All family Members Adhaar card</label>
                                            <input @if ($services->allfamily_mem_aadhaarcard == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="allfamily_mem_aadhaarcard">
                                            @if ($services->allfamily_mem_aadhaarcard != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/allfamily_mem_aadhaarcard/{{ $services->allfamily_mem_aadhaarcard }}">Download</a><br>
                                            @endif
                                            @endif
                                        </div>
                                        @elseif($serviceid == 180)
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Adhaar link cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" value="{{ $services->mobile }}" class="form-control number"
                                            name="mobile" maxlength="10" placeholder="Adhaar link cell Number"/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front & Back)</label>
                                            @if($customers->aadhaar_file == "")
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                            @else
                                            <br><a target="_blank" href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}" class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        </div>


                                        @endif



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
                    var status = "{{ $services->status }}";
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

                $('#enrollment_type').change(function() {
                    if ($('#enrollment_type').val() == 'Enrollment Slip') {
                        $('#ensliphide').show("slow");
                        $('#ennumberhide').hide("slow");
                        $('#enslip').prop("required", true);
                        $('#ennumber').prop("required", false);
                    } else if ($('#enrollment_type').val() == 'Enrollment Number') {
                        $('#ennumberhide').show("slow");
                        $('#ensliphide').hide("slow");
                        $('#enslip').prop("required", false);
                        $('#ennumber').prop("required", true);
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



                document.getElementById("myForm").addEventListener("submit", function() {
                    const btn = document.getElementById("save");
                    btn.disabled = true;
                    btn.innerText = "Submitting...";
                });
            </script>
            @endpush