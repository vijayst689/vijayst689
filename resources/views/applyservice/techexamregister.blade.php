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
                                    <form class="row g-4" action="{{ url('submittecexam_register') }}"
                                        onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                                        id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            <div class="mb-3 col-md-6">
                                                <label for="applicant_name" class="form-label">Applicant Name</label>
                                                <input required type="text" class="form-control" name="applicant_name"
                                                    placeholder="Applicant Name" maxlength="30" />

                                                <label for="mobile" class="form-label number">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control"
                                                    name="mobile" placeholder="Mobile No" />

                                                <label for="gender" class="form-label">Gender</label>
                                                <select required type="text" maxlength="20" class="form-control"
                                                    name="gender" placeholder="Gender">
                                                    <option value="">Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>

                                                <label for="photo" class="form-label">Photo</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="photo" />

                                                <label for="photo" class="form-label">District</label>
                                                <input type="text" maxlength="15" class="form-control" name="district"
                                                    placeholder="District" />
                                            </div>
                                            <div class="mb-3 col-md-6">

                                                <label for="father_name" class="form-label">Father/Mother/Spouse
                                                    Name</label>
                                                <input required type="text" class="form-control" name="father_name"
                                                    placeholder="Father Name" maxlength="30" />

                                                <label for="email" class="form-label">EMail</label>
                                                <input required type="text" class="form-control" name="email"
                                                    placeholder="Email" maxlength="30" />

                                                <label for="dob" class="form-label">DOB</label>
                                                <input required type="date" class="form-control" name="dob"
                                                    placeholder="DOB" maxlength="30" />

                                                <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="aadhaar_card" />

                                                <label for="address" class="form-label">Address</label>
                                                <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address"
                                                    placeholder="Address"></textarea>

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
