@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Services</div>
            </div>

            <div class="row">
                <div class="col-xxl-8 d-flex align-items-stretch">
                    <div class="overflow-hidden rounded-3">
                        <div class="card-body position-relative p-4">
                            <div class="row">
                                @foreach ($ourservice as $ser)
                                <div class="d-flex align-items-center gap-3 col-md-5 mb-5">
                                    <div class="text-center">
                                        <a href="{{ url('/services', $ser->id) }}/{{ $customerid }}"><img
                                                src="/upload/service/{{ $ser->service_image }}" alt=""
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
