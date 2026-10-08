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
                            <form action="{{ url('/smartcardotp_update') }}" id="myForm" method="POST"
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
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label fw-bold text-dark fs-5">
                                            விண்ணப்ப வகை (Application Type) <span class="text-danger">*</span>
                                        </label>
                                        <div class="d-flex gap-4 p-3 rounded-3 bg-light border"
                                            style="border-color: #cbd5e1 !important;">
                                            <div class="form-check form-check-inline">
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    class="form-check-input" type="radio" name="application_type"
                                                    id="type_addition" value="சேர்க்கை"
                                                    {{ isset($services) && $services->application_type == 'சேர்க்கை' ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label fw-bold cursor-pointer" for="type_addition">
                                                    <i class="bi bi-person-plus-fill text-success me-1"></i> பெயர் சேர்க்கை
                                                    (Name Addition)
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                    class="form-check-input" type="radio" name="application_type"
                                                    id="type_removal" value="பெயர் நீக்கம்"
                                                    {{ isset($services) && $services->application_type == 'பெயர் நீக்கம்' ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label fw-bold cursor-pointer" for="type_removal">
                                                    <i class="bi bi-person-dash-fill text-danger me-1"></i> பெயர் நீக்கம்
                                                    (Name Removal)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="relationship" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control"
                                            name="relationship">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship == 'தந்தை') selected @endif value="தந்தை">தந்தை
                                            </option>
                                            <option @if ($services->relationship == 'தாய்') selected @endif value="தாய்">தாய்
                                            </option>
                                            <option @if ($services->relationship == 'மகன்') selected @endif value="மகன்">மகன்
                                            </option>
                                            <option @if ($services->relationship == 'மகள்') selected @endif value="மகள்">மகள்
                                            </option>
                                            <option @if ($services->relationship == 'கணவர்') selected @endif value="கணவர்">கணவர்
                                            </option>
                                            <option @if ($services->relationship == 'மனைவி') selected @endif value="மனைவி">மனைவி
                                            </option>
                                            <option @if ($services->relationship == 'மாமியார்') selected @endif value="மாமியார்">
                                                மாமியார்</option>
                                            <option @if ($services->relationship == 'மாமனார்') selected @endif value="மாமனார்">
                                                மாமனார்</option>
                                            <option @if ($services->relationship == 'மருமகன்') selected @endif value="மருமகன்">
                                                மருமகன்</option>
                                            <option @if ($services->relationship == 'மருமகள்') selected @endif value="மருமகள்">
                                                மருமகள்</option>
                                            <option @if ($services->relationship == 'பேரன்') selected @endif value="பேரன்">பேரன்
                                            </option>
                                            <option @if ($services->relationship == 'பேத்தி') selected @endif value="பேத்தி">
                                                பேத்தி</option>
                                            <option @if ($services->relationship == 'மற்ற உறவுகள்') selected @endif
                                                value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                        </select>

                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="linked_mobile_number" class="form-label">Linked Mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                            value="{{ $services->linked_mobile_number }}" class="form-control"
                                            name="linked_mobile_number" maxlength="10" placeholder="Linked Mobile Number" />
                                    </div> --}}

                                    {{-- Aadhaar Card Section --}}
                                    <!-- <div class="mb-3 col-md-6">
                                        <label class="form-label">Aadhaar Card Front Page</label>
                                        @if ($services->aadhaar_card != '')
                                            <div
                                                class="mb-2 p-2 border rounded bg-light d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-2">
                                                    <i class="bi bi-file-earmark-text text-primary me-1"></i>
                                                    <strong>File:</strong> {{ $services->aadhaar_card }}
                                                </span>
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-sm btn-outline-primary">View / Download</a>
                                            </div>
                                        @endif
                                        @if (Auth::user()->id == $apply_user_id || Auth::user()->id == $services->user_id)
                                            <input @if ($services->aadhaar_card == '' && $services->documents == 'Aadhaar Card') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card"
                                                id="aadhaar_card">
                                        @endif
                                    </div> -->

                                    {{-- Smart Card Section --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Smart Card Online Print</label>
                                        @if ($services->smart_card != '')
                                            <div
                                                class="mb-2 p-2 border rounded bg-light d-flex justify-content-between align-items-center">
                                                <span class="text-truncate me-2">
                                                    <i class="bi bi-file-earmark-text text-primary me-1"></i>
                                                    <strong>File:</strong> {{ $services->smart_card }}
                                                </span>
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                    class="btn btn-sm btn-outline-primary">View / Download</a>
                                            </div>
                                        @endif
                                        @if (Auth::user()->id == $apply_user_id || Auth::user()->id == $services->user_id)
                                            <input @if ($services->smart_card == '' && $services->documents == 'Smart Card') required @endif class="form-control"
                                                type="file" accept=".jpg,.jpeg,.png,.pdf" name="smart_card"
                                                id="smart_card">
                                        @endif
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">No Of Person</label>
                                        <input type="text" class="form-control" value="{{ $services->name_count }}"
                                            readonly>
                                        <input type="hidden" name="name_count" value="{{ $services->name_count }}">
                                    </div>

                                    {{-- Member Names and File Upload Section --}}
                                    @php
                                        $members = [];
                                        if (!empty($services->members)) {
                                            if (is_array($services->members)) {
                                                $members = $services->members;
                                            } else {
                                                $decoded = json_decode($services->members, true);
                                                $members = is_array($decoded)
                                                    ? $decoded
                                                    : explode(',', $services->members);
                                            }
                                        }
                                    @endphp

                                    <div class="row">
                                        @foreach ($members as $key => $member)
                                            @php
                                                // Extract member name and file path if stored as JSON object
                                                $memberName = is_array($member) ? $member['name'] ?? '' : trim($member);
                                                $memberFile = is_array($member)
                                                    ? $member['aadhaar_card_path'] ?? ''
                                                    : '';
                                            @endphp

                                            <div class="col-md-6 mb-4">
                                                <div class="card border p-3 bg-light">
                                                    <h6 class="fw-bold mb-3">Member {{ $key + 1 }} Details</h6>

                                                    {{-- Member Name Input --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Name {{ $key + 1 }}</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" class="form-control"
                                                            name="member_name[{{ $key }}][name]"
                                                            value="{{ $memberName }}">
                                                    </div>

                                                    {{-- Existing File View --}}
                                                    @if (!empty($memberFile))
                                                        <div
                                                            class="mb-2 p-2 border rounded bg-white d-flex justify-content-between align-items-center">
                                                            <span class="text-truncate me-2" style="max-width: 200px;">
                                                                <i class="bi bi-file-earmark-image text-primary me-1"></i>
                                                                <strong>File:</strong> {{ basename($memberFile) }}
                                                            </span>
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/{{ $memberFile }}"
                                                                class="btn btn-sm btn-outline-primary">View / Download</a>
                                                        </div>
                                                        {{-- Keep track of existing file path --}}
                                                        <input type="hidden"
                                                            name="member_name[{{ $key }}][existing_file]"
                                                            value="{{ $memberFile }}">
                                                    @endif

                                                    {{-- File Upload Field (Enabled only if user is authorized) --}}
                                                    @if (Auth::user()->id == $apply_user_id || Auth::user()->id == $services->user_id)
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted">
                                                                {{ !empty($memberFile) ? 'Update Document (Optional)' : 'Upload Document' }}
                                                            </label>
                                                            <input class="form-control" type="file"
                                                                accept="image/jpeg, image/png, application/pdf"
                                                                name="member_file_{{ $key }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    @if (Auth::user()->id != $apply_user_id)
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <select class="form-control" name="status" id="service_status">
                                                <option value="">Select</option>
                                                <option @if ($services->status == 'Pending') selected @endif value="Pending">
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
                                        <button id="save" type="submit"
                                            class="btn btn-primary me-2">Submit</button>
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
            var documents = "{{ $services->documents }}";

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

            if (documents == "Aadhaar Card") {
                $('#aadhaar_cardhide').show("slow");
            } else if (documents == "Smart Card") {
                $('#smart_cardhide').show("slow");
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

        $('#documents').change(function() {
            if ($('#documents').val() == 'Aadhaar Card') {
                $('#aadhaar_cardhide').show("slow");
                $('#smart_cardhide').hide("slow");
                $('#smart_card').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#documents').val() == 'Smart Card') {
                $('#smart_cardhide').show("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#smart_card').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#smart_cardhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#smart_card').prop("required", false);

            }
        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
