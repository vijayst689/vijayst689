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
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <h6 class="card-title">Service Payment : <span
                                            class="text-danger">{{ $payment }}</span></h6>
                                    <form class="row g-4" action="{{ url('submitapply_csc_tec') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">

                                            <div class="mb-3 col-md-4">
                                                <label for="name" class="form-label">Name</label>
                                                <input required type="text" class="form-control" name="name"
                                                    placeholder="Name" maxlength="30" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="mobile" class="form-label">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control number"
                                                    name="mobile" placeholder="Mobile Number" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="aadhaar_card" class="form-label">Adhaar card (front &
                                                    Back)</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="aadhaar_card" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="shop_name" class="form-label">Shop Name</label>
                                                <input required type="text" class="form-control" name="shop_name"
                                                    placeholder="Shop Name" maxlength="50" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="shop_address" class="form-label">Shop Address</label>
                                                <textarea required rows="2" type="text" maxlength="200" class="form-control" name="shop_address"
                                                    placeholder="Shop Address"></textarea>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="pan_card" class="form-label">Pan Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="pan_card" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="door_no" class="form-label">Door No</label>
                                                <input required type="text" maxlength="15" class="form-control"
                                                    name="door_no" placeholder="Door No" />
                                            </div>

                                            <div class="mb-3 col-md-4">
                                                <label for="street_name" class="form-label">Street Name</label>
                                                <input required type="text" class="form-control" name="street_name"
                                                    placeholder="Street Name" maxlength="30" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="tec_certificate" class="form-label">Tec certificate</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="tec_certificate" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="postal_name" class="form-label">Postal Name</label>
                                                <input required type="text" class="form-control" name="postal_name"
                                                    placeholder="Postal Name" maxlength="30" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="village_name" class="form-label">Village Name</label>
                                                <input required type="text" class="form-control" name="village_name"
                                                    placeholder="Village Name" maxlength="30" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="bank_passbook" class="form-label">Bank passbook</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="bank_passbook" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="dist_id" class="form-label">District</label>
                                                <select required name="dist_id" id="dist_id" class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option value="{{ $d->id }}">{{ $d->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="taluk_id" class="form-label">Taluk</label>
                                                <select required name="taluk_id" id="taluk" class="form-control">
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="voterid" class="form-label">Voter Id</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="voterid" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="panchayath_id" class="form-label">VAO Area</label>
                                                <select required name="panchayath_id" id="panchayath"
                                                    class="form-control">
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="pincode" class="form-label">Pin Code</label>
                                                <input required type="text" class="form-control" name="pincode"
                                                    placeholder="Pin Code" maxlength="10" />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="bc_agent_certificate" class="form-label">Bc Agent
                                                    Certificate</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="bc_agent_certificate" />
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

                    $('#dist_id').on('change', function() {
                        var dist_id = this.value;
                        $("#taluk").html('');
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
                                $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                            }
                        });
                    });

                    $('#taluk').on('change', function() {
                        var taluk_id = this.value;
                        $("#panchayath").html('');
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
                            }
                        });
                    });
                </script>
            @endpush
