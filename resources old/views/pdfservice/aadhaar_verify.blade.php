@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-danger">{{ $servicename }}</h5>
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong> {{ session('success') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong> {{ session('error') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    </div>
                    @endif
                    <form onsubmit="return checkpayment(event)" action="{{ url('/submitaadhaar_verify') }}"
                    id="formAccountSettings" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="amount" id="amount">
                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                    <input type="hidden" name="servicepayment" value="{{ $payment }}">
                    <div class="row">
                      
                  <div class="mb-3 col-md-6">
                    <label for="rc_no" class="form-label">Aadhaar Number</label>
                    <input class="form-control number" type="text" value="{{ old('aadhaar_no') }}" name="aadhaar_no" maxlength="12" required
                    autofocus placeholder="Enter Aadhaar Number" />
                </div>

            </div>
            <div class="row">
                      
                  <div class="mb-3 col-md-6">
                    <label for="rc_no" class="form-label">Enter Captcha</label>
                    <input class="form-control" type="text" name="captcha_data" maxlength="12" required
                    autofocus placeholder="Enter Captcha" />
                </div>

                 <div class="mb-3 col-md-6">
                    <label for="rc_no" class="form-label">Captcha</label>
                   <img src="" id="captcha_img">
                </div>
                <input  type="hidden" name="captcha_txid" id="captcha_txid"/>
            </div>
            <div class="mt-2 text-center" id="nopayment"></div>
            <div class="mt-2 text-center">
                <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
            </div>
        </form>
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Aadhaar Number</th>
                        <th>Masked Mobile</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Datetime</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($aadhaar_verify as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->aadhaar_no }}</td>
                                            <td>{{ $ser->mobile }}</td>
                                            <td>{{ $ser->gender }}</td>
                                            <td>{{ $ser->age }}</td>
                                            <td>{{ $ser->address }}</td>
                                          
                                            <td>{{ $ser->date }}</td>

                                                    </tr>
                                                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
@push('page_scripts')
<script>
    $(function() {

                var url = "{{ url('/getcaptcha') }}";
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if(result.status == "100"){
                    //alert(result.statusMessage);
                    $('#captcha_img').attr("src",result.captchaBase64String);
                    //$("#captcha_img").val(result.captchaBase64String);
                    $("#captcha_txid").val(result.captchaTxnId);

                }else{
                   
                    alert(result.statusMessage);
                }
            }
        });

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
     var amount = "{{ $amount }}";
    ramjibalance=parseFloat(ramjibalance);
    amount=parseInt(amount);
    function checkpayment(e){
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
            $("#amount").val(amount);
            return true;

        }
    }

</script>
@endpush
