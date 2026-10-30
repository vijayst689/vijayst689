@extends('layouts.app')
@section('content')
 <style>
        /* Default radio border color */
        /* Default border color */
        .form-check-input {
            border-color: #dd1181;
            /* blue border */
        }

        /* Checked state */
        .form-check-input:checked {
            background-color: #dd1181;
            border-color: #dd1181;
        }

        /* Focus shadow */
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(238, 4, 82, 0.25);
        }
    </style>
    <style>
        .category-header {
            background: #e0e0e0;
            padding: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .kob-card {
            border: 1px solid #ddd;
            margin-bottom: 8px;
        }

        .kob-header {
            background: #009688;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        .kob-body {
            padding: 10px;
            background: #f9f9f9;
        }
    </style>
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
                                    <form class="row g-4" action="{{ url('submitapply_employement') }}"
                                enctype="multipart/form-data" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">

                                    @if ($serviceid == 257)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Password</label>
                                            <input required type="password" maxlength="20" class="form-control"
                                                name="password" placeholder="Password" />
                                        </div>
                                        {{-- <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_no" placeholder="Aadhaar Number" />
                                        </div> --}}
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="Date of Birth" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="emp_reg_number" class="form-label">Employment Registeration
                                                Number</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="emp_reg_number" placeholder="Employment Registeration Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="employment_card" class="form-label">Employment Card</label>
                                            <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                                class="form-control" name="employment_card" />
                                        </div>
                                    @elseif ($serviceid == 285)
                                        <div class="mb-3 col-md-6">
                                            <label for="emp_reg_number" class="form-label">Employment Registeration
                                                Number</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="emp_reg_number" placeholder="Employment Registeration Number" />
                                        </div>
                                    @elseif ($serviceid == 286)
                                        <div class="mb-3 col-md-6">
                                            <label for="emp_reg_number" class="form-label">Employment Registeration
                                                Number</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="emp_reg_number" placeholder="Employment Registeration Number" />
                                        </div>
                                    @elseif ($serviceid == 287)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Username</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Username " />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Password</label>
                                            <input required type="password" maxlength="20" class="form-control"
                                                name="password" placeholder="Password" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="marksheet" class="form-label">Mark Sheet</label>
                                            <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                                class="form-control" name="marksheet" />
                                        </div>
                                    @elseif ($serviceid == 288)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Father Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="father_name" placeholder="Father Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Mother Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="mother_name" placeholder="Mother Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="text" class="form-control" name="dob"
                                                placeholder="dd/mm/yyyy">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" maxlength="10" class="form-control number"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_no" placeholder="Aadhaar Number" />
                                        </div>
                                        <h5 class="text-danger mt-3">
                                            Note: Basic details மட்டும் பதிவு செய்யவும்.
                                            Username மற்றும் Password ஆக Date of Birth (DD/MM/YYYY) பயன்படுத்தப்படும்.
                                            Qualification details-ஐ பதிவு செய்த பிறகு update செய்யலாம்.
                                        </h5>
                                    @elseif ($serviceid == 290)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Father Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="father_name" placeholder="Father Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="Date of Birth" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input required type="text" maxlength="10" class="form-control number"
                                                name="mobile" placeholder="Cell Number" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="community" class="form-label">Community</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="community" placeholder="Community" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="caste" class="form-label">Caste</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="caste" placeholder="Caste" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Email Id</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="email" placeholder="Email Id" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Address" maxlength="500" rows="3" required></textarea>
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
    </script>
@endpush
