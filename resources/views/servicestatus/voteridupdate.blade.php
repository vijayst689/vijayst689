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
                            <form action="{{ url('/voterid_update') }}" id="formAccountSettings" method="POST"
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

                                    @if ($serviceid == 113)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-3 col-md-4">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                        id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                                value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="constituent_assembly" class="form-label">Constituent
                                                        Assembly</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->constituent_assembly }}"
                                                        class="form-control" name="constituent_assembly" maxlength="100"
                                                        placeholder="Constituent Assembly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_english" class="form-label">Name in English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->name_in_english }}" class="form-control"
                                                name="name_in_english" maxlength="100" placeholder="Name in English" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label>Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif

                                            <label for="door_no" class="form-label">Door No</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->door_no }}" class="form-control"
                                                name="door_no" maxlength="30" placeholder="Door No" />

                                            <label for="street_name_english" class="form-label">Street Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->street_name_english }}"
                                                class="form-control" name="street_name_english" maxlength="100"
                                                placeholder="Street Name" />

                                            <label for="postal_area_english" class="form-label">Postal Area</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->postal_area_english }}"
                                                class="form-control" name="postal_area_english" maxlength="100"
                                                placeholder="Postal Area" />

                                            <label for="voterid_no" class="form-label">குடும்ப உறுப்பினர்
                                                வாக்காளர் அடையாள அட்டை எண்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->voterid_no }}" class="form-control"
                                                name="voterid_no" maxlength="10" placeholder="அடையாள அட்டை எண்" />

                                            <label for="mobile" class="form-label">வாக்காளர் அட்டை பதிவு
                                                செய்ய வாடிக்கையாளர்களுக்கு
                                                OTP வரும் அதனை கேட்டால் தகவல் தரும்படி வாடிக்கையாளரிடம்
                                                தெரிவிக்கவும்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_tamil" class="form-label">Name in Tamil</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_in_tamil }}"
                                                class="form-control" name="name_in_tamil" maxlength="100"
                                                placeholder="Name in English" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif

                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->pin_code }}" class="form-control"
                                                name="pin_code" maxlength="10" placeholder="Pin Code" />

                                            <label for="street_name_tamil" class="form-label">தெரு பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->street_name_tamil }}"
                                                class="form-control" name="street_name_tamil" maxlength="100"
                                                placeholder="தெரு பெயர்" />

                                            <label for="postal_area_tamil" class="form-label">அஞ்சல் பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->postal_area_tamil }}"
                                                class="form-control" name="postal_area_tamil" maxlength="100"
                                                placeholder="அஞ்சல் பெயர்" />

                                            <label for="relationship" class="form-label">Relationship</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'Father') selected @endif value="Father">
                                                    Father.
                                                </option>
                                                <option @if ($services->relationship == 'Mother') selected @endif value="Mother">
                                                    Mother.
                                                </option>
                                                <option @if ($services->relationship == 'Husband') selected @endif
                                                    value="Husband">Husband.
                                                </option>
                                                <option @if ($services->relationship == 'Wife') selected @endif value="Wife">
                                                    Wife.
                                                </option>
                                            </select>
                                        </div>
                                        {{-- @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->voter_id != '')
                                                    <label>Relative Voter Id</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Relative Voter Id</label>
                                                <input @if ($services->voter_id == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="voter_id">
                                                @if ($services->voter_id != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}">Download</a><br>
                                                @endif
                                            @endif --}}
                                    @elseif ($serviceid == 120)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Epic No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->epic_no }}" class="form-control"
                                                name="epic_no" maxlength="15" placeholder="Epic No" />
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Old Voter ID/Aadhar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Old Voter ID/Aadhar Card</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>
                                    @elseif ($serviceid == 164)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Epic No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->epic_no }}" class="form-control"
                                                name="epic_no" maxlength="15" placeholder="Epic No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />
                                        </div>
                                    @elseif ($serviceid == 182)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Epic No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->epic_no }}" class="form-control"
                                                name="epic_no" maxlength="15" placeholder="Epic No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->voter_id != '')
                                                    <label>Voter ID</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Voter ID</label>
                                                <input @if ($services->voter_id == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="voter_id">
                                                @if ($services->voter_id != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhar Card</label>
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
            var dist_id = "{{ $services->dist_id }}";
            var taluk_id = "{{ $services->taluk_id }}";

            gettaluk(dist_id);
            getpanchayath(taluk_id);

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
                $('#applicationhide').show("slow");
                $('#application').prop("required", true);
            }
        });

        $('#dist_id').change(function() {
            var dist_id = this.value;
            gettaluk(dist_id);
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
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            } else if ($('#service_status').val() == 'Processing') {
                $('#acknowledgementhide').show("slow");
                $('#acknowledgement').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            } else if ($('#service_status').val() == 'Approved') {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#application').prop("required", true);
                $('#applicationhide').show("slow");
            } else {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            }
        });
    </script>
@endpush
