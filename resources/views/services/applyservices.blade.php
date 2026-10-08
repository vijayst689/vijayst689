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
                        <h5 class="card-title">Apply Service</h5>
                        <div class="row">
                            <form class="row g-4" action="#" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <input type="hidden" name="customerid" value="{{ $customerid }}">
                                        <label for="input1" class="form-label">Service</label>
                                        <div class="col-sm-10">
                                            <select id="serviceid" class="form-select">
                                                <option value="">Select</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->service_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
