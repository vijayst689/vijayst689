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
                            <form action="{{ url('/submit_statusupdate_gst') }}" id="formAccountSettings" method="POST"
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
                                    if ($services->retailer_id == 0) {
                                        $apply_user_id = $services->distributor_id;
                                    } elseif ($services->distributor_id == 0) {
                                        $apply_user_id = $services->retailer_id;
                                    }
                                @endphp

                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->trade_name }}" class="form-control" name="trade_name"
                                        placeholder="Name" />

                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        maxlength="10" class="form-control number" value="{{ $services->mobile }}"
                                        name="mobile" placeholder="Mobile Number" />

                                    <label for="aadhaar_no" class="form-label number">Aadhaar Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        maxlength="12" class="form-control number" value="{{ $services->aadhaar_no }}"
                                        name="aadhaar_no" placeholder="Aadhaar No" />

                                    <label for="pan_no" class="form-label number">Pan Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        maxlength="10" class="form-control number" value="{{ $services->pan_no }}"
                                        name="pan_no" placeholder="Pan No" />

                                    <label for="business_details" class="form-label">Business Details</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif class="form-control" name="business_details" id="business_details">
                                        <option value="">Select Business Details</option>
                                        <option @if ($services->business_details == 'Own Property') selected @endif value="Own Property">
                                            Own Property</option>
                                        <option @if ($services->business_details == 'Rental') selected @endif value="Rental">
                                            Rental</option>
                                    </select>


                                        <div id="details_hide" style="display: none">
                                            <label for="business_details_documents"
                                                class="form-label">Documents</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required name="business_details_documents"
                                                id="business_details_documents" class="form-control">
                                                <option value="">Select Documents</option>
                                                <option @if ($services->business_details_documents == 'EB Bill') selected @endif value="EB Bill">EB Bill</option>
                                                <option @if ($services->business_details_documents == 'Property Tax') selected @endif value="Property Tax">Property Tax</option>
                                            </select>
                                        </div>

                                        <div id="rental_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->rental_agreement != '')
                                            <label>Rental Agreement</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Rental Agreement</label>
                                        <input @if ($services->rental_agreement == '') @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="rental_agreement" id="rental_agreement">
                                        @if ($services->rental_agreement != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}">Download</a><br>
                                        @endif
                                    @endif
                                        </div>

                                        <div id="ebbill_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->ebbill != '')
                                            <label>EB Bill</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/ebbill/{{ $services->ebbill }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>EB Bill</label>
                                        <input @if ($services->ebbill == '') @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="ebbill" id="ebbill">
                                        @if ($services->ebbill != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/ebbill/{{ $services->ebbill }}">Download</a><br>
                                        @endif
                                    @endif

                                        </div>

                                        <div id="propertytax_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->property_tax != '')
                                            <label>Property tax</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Property tax</label>
                                        <input @if ($services->property_tax == '') @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="property_tax" id="property_tax">
                                        @if ($services->property_tax != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}">Download</a><br>
                                        @endif
                                    @endif

                                        </div>
                                    </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->aadhaar_card != '')
                                            <label>Pan Card</label>
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
                                        @if ($services->aadhaar_card != '')
                                            <label>Aadhaar Card</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Pan Card</label>
                                        <input @if ($services->pan_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="pan_card">
                                        @if ($services->pan_card != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
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
                                        <input @if ($services->pan_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="photo">
                                        @if ($services->photo != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                        @endif
                                    @endif

                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->bank_pass_book_front_page != '')
                                            <label>BankPass Book</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/passbook_front/{{ $services->bank_pass_book_front_page }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>BankPass Book</label>
                                        <input @if ($services->bank_pass_book_front_page == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png"
                                            name="bank_pass_book_front_page">
                                        @if ($services->bank_pass_book_front_page != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/passbook_front/{{ $services->bank_pass_book_front_page }}">Download</a><br>
                                        @endif
                                    @endif
                                    <label for="business_address" class="form-label">Business Address</label>
                                    <textarea rows="2" @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text" maxlength="200"
                                        class="form-control" value="{{ $services->business_address }}" name="business_address"
                                        placeholder="Buisness Address">{{ $services->business_address }}</textarea>
                                </div>

                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
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
    </main>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            var status = "{{ $services->status }}";
            var business_details = "{{ $services->business_details }}";
            var business_details_documents = "{{ $services->business_details_documents }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";

            if (business_details = "Own Property") {
                $('#details_hide').show("slow");
            } else if (business_details == "Rental") {
                $('#rental_hide').show("slow");
            }
            if(business_details_documents == "EB Bill"){
                 $('#ebbill_hide').show("slow");
            }else if(business_details_documents == "Property Tax"){
                 $('#propertytax_hide').show("slow");
            }

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



        $('#business_details').change(function() {
            if ($('#business_details').val() == 'Own Property') {
                $('#details_hide').show("slow");
                $('#rental_hide').hide("slow");
                $('#business_details_documents').prop("required", true);
                $('#rental_agreement').prop("required", false);
            } else if ($('#business_details').val() == 'Rental') {
                $('#rental_hide').show("slow");
                $('#details_hide').hide("slow");
                $('#rental_agreement').prop("required", true);
                $('#business_details_documents').prop("required", false);
                $('#propertytax_hide').hide("slow");
                $('#ebbill_hide').hide("slow");
                $('#property_tax').prop("required", false);
                $('#ebbill').prop("required", false);
            } else {
                $('#details_hide').hide("slow");
                $('#rental_hide').hide("slow");
                $('#business_details_documents').prop("required", false);
                $('#rental_agreement').prop("required", false);
                $('#propertytax_hide').hide("slow");
                $('#ebbill_hide').hide("slow");
                $('#property_tax').prop("required", false);
                $('#ebbill').prop("required", false);

            }
        });

        $('#business_details_documents').change(function() {
            if ($('#business_details_documents').val() == 'EB Bill') {
                $('#ebbill_hide').show("slow");
                $('#propertytax_hide').hide("slow");
                $('#ebbill').prop("required", true);
                $('#property_tax').prop("required", false);
            } else if ($('#business_details_documents').val() == 'Property Tax') {
                $('#propertytax_hide').show("slow");
                $('#ebbill_hide').hide("slow");
                $('#property_tax').prop("required", true);
                $('#ebbill').prop("required", false);
            } else {
                $('#propertytax_hide').hide("slow");
                $('#ebbill_hide').hide("slow");
                $('#property_tax').prop("required", false);
                $('#ebbill').prop("required", false);
            }
        });

    </script>
@endpush
