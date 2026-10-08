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
                            <form class="row g-4" action="{{ url('submitapply_teccorrection') }}" enctype="multipart/form-data"
                                method="post" onsubmit="return checkpayment(event)" id="myForm">
                                @csrf
                               <div class="row">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="service_amount" value="{{ $payment }}">
                        <input type="hidden" name="user_id" value="{{ $customers->id }}">

                           <div class="mb-3 col-md-6">
                            <label for="applicant_name" class="form-label">Applicant Name</label>
                            <input required type="text" class="form-control"
                            name="applicant_name" placeholder="Applicant Name" maxlength="30" />

                            <label for="mobile" class="form-label">Cell Number</label>
                            <input required type="text" class="form-control number"
                            name="mobile" placeholder="Cell Number" maxlength="10" />

                            <label for="email" class="form-label">Tec Register Mail</label>
                            <input required type="text" class="form-control"
                            name="email" placeholder="Tec Register Mail" maxlength="30" />
                           
                            <label for="tec_password" class="form-label number">Tec Password</label>
                            <input required type="text" maxlength="20" class="form-control"
                            name="tec_password" placeholder="Tec Password"/>                       
                          
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Photo</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                            name="photo" />
                            <label for="aadhaar_card" class="form-label">Aadhaar Card(Front & Back)</label>
                            <input required accept="image/jpeg, image/png"  type="file" class="form-control"
                            name="aadhaar_card" />
                           
                        </div>
                         <div class="text-center"><p id="nopayment"></p></div>
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
