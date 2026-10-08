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
                            <form class="row g-4" action="{{ url('submitapply_police') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post" id="myForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                   <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" maxlength="100" class="form-control" name="name"
                                            placeholder="Name" />
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input required type="date" maxlength="10" class="form-control" name="dob"
                                            placeholder="Date of Birth" />
                                        <label for="address_tamil" class="form-label">Address Type In Tamil</label>
                                        <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_tamil"
                                            placeholder="Address Type In Tamil"></textarea>
                                        <label for="emailid" class="form-label">Email ID</label>
                                        <input required type="email" maxlength="100" class="form-control" name="emailid"
                                            placeholder="Email ID" />
                                        <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card PDF Format Only
                                            Upload</label>
                                        <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                            name="aadhaar_card" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="father_name" class="form-label">Father Name</label>
                                        <input required type="text" maxlength="100" class="form-control"
                                            name="father_name" placeholder="Father Name" />
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input required type="text" maxlength="10" class="form-control number"
                                            name="mobile" placeholder="Mobile Number" />
                                        <label for="address_english" class="form-label">Address Type In English</label>
                                        <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_english"
                                            placeholder="Address Type In English"></textarea>
                                        <label for="pincode" class="form-label">Pincode </label>
                                        <input required type="text" maxlength="10" class="form-control number"
                                            name="pincode" placeholder="Pincode" />
                                    </div>

                                </div>
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
