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
                        <form onsubmit="return checkpayment(event)" action="{{ url('/submitvoterpdf') }}"
                            id="formAccountSettings" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="servicepayment" value="{{ $payment }}">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="epic_no" class="form-label">E-pic  Number</label>
                                    <input class="form-control" type="text" name="epic_no" maxlength="10" required id="epic_no"
                                        autofocus placeholder="E-pic Number" />
                                </div>
                                <div id="verifybtnhide" class="form-label col-sm-2 mt-4" >
                                    <button onclick="getpdfotp();" id="getepic" class="btn btn-primary" type="button">Verify Epic</button>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="svnshow">
                                <div class="mb-3 col-md-6" >
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" maxlength="80" required
                                        autofocus placeholder="Name" />
                                </div>
                                <div class="mb-3 col-md-6" >
                                    <label for="stateCd" class="form-label">State Code</label>
                                    <input class="form-control" type="text" name="stateCd" id="stateCd" maxlength="10" required readonly autofocus placeholder="State Code" />
                                </div>
                                <div class="mb-3 col-md-6" >
                                    <div class="mb-3 col-md-6" id="otphide" style="display: none;">
                                        <label for="mobile" class="form-label">Enter OTP</label>
                                        <input class="form-control number" type="text" name="otp" maxlength="6" required id="otp" placeholder="Enter OTP" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 text-center" id="nopayment"></div>
                            <div class="mt-2 text-center" id="submithide" style="display: none;">
                                <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>EPIC Number</th>
                                        <th>Name</th>
                                        <th>PDF</th>
                                        <th>Amount</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($voterdetails as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->epic_no }}</td>
                                            <td>{{ $ser->name }}</td>
                                            @if (pathinfo($ser->pdf, PATHINFO_EXTENSION) != 'pdf')
                                            <td><a href="<?php echo $ser->pdf; ?>" download class="btn btn-primary btn-sm">Download</a></td>
                                            @else
                                            <td><a href="{{ url('/') }}/upload/voterpdf/{{ $ser->pdf }}" download class="btn btn-primary btn-sm">Download</a></td>
                                            @endif
                                            <td>{{ $ser->amount }}</td>
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
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        var amount = "{{ $amount }}";
        ramjibalance = parseFloat(ramjibalance);
        amount = parseInt(amount);

        function checkpayment(e) {
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
                $("#amount").val(amount);
                return true;

            }
        }

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
            $("#submithide").hide();
        });


        function getpdfotp(){
        var epic = $("#epic_no").val().trim();
        if(epic == ""){
            alert("Please Enter EPic Number");
            $("#epic_no").focus();
            return false;
        }
        var ebic_length = epic.length;
        if(ebic_length < 10){
            alert("Entered EPic Number is Incorrect");
            $("#epic_no").focus();
            return false;
        }
        $("#getepic").attr("disabled",true);
        var url = "{{ url('/getpdfotp') }}/"+epic;
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if(result.Status == "Success"){
                    alert(result.message);
                    $("#name").val(result.name);
                    $("#stateCd").val(result.stateCd);

                    $("#verifybtnhide").hide();
                    $("#verifyotphide").show();
                    $("#svnshow").hide();
                    $("#svnshow").show();
                    $("#otphide").show();
                    $("#submithide").show();
                    $("#epic_no").attr("readonly",true);
                }else{
                    $("#getepic").attr("disabled",false);
                    alert(result.message);
                }
            }
        });

    }
    </script>
@endpush
