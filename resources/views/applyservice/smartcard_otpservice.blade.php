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
                                    <form class="row g-4" action="{{ url('submitapply_smartcardotp') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" name="service_amount" value="{{ $payment }}">

                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Documents</label>
                                            <select required id="documents" name="documents" class="form-control">
                                                <option value="">Select Documents</option>
                                                <option value="Aadhaar Card">Aadhaar Card</option>
                                                <option value="Smart Card">Smart Card</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="" id="aadhaar_cardhide" style="display: none;">
                                                <label>Aadhaar Card</label>
                                                <input id="aadhaar_card" class="form-control" type="file"
                                                    name="aadhaar_card">
                                            </div>
                                            <div class="" id="smart_cardhide" style="display: none;">
                                                <label>Smart Card</label>
                                                <input id="smart_card" class="form-control" type="file"
                                                    name="smart_card">
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
                </script>
            @endpush
