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
                        <form onsubmit="return checkpayment(event)" action="{{ url('/submitgstfind') }}"
                            id="formAccountSettings" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="servicepayment" value="{{ $payment }}">
                            <div class="row">

                                <div class="mb-3 col-md-6">
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
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
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
