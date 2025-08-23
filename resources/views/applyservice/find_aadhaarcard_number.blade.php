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
                                    <form class="row g-4" action="{{ url('submitfindaadhaar_number') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input required type="text" class="form-control" name="name"
                                                    placeholder="Name" maxlength="30" />
                                                <label>Mobile Number(Smartcard Link)</label>
                                                <input id="smart_link_no" class="form-control" type="text"
                                                    name="smart_link_no" maxlength="10"
                                                    placeholder="Mobile Number(Smartcard Link)" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="documents" class="form-label">Documents </label>
                                                <select required type="text" class="form-control" name="documents"
                                                    id="documents">
                                                    <option value="">Select Documents</option>
                                                    <option value="Pan Card Number">Pan Card Number</option>
                                                    <option value="Adhaar Enrolment Slip">Adhaar Enrolment Slip</option>
                                                </select>
                                                <div class="" id="pan_card_nohide" style="display: none;">
                                                    <label>Pan Card Number</label>
                                                    <input id="pan_card_no" class="form-control" type="text"
                                                        name="pan_card_no" maxlength="10" placeholder="Pan Card Number">
                                                </div>
                                                <div class="" id="aadhaar_entrolment_sliphide" style="display: none;">
                                                    <label>Aadhaar Enrolment Slip</label>
                                                    <input id="aadhaar_entrolment_slip" class="form-control" type="file"
                                                        name="aadhaar_entrolment_slip">
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

                    $('#documents').change(function() {
                        if ($('#documents').val() == 'Pan Card Number') {
                            $('#pan_card_nohide').show("slow");
                            $('#pan_card_no').prop("required", true);
                            $('#aadhaar_entrolment_sliphide').hide("slow");
                            $('#aadhaar_entrolment_slip').prop("required", false);

                        } else if ($('#documents').val() == 'Adhaar Enrolment Slip') {
                            $('#aadhaar_entrolment_sliphide').show("slow");
                            $('#aadhaar_entrolment_slip').prop("required", true);
                            $('#pan_card_nohide').hide("slow");
                            $('#pan_card_no').prop("required", false);
                        } else {
                            $('#pan_card_nohide').hide("slow");
                            $('#pan_card_no').prop("required", false);
                            $('#aadhaar_entrolment_slip').prop("required", false);
                            $('#aadhaar_entrolment_sliphide').hide("slow");
                        }
                    });
                </script>
            @endpush
