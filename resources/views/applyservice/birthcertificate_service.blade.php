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
                        <form class="row g-4" action="{{ url('submitapply_birthcertificate') }}" enctype="multipart/form-data"
                            method="post" id="myForm" onsubmit="return checkpayment(event)">
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
                                    <input  required type="text" maxlength="10" class="form-control"
                                    name="mobile" placeholder="Mobile Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of birth</label>
                                    <input required type="date" class="form-control"
                                        name="date_of_birth" placeholder="Date of birth" maxlength="10" />
                               </div>
                               <div class="mb-3 col-md-6">
                                <label for="district_name" class="form-label">District</label>
                                <select required name="dist_id" id="dist_id" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $d)
                                        <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                <label class="form-label">Place of Birth</label>
                                <select required id="place_of_birth" name="place_of_birth" class="form-control">
                                      <option value="">Select Place of Birth</option>
                                      <option value="Hospital">Hospital</option>
                                      <option value="Home/others">Home/others</option>
                                </select>
                                <div class="" id="hospitalhide" class="form-control" style="display: none;">
                                    <label>Hospital</label>
                                    <input class="form-control" id="hospital_name" type="text" name="hospital_name" maxlength="100" placeholder="Hospital Name" />
                                </div>
                                    
                                </div>
                                @elseif($serviceid == 156)
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control"
                                    name="name" maxlength="30"placeholder="Name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input required type="text" maxlength="10" class="form-control"
                                    name="mobile" placeholder="Mobile Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="date_of_death" class="form-label">Date of Death</label>
                                    <input required type="date" class="form-control"
                                        name="date_of_death" placeholder="Date of Death" maxlength="10" />
                               </div>
                               <div class="mb-3 col-md-6">
                                <label for="district_name" class="form-label">District</label>
                                <select required name="dist_id" id="dist_id" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $d)
                                        <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Place of Death</label>
                                    <select required id="place_of_death" name="place_of_birth" class="form-control">
                                          <option value="">Select Place of Death</option>
                                          <option value="Hospital">Hospital</option>
                                          <option value="Home/others">Home/others</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="" id="hospital" class="form-control" style="display: none;">
                                        <label>Hospital</label>
                                        <input class="form-control" id="hospital_name" type="text" name="hospital_name" maxlength="100" placeholder="Hospital Name" />
                                    </div>
                                </div>
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
    $('#place_of_death').change(function(){
        if($('#place_of_death').val() == 'Hospital') {
            $('#hospital').show("slow"); 
            $('#hospital_name').prop("required", true);  
        }else{
            $('#hospital').hide("slow");
            $('#hospital_name').prop("required", false); 
        } 
    });
</script>
@endpush