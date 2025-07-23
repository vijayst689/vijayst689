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
                            <form action="{{ url('/fssaiservice_update') }}" id="formAccountSettings" method="POST"
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

                                    @if ($serviceid == 122)
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Food service</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                id="food_service" name="food_service" class="form-control">
                                                <option value="">Select service</option>
                                                <option @if ($services->food_service == 'Petty Retailer') selected @endif
                                                    value="Petty Retailer">Petty Retailer of snacks/tea shops</option>
                                                <option @if ($services->food_service == 'Hawker') selected @endif value="Hawker">
                                                    Hawker (Itinerant / Mobile food vendor)</option>
                                            </select>

                                            <label for="shop_name" class="form-label">Shop Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->shop_name }}" class="form-control" name="shop_name"
                                                maxlength="100" placeholder="Shop Name" />
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                                maxlength="10" placeholder="Mobile Number" />
                                            <label for="email_id" class="form-label">Email Id</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="email"
                                                value="{{ $services->email_id }}" class="form-control" name="email_id"
                                                maxlength="50" placeholder="Email Id" />
                                            <label for="mobile_no" class="form-label">Applicant Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->mobile_no }}" class="form-control number"
                                                name="mobile_no" maxlength="10" placeholder="Applicant Mobile Number" />

                                            <label class="form-label">Documents</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                id="documents" name="documents" class="form-control">
                                                <option value="">Select Documents</option>
                                                <option @if ($services->documents == 'Rental Agreement') selected @endif
                                                    value="Rental Agreement">Rental Agreement</option>
                                                <option @if ($services->documents == 'Electricity Bill') selected @endif
                                                    value="Electricity Bill">Electricity Bill</option>
                                                <option @if ($services->documents == 'Property Tax') selected @endif
                                                    value="Property Tax">Property Tax</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label>Applicant Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Applicant Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->shop_photo != '')
                                                    <label>Shop Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Shop Photo</label>
                                                <input @if ($services->shop_photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="shop_photo">
                                                @if ($services->shop_photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}">Download</a><br>
                                                @endif
                                            @endif
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
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->pan_card != '')
                                                    <label>Pan Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Pan Card</label>
                                                <input @if ($services->pan_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="pan_card">
                                                @if ($services->pan_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            <div class="" id="rental_agreementhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->rental_agreement != '')
                                                        <label>Rental Agreement</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Rental Agreement</label>
                                                    <input @if ($services->rental_agreement == '' && $services->documents == 'Rental Agreement') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="rental_agreement"
                                                        id="rental_agreement">
                                                    @if ($services->rental_agreement != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="electricity_billhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->electricity_bill != '')
                                                        <label>Electricity Bill</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Electricity Bill</label>
                                                    <input @if ($services->electricity_bill == '' && $services->documents == 'Electricity Bill') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="electricity_bill"
                                                        id="electricity_bill">
                                                    @if ($services->electricity_bill != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="property_taxhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->property_tax != '')
                                                        <label>Property Tax</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Property Tax</label>
                                                    <input @if ($services->property_tax == '' && $services->documents == 'Property Tax') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="property_tax"
                                                        id="property_tax">
                                                    @if ($services->property_tax != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 123)
                                        <div class="mb-3 col-md-4">
                                            <label for="shop_name" class="form-label">Shop Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->shop_name }}" class="form-control"
                                                name="shop_name" maxlength="30" placeholder="Shop Name" />
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />
                                            <label for="email_id" class="form-label">Email Id</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->email_id }}" class="form-control"
                                                name="email_id" maxlength="50" placeholder="Email Id" />
                                            <label for="mobile" class="form-label">Applicant Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Applicant Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label>Applicant Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Applicant Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label>Shop Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Shop Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
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
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->pan_card != '')
                                                    <label>Pan Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Pan Card</label>
                                                <input @if ($services->pan_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="pan_card">
                                                @if ($services->pan_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->old_food_license != '')
                                                    <label>old food license certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/old_food_license/{{ $services->old_food_license }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>old food license certificate</label>
                                                <input @if ($services->old_food_license == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="old_food_license">
                                                @if ($services->old_food_license != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/old_food_license/{{ $services->old_food_license }}">Download</a><br>
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
            var documents = "{{ $services->documents }}";

            if (documents == "Rental Agreement") {
                $('#rental_agreementhide').show("slow");
            } else if (documents == "Electricity Bill") {
                $('#electricity_billhide').show("slow");
            } else if (documents == "Property Tax") {
                $('#property_taxhide').show("slow");
            }

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

        $('#documents').change(function() {
            if ($('#documents').val() == 'Rental Agreement') {
                $('#rental_agreementhide').show("slow");
                $('#electricity_billhide').hide("slow");
                $('#property_taxhide').hide("slow");
                $('#property_tax').prop("required", false);
                $('#electricity_bill').prop("required", false);
                $('#rental_agreement').prop("required", true);

            } else if ($('#documents').val() == 'Electricity Bill') {
                $('#electricity_billhide').show("slow");
                $('#rental_agreementhide').hide("slow");
                $('#property_taxhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#property_tax').prop("required", false);
                $('#electricity_bill').prop("required", true);

            } else if ($('#documents').val() == 'Property Tax') {
                $('#property_taxhide').show("slow");
                $('#electricity_bill').hide("slow");
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill').prop("required", false);
                $('#property_tax').prop("required", true);

            } else {
                $('#rental_agreementhide').hide("slow");
                $('#electricity_billhide').hide("slow");
                $('#property_taxhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill').prop("required", false);
                $('#property_tax').prop("required", false);

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
    </script>
@endpush
