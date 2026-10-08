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
                                    
                                            <label for="input1" class="form-label">Service</label>
                                            <div class="col-sm-12">
                                                <div class="mb-3 row">
                                                @foreach ($services as $service)
                                                <div class="col-md-3 col-lg-2 col-sm-4 mb-2">
                                                    <div class="text-center">
                                                        <a href="{{ url('/softwareservices', $service->id) }}">
                                                            <img src="/upload/sub_service/{{ $service->sub_service_image }}"
                                                                alt=""
                                                                class="rounded-circle img-thumbnail avatar-xl"></a>
                                                        <h5 class="text-danger">{{ $service->service_name }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                            </div>
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
            window.location.href = "{{ url('softwareservices') }}/" + serviceid;

        });
    </script>
@endpush
