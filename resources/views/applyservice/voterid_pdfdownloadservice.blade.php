@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
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
        <!--end breadcrumb-->
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
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                            <h5 class="card-title mt-2">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span
                                    class="text-danger">{{ $payment }}</span></h6>
                            <div class="card-body p-4">
                                <form class="row g-4" action="{{ url('submitapply_voteridpdfdownload') }}"
                                    enctype="multipart/form-data" method="post" id="myForm">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" name="service_amount" value="{{ $payment }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                        @if ($serviceid == 69)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                        @elseif ($serviceid == 70)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <h2 class="card-title">வாக்காளர் அட்டையுடன் இணைக்க வேண்டிய செல் நம்பருக்கு வரும் OTP யை கொடுக்க வேண்டும். ஒத்துழைப்பு தரும் பட்சத்தில் உடனடியாக இணைத்து தரப்படும்.</h2>
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        @elseif ($serviceid == 71)
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Voter Id Number/Epic Number</label>
                                            <input required type="text" maxlength="15" class="form-control"
                                                name="epic_no" placeholder="Voter Id Number/Epic Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name As Per Aadhaar</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="name" placeholder="Name" />
                                        </div>
                                         <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        @endif
                                        <div class="text-center">
                                            <p id="nopayment"></p>
                                        </div>
                                        <div class="text-center">
                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <button id="save" type="submit"
                                                        class="btn btn-primary">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
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