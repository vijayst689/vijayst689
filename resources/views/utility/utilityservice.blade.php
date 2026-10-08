@extends('layouts.app')
@section('content')
    <style>
        body {
            background-color: #FF3CAC;
            background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%);
            background-repeat: no-repeat;
            background-repeat: no-repeat;
            background-size: cover;
            min-width: 100%;
            min-height: 100vh;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body"
                    style="background: rgb(34,193,195);
                             background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%);">
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
                    <form class="row g-4" onsubmit="return checkpayment(event)" action="{{ url('proceedrecharge') }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <h1 class="card-title mt-2">{{ $servicename }}</h1>
                        @if ($serviceid == 1)
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label style="font-size:20px;color: red;" for="mobile_number" class="form-label">Mobile
                                        Number</label>
                                    <input required type="text" class="form-control number" name="mobile" maxlength="10"
                                        placeholder="Mobile Number" />

                                    <label style="font-size:20px;color: red;" for="circle" class="form-label">Select
                                        Circle</label>
                                    <select required name="circle" class="form-control">
                                        <option value="">Select</option>
                                        <option value="9">Karnataka</option>
                                        <option value="14">Kerala</option>
                                        <option selected value="8">Tamil Nadu</option>
                                    </select>

                                    <label style="font-size:20px;color: red;" for="operator" class="form-label">Select
                                        Operator</label>
                                    <select required name="operator" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($operator as $op)
                                            <option value="{{ $op->code }}">{{ $op->name }}</option>
                                        @endforeach
                                    </select>

                                    <label style="font-size:20px;color: red;" for="amount" class="form-label">Recharge
                                        Amount</label>
                                    <input required type="text" id="amount" class="form-control number" name="amount"
                                        maxlength="5" placeholder="Amount" />
                                </div>
                            </div>
                        @elseif($serviceid == 2)
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label style="font-size:20px;color: red;" for="mobile_number" class="form-label">DTH
                                        NUMBER</label>
                                    <input required type="text" class="form-control number" name="mobile" maxlength="15"
                                        placeholder="DTH Number" />

                                    <label style="font-size:20px;color: red;" for="circle" class="form-label">Select
                                        Circle</label>
                                    <select required name="circle" class="form-control">
                                        <option value="">Select</option>
                                        <option value="9">Karnataka</option>
                                        <option value="14">Kerala</option>
                                        <option selected value="8">Tamil Nadu</option>
                                    </select>

                                    <label style="font-size:20px;color: red;" for="operator" class="form-label">Select
                                        Operator</label>
                                    <select required name="operator" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($operator as $op)
                                            <option value="{{ $op->code }}">{{ $op->name }}</option>
                                        @endforeach
                                    </select>

                                    <label style="font-size:20px;color: red;" for="amount" class="form-label">Recharge
                                        Amount</label>
                                    <input required type="text" id="1" class="form-control number" name="amount"
                                        maxlength="5" placeholder="Amount" />
                                </div>
                            </div>
                        @endif
                        <div class="text-center">
                            <div class="col-8">
                                <p id="nopayment"></p>
                                <div class="mb-0">
                                    <button id="save" type="submit" class="btn btn-warning">Proceed</button>
                                </div>
                            </div>
                        </div>
                        <div class="customer-table">
                            <div class="table-responsive white-space-nowrap">
                                <table id="example2" class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>User Id</th>
                                            <th>Mobile</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recha as $key => $r)
                                            <tr>
                                                <td class="text-white">{{ $r->user_id }}</td>
                                                <td class="text-white">{{ $r->mobile }}</td>
                                                <td class="text-white">{{ $r->amount }}</td>
                                                <td class="text-white">{{ $r->status }}</td>
                                                <td class="text-white">{{ $r->message }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $("#amount").keyup(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = $("#amount").val();
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", false);
            }
        });

        var ramjibalance = "{{ $mainbalance->rawallet }}";
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = $("#amount").val();
            amount = parseInt(amount);
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
                return true;

            }
        }

        function edit_retailer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status,
            dist_id, taluk_id, panchayath_id) {
            $("#editname").val(name);
            $("#editphone").val(phone);
            $("#editadhar").val(aadhaar_no);
            $("#editgender").val(gender);
            $("#editemail").val(email);
            $("#editdob").val(date_of_birth);
            $("#editaddress").val(address);
            $("#dist_id").val(dist_id);
            $("#retailer_id").val(id);
            $("#editretailer").modal("show");
        }

        function edit_status(id, status) {
            $("#upstatus").val(status);
            $("#request_id").val(id);
            $("#statusupdate").modal("show");
        }

        function statusupdates(id, status) {
            $("#editstatusupdate").val(status);
            $("#status_id").val(id);
            $("#statusup").modal("show");
        }
    </script>
@endpush
