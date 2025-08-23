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
                    <div id="category_div" class="row">
                        @if (Auth::user()->user_type_id == 1 ||
                                Auth::user()->user_type_id == 2 ||
                                Auth::user()->user_type_id == 3 ||
                                Auth::user()->user_type_id == 4)
                            <div class="col-4 col-md-2 mb-3 category_data">
                                <div class="card p-2 h-100">
                                    <a href="{{ url('/addcustomer') }}">
                                        <div class="mb-1">
                                            <img src="/upload/mylogo/tnega.jpg" width="100%" />
                                            <p class="text-primary">TNEGA</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('/pdfservices') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/pdf.jpg" width="100%" />
                                        <p class="text-primary">PDF</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('/panservices') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/nsdl.jpg" width="100%" />
                                        <p class="text-primary">NSDL PAN</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('/utility') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/uti.jpg" width="100%" />
                                        <p class="text-primary">UTILITY</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="container-xxl flex-grow-1">
                                    <div id="category_div" class="row">
                                        @foreach ($ourservice as $ser)
                                            <div class="col-4 col-md-2 mb-3 category_data">
                                                <div class="card p-2 h-100">
                                                    @if ($ser->id == 119)
                                                        <a href="{{ url('/licservices', $ser->id) }}">
                                                        @elseif ($ser->id == 224)
                                                            <a href="{{ url('/applyservices/225') }}">
                                                            @else
                                                                <a href="{{ url('/servicesone', $ser->id) }}">
                                                    @endif
                                                    <div class="mb-1">
                                                        <img src="/upload/service/{{ $ser->service_image }}"
                                                            style="width: 120px; height: 130px;" />
                                                        <p class="text-primary">{{ $ser->service_name }}</p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                .id + '~' + value.amount + '">' + value.service_name +
                                '</option>');
                        });
                    }
                });
            });

            $('#subserviceid').on('change', function() {
                $("#datahide").hide();
                var serviceid = this.value;
                if (serviceid != "") {

                    var wallet = "{{ Auth::user()->wallet }}";
                    var amount = $("#subserviceid").val().split("~")[1];
                    if (parseFloat(amount) > parseInt(wallet)) {
                        alert("Insufficient Funds.Please Top Up");
                        window.location.href = "{{ url('wallet') }}";
                        return false;
                    }
                    $("#datahide").show();

                }
            });
        </script>
    @endpush
