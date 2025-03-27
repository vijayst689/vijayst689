@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ $servicename }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
              
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form onsubmit="return checkpayment(event)" action="{{ url('/submitnewpancard') }}"
                        id="formAccountSettings" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="amount" id="amount">
                        <input type="hidden" name="serviceid"  value="{{ $serviceid }}">
                        <input type="hidden" name="servicepayment" value="{{ $payment }}">
                        <div class="row">
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
                        </div>
                        <div class="mt-2 text-center" id="nopayment"></div>
                        <div class="mt-2 text-center">
                            <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </form>
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Mobile</th>
                                        <th width="20%">Message</th>
                                        <th>Amount</th>
                                        <th>Datetime</th>
                                        <th>Status</th>
                                        <th>Text</th>
                                        <th width="20%">Remark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pandetails as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->mobile }}</td>
                                            <td>{{ $ser->message }}</td>
                                            <td>{{ $ser->amount }}</td>
                                            <td>{{ $ser->applied_date }}</td>
                                            <td>{{ $ser->status }}</td>
                                            @if($ser->status == "Failure")
                                            <td>Refunded</td>
                                            @else
                                            <td>{{ $ser->status }}</td>
                                            @endif
                                            <td>{{ $ser->opid }}</td>
                                            <td style="white-space: nowrap;">
                                                @if($ser->status == "Pending" || $ser->status == "Processing")
                                                <a href="{{ url('/pancard_reapply', $ser->api_txid) }}/{{ $ser->service_id }}" type="button"
                                                    style="font-size: small" class="btn-sm btn btn-primary">Reapply</a>
                                                @endif
                                            </td>

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
    </main>
@endsection
@push('page_scripts')
    <script>
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
    </script>
@endpush
