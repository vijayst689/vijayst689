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
                            <form action="{{ url('/nalavariyam_update') }}" id="formAccountSettings"
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
                                    if ($services->retailer_id == 0) {
                                        $apply_user_id = $services->distributor_id;
                                    } elseif ($services->distributor_id == 0) {
                                        $apply_user_id = $services->retailer_id;
                                    }
                                @endphp

                               @if ($serviceid == 95)
                                <div class="mb-3 col-md-6">
                                    <label for="register_no" class="form-label">Register Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->register_no }}" class="form-control" name="register_no"
                                        maxlength="20" placeholder="Register Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->aadhaar_no }}" class="form-control" name="aadhaar_no"
                                        maxlength="12" placeholder="Adhaar Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label">Cell Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                        maxlength="10" placeholder="Cell Number" />
                                </div>

                                @elseif ($serviceid == 96)
                                    <div class="mb-3 col-md-6">
                                        <label for="register_no" class="form-label">Register Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->register_no }}" class="form-control" name="register_no"
                                        maxlength="20" placeholder="Register Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->aadhaar_no }}" class="form-control" name="aadhaar_no"
                                        maxlength="13" placeholder="Adhaar Number" />
                                </div>
                                @elseif ($serviceid == 97)
                                <div class="mb-3 col-md-6">
                                    <label for="register_no" class="form-label">Register Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->register_no }}" class="form-control" name="register_no"
                                        maxlength="20" placeholder="Register Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label">Cell Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                        maxlength="10" placeholder="Cell Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="dob" class="form-label">DOB</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="date"
                                        value="{{ $services->dob }}" class="form-control" name="dob"
                                        maxlength="10" placeholder="DOB" />
                                </div>
                                @elseif ($serviceid == 98)
                                <div class="mb-3 col-md-6">
                                    <label for="register_no" class="form-label">Register Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->register_no }}" class="form-control" name="register_no"
                                        maxlength="20" placeholder="Register Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label">Cell Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                        maxlength="10" placeholder="Cell Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                    @if ($services->photo != '')
                                        <label>Photo</label>
                                        <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                            class="btn btn-primary me-2">View</a><br>
                                    @endif
                                @else
                                    <label>Photo</label>
                                    <input @if ($services->photo == '') required @endif class="form-control"
                                        type="file" accept="image/jpeg, image/png" name="photo">
                                    @if ($services->photo != '')
                                        <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                    @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->signature != '')
                                    <label>Signature</label>
                                    <br><a target="_blank"
                                        href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}"
                                        class="btn btn-primary me-2">View</a><br>
                                @endif
                            @else
                                <label>Signature</label>
                                <input @if ($services->signature == '') required @endif class="form-control"
                                    type="file" accept="image/jpeg, image/png" name="signature">
                                @if ($services->signature != '')
                                    <a target="_blank"
                                        href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}">Download</a><br>
                                @endif
                            @endif
                            </div>

                                @endif

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
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";

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
    </script>
@endpush
