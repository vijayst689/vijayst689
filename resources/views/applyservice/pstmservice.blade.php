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
                            <form class="row g-4" action="{{ url('submitapply_pstm') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    <div class="row">
                                        <h4 class="text-center"> Individual Details </h4>
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Applicant Name</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Applicant Name" maxlength="100" />
                                            <label for="name" class="form-label">Applicant Name in Tamil</label>
                                            <input required type="text" class="form-control" name="name_tamil"
                                                placeholder="Applicant Name in Tamil" maxlength="100" />
                                            <label for="dob" class="form-label">Date of Birth(As per School
                                                Records)</label>
                                            <input required type="date" maxlength="10" class="form-control"
                                                name="dob" placeholder="DOB" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label">Father Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="father_name" placeholder="Father Name" />
                                            <label for="name" class="form-label">Father Name in Tamil</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="father_name_tamil" placeholder="Father Name in Tamil" />
                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="name" class="form-label number">Mother Name</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="mother_name" placeholder="Mother Name" />
                                            <label for="name" class="form-label number">Mother Name in Tamil</label>
                                            <input required type="text" maxlength="100" class="form-control"
                                                name="mother_name_tamil" placeholder="Mother Name in Tamil" />
                                            <label for="emis_id" class="form-label">EMIS ID</label>
                                            <input required type="text" maxlength="20" class="form-control"
                                                name="emis_id" placeholder="EMIS ID" />

                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4 class="text-center"> School Details </h4>
                                        <div class="mb-3 col-md-4">
                                            <label for="academic_yr_from" class="form-label">Academic Year From</label>
                                            <select required id="academic_yr_from" name="academic_yr_from"
                                                class="form-control">
                                                <option value="">Select</option>
                                                @php
                                                    $startYear = 1970;
                                                    $currentYear = date('Y');
                                                    $endYear = $currentYear;

                                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                                        $nextYear = $year + 1;
                                                        echo "<option value=\"$year - $nextYear\">{$year}-{$nextYear}</option>";
                                                    }
                                                @endphp
                                            </select>
                                            <label for="class" class="form-label">Class To</label>
                                            <select required id="class_to" name="class_to" class="form-control">
                                                <option value="">Select</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                                <option value="VII">VII</option>
                                                <option value="VIII">VIII</option>
                                                <option value="IX">IX</option>
                                                <option value="X">X</option>
                                                <option value="XI">XI</option>
                                                <option value="XII">XII</option>
                                            </select>
                                            <label for="class" class="form-label">School Type</label>
                                            <select required id="school_type" name="school_type" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Government">Government</option>
                                                <option value="Fully Aided">Fully Aided</option>
                                                <option value="Partially Aided">Partially Aided</option>
                                            </select>

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="academic_yr_to" class="form-label">Academic Year To</label>
                                            <select required id="academic_yr_to" name="academic_yr_to"
                                                class="form-control">
                                                <option value="">Select</option>
                                                @php
                                                    $startYear = 1970;
                                                    $currentYear = date('Y');
                                                    $endYear = $currentYear;

                                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                                        $nextYear = $year + 1;
                                                        echo "<option value=\"$year - $nextYear\">{$year}-{$nextYear}</option>";
                                                    }
                                                @endphp
                                            </select>
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="school_name" class="form-label">School Name</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="school_name" placeholder="School Name" />

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="class" class="form-label">Class From</label>
                                            <select required id="class_from" name="class_from" class="form-control">
                                                <option value="">Select</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                                <option value="VII">VII</option>
                                                <option value="VIII">VIII</option>
                                                <option value="IX">IX</option>
                                                <option value="X">X</option>
                                                <option value="XI">XI</option>
                                                <option value="XII">XII</option>
                                            </select>

                                            <label for="block" class="form-label">Block</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="block" placeholder="Block" />

                                            <label>Upload copy of TC</label>
                                            <input id="tc" class="form-control" required type="file"
                                                name="tc">
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
    </script>
@endpush
