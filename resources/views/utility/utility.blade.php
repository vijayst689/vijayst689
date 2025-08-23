@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">UTILITY SERVICES</div>
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
                <div class="col-xxl-8 d-flex align-items-stretch">
                    <div class="overflow-hidden rounded-3">
                        <div class="card-body position-relative p-4">
                            <div class="row">
                                @foreach ($utlityser as $ut)
                                    <div class="col-md-3 col-lg-6 col-sm-4 mb-2">
                                        <div class="text-center">
                                           <a href="{{ url('/utilityservice', $ut->id) }}"> <img src="/upload/uti_image/{{ $ut->ser_image }}" alt=""
                                            class="rounded-circle bg-grd-info p-1"  width="100" height="100"></a>
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
