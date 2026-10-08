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
                            <form action="{{ url('/aadhaarfind_update') }}" id="myForm"
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
                                        <label for="name" class="form-label">Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                            maxlength="100" class="form-control" value="{{ $services->name }}"
                                            name="name" placeholder="Name" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Find</label>
                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="find_number"
                                            name="find_number" class="form-control">
                                            <option value="">Select Find</option>
                                            <option @if ($services->find_number == 'Cell Number') selected @endif value="Cell Number">
                                                Cell Number</option>
                                            <option @if ($services->find_number == 'Nalavariyam Register Number') selected @endif
                                                value="Nalavariyam Register Number">Nalavariyam Register Number</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">

                                    <div class="" id="mobilehide" style="display: none;">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                value="{{ $services->mobile }}" class="form-control number"
                                                name="mobile" maxlength="10" placeholder="Cell Number" />
                                        </div>
                                        <div class="" id="nalavariyam_reg_nohide" style="display: none;">
                                            <label for="nalavariyam_reg_no" class="form-label">Nalavariyam Register Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                value="{{ $services->nalavariyam_reg_no }}" class="form-control"
                                                name="nalavariyam_reg_no" maxlength="20" placeholder="Nalavariyam Register Number" />
                                        </div>
                                        </div>
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
                                                    type="text" maxlength="150" name="application"
                                                    id="application" />
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
            var find_number = "{{ $services->find_number }}";

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

            if (find_number == "Cell Number") {
                $('#mobilehide').show("slow");
                $('#mobile').prop("required", true);
            } else if (find_number == "Nalavariyam Register Number") {
                $('#nalavariyam_reg_nohide').show("slow");
                $('#nalavariyam_reg_no').prop("required", true);
            }
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


        $('#find_number').change(function() {
            if ($('#find_number').val() == 'Cell Number') {
                $('#mobilehide').show("slow");
                $('#nalavariyam_reg_nohide').hide("slow");
                $('#nalavariyam_reg_no').prop("required", false);
                $('#mobile').prop("required", true);

            } else if ($('#find_number').val() == 'Nalavariyam Register Number') {
                $('#nalavariyam_reg_nohide').show("slow");
                $('#mobilehide').hide("slow");
                $('#mobile').prop("required", false);
                $('#nalavariyam_reg_no').prop("required", true);

            } else {
                $('#mobilehide').hide("slow");
                $('#nalavariyam_reg_nohide').hide("slow");
                $('#mobile').prop("required", false);
                $('#nalavariyam_reg_no').prop("required", false);

            }
        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush

