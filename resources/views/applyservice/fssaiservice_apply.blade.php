@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
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
                                    <form class="row g-4" action="{{ url('submit_fssaiservice') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                            @if ($serviceid == 122)
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Food service</label>
                                                    <select required id="food_service" name="food_service"
                                                        class="form-control">
                                                        <option value="">Select service</option>
                                                        <option value="Petty Retailer">Petty Retailer of snacks/tea shops
                                                        </option>
                                                        <option value="Hawker">Hawker (Itinerant / Mobile food vendor)
                                                        </option>
                                                    </select>
                                                    <label for="shop_name" class="form-label">Shop Name</label>
                                                    <input required type="text" class="form-control" maxlength="30"
                                                        name="shop_name" placeholder="Shop Name" />
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input required type="text" class="form-control number"
                                                        maxlength="10" name="mobile" placeholder="Mobile Number" />
                                                    <label for="email_id" class="form-label">Email Id</label>
                                                    <input required type="text" class="form-control" maxlength="50"
                                                        name="email_id" placeholder="Email Id" />
                                                    <label for="mobile_no" class="form-label">Applicant Mobile
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        maxlength="10" name="mobile_no"
                                                        placeholder="Applicant Mobile Number" />
                                                    <label class="form-label">Documents</label>
                                                    <select required id="documents" name="documents" class="form-control">
                                                        <option value="">Select Documents</option>
                                                        <option value="Rental Agreement">Rental Agreement</option>
                                                        <option value="Electricity Bill">Electricity Bill</option>
                                                        <option value="Property Tax">Property Tax</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label text-danger">Applicant
                                                        Photo</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="photo" />
                                                    <label for="shop_photo" class="form-label text-danger">Shop
                                                        Photo</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="shop_photo" />
                                                    <label for="aadhaar_card" class="form-label text-danger">Aadhaar
                                                        Card</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />
                                                    <label for="pan_card" class="form-label text-danger">Pan Card</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="pan_card" />

                                                    <div class="" id="rental_agreementhide" style="display: none;">
                                                        <label class="form-label text-danger">Rental Agreement</label>
                                                        <input id="rental_agreement" class="form-control" type="file"
                                                            name="rental_agreement">
                                                    </div>
                                                    <div class="" id="electricity_billhide" style="display: none;">
                                                        <label class="form-label text-danger">Electricity Bill</label>
                                                        <input id="electricity_bill" class="form-control" type="file"
                                                            name="electricity_bill">
                                                    </div>
                                                    <div class="" id="property_taxhide" style="display: none;">
                                                        <label class="form-label text-danger">Property Tax</label>
                                                        <input id="property_tax" class="form-control" type="file"
                                                            name="property_tax">
                                                    </div>

                                                </div>
                                            @elseif ($serviceid == 123)
                                                <div class="mb-3 col-md-6">
                                                    <label for="shop_name" class="form-label">Shop Name</label>
                                                    <input required type="text" class="form-control" maxlength="30"
                                                        name="shop_name" placeholder="Shop Name" />
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input required type="text" class="form-control number"
                                                        maxlength="10" name="mobile" placeholder="Mobile Number" />
                                                    <label for="email_id" class="form-label">Email Id</label>
                                                    <input required type="text" class="form-control" maxlength="50"
                                                        name="email_id" placeholder="Email Id" />
                                                    <label for="mobile_no" class="form-label">Applicant Mobile
                                                        Number</label>
                                                    <input required type="text" class="form-control number"
                                                        maxlength="10" name="mobile_no"
                                                        placeholder="Applicant Mobile Number" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label text-danger">Applicant
                                                        Photo</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="photo" />
                                                    <label for="shop_photo" class="form-label text-danger">Shop
                                                        Photo</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="shop_photo" />
                                                    <label for="aadhaar_card" class="form-label text-danger">Aadhaar
                                                        Card</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="aadhaar_card" />
                                                    <label for="pan_card" class="form-label text-danger">Pan Card</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="pan_card" />
                                                    <label for="old_food_license" class="form-label text-danger">old food
                                                        license
                                                        certificate</label>
                                                    <input required accept="image/jpeg, image/png" type="file"
                                                        class="form-control" name="old_food_license" />
                                                </div>
                                            @endif
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
         document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
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
                            $('#property_tax').prop("required", false);
                            $('#rental_agreement').prop("required", false);
                            $('#electricity_bill').prop("required", true);

                        } else if ($('#documents').val() == 'Property Tax') {
                            $('#property_taxhide').show("slow");
                            $('#electricity_billhide').hide("slow");
                            $('#rental_agreementhide').hide("slow");
                            $('#rental_agreement').prop("required", false);
                            $('#electricity_bill').prop("required", false);
                            $('#property_tax').prop("required", true);

                        } else {
                            $('#property_taxhide').hide("slow");
                            $('#electricity_billhide').hide("slow");
                            $('#rental_agreementhide').hide("slow");
                            $('#rental_agreement').prop("required", false);
                            $('#electricity_bill').prop("required", false);
                            $('#property_tax').prop("required", false);
                        }
                    });
                </script>
            @endpush
