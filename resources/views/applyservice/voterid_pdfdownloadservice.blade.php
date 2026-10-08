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
                            <form class="row g-4" action="{{ url('submitapply_voteridpdfdownload') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">

                                    @if ($serviceid == 69)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                       
                                    @elseif ($serviceid == 70)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <h2 class="card-title">வாக்காளர் அட்டையுடன் இணைக்க வேண்டிய செல் நம்பருக்கு வரும்
                                                OTP யை கொடுக்க வேண்டும். ஒத்துழைப்பு தரும் பட்சத்தில் உடனடியாக இணைத்து
                                                தரப்படும்.</h2>
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                    @elseif ($serviceid == 71)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
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
