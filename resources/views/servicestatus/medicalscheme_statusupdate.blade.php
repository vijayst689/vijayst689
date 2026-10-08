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
                            <form action="{{ url('/medicalscheme_update') }}" id="myForm" method="POST"
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

                                    @if ($serviceid == 179)
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_no" class="form-label text-primary">Smartcard
                                                Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->smartcard_no }}" class="form-control"
                                                name="smartcard_no" maxlength="15" placeholder="Smartcard Number" />

                                            <label for="aadhaar_no" class="form-label text-primary">Aadhaar Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->aadhaar_no }}" class="form-control" name="aadhaar_no"
                                                maxlength="15" placeholder="Aadhaar Number" />

                                            <label for="mobile" class="form-label text-primary">Cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                                maxlength="10" placeholder="Cell Mobile" />

                                                 <label for="pin_code" class="form-label text-primary">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->pin_code }}" class="form-control"
                                                name="pin_code" maxlength="6" placeholder="Pin Code" />

                                                 <label class="form-label text-primary">குடும்ப உறுப்பினரின் தந்தை அல்லது கணவர் பெயர்</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                id="relation" name="relation" class="form-control">
                                                <option value="">Select Name</option>
                                                <option @if ($services->relation == 'Father Name') selected @endif
                                                    value="Father Name">தந்தை பெயர்</option>
                                                <option @if ($services->relation == 'Husband Name') selected @endif
                                                    value="Husband Name">கணவர் பெயர்</option>
                                            </select>

                                            <label for="marital_status" class="form-label text-primary">Maritial
                                                Status</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control"
                                                name="marital_status">
                                                <option value="">Select Maritial Status</option>
                                                <option @if ($services->marital_status == 'Single') selected @endif value="Single">
                                                    Single
                                                </option>
                                                <option @if ($services->marital_status == 'Married') selected @endif value="Married">
                                                    Married
                                                </option>
                                                <option @if ($services->marital_status == 'Widower') selected @endif value="Widower">
                                                    Widower
                                                </option>
                                                <option @if ($services->marital_status == 'Divorced') selected @endif value="Divorced">
                                                    Divorced
                                                </option>
                                            </select>

                                           
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->vao_or_income_certificate != '')
                                                    <label for="vao_or_income_certificate"
                                                        class="form-label text-primary">VAO
                                                        Certificate/Income Certificate(1,20,000)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/vao_or_income_certificate/{{ $services->vao_or_income_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label for="vao_or_income_certificate" class="form-label text-primary">VAO
                                                    Certificate/Income Certificate(1,20,000)</label>
                                                <input @if ($services->vao_or_income_certificate == '') required @endif
                                                    class="form-control" type="file" accept="application/pdf"
                                                    name="vao_or_income_certificate">
                                                @if ($services->vao_or_income_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/vao_or_income_certificate/{{ $services->vao_or_income_certificate }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smartcard_onlineprint != '')
                                                    <label for="smartcard_onlineprint"
                                                        class="form-label text-primary">Smart card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label for="smartcard_onlineprint" class="form-label text-primary">Smart
                                                    card</label>
                                                <input @if ($services->smartcard_onlineprint == '') required @endif
                                                    class="form-control" type="file" accept="application/pdf"
                                                    name="smartcard_onlineprint">
                                                @if ($services->smartcard_onlineprint != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card (Front &
                                                        Back)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label for="aadhaar_card" class="form-label">Aadhaar Card (Front &
                                                    Back)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label for="photo" class="form-label text-primary">Live
                                                        Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label for="photo" class="form-label text-primary">Live Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->passportsize_photo != '')
                                                    <label for="passportsize_photo"
                                                        class="form-label text-primary">Passport
                                                        Size
                                                        Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/passportsize_photo/{{ $services->passportsize_photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label for="passportsize_photo" class="form-label text-primary">Passport
                                                    Size
                                                    Photo</label>
                                                <input @if ($services->passportsize_photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg"
                                                    name="passportsize_photo">
                                                @if ($services->passportsize_photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/passportsize_photo/{{ $services->passportsize_photo }}">Download</a><br>
                                                @endif
                                            @endif

                                            <div class="mb-3 col-md-6" id="father_namehide" style="display: none;">
                                                <label for="father_name" class="form-label text-primary">தந்தை
                                                    பெயர்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->father_name }}" class="form-control"
                                                    name="father_name" maxlength="100" placeholder="தந்தை பெயர்" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="husband_namehide" style="display: none;">
                                                <label for="husband_name" class="form-label text-primary">கணவர்
                                                    பெயர்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->husband_name }}" class="form-control"
                                                    name="husband_name" maxlength="100" placeholder="கணவர் பெயர்" />
                                            </div>

                                        </div>
                                    @elseif($serviceid == 180)
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Adhaar link cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Adhaar link cell Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card (Front & Back)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
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
            var member = "{{ $services->member }}";
            var relation = "{{ $services->relation }}";
            // alert(member);

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

            if (relation == "Father Name") {
                $('#father_namehide').show("slow");
            } else if (relation == "Husband Name") {
                $('#husband_namehide').show("slow");
            }

            if (member == "Add 1 Member") {
                $('#aadhaarhide').show("slow");
            } else if (member == "Add 2 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
            } else if (member == "Add 3 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
            } else if (member == "Add 4 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
            } else if (member == "Add 5 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
            } else if (member == "Add 6 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar6hide').show("slow");
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

        $('#member').change(function() {
            if ($('#member').val() == 'Add 1 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);

            } else if ($('#member').val() == 'Add 2 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);

            } else if ($('#member').val() == 'Add 3 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);

            } else if ($('#member').val() == 'Add 4 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);

            } else if ($('#member').val() == 'Add 5 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);

            } else if ($('#member').val() == 'Add 6 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar6hide').show("slow");
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);
                $('#aadhaar6').prop("required", true);

            } else {
                $('#aadhaarhide').hide("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar').prop("required", false);
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);

            }
        });

        $('#relation').change(function() {

            if ($('#relation').val() == 'Father Name') {
                $('#father_namehide').show("slow");
                $('#husband_namehide').hide("slow");
                $('#husband_name').prop("required", false);
                $('#father_name').prop("required", true);

            } else if ($('#relation').val() == 'Husband Name') {
                $('#husband_namehide').show("slow");
                $('#father_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", true);

            } else {
                $('#father_namehide').hide("slow");
                $('#husband_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", false);

            }
        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
