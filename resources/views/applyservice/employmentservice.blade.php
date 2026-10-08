@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_employement') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post" id="myForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                     @if ($serviceid == 244)
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
                                    @elseif ($serviceid == 251)
                                        <div class="mb-3 col-md-6">
                                            <label for="emp_reg_number" class="form-label">Employment Registeration
                                                Number</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="emp_reg_number" placeholder="Employment Registeration Number" />
                                        </div>
                                    @elseif ($serviceid == 252)
                                        <div class="mb-3 col-md-6">
                                            <label for="emp_reg_number" class="form-label">Employment Registeration
                                                Number</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="emp_reg_number" placeholder="Employment Registeration Number" />
                                        </div>
                                    @elseif ($serviceid == 253)
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
                                    @elseif ($serviceid == 254)
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
                                    @elseif ($serviceid == 255)
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
                                    <div class="mt-2 text-center">
                                        <button id="save" type="submit" class="btn btn-primary me-2">Apply</button>
                                    </div>
                            </form>
                        </div>
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
                var ramjibalance = "{{ $mainbalance->rawallet }}";
        //alert(ramjibalance);
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = {{ $admin_payment }};
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#ramjidebit_amount").val(amount);
                return true;

            }
        }
    </script>
@endpush
