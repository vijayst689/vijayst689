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
                             <form action="{{ url('/pstm_update') }}" id="formAccountSettings" method="POST"
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

                                    <div class="row">
                                        <h4 class="text-center"> Individual Details </h4>
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Applicant Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->name }}" class="form-control" name="name"
                                                maxlength="30" placeholder="Applicant Name" />

                                            <label for="name" class="form-label">Applicant Name in Tamil</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->name_tamil }}" class="form-control" name="name_tamil"
                                                maxlength="100" placeholder="Applicant Name in Tamil" />

                                            <label for="dob" class="form-label">Date of Birth(As per School
                                                Records)</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="date"
                                                maxlength="10" class="form-control" value="{{ $services->dob }}"
                                                name="dob" placeholder="DOB" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="father_name" class="form-label">Father Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->father_name }}" class="form-control"
                                                name="father_name" maxlength="100" placeholder="Father Name" />
                                            <label for="name" class="form-label">Father Name in Tamil</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->father_name_tamil }}" class="form-control"
                                                name="father_name_tamil" maxlength="100"
                                                placeholder="Father Name in Tamil" />
                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                maxlength="10" class="form-control" value="{{ $services->mobile }}"
                                                name="mobile" placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="mother_name" class="form-label">Mother Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->mother_name }}" class="form-control"
                                                name="mother_name" maxlength="100" placeholder="Mother Name" />
                                            <label for="mother_name" class="form-label">Mother Name in Tamil</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->mother_name_tamil }}"
                                                class="form-control" name="mother_name_tamil" maxlength="100"
                                                placeholder="Mother Name in Tamil" />
                                            <label for="" class="form-label">EMIS ID</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control"
                                                value="{{ $services->emis_id }}" name="emis_id" placeholder="EMIS ID" />

                                        </div>
                                    </div>
                                    
                                        <div class="row">
                                            <h4 class="text-center"> School Details </h4>
                                        <div class="mb-3 col-md-4">
                                        <label for="academic_yr_from" class="form-label">Academic Year From</label>
                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control"
                                            name="academic_yr_from">
                                            <option value="">Select</option>
                                            @php
                                            $startYear = 1970;
                                            $currentYear = date('Y');
                                            $endYear = $currentYear;
                                            $currentdata = $services->academic_yr_from;
                                           
                                            for ($year = $startYear; $year <= $endYear; $year++) {
                                                $nextYear = $year + 1;
                                                $range = $year . ' - ' . $nextYear;
                                                //echo $currentdata;die;
                                                $selected = ($currentdata == $range) ? 'selected' : '';
                                                echo "<option value=\"$year - $nextYear\" $selected>{$year}-{$nextYear}</option>";
                                            }
                                            @endphp
                                        </select>
                                            <label for="class_to" class="form-label">Class To</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                name="class_to" id="class_to" class="form-control">
                                                <option value="">Select</option>
                                                <option @if ($services->class_to == 'I') selected @endif value="I">
                                                    I</option>
                                                <option @if ($services->class_to == 'II') selected @endif value="II">
                                                    II</option>
                                                <option @if ($services->class_to == 'III') selected @endif value="III">
                                                    III</option>
                                                <option @if ($services->class_to == 'IV') selected @endif value="IV">
                                                    IV</option>
                                                <option @if ($services->class_to == 'V') selected @endif value="V">
                                                    V</option>
                                                <option @if ($services->class_to == 'VI') selected @endif value="VI">
                                                    VI</option>
                                                <option @if ($services->class_to == 'VII') selected @endif value="VII">
                                                    VII</option>
                                                <option @if ($services->class_to == 'VIII') selected @endif value="VIII">
                                                    VIII</option>
                                                <option @if ($services->class_to == 'IX') selected @endif value="IX">
                                                    IX</option>
                                                <option @if ($services->class_to == 'X') selected @endif value="X">
                                                    X</option>
                                                <option @if ($services->class_to == 'XI') selected @endif value="XI">
                                                    XI</option>
                                                <option @if ($services->class_to == 'XII') selected @endif value="XII">
                                                    XII</option>

                                            </select>
                                            <label for="school_type" class="form-label">School Type</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control"
                                                name="school_type">
                                                <option value="">Select</option>
                                                <option @if ($services->school_type == 'Government') selected @endif value="Government">Government
                                                </option>
                                                <option @if ($services->school_type == 'Fully Aided') selected @endif value="Fully Aided">Fully Aided
                                                </option>
                                                <option @if ($services->school_type == 'Partially Aided') selected @endif value="Partially Aided">Partially Aided
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="academic_yr_to" class="form-label">Academic Year To</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control"
                                                name="academic_yr_to">
                                                <option value="">Select</option>
                                                @php
                                                $startYear = 1970;
                                                $currentYear = date('Y');
                                                $endYear = $currentYear;
                                                $currentdata = $services->academic_yr_to;
                                                for ($year = $startYear; $year <= $endYear; $year++) {
                                                    $nextYear = $year + 1;
                                                    $range = $year . ' - ' . $nextYear;
                                               
                                                $selected = ($currentdata == $range) ? 'selected' : '';
                                                echo "<option value=\"$year - $nextYear\" $selected>{$year}-{$nextYear}</option>";
                                                }
                                                @endphp
                                            </select>
                                            <label for="dist_id" class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="school_name" class="form-label">School Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->school_name }}" class="form-control"
                                                name="school_name" maxlength="500" placeholder="Father Name" />
                                        </div>  
                                            <div class="mb-3 col-md-4"> 
                                            <label for="class_from" class="form-label">Class From</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                name="class_from" id="class_from" class="form-control">
                                                <option value="">Select</option>
                                                <option @if ($services->class_from == 'I') selected @endif value="I">
                                                    I</option>
                                                <option @if ($services->class_from == 'II') selected @endif value="II">
                                                    II</option>
                                                <option @if ($services->class_from == 'III') selected @endif value="III">
                                                    III</option>
                                                <option @if ($services->class_from == 'IV') selected @endif value="IV">
                                                    IV</option>
                                                <option @if ($services->class_from == 'V') selected @endif value="V">
                                                    V</option>
                                                <option @if ($services->class_from == 'VI') selected @endif value="VI">
                                                    VI</option>
                                                <option @if ($services->class_from == 'VII') selected @endif value="VII">
                                                    VII</option>
                                                <option @if ($services->class_from == 'VIII') selected @endif value="VIII">
                                                    VIII</option>
                                                <option @if ($services->class_from == 'IX') selected @endif value="IX">
                                                    IX</option>
                                                <option @if ($services->class_from == 'X') selected @endif value="X">
                                                    X</option>
                                                <option @if ($services->class_from == 'XI') selected @endif value="XI">
                                                    XI</option>
                                                <option @if ($services->class_from == 'XII') selected @endif value="XII">
                                                    XII</option>

                                                </select>
                                            <label for="block" class="form-label">Block</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->block }}" class="form-control"
                                                name="block" maxlength="30" placeholder="Block" />


                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->tc != '')
                                                    <label>Upload copy of TC</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tc/{{ $services->tc }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Upload copy of TC</label>
                                                <input @if ($services->tc == '') required @endif
                                                    class="form-control" type="file" name="tc">
                                                @if ($services->tc != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tc/{{ $services->tc }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
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
                                                @if ($services->status != 'Approved')
                                            <option @if ($services->status == 'Rejected') selected @endif value="Rejected">
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
                                    <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                        <label for="select" class="form-label">Select</label>
                                        <select class="form-control" name="selects" id="select">
                                            <option>select</option>
                                            <option @if ($services->selects == 'Text') selected @endif
                                                value = "Text">Text</option>
                                            <option @if ($services->selects == 'File') selected @endif
                                                value = "File">File</option>
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
                                                value = "Text">Text</option>
                                            <option @if ($services->lects == 'File') selected @endif
                                                value = "File">File</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                        <label for="application" class="form-label">Application</label>
                                        <input value="{{ $services->application }}" class="form-control"
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
    </main>
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
        if(lects == "Text"){
            $('#applicationhide').show("slow");
        }
        if(lects == "File"){
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
                $('#selects').prop("required", false);
                $('#selectshide').hide("slow");
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

        $('#selects').change(function(){
            if($('#selects').val() == 'Text') {
                $('#applicationhide').show("slow");
                $('#application').prop("required", true); 
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
            }else if($('#selects').val() == 'File'){
                $('#certhide').show("slow");
                $('#certificate').prop("required", false);
                $('#applicationhide').hide("slow"); 
                $('#application').prop("required", false);
            }else{
                $('#applicationhide').hide("slow");
                $('#application').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
            }  
        });

</script>
@endpush