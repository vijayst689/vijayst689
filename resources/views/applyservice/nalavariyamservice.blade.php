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
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_itr') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                               <div class="row">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="service_amount" value="{{ $payment }}">
                        <input type="hidden" name="user_id" value="{{ $customers->id }}">

                        @if ($serviceid == 76)

                            <div class="mb-3 col-md-6">
                            <label for="register_number" class="form-label">Register Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="register_number" placeholder="Register Number"/>
                           
                        </div>   
                        <div class="mb-3 col-md-6">
                            <label for="adhaar_number" class="form-label">Adhaar Number</label>
                            <input required type="text" class="form-control" maxlength="13"
                            name="adhaar_number" placeholder="Adhaar Number"/>
                        </div> 

                        @elseif ($serviceid == 77)
                        <div class="mb-3 col-md-6">
                            <label for="register_number" class="form-label">Register Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="register_number" placeholder="Register Number"/>
                        </div>     
                        <div class="mb-3 col-md-6">
                            <label for="cell_number" class="form-label">Cell Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="cell_number" placeholder="Cell Number"/>
                        </div>  
                        <div class="mb-3 col-md-6">
                            <label for="dob" class="form-label">DOB</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="dob" placeholder="DOB"/>
                        </div> 
                      

                        @elseif ($serviceid == 78)
                        <div class="mb-3 col-md-6">
                            <label for="register_number" class="form-label">Register Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="register_number" placeholder="Register Number"/>
                        </div>     
                        <div class="mb-3 col-md-6">
                            <label for="adhaar_number" class="form-label">Adhaar Number</label>
                            <input required type="text" class="form-control" maxlength="13"
                            name="adhaar_number" placeholder="Adhaar Number"/>
                        </div> 
                        <div class="mb-3 col-md-6">
                            <label for="cell_number" class="form-label">Cell Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="cell_number" placeholder="Cell Number"/>
                        </div> 

                        @elseif ($serviceid == 79)
                        <div class="mb-3 col-md-6">
                            <label for="register_number" class="form-label">Register Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="register_number" placeholder="Register Number"/>
                        </div>        
                        <div class="mb-3 col-md-6">
                            <label for="cell_number" class="form-label">Cell Number</label>
                            <input required type="text" class="form-control" maxlength="30"
                            name="cell_number" placeholder="Cell Number"/>
                        </div> 
                        <div class="mb-3 col-md-6">
                            <label for="cell_number" class="form-label">Photo</label>
                            <input required type="file" class="form-control" maxlength="30"
                            name="cell_number" placeholder="Cell Number"/>
                        </div> 
                       
                        <div class="mb-3 col-md-6">
                            <label for="signature" class="form-label">Signature</label>
                            <input required type="file" class="form-control" maxlength="30" name="cell_number"/>
                        </div> 
                        @endif   

                         <div class="text-center"><p id="nopayment"></p></div>
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
