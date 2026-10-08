@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>
                    <center>
                    தற்போது உள்ள கணக்கின்படி அதிகபட்ச விண்ணப்பம் செய்தவரின் Completed 600 விண்ணப்பத்திற்கு மேல் இல்லை ஆகவே 600 விண்ணப்பம் வரை லாக் செய்யப்படுகிறது மேலும் அவர் தனது விண்ணப்பத்தின் எண்ணிக்கையை பூர்த்தி செய்ய கால அவகாசம் வழங்கப்பட்டுள்ளது 
                    </br></br>
                    மேலும் 11-8-2024 க்கு பின் 500விண்ணப்பத்தினை லாக் செய்யப்படும் அவ்வாறு படிப்படியாக விண்ணப்ப கணக்கை குறைக்கப்படும்.
                    </br></br>
                    ஆகவே உங்கள் Completed யில் இருக்கும் விண்ணப்பங்களின் எண் மற்றும் செல் நம்பர் சரியாக பதிவு செய்யவும்.
                    </br></br>
                    தவறான செல் நம்பர் மற்றும் விண்ணப்ப எண் வழங்கினாலும் லாக் ஆகிவிடும்</center>
                    
                    </h5>
                    </div>
                    </section>
                    <section class="content">
                        <div class="container-fluid">
                        <div class="row">
                        <div class="col-12">
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
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Online</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Offline</a>
                    </li>
                    </ul>
                    </div>
                    <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <div class="table-responsive" style="overflow-x: auto; ">
                    <table id="" class="table table-bordered table-striped">    <thead>
                            <tr>
                                <th>S No</th>
                                <th>Services</th>
                                <th>Amount</th>
                                <th>Download</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <center>
        புதிய விண்ணப்பம் செய்யும் முன் ஏற்கனவே விண்ணப்பம் செய்யதுள்ள விண்ணங்களின் குறைகளை சரி செய்யவும்.
        </br>
         குறைந்தபட்சம் 15 விண்ணப்பம் வரை மட்டுமே உங்களுக்கு வாய்ப்பு வழங்கப்படுகிறது
        </br>
        
        <a href="{{ url('onlinestatus') }}/Resubmit/{{ date('Y-m-d', strtotime('-700 days')) }}/{{ date('Y-m-d') }}" class="nav-link "> Go to Resubmit <i class="fas fa-arrow-circle-right"></i></p></a>
        </center> --}}
            </div>
        </div>
    </div>
</div>


@endsection
@push('page_scripts')
<script>
    function edit_customer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status) {
        $("#editname").val(name);
        $("#editphone").val(phone);
        $("#editadhar").val(aadhaar_no);
        $("#editgender").val(gender);
        $("#editemail").val(email);
        $("#editdob").val(date_of_birth);
        $("#editaddress").val(address);
        $("#editstatus").val(status);
        $("#cusid").val(id);
        $("#editcustomer").modal("show");
    }
</script>
@endpush