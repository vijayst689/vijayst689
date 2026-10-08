@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h5 class="card-title">PDF SERVICES</h5>
        <div class="card">
            <div class="card-body">
                <div class="row g-4">
                    @foreach ($service as $s)
                        <div class="col-xl-3 col-md-3 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body bg-dark">
                                    <div class="position-relative">
                                        <img src="/upload/find_service/{{ $s->ser_image }}" class="img-fluid rounded"
                                        style="width: 200px; height: 150px;" alt="">
                                    </div>
                                    <div class="text-center mt-1 pt-1">
                                        <p class="mb-0 text-success"><b>{{ $s->name }}</b></p>
                                        <hr class="text-black">
                                        <h6 class="mb-2 text-danger">Amount: {{ $s->payment }}</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ url('/applypdfservice',$s->id) }}" class="btn btn-light">Apply</a>
                                        <a href="{{ url('/applypdfservice',$s->id) }}" class="btn btn-primary">List</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
