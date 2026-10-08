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
                            <form action="{{ url('/dharsan_update') }}" id="myForm" method="POST"
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
                                        }
                                        elseif ($services->retailer_id == 0) {
                                            $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                            $apply_user_id = $services->retailer_id;
                                        }
                                    @endphp
                                   
                                   @if($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186)

                                   <div class="mb-3 col-md-6">
                                   <label for="name" class="form-label">Name</label>
                                   <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text" value="{{ $services->name }}"  class="form-control"
                                   name="name" maxlength="30" placeholder="Name" />
                                   <label for="mobile" class="form-label number">Mobile Number</label>
                                   <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text" maxlength="10" class="form-control" value="{{ $services->mobile }}"
                                   name="mobile" placeholder="Mobile Number" />
                                   <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                                   <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="date" maxlength="10" class="form-control" value="{{ $services->darshan_date }}"
                                   name="darshan_date" />
                                   
                               </div>
                                   <div class="mb-3 col-md-6">
                                       @if (Auth::user()->id != $apply_user_id)
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
                                       @if (Auth::user()->id != $apply_user_id)
                                                   @if ($services->aadhaar_card != '')
                                                       <label>Aadhaar Card(Front & Back)</label>
                                                       <br><a target="_blank"
                                                           href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                           class="btn btn-primary me-2">View</a><br>
                                                   @endif
                                               @else
                                                   <label>Aadhaar Card(Front & Back)</label>
                                                   <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                       type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                                   @if ($services->aadhaar_card != '')
                                                       <a target="_blank"
                                                           href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                   @endif
                                               @endif
                                       <label for="time" class="form-label">நேரம்</label>
                                               <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control"
                                                   name="time">
                                                   <option value="">Select Time</option>
                                                   <option @if ($services->time == '03:00 - 04:00') selected @endif value="03:00 - 04:00">03:00 - 04:00</option>
                                                   <option @if ($services->time == '04:00 - 05:00') selected @endif value="04:00 - 05:00">04:00 - 05:00</option>
                                                   <option @if ($services->time == '05:00 - 06:00') selected @endif value="05:00 - 06:00">05:00 - 06:00</option>
                                                   <option @if ($services->time == '06:00 - 07:00') selected @endif value="06:00 - 07:00">06:00 - 07:00</option>
                                                   <option @if ($services->time == '07:00 - 08:00') selected @endif value="07:00 - 08:00">07:00 - 08:00</option>
                                                   <option @if ($services->time == '08:00 - 09:00') selected @endif value="08:00 - 09:00">08:00 - 09:00</option>
                                                   <option @if ($services->time == '09:00 - 10:00') selected @endif value="09:00 - 10:00">09:00 - 10:00</option>
                                                   <option @if ($services->time == '10:00 - 11:00') selected @endif value="10:00 - 11:00">10:00 - 11:00</option>
                                                   <option @if ($services->time == '11:00 - 12:00') selected @endif value="11:00 - 12:00">11:00 - 12:00</option>
                                                   <option @if ($services->time == '12:00 - 13:00') selected @endif value="12:00 - 13:00">12:00 - 13:00</option>
                                                   <option @if ($services->time == '02:00 - 03:00') selected @endif value="02:00 - 03:00">02:00 - 03:00</option>
                                                   <option @if ($services->time == '16:00 - 17:00') selected @endif value="16:00 - 17:00">16:00 - 17:00</option>
                                                   <option @if ($services->time == '17:00 - 18:00') selected @endif value="17:00 - 18:00">17:00 - 18:00</option>
                                                   <option @if ($services->time == '18:00 - 19:00') selected @endif value="18:00 - 19:00">18:00 - 19:00</option>
                                                   <option @if ($services->time == '19:00 - 20:00') selected @endif value="19:00 - 20:00">19:00 - 20:00</option>
                                                   <option @if ($services->time == '20:00 - 21:00') selected @endif value="20:00 - 21:00">20:00 - 21:00</option>
                                                   <option @if ($services->time == '21:00 - 22:00') selected @endif value="21:00 - 22:00">21:00 - 22:00</option>
                                                   <option @if ($services->time == '22:00 - 23:00') selected @endif value="22:00 - 23:00">22:00 - 23:00</option>
                                                   
                                               </select>
                                      
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
                                                    value="Rejected">Rejected</option>
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
                                            <option @if ($services->lects == 'Text') selected @endif value = "Text">
                                                Text</option>
                                            <option @if ($services->lects == 'File') selected @endif value = "File">
                                                File</option>
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
                                @endif
                            </div>

                                <div class="mt-2 text-center">
                                    @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                    @elseif($services->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                    @else
                                        <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
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

        $('#place_of_birth').change(function(){
        if($('#place_of_birth').val() == 'Hospital') {
            $('#hospitalhide').show("slow"); 
            $('#hospital_name').prop("required", true);  
        }else{
            $('#hospitalhide').hide("slow");
            $('#hospital_name').prop("required", false); 
        } 
    });
    $('#place_of_death').change(function(){
        if($('#place_of_death').val() == 'Hospital') {
            $('#hospital').show("slow"); 
            $('#hospital_name').prop("required", true);  
        }else{
            $('#hospital').hide("slow");
            $('#hospital_name').prop("required", false); 
        } 
    });

    document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
