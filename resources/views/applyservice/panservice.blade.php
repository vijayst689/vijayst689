@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                        <div class="card-body p-4">
                            <form class="row g-4" onsubmit="return checkpayment(event)" action="{{ url('submitapply_pancard') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="service_amount" value="{{ $payment }}">
                                <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                <input type="hidden" name="ramjidebit_amount" id="ramjidebit_amount">
                                @if ($serviceid == 71)
                                    <div class="mb-3 col-md-6">
                                        <label for="aadhaar_no" class="form-label">Aadhaar Card No</label>
                                        <input required type="text" class="form-control number" maxlength="12" name="aadhaar_no" placeholder="Aadhaar Card No" />
                                    </div>
                                @elseif($serviceid == 69)

                                    <div class="mb-3 col-md-6">
                                        <label for="mode" class="form-label">Mode</label>
                                        <select required class="form-control" name="mode" style="width: 100%;">
                                            <option value="">Select</option>
                                            <option value="EKYC">EKYC (Pan without Signature)</option>
                                            <option value="ESIGN">ESIGN (Pan with Signature and Photo)</option>
                                        </select>
                                        <label for="mobile" class="form-label">Applicant Mobile Number</label>
                                        <input required class="form-control number" name="mobile"
                                            type="text" maxlength="10" style="width: 100%;"
                                            placeholder="Mobile Number">

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required class="form-control" name="name" type="text"
                                            maxlength="30" style="width: 100%;" placeholder="Name">

                                        <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                        <input required class="form-control number" name="aadhaar_no" type="text"  maxlength="12" style="width: 100%;" placeholder="Aadhaar Number">

                                    </div>
                                    @elseif($serviceid == 70)
                                    <div class="mb-3 col-md-6">
                                        <label for="mode" class="form-label">Mode</label>
                                        <select required class="form-control" name="mode" style="width: 100%;">
                                            <option value="">Select</option>
                                            <option value="EKYC">EKYC (Pan without Signature)</option>
                                            <option value="ESIGN">ESIGN (Pan with Signature and Photo)</option>
                                        </select>
                                        <label for="mobile" class="form-label">Applicant Mobile Number</label>
                                        <input required class="form-control number" name="mobile"
                                            type="text" maxlength="10" style="width: 100%;"
                                            placeholder="Mobile Number">

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required class="form-control" name="name" type="text"
                                            maxlength="30" style="width: 100%;" placeholder="Name">

                                        <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                        <input required class="form-control number" name="aadhaar_no" type="text"  maxlength="12" style="width: 100%;" placeholder="Aadhaar Number">

                                    </div>
                                @elseif($serviceid == 190)
                                <div class="mb-3 col-md-6">

                                        <label for="panno" class="form-label">PAN NO</label>
                                        <input required class="form-control" name="panno" type="text"  maxlength="10" style="width: 100%;" placeholder="PAN Number">

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
    </main>
@endsection
@push('page_scripts')
    <script>
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

        var serviceid = "{{ $serviceid }}";
 var ramjibalance = "{{ $mainbalance->rawallet }}";
    ramjibalance=parseFloat(ramjibalance);
    function checkpayment(e){
        if(serviceid == 69 || serviceid == 70){
            var amount = 103;
        }else if(serviceid == 71){
            var amount = 16;
        }
        if(amount > ramjibalance){
            alert("LOW BALANCE");
            $('#save').prop("disabled", true);
                    $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                        'color': 'red',
                        'font-size': '130%',
                        'font-weight': 'bold'
                    });
                    return false;
        }else{
            $("#nopayment").html("");
            $("#save").attr("disabled",true);
            $("#ramjidebit_amount").val(amount);
            return true;

        }
    }
    </script>
@endpush
