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
                                <h5 class="card-title">{{ $servicename }}</h5>
                                <form action="{{ url('/voterid_update') }}" id="myForm" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach ($services as $key => $ser)
                                    <div class="row">
                                        <input type="hidden" name="applied_serviceid" value="{{ $ser->id }}">
                                        <input type="hidden" name="user_id" value="{{ $ser->user_id }}">
                                        <input type="hidden" name="retailer_id" value="{{ $ser->retailer_id }}">
                                        <input type="hidden" name="distributor_id"
                                            value="{{ $ser->distributor_id }}">
                                        <input type="hidden" name="serviceid" value="{{ $ser->service_id }}">
                                        @php
                                        $apply_user_id = 0;
                                        if ($ser->distributor_id == 0 && $ser->retailer_id == 0) {
                                        $apply_user_id = $ser->user_id;
                                        } elseif ($ser->retailer_id == 0) {
                                        $apply_user_id = $ser->distributor_id;
                                        } elseif ($ser->distributor_id == 0) {
                                        $apply_user_id = $ser->retailer_id;
                                        }
                                        @endphp


                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $ser->name }}" class="form-control"
                                            name="name" maxlength="30" placeholder="Name" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $ser->mobile }}"
                                            class="form-control number" name="mobile" maxlength="10"
                                            placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            @if (Auth::user()->id != $apply_user_id)
                                            @if ($ser->aadhaar_card != '')
                                            <label>Aadhar Card (Front & Back)</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $ser->aadhaar_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Aadhar Card (Front & Back)</label>
                                            <input @if ($ser->aadhaar_card == '') required @endif
                                            class="form-control" type="file"
                                            accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($ser->aadhaar_card != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $ser->aadhaar_card }}">Download</a><br>
                                            @endif
                                            @endif

                                        </div>
                                        <div class="mb-3 col-md-6">

                                            @if (Auth::user()->id != $apply_user_id)
                                            @if ($ser->voter_id != '')
                                            <label>Voter Id</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/voter_id/{{ $ser->voter_id }}"
                                                class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>Voter Id</label>
                                            <input @if ($ser->voter_id == '') required @endif
                                            class="form-control" type="file"
                                            accept="image/jpeg, image/png" name="voter_id">
                                            @if ($ser->voter_id != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/voter_id/{{ $ser->voter_id }}">Download</a><br>
                                            @endif
                                            @endif

                                        </div>
                                        <div class="row">
                                            <table id="pricetable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>VOTER ID CORRECTION</th>
                                                        <th>CORRECTION DATA</th>
                                                        <th>CORRECTION DOCUMENTS</th>
                                                        <th>DOCUMENTS</th>
                                                        <th><a class="btn btn-sm btn-success"
                                                                onclick="addnewrow()"><i
                                                                    class='mdi mdi-plus-circle-outline'></i></a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ser->details as $details)
                                                    <input type="hidden" name="details_id[]"
                                                        value="{{ $details->id }}">
                                                    <tr>
                                                        <td> <select
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                required name="voterid_correction[]"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'NAME') selected @endif
                                                                    value="NAME">NAME</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'GENDER') selected @endif
                                                                    value="GENDER">GENDER</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'DOB/AGE') selected @endif
                                                                    value="DOB/AGE">DOB/AGE</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'RELATION TYPE') selected @endif
                                                                    value="RELATION TYPE">RELATION TYPE
                                                                </option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'RELATIVE NAME') selected @endif
                                                                    value="RELATIVE NAME">RELATIVE NAME
                                                                </option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'ADDRESS') selected @endif
                                                                    value="ADDRESS">ADDRESS</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'MOBILE NO') selected @endif
                                                                    value="MOBILE NO">MOBILE NO</option>
                                                                <option
                                                                    @if ($details->voterid_correction == 'PHOTO') selected @endif
                                                                    value="PHOTO">PHOTO</option>
                                                            </select></td>


                                                        <td><input
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            required class="form-control" type="text"
                                                            value="{{ $details->new_data }}"
                                                            name="new_data[]" maxlength="70"></td>
                                                        <td><select
                                                                @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                required name="correction_documents[]"
                                                                class="form-control correction_docs">
                                                                <option value="">Select</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Name Correction') selected @endif
                                                                    value="Name Correction">Name Correction
                                                                </option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Gender Correction') selected @endif
                                                                    value="Gender Correction">Gender Correction
                                                                </option>
                                                                <option
                                                                    @if ($details->correction_documents == 'DOB/AGE Correction') selected @endif
                                                                    value="DOB/AGE Correction">DOB/AGE
                                                                    Correction</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Relation Type Correction') selected @endif
                                                                    value="Relation Type Correction">Relation
                                                                    Type Correction</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Relative Name Correction') selected @endif
                                                                    value="Relative Name Correction">Relative
                                                                    Name Correction</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Address Correction') selected @endif
                                                                    value="Address Correction">Address
                                                                    Correction</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Mobile No Correction') selected @endif
                                                                    value="Mobile No Correction">Mobile No
                                                                    Correction</option>
                                                                <option
                                                                    @if ($details->correction_documents == 'Photo Correction') selected @endif
                                                                    value="Photo Correction">Photo Correction
                                                                </option>
                                                            </select></td>
                                                        <td>
                                                            <P class='changename'></P>
                                                            @if (Auth::user()->id != $apply_user_id)
                                                            <a target="_blank"
                                                                class="btn btn-primary btn-sm"
                                                                href="{{ URL::to('/') }}/upload/services/voter_id/{{ $details->doc }}">View</a>
                                                            @else
                                                            <input
                                                                @if ($details->doc == '') required @endif
                                                            class="form-control" type="file"
                                                            name="doc[]"
                                                            accept="image/jpeg, image/png">
                                                            @endif
                                                        </td>
                                                        <td><a onClick='removerow()'
                                                                class='btn btn-sm btn-danger btnDelete'><i
                                                                    class='mdi mdi-trash-can-outline'></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if (Auth::user()->id != $apply_user_id)
                                    <div class="mb-3 col-md-6">
                                        <label for="service_name" class="form-label">Service
                                            Status</label>
                                        <select class="form-control" name="status" id="service_status">
                                            <option value="">Select</option>
                                            <option @if ($ser->status == 'Pending') selected @endif
                                                value="Pending">Pending</option>
                                            <option @if ($ser->status == 'Resubmit') selected @endif
                                                value="Resubmit">Resubmit</option>
                                            <option @if ($ser->status == 'Processing') selected @endif
                                                value="Processing">Processing</option>
                                            @if ($ser->status != 'Approved')
                                            <option
                                                @if ($ser->status == 'Rejected') selected @endif
                                                value="Rejected">
                                                Rejected</option>
                                            @endif
                                            <option @if ($ser->status == 'Approved') selected @endif
                                                value="Approved">Approved</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input value="{{ $ser->remarks }}" class="form-control"
                                            type="text" name="remarks" maxlength="100" id="remarks"
                                            placeholder="Remarks" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                        <label for="select" class="form-label">Select</label>
                                        <select class="form-control" name="selects" id="select">
                                            <option>select</option>
                                            <option @if ($ser->selects == 'Text') selected @endif
                                                value = "Text">Text</option>
                                            <option @if ($ser->selects == 'File') selected @endif
                                                value = "File">File</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="acknowledgementhide"
                                        style="display :none;">
                                        <label for="acknowledgement"
                                            class="form-label">Acknowledgement</label>
                                        <input class="form-control" type="file" name="acknowledgement"
                                            id="acknowledgement" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationnohide"
                                        style="display :none;">
                                        <label for="application_no" class="form-label">Application
                                            No</label>
                                        <input value="{{ $ser->application_no }}" class="form-control"
                                            type="text" maxlength="20" name="application_no"
                                            id="application_no" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                        <label for="selects" class="form-label">Select</label>
                                        <select class="form-control" name="lects" id="selects">
                                            <option>select</option>
                                            <option @if ($ser->lects == 'Text') selected @endif
                                                value = "Text">Text</option>
                                            <option @if ($ser->lects == 'File') selected @endif
                                                value = "File">File</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationhide"
                                        style="display :none;">
                                        <label for="application" class="form-label">Application</label>
                                        <input value="{{ $ser->application }}" class="form-control"
                                            type="text" maxlength="150" name="application"
                                            id="application" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                        <label for="certificate" class="form-label">Certificate</label>
                                        <input class="form-control" type="file" name="certificate"
                                            id="certificate" />
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service
                                                Status</label>
                                            <input disabled value="{{ $ser->status }}"
                                                class="form-control" type="text" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $ser->remarks }}</textarea>
                                        </div>

                                    </div>
                                    @endif
                            </div>

                            <div class="mt-2 text-center">
                                @if ($ser->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                <button type="submit" disabled
                                    class="btn btn-primary me-2">Resubmit</button>
                                @elseif($ser->status == 'Approved')
                                <button type="button" disabled
                                    class="btn btn-primary me-2">Completed</button>
                                @else
                                <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
                                @endif
                            </div>
                            <input type="hidden" id="serstatus" value="{{ $ser->status }}">
                            <input type="hidden" id="seracknowledgement" value="{{ $ser->acknowledgement }}">
                            @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @endsection

    @push('page_scripts')
    <script>
        $(function() {
            var status = "{{ $ser->status }}";
            var acknowledgement = "{{ $ser->acknowledgement }}";
            var certificate = "{{ $ser->certificate }}";
            var selects = "{{ $ser->selects }}";
            var lects = "{{ $ser->lects }}";

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

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
    @endpush