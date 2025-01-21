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
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form onsubmit="return checkpayment(event)" action="{{ url('/submitdlfind') }}" id="formAccountSettings" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="amount" id="amount">
                    <input type="hidden" name="serviceid"  value="{{ $serviceid }}">
                    <input type="hidden" name="servicepayment" value="{{ $payment }}">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                          <label for="aadhaar_no" class="form-label">Driving License Number</label>
                          <input class="form-control" type="text" name="dl_no" maxlength="20" required autofocus
                          placeholder="Enter Driving License Number" />
                      </div>

                       <div class="mb-3 col-md-6">
                          <label for="aadhaar_no" class="form-label">Date of Birth</label>
                          <input class="form-control" type="date" name="dob"  required autofocus/>
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
                                        <th>DL Number</th>
                                        <th>DOB</th>
                                        <th>PDF</th>
                                        <th>Amount</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dldetails as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->dlnumber }}</td>
                                            <td>{{ $ser->dob }}</td>
                                             @if (pathinfo($ser->pdf, PATHINFO_EXTENSION) != 'pdf')
                                            <td><a href="<?php echo $ser->pdf; ?>" download class="btn btn-primary btn-sm">Download</a></td>
                                            @else
                                            <td><a href="{{ url('/') }}/upload/dl/{{ $ser->pdf }}" download class="btn btn-primary btn-sm">Download</a></td>
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
