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
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form onsubmit="return checkpayment(event)" action="{{ url('submitutislnew') }}"
                               id="myForm" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="servicepayment" value="{{ $payment }}">
                                <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required class="form-control" name="name" type="text" maxlength="30"
                                            style="width: 100%;" placeholder="Name">

                                        <label for="aadhaar_pdf" class="form-label">Aadhaar Pdf</label>
                                        <input required class="form-control" accept="application/pdf,image/x-eps"
                                            name="aadhaar_pdf" type="file" style="width: 100%;">

                                        <label for="signature" class="form-label">Signature</label>
                                        <input required class="form-control" name="signature" type="file"
                                            style="width: 100%;">

                                        <label for="father_name" class="form-label">Father Name</label>
                                        <input required class="form-control" name="father_name" type="text"
                                            maxlength="30" style="width: 100%;" placeholder="Father Name">
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        <label for="mobile" class="form-label">Mobile No</label>
                                        <input required class="form-control number" name="mobile" type="text"
                                            maxlength="10" style="width: 100%;" placeholder="Mobile Number">

                                        <label for="photo" class="form-label">Photo</label>
                                        <input required class="form-control" name="photo" type="file"
                                            style="width: 100%;">

                                        <label for="email" class="form-label">Email</label>
                                        <input required class="form-control" name="email" type="text" maxlength="70"
                                            style="width: 100%;" placeholder="E-Mail">

                                        <label for="date_of_birth" class="form-label">DOB</label>
                                        <input required class="form-control" name="date_of_birth" type="date"
                                            style="width: 100%;">

                                    </div>
                                </div>
                                <div class="text-center">
                                    <p id="nopayment"></p>
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
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
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
        
        var wallet = "{{ Auth::user()->wallet }}";
        var amount = "{{ $payment }}";

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
