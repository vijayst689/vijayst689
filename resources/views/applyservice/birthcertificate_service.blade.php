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
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                            <form class="row g-4" action="{{ url('submitapply_birthcertificate') }}" enctype="multipart/form-data" onsubmit="return checkpayment(event)"
                            method="post" id="myForm">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="service_amount" value="{{ $payment }}">
                                <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                @if($serviceid == 155)
                                <div class="mb-3 col-md-6">
                                    <label for="childname" class="form-label">Child Name</label>
                                    <input required type="text" class="form-control"
                                    name="childname" maxlength="30"placeholder="Child Name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input required type="text" maxlength="10" class="form-control"
                                    name="mobile" placeholder="Mobile Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of birth</label>
                                    <input required type="date" class="form-control"
                                        name="date_of_birth" placeholder="Date of birth" maxlength="10" />
                               </div>
                                <div class="mb-3 col-md-6">
                                <label class="form-label">Place of birth</label>
                                <select required id="place_of_birth" name="place_of_birth" class="form-control">
                                      <option value="">Select Place of birth</option>
                                      <option value="Hospital">Hospital</option>
                                      <option value="Home/others">Home/others</option>
                                </select>
                                <div class="" id="hospitalhide" class="form-control" style="display: none;">
                                    <label>Hospital</label>
                                    <input class="form-control" id="hospital_name" type="text" name="hospital_name" maxlength="50" placeholder="Hospital Name" />
                                </div>

                                </div>
                                @elseif($serviceid == 156)
                                @endif
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
    $('#place_of_birth').change(function(){
        if($('#place_of_birth').val() == 'Hospital') {
            $('#hospitalhide').show("slow");
            $('#hospital_name').prop("required", true);
        }else{
            $('#hospitalhide').hide("slow");
            $('#hospital_name').prop("required", false);
        }
    });
</script>
@endpush
