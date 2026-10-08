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
                        <form onsubmit="return checkpayment(event)" action="{{ url('/submitrationfind') }}"
                            id="formAccountSettings" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="amount" id="amount">
                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                            <input type="hidden" name="servicepayment" value="{{ $payment }}">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input class="form-control" type="text" name="aadhaar_no" maxlength="12" required
                                        autofocus placeholder="Aadhaar Number" />
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
                                        <th>Aadhaar Number</th>
                                        <th>Number</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($rationdetails as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->aadhaar_no }}</td>
                                            @php
                                                $pdf = $ser->pdf;

                                                // If ration number exists → show number only
                                                if (!empty($pdf) && is_numeric($pdf)) {
                                                    $content = $pdf;
                                                } else {
                                                    // Old file data → download button
                                                    if (filter_var($pdf, FILTER_VALIDATE_URL)) {
                                                        $url = $pdf;
                                                    } else {
                                                        $url = url('upload/smartpdf/' . $pdf);
                                                    }

                                                    $content =
                                                        '<a href="' .
                                                        $url .
                                                        '" download class="btn btn-primary btn-sm">Download</a>';
                                                }
                                            @endphp

                                            <td>{!! $content !!}</td>

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
