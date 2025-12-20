@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $servicename }}</div>
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
                <form onsubmit="return checkpayment(event)" action="{{ url('/submitvoterfind') }}"
                    id="formAccountSettings" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="amount" id="amount">
                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                    <input type="hidden" name="servicepayment" value="{{ $payment }}">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input" type="radio" name="ser" id="inlineRadio1" value="1" />
                                <label class="form-check-label" for="inlineRadio1">Server 1</label>
                            </div>

                            <!--  <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="ser" id="inlineRadio2" value="2" />
                          <label class="form-check-label" for="inlineRadio2">Server 2</label>
                      </div> -->

                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="epic_no" class="form-label">E-pic Number</label>
                            <input class="form-control" type="text" name="epic_no" maxlength="10" required id="epic_no"
                                autofocus placeholder="E-pic Number" />
                        </div>
                        <div id="verifybtnhide" class="form-label col-sm-2 mt-4">
                            <button onclick="getepicdata();" id="getepic" class="btn btn-primary" type="button">Verify Epic</button>
                        </div>
                    </div>
                    <div class="row" style="display: none" id="svnshow">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" id="name" maxlength="80" required
                                autofocus placeholder="Name" />
                        </div>
                        <div class="mb-3 col-md-6">

                            <label for="state_name" class="form-label">State</label>
                            <input class="form-control" type="text" id="state" name="state_name" maxlength="50" required
                                autofocus placeholder="State Name" />
                        </div>
                    </div>

                    <div class="row" id="verifyotphide" style="display: none">
                        <div class="mb-3 col-md-4">
                            <label for="mobile" class="form-label">Enter Mobile Number</label>
                            <input class="form-control number" type="text" name="mobile" maxlength="10" required id="mobile" placeholder="Enter Mobile Number" />
                        </div>
                        <div class="form-label col-sm-2 mt-4" id="otpbtnhide">
                            <button onclick="getotp();" id="checkotp" class="btn btn-success" type="button">GET OTP</button>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4" id="otphide" style="display: none;">
                        <label for="mobile" class="form-label">Enter OTP</label>
                        <input class="form-control number" type="text" name="otp" maxlength="6" required id="otp" placeholder="Enter OTP" />
                    </div>

                    <div class="mt-2 text-center" id="nopayment"></div>
                    <div class="mt-2 text-center" id="submithide" style="display: none;">
                        <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
                <div class="customer-table">
                    <div class="table-responsive white-space-nowrap">
                        <table id="example2" class="table align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl No</th>
                                    <th>EPIC Number</th>
                                    <th>Name</th>
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
    });

    function getepicdata() {
        var ebic = $("#epic_no").val().trim();
        if (ebic == "") {
            alert("Please Enter EPic Number");
            $("#epic_no").focus();
            return false;
        }
        var ebic_length = ebic.length;
        if (ebic_length < 10) {
            alert("Entered EPic Number is Incorrect");
            $("#epic_no").focus();
            return false;
        }
        $("#getepic").attr("disabled", true);
        var url = "{{ url('/getepic') }}/" + ebic;
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.Status == "Success") {
                    alert(result.message);
                    $("#name").val(result.name);
                    $("#state").val(result.state);

                    $("#verifybtnhide").hide();
                    $("#verifyotphide").show();
                    $("#svnshow").hide();
                    $("#svnshow").show();
                    $("#epic_no").attr("readonly", true);
                } else {
                    $("#getepic").attr("disabled", false);
                    alert(result.message);
                }
            }
        });

    }

    function getotp() {
        var mobile = $("#mobile").val().trim();
        var epic = $("#epic_no").val().trim();
        if (mobile == "") {
            alert("Please Enter Mobile Number");
            $("#mobile").focus();
            return false;
        }
        var mobile_length = mobile.length;
        if (mobile_length < 10) {
            alert("Please Enter Mobile Number Correctly");
            $("#mobile").focus();
            return false;
        }
        $("#checkotp").attr("disabled", true);
        var url = "{{ url('/getotp') }}/" + mobile;
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.Status == "Success") {
                    alert(result.message);
                    $("#checkotp").attr("disabled", false);
                    $("#otpbtnhide").hide();
                    $("#otphide").show();
                    $("#submithide").show();
                    $("#mobile").attr("readonly", true);
                } else {
                    alert(result.message);
                    $("#checkotp").attr("disabled", false);
                }
            }
        });


    }
</script>
@endpush