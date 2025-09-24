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
                    <form onsubmit="return checkpayment(event)" action="{{ url('/submitgstfind') }}"
                        id="formAccountSettings" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="amount" id="amount">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="servicepayment" value="{{ $payment }}">

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="pan_no" class="form-label">Pan Number</label>
                                <input class="form-control" type="text" name="pan_no" maxlength="10" required
                                    placeholder="Pan Number" />
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
                                        <th>Pan Number</th>
                                        <th>GST No</th>
                                        <th>Name</th>
                                        <th>State</th>
                                        <th>GST Status</th>
                                        <th>Trade Name</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gst_verify as $key => $gst)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $gst->pan_no }}</td>
                                            <td>{{ $gst->gstin }}</td>
                                            <td>{{ $gst->legal_name }}</td>
                                            <td>{{ $gst->state_jurisdiction }}</td>
                                            <td>{{ $gst->gst_status }}</td>
                                            <td>{{ $gst->trade_name }}</td>
                                            <td>{{ $gst->primary_address }}</td>
                                            <td>{{ $gst->registration_date }}</td>
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
    </script>
@endpush
