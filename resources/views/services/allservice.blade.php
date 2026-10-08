@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($ourservice as $ser)
                        <div class="col-md-3 col-lg-2 col-sm-4 mb-2">
                            <div class="text-center">
                                <a href="{{ url('/services', $ser->id) }}/{{ $customerid }}"><img
                                        src="/upload/service/{{ $ser->service_image }}" alt=""
                                        class="rounded-circle img-thumbnail avatar-xl"></a>
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
