@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            <div class="card">
                <div class="card-body">
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
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h6 class="card-title">Service Payment : <span
                                        class="text-danger">{{ $payment }}</span></h6>
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('submitapply_gst') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            <div class="mb-3 col-md-6">
                                                <label for="trade_name" class="form-label">Trade Name</label>
                                                <input required type="text" class="form-control" name="trade_name"
                                                    placeholder="Trade Name" />

                                                <label for="mobile" class="form-label number">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control number"
                                                    name="mobile" placeholder="Mobile Number" />

                                                <label for="aadhaar_no" class="form-label number">Aadhaar Number</label>
                                                <input required type="text" maxlength="12" class="form-control number"
                                                    name="aadhaar_no" placeholder="Aadhaar Number" />

                                                <label for="pan_no" class="form-label">Pan Number</label>
                                                <input required type="text" class="form-control number" maxlength="10"
                                                    name="pan_no" placeholder="Pan Number" />

                                                <label for="business_details" class="form-label">Business Details</label>
                                                <select required name="business_details" id="business_details"
                                                    class="form-control">
                                                    <option value="">Select Business Details</option>
                                                    <option value="Own Property">Own Property</option>
                                                    <option value="Rental">Rental</option>
                                                </select>

                                                <div id="details_hide" style="display: none">
                                                    <label for="business_details_documents"
                                                        class="form-label">Documents</label>
                                                    <select required name="business_details_documents"
                                                        id="business_details_documents" class="form-control">
                                                        <option value="">Select Documents</option>
                                                        <option value="EB Bill">EB Bill</option>
                                                        <option value="Property Tax">Property Tax</option>
                                                    </select>
                                                </div>

                                                <div id="rental_hide" style="display: none">
                                                    <label for="rental_agreement" class="form-label">Rental
                                                        Agreement</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="rental_agreement"
                                                        id="rental_agreement" />
                                                </div>

                                                <div id="ebbill_hide" style="display: none">
                                                    <label for="ebbill" class="form-label">EB Bill</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="ebbill" id="ebbill" />
                                                </div>
                                                <div id="propertytax_hide" style="display: none">
                                                    <label for="property_tax" class="form-label">Property Tax</label>
                                                    <input accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="property_tax" id="property_tax" />
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="photo" class="form-label">Photo</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="photo" />
                                                <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="aadhaar_card" />
                                                <label for="pan_card" class="form-label">Pan Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="pan_card" />
                                                <label for="bank_pass_book_front_page" class="form-label">Bank Pass Book
                                                    Front
                                                    Page</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="bank_pass_book_front_page" />
                                                <label for="business_address" class="form-label">Business Address</label>
                                                <textarea required type="text" rows="2" maxlength="200" class="form-control" name="business_address"
                                                    placeholder="Business Address"></textarea>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p id="nopayment"></p>
                                        </div>
                                        <div class="text-center">
                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <button id="save" type="submit"
                                                        class="btn btn-primary">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
            @push('page_scripts')
                <script>
                    $(function() {
                        var wallet = "{{ Auth::user()->wallet }}";
                        var amount = "{{ $payment }}";
                        if (parseFloat(amount) > parseInt(wallet)) {
                            $('#save').prop("disabled", true);
                            $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                                'color': 'red',
                                'font-size': '150%',
                                'font-weight': 'bold'
                            });
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
