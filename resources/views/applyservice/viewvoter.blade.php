@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                            <div class="card-body p-4">
                                <h5 class="card-title">Apply Service</h5>
                                <form class="row g-4" action="#" enctype="multipart/form-data" method="post">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
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
                                </form>
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
            var serviceid = this.value;
            // var customerid =  $("#customerid").val();
            window.location.href = "{{ url('applyservices') }}/" + serviceid;

        });
    </script>
@endpush
