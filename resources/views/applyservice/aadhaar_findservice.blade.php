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
                            <form class="row g-4" action="{{ url('submitapply_aadhaarfind') }}"
                                enctype="multipart/form-data" onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" maxlength="100" class="form-control" name="name"
                                            placeholder="Name" />

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="find_number" class="form-label">Find</label>
                                        <select class="form-control" id="find_number" name="find_number">
                                            <option value="">Select Find</option>
                                            <option value="Cell Number">Cell Number</option>
                                            <option value="Nalavariyam Register Number">Nalavariyam Register Number</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="" id="mobilehide" style="display: none;">
                                            <label for="mobile" class="form-label">Cell Number</label>
                                            <input type="text" class="form-control number" maxlength="10" name="mobile">
                                        </div>
                                        <div class="" id="nalavariyam_reg_nohide" style="display: none;">
                                            <label class="form-label">Nalavariyam Register Number</label>
                                            <input class="form-control" type="text" maxlength="20"
                                                name="nalavariyam_reg_no">
                                        </div>
                                    </div>

                                    <h6 class="text-center text-danger">80% possible to find adhaar Number</h6>
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
       $('#find_number').change(function() {
            if ($('#find_number').val() == 'Cell Number') {
                $('#mobilehide').show("slow");
                $('#nalavariyam_reg_nohide').hide("slow");
                $('#nalavariyam_reg_no').prop("required", false);
                $('#mobile').prop("required", true);

            } else if ($('#find_number').val() == 'Nalavariyam Register Number') {
                $('#nalavariyam_reg_nohide').show("slow");
                $('#mobilehide').hide("slow");
                $('#mobile').prop("required", false);
                $('#nalavariyam_reg_no').prop("required", true);

            } else {
                $('#mobilehide').hide("slow");
                $('#nalavariyam_reg_nohide').hide("slow");
                $('#mobile').prop("required", false);
                $('#nalavariyam_reg_no').prop("required", false);
            }
        });
    </script>
@endpush
