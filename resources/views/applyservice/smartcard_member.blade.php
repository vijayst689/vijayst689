@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                        <div class="card-body p-4">
                            <form class="row g-4" action="{{ url('submitapply_smart_member') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Member</label>
                                        <select required id="add_member" name="add_member" class="form-control">
                                            <option value="">Select Member</option>
                                            <option value="Add 1 Member">Add 1 Member</option>
                                            <option value="Add 2 Member">Add 2 Member</option>
                                            <option value="Add 3 Member">Add 3 Member</option>
                                            <option value="Add 4 Member">Add 4 Member</option>
                                            <option value="Add 5 Member">Add 5 Member</option>
    
                                        </select>
                                        <div class="mb-3 col-md-6">
                                            <label>Smart Card</label>
                                            <input id="smart_card" class="form-control" required type="file"
                                                name="smart_card">
                                        </div>
                                    </div>
                                
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3 row" id="aadhaar_cardhide" style="display: none;">
                                            <label>Aadhaar Card</label>
                                            <input id="aadhaar_card" class="form-control" type="file"
                                                name="aadhaar_card">
                                        </div>
                                
                                        <div class="mb-3 row" id="aadhaar_card2hide" style="display: none;">
                                            <label>2nd Member Aadhaar Card</label>
                                            <input id="aadhaar_card2" class="form-control" type="file"
                                                name="aadhaar_card2">
                                        </div>
                                       
                                        <div class="mb-3 row" id="aadhaar_card3hide" style="display: none;">
                                            <label>3rd Member Aadhaar Card</label>
                                            <input id="aadhaar_card3" class="form-control" type="file"
                                                name="aadhaar_card3">
                                        </div>
                                       
                                        <div class="mb-3 row" id="aadhaar_card4hide" style="display: none;">
                                            <label>4th Member Aadhaar Card</label>
                                            <input id="aadhaar_card4" class="form-control" type="file"
                                                name="aadhaar_card4">
                                        </div>
                                       
                                        <div class="mb-3 row" id="aadhaar_card5hide" style="display: none;">
                                            <label>5th Member Aadhaar Card</label>
                                            <input id="aadhaar_card5" class="form-control" type="file"
                                                name="aadhaar_card5">
                                        </div>
                                        
                                        </div>
                                    </div>
                                
                                </div>

                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
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
    </main>
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

        $('#add_member').change(function() {
            if ($('#add_member').val() == 'Add 1 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#add_member').val() == 'Add 2 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);

            } else if ($('#add_member').val() == 'Add 3 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);

            } else if ($('#add_member').val() == 'Add 4 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);

            } else if ($('#add_member').val() == 'Add 5 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').show("slow");
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);
                $('#aadhaar_card5').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);               

            }
        });
    </script>
@endpush
