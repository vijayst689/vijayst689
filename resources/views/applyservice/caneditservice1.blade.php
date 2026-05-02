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
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span>
                            </h6>
                            <form class="row g-4" action="{{ url('submitapply_canedit') }}" enctype="multipart/form-data" onsubmit="return checkpayment(event)"
                                method="post" id="myForm">
                                @csrf
                                <div class="row mt-3">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                   @if($serviceid == 65)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="applicant_name"
                                                class="form-label">Applicant Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="applicant_name" placeholder="Applicant Name" />

                                            <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="aadhaar_number" class="form-label"> Aadhaar
                                                Number</label>
                                            <input required type="text" class="form-control number"
                                                name="aadhaar_number" placeholder="Aadhaar Number" maxlength="12" />

                                            <label style="color:#23e156" for="certificate_name"
                                                class="form-label number"> Certificate Name</label>
                                            <select required id="certificate_name" name="certificate_name" class="form-control">
                                                <option value="">Select certificate</option>
                                                <option value="Income certificate">Income certificate</option>
                                                <option value="Nativity certificate">Nativity certificate </option>
                                                <option value="Residential certificate">Residential certificate </option>
                                                <option value="First Graduation certificate">First Graduation certificate
                                                </option>
                                                <option value="Community certificate">Community certificate</option>
                                                <option value="Obc Certificate">Obc Certificate </option>
                                                <option value="No marriage certificate">No marriage certificate </option>
                                                <option value="Small farmer certificate">Small farmer certificate </option>
                                                <option value="Old age pension certificate">Old age pension certificate
                                                </option>
                                                <option value="No male child certificate">No male child certificate
                                                </option>
                                                <option value="Widow certificate">Widow certificate</option>
                                            </select>
                                        </div>
                                   
                                    @elseif($serviceid == 67)
                                         <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="applicant_name"
                                                class="form-label">Applicant Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="applicant_name" placeholder="Applicant Name" />
                                            {{-- <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card
                                                (Front & Back)</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" /> --}}
                                                <label style="color:#23e156" for="certificate_number"
                                                class="form-label number">Legal Heir Certificate Number</label>
                                            <select required id="certificate_number" name="certificate_number"
                                                class="form-control">
                                                <option value="">Select certificate</option>
                                                <option value="Legal Heir Certificate">Legal Heir Certificate</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label"> Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            
                                        </div>
                                     @elseif($serviceid == 225)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="can_number" class="form-label">Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="applicant_name"
                                                class="form-label">Applicant Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="applicant_name" placeholder="Applicant Name" />
                                           
                                        </div>
                                        <div class="mb-3 col-md-6">
                                             <label style="color:#23e156" for="certificate_number"
                                                class="form-label">Certificate Number</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="certificate_number" placeholder="Certificate Number" />
                                            {{-- <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front
                                                & Back) </label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" /> --}}
                                            <label style="color:#23e156" for="certificate_name"
                                                class="form-label">Certificate Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="certificate_name" placeholder="Certificate Name" />
                                        </div>
                                    @elseif($serviceid == 226)
                                        <div class="mb-3 col-md-6">
                                           <label style="color:#23e156" for="can_number" class="form-label">Can
                                                Number</label>
                                            <input required type="text" class="form-control" name="can_number"
                                                placeholder="Can Number" maxlength="30" />
                                            <label style="color:#23e156" for="applicant_name"
                                                class="form-label">Applicant Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="applicant_name" placeholder="Applicant Name" />
                                           
                                        </div>
                                        <div class="mb-3 col-md-6">
                                             <label style="color:#23e156" for="certificate_number"
                                                class="form-label">Certificate Number</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="certificate_number" placeholder="Certificate Number" />
                                            {{-- <label for="aadhaar_card" class="form-label text-danger"> Aadhaar Card (Front)
                                            </label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" /> --}}
                                            <label style="color:#23e156" for="certificate_name"
                                                class="form-label">Certificate Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="certificate_name" placeholder="Certificate Name" />
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
                    var ramjibalance = "{{ $mainbalance->rawallet }}";
                    //alert(ramjibalance);
                    ramjibalance = parseFloat(ramjibalance);

                    function checkpayment(e) {
                        var amount = {{ $admin_payment }};
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
                            $("#ramjidebit_amount").val(amount);
                            return true;

                        }
                    }
        $('#district_id').on('change', function() {
            var district_id = this.value;
            $("#taluk").html('');
            var url = "{{ url('service/get_taluk') }}/" + district_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
@endpush
