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
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('submitapply_driving_license') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            @if ($serviceid == 150)
                                                <div class="mb-3 col-md-6">
                                                    <label for="reg_cell_number" class="form-label number">Registered Cell
                                                        Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="reg_cell_number" placeholder="Registered Cell Number" />
                                                    <label for="dob" class="form-label">DOB</label>
                                                    <input required type="date" maxlength="10" class="form-control"
                                                        name="dob" placeholder="DOB" />

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="id_proof" class="form-label">ID Proof</label>
                                                    <select required class="form-control " id="id_proof" name="id_proof"
                                                        style="width: 100%;">
                                                        <option value="">Select ID Proof</option>
                                                        <option value="Licence">License</option>
                                                        <option value="Aadhaar Card">Aadhaar Card(Front&Back)</option>
                                                    </select>
                                                    <div class="" id="driving_licensehide" style="display: none;">
                                                        <label>License</label>
                                                        <input id="driving_license" class="form-control required"
                                                            type="file" name="driving_license">
                                                    </div>
                                                    <div class="" id="aadhaar_cardhide" style="display: none;">
                                                        <label>Aadhaar card(Front&Back)</label>
                                                        <input id="aadhaar_card" class="form-control required"
                                                            type="file" name="aadhaar_card">
                                                    </div>

                                                </div>
                                            @elseif($serviceid == 148)
                                                <div class="mb-3 col-md-6">
                                                    <label for="reg_cell_number" class="form-label number">Registered Cell
                                                        Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="reg_cell_number" placeholder="Registered Cell Number" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="dob" class="form-label">DOB</label>
                                                    <input required type="date" maxlength="10" class="form-control"
                                                        name="dob" placeholder="DOB" />
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

                    $('#id_proof').change(function() {
                        if ($('#id_proof').val() == 'Licence') {
                            $('#driving_licensehide').show("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_license').prop("required", true);

                        } else if ($('#id_proof').val() == 'Aadhaar Card') {
                            $('#aadhaar_cardhide').show("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#driving_license').prop("required", false);
                            $('#aadhaar_card').prop("required", true);
                        } else {
                            $('#driving_licensehide').hide("slow");
                            $('#aadhaar_cardhide').hide("slow");
                            $('#aadhaar_card').prop("required", false);
                            $('#driving_license').prop("required", false);

                        }
                    });
                </script>
            @endpush
