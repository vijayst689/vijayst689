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
                            <form class="row g-4" action="{{ url('submitapply_itr') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" class="form-control" name="name"
                                            placeholder="Name" />

                                        <label for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" maxlength="10" class="form-control" name="mobile"
                                            placeholder="Mobile Number" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pan_card" class="form-label">Pan Card</label>
                                        <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                            name="pan_card" />

                                        <label for="bank_passbook" class="form-label">Bank Pass Book</label>
                                        <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                            name="bank_passbook" />

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="aahaar_no" class="form-label">Aadhaar Number</label>
                                        <input required type="text" class="form-control number" name="aadhaar_no"
                                            placeholder="Aadhaar Number" maxlength="12" />
                                        <label for="email" class="form-label">Email</label>
                                        <input required type="email" class="form-control" name="email"
                                            placeholder="Email" maxlength="50" />


                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="aadhaar_card" class="form-label">Adhaar Card (Front & Back)</label>
                                        <input required type="file" class="form-control" name="aadhaar_card"
                                            placeholder="Adhaar card (Front & Back)" />
                                    </div>
                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                            </div>
                                        </div>
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
