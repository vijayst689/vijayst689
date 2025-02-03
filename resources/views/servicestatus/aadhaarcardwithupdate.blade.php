@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-lg flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>{{ $servicename }}</h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('success') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('error') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('/aadhaarcard_without_update') }}" id="formAccountSettings"
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
                                        }
                                        elseif ($services->retailer_id == 0) {
                                            $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                            $apply_user_id = $services->retailer_id;
                                        }
                                    @endphp

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Applicant Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->name }}" class="form-control" name="name"
                                            maxlength="30" placeholder="Name" />

                                        <label for="relationship" class="form-label">Relationship</label>
                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control"
                                            name="relationship">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship == 'Father') selected @endif value="Father">Father
                                            </option>
                                            <option @if ($services->relationship == 'Mother') selected @endif value="Mother">Mother
                                            </option>
                                            <option @if ($services->relationship == 'Husband') selected @endif value="Husband">
                                                Husband</option>
                                            <option @if ($services->relationship == 'Gaurdian') selected @endif value="Gaurdian">
                                                Gaurdian</option>
                                        </select>

                                        <label for="name_english" class="form-label">Name In English</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->name_english }}" class="form-control" name="name_english"
                                            maxlength="30" placeholder="Name English" />

                                        <label for="name_tamil" class="form-label">தமிழில் பெயர்</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->name_tamil }}" class="form-control" name="name_tamil"
                                            maxlength="30" placeholder="தமிழில் பெயர்" />

                                        <label for="address_english" class="form-label">Address In English</label>
                                        <textarea @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->address_english }}" class="form-control" name="address_english" maxlength="200"
                                            placeholder="address_english">{{ $services->address_english }}</textarea>
                                    </div>
                                    <div class="mb-3 col-md-6">

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
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif
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
                                                    href="{{ URL::to('/') }}/upload/services/signature/{{ $services->smart_card }}">Download</a><br>
                                            @endif
                                        @endif
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                            maxlength="10" placeholder="Mobile">

                                        <label for="address_tamil" class="form-label">முகவரி தமிழில்</label>
                                        <textarea @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->address_tamil }}" class="form-control" name="address_tamil" maxlength="200"
                                            placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
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
                                                    <option @if ($services->status == 'Approved') selected @endif
                                                        value="Approved">Approved</option>
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
                                                    <option @if ($services->selects == 'Text') selected @endif value = "Text">Text</option>
                                                    <option @if ($services->selects == 'File') selected @endif value = "File">File</option>
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
            <div class="content-backdrop fade"></div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var selects = "{{ $services->selects }}";
            
            if (status == "Resubmit") {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
            } else if (status == "Processing") {
            if(selects == "Text"){
                $('#applicationnohide').show("slow");
            }
            if(selects == "File"){
                $('#acknowledgementhide').show("slow");
                if (acknowledgement == "") {
                    $('#acknowledgement').prop("required", true);
                }
            }
                $('#selecthide').show("slow");
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
                    $('#select').prop("required", false);
                    $('#selecthide').hide("slow");
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
                } else if ($('#service_status').val() == 'Approved') {
                    $('#remarkshide').hide("slow");
                    $('#remarks').prop("required", false);
                    $('#acknowledgementhide').hide("slow");
                    $('#acknowledgement').prop("required", false);
                    $('#certhide').show("slow");
                    $('#certificate').prop("required", true);
                    $('#applicationnohide').hide("slow");
                    $('#application_no').prop("required", false);
                    $('#select').prop("required", false);
                    $('#selecthide').hide("slow");
                } else {
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
                }
            });

            $('#select').change(function(){
                if($('#select').val() == 'Text') {
                    $('#applicationnohide').show("slow");
                    $('#application_no').prop("required", true); 
                    $('#acknowledgementhide').hide("slow");
                    $('#acknowledgement').prop("required", false);
                }else if($('#select').val() == 'File'){
                    $('#acknowledgementhide').show("slow");
                    $('#acknowledgement').prop("required", false);
                    $('#applicationnohide').hide("slow"); 
                    $('#application_no').prop("required", false);
                }else{
                    $('#applicationnohide').hide("slow");
                    $('#application_no').prop("required", false);
                    $('#acknowledgementhide').hide("slow");
                    $('#acknowledgement').prop("required", false);
                }  
            });
    </script>
@endpush
