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
                             <form class="row g-4" action="{{ url('submitapply_pstm') }}" enctype="multipart/form-data"
                            method="post">
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
                                    <label for="dob" class="form-label">Date of Birth(As per School Records)</label>
                                    <input required type="date" maxlength="10" class="form-control" name="dob"
                                        placeholder="DOB" />

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label">Father Name</label>
                                    <input required type="text" maxlength="100" class="form-control" name="father_name"
                                        placeholder="Father Name" />
                                        <label for="name" class="form-label">Father Name in Tamil</label>
                                    <input required type="text" maxlength="100" class="form-control" name="father_name_tamil"
                                        placeholder="Father Name in Tamil" />
                                        <label for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" maxlength="10" class="form-control" name="mobile"
                                            placeholder="Mobile Number" />

                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="name" class="form-label number">Mother Name</label>
                                    <input required type="text" maxlength="100" class="form-control" name="mother_name"
                                        placeholder="Mother Name" />
                                    <label for="name" class="form-label number">Mother Name in Tamil</label>
                                    <input required type="text" maxlength="100" class="form-control" name="mother_name_tamil"
                                        placeholder="Mother Name in Tamil" />
                                    <label for="emis_id" class="form-label">EMIS ID</label>
                                    <input required type="text" maxlength="20" class="form-control" name="emis_id"
                                        placeholder="EMIS ID" />

                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center"> School Details </h4>
                                <div class="mb-3 col-md-4">
                                    <label for="academic_yr_from" class="form-label">Academic Year From</label>
                                    <select required id="academic_yr_from" name="academic_yr_from" class="form-control">
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
                                        <select required id="academic_yr_to" name="academic_yr_to" class="form-control">
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
                                            @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                            @endforeach
                                    </select>
                                    <label for="school_name" class="form-label">School Name</label>
                                    <input required type="text" maxlength="500" class="form-control" name="school_name"
                                        placeholder="School Name" />

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
                                    <input required type="text" maxlength="30" class="form-control" name="block"
                                        placeholder="Block" />
                                    
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

    $('#dist_id').on('change', function() {
        var dist_id = this.value;
        $("#taluk").html('');
        var url = "{{ url('service/get_taluk') }}/" + dist_id;
        $.ajax({
            url: url,
            type: "GET",
            success: function(result) {
                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                $.each(result, function(key, value) {
                    $("#taluk").append('<option value="' + value
                        .id + '">' + value.taluk_name + '</option>');
                });
            }
        });
    });
    
</script>
@endpush
