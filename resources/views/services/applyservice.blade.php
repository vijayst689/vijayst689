@extends('layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Apply Service</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
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
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0 fw-bold"></h5>
                            </div>
                        </div>
                        <form class="row g-4" action="{{ url('/submit_applyservice') }}" enctype="multipart/form-data"
                        method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <input type="hidden" name="customerid" value="{{ $customerid }}">
                            <label for="input1" class="form-label">Service</label>
                            <select id="serviceid" class="form-select">
                            <option value="">Select</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input1" class="form-label">Select Service</label>
                         <select id="subserviceid" name="serviceid" class="form-select">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div id="datahide" class="row col-md-12 mt-4" style="display: none;">
                    @foreach($customers as $customer)
                         <div class="col-md-6 mb-2">
                                    <label for="input1" class="form-label">Name</label>
                                    <input type="text" disabled class="form-control" placeholder="Name" value="{{ $customer->name }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">Phone</label>
                                    <input type="text" value="{{ $customer->phone }}" disabled class="form-control"  placeholder="Phone">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">Aadhaar No</label>
                                    <input type="text" value="{{ $customer->aadhaar_no }}" disabled class="form-control number" placeholder="Aadhaar No">
                                </div>
                                @foreach($customer->document as $doc)
                                    <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">{{ $doc->file_name }}</label>
                                    @if($doc->cus_docx != "")
                                          <br><a target="_blank" class="btn btn-grd btn-grd-primary px-1"  href="{{ URL::to('/') }}/upload/document/{{ $doc->cus_docx }}" >Download</a>
                                          @else
                                           <br><a class="btn btn-grd btn-grd-primary px-1">No File</a>
                                        @endif
                                </div>
                                @endforeach
                    @endforeach
                            <div class="row">
                                        <label class="col-sm-5 col-form-label"></label>
                                        <div class="col-sm-7">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
                                               
                                            </div>
                                        </div>
                                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div><!--end row-->
</div>
</main>
@endsection
@push('page_scripts')
<script>
    $('#serviceid').on('change', function() {
            var parentid = this.value;
            $("#subserviceid").html('');
            var url = "{{ url('get_subservice') }}/" + parentid;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#subserviceid').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#subserviceid").append('<option value="' + value
                            .id + '~'+ value.amount +'">' + value.service_name + '</option>');
                    });
                }
            });
        });

    $('#subserviceid').on('change', function() {
            $("#datahide").hide();
            var serviceid = this.value;
            if(serviceid != ""){
               
                var wallet = "{{ Auth::user()->wallet }}";
                var amount = $("#subserviceid").val().split("~")[1];
                    if(parseFloat(amount) > parseInt(wallet)){
                    alert("Insufficient Funds.Please Top Up");
                    window.location.href = "{{ url('wallet') }}";
                    return false;
                    }
                    $("#datahide").show();
                   
            }
        });
</script>
@endpush
