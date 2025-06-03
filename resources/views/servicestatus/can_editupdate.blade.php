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
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <form action="{{ url('/caneditupdate') }}" id="formAccountSettings" method="POST"
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

                                                                     @if ($serviceid == 208)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_number" class="form-label">Can Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->can_number }}" class="form-control" name="can_number"
                                                maxlength="30" placeholder="Can Number" />
                                                <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->name_tamil }}" class="form-control" name="name_tamil"
                                                maxlength="100" placeholder="பெயர் தமிழில்" />

                                           @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->name_english }}" class="form-control"
                                                name="name_english" maxlength="100" placeholder="Name In English" />
                                             <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->mobile }}" class="form-control" name="mobile"
                                                maxlength="10" placeholder="Mobile Number" />
                                        </div>
                                    @elseif ($serviceid == 209)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_number" class="form-label">Can Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->can_number }}" class="form-control"
                                                name="can_number" maxlength="30" placeholder="Can Number" />
                                                 <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_tamil }}" class="form-control"
                                                name="name_tamil" maxlength="100" placeholder="பெயர் தமிழில்" />

                                                @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                           
                                            <label for="name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_english }}"
                                                class="form-control" name="name_english" maxlength="100"
                                                placeholder="Name In English" />
                                            <label for="dob" class="form-label">Date Of Birth [05041997]</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="8" placeholder="ddmmyyyy" />
                                            
                                        </div>
                                    @elseif ($serviceid == 210)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_number" class="form-label">Can Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->can_number }}" class="form-control"
                                                name="can_number" maxlength="30" placeholder="Can Number" />
                                                 <label for="dob" class="form-label">Date Of Birth [05041997]</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="8" placeholder="ddmmyyyy" />
                                            
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}" class="form-control"
                                                name="mobile" maxlength="10" placeholder="Mobile Number" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 211)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_number" class="form-label">Can Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->can_number }}" class="form-control"
                                                name="can_number" maxlength="30" placeholder="Can Number" />
                                                 <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_tamil }}" class="form-control"
                                                name="name_tamil" maxlength="100" placeholder="பெயர் தமிழில்" />
                                            <label for="dob" class="form-label">Date Of Birth [05041997]</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="8" placeholder="ddmmyyyy" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                           
                                            <label for="name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_english }}"
                                                class="form-control" name="name_english" maxlength="100"
                                                placeholder="Name In English" />
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}" class="form-control"
                                                name="mobile" maxlength="10" placeholder="Mobile Number" />
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 226)
                                      <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $services->can_number }}" class="form-control"
                                            name="can_number" maxlength="30" placeholder="Can Number" />

                                        <label class="form-label">Documents</label>
                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="document"
                                        name="document" class="form-control">
                                        <option value="">Select Documents</option>
                                        <option @if ($services->document == 'Yes') selected @endif value="Yes">Yes</option>
                                        <option @if ($services->document == 'No') selected @endif value="No">No</option>
                                    </select>
                                    </div> 
                                     <div class="mb-3 col-md-6">
                                         @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                    <div class="" id="save_application_numberhide" style="display: none;">
                                        <label for="save_application_number" class="form-label">Application Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->save_application_number }}" class="form-control" name="save_application_number"
                                            maxlength="60" placeholder="Application Number" />
                                     </div>

                                     <div class="" id="save_certificatehide" style="display: none;">
                                        <label for="save_certificate" class="form-label">Certificate Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->save_certificate }}" class="form-control number" name="save_certificate"
                                            maxlength="60" placeholder="Certificate Name" />
                                     </div>
                                     </div>
                                    @elseif ($serviceid == 227)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $services->can_number }}" class="form-control"
                                            name="can_number" maxlength="30" placeholder="Can Number" />
                                        <label for="application_name" class="form-label">Application Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $services->application_name }}" class="form-control"
                                            name="application_name" maxlength="30" placeholder="Application Name" />
                                    </div>      
                                    <div class="mb-3 col-md-6">
                                        @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        <label for="certificate_name" class="form-label">Certificate Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                            type="text" value="{{ $services->certificate_name }}" class="form-control"
                                            name="certificate_name" maxlength="30" placeholder="Certificate Name" />
                                    </div>      
                                    @endif

                                    @if (Auth::user()->id != $apply_user_id)
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
                                            @if ($services->status != 'Approved')
                                                <option @if ($services->status == 'Rejected') selected @endif
                                                    value="Rejected">
                                                    Rejected</option>
                                            @endif
                                            <option @if ($services->status == 'Approved') selected @endif
                                                value="Approved">Approved</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input value="{{ $services->remarks }}" class="form-control" type="text"
                                            name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                    </div>
                                  
                                   
                                    <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                        <label for="application_no" class="form-label">Application No</label>
                                        <input value="{{ $services->application_no }}" class="form-control"
                                            type="text" maxlength="20" name="application_no"
                                            id="application_no" />
                                    </div>
                                   
                                    <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                        <label for="application" class="form-label">Application</label>
                                        <input value="{{ $services->application }}" class="form-control"
                                            type="text" maxlength="150" name="application" id="application" />
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
        var dist_id = "{{ $services->dist_id }}";
        var taluk_id = "{{ $services->taluk_id }}";
        var document = "{{ $services->document }}";

            gettaluk(dist_id);
            getpanchayath(taluk_id);

       if (status == "Resubmit") {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
            } else if (status == "Processing") {
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
            } else if (status == "Approved") {
                $('#applicationhide').show("slow");
                $('#application').prop("required", true);
            }

        if (document == "Yes") {
            $('#save_application_numberhide').show("slow");
            $('#save_certificatehide').hide("slow");
        } else if (document == "No") {
            $('#save_certificatehide').show("slow");
            $('#save_application_numberhide').hide("slow");
        } 

          $('#document').change(function() {
            if ($('#document').val() == 'Yes') {
                $('#save_application_numberhide').show("slow");
                $('#save_certificatehide').hide("slow");
                $('#save_certificate').prop("required", false);
                $('#save_application_number').prop("required", true);

            } else if ($('#document').val() == 'No') {
                $('#save_certificatehide').show("slow");
                $('#save_application_numberhide').hide("slow");
                $('#save_application_number').prop("required", false);
                $('#save_certificate').prop("required", true);

            } else {
                $('#save_certificatehide').hide("slow");
                $('#save_application_numberhide').hide("slow");
                $('#save_application_number').prop("required", false);
                $('#save_certificate').prop("required", false);
            }
        });
    });

        $('#service_status').change(function() {
            if ($('#service_status').val() == 'Resubmit') {
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#applicationhide').hide("slow");
                $('#application').prop("required", false);
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
            } else if ($('#service_status').val() == 'Processing') {
                // $('#acknowledgementhide').show("slow");
                // $('#acknowledgement').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#applicationhide').hide("slow");
                $('#application').prop("required", false);
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
            } else if ($('#service_status').val() == 'Approved') {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationhide').show("slow");
                $('#application').prop("required", true);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
            } else {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationhide').hide("slow");
                $('#application').prop("required", false);
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
