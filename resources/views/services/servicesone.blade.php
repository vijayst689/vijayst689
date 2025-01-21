@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
             <div class="card-body">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        {{-- <h5 class="card-title mt-2">{{ $servicename }}</h5>
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6> --}}
                        <div class="card-body p-4">
                            <form class="row g-4" action="#" enctype="multipart/form-data"
                                method="post">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        {{-- <input type="hidden" id="customerid" name="customerid" value="{{ $customerid }}"> --}}
                                        @if($serviceid == 119)
                                        @foreach ($services as $service)
                                        <div class="col-sm-4 col-md-6 col-xl-2 mb-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="bg-label">
                                                    <a href="{{ url('/applyservices', $service->id) }}"><img
                                                            src="/upload/service/{{ $service->service_image }}" alt="user-avatar" style="width: 160px; height: 180px;"
                                                         id="uploadedAvatar">
                                                </span></a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @elseif($serviceid == 10)
                                            @foreach ($services as $service)
                                                <div class="col-sm-4 col-md-6 col-xl-2 mb-2">
                                                    <div class="text-center">
                                                        <a href="{{ url('/softwareservices', $service->id) }}">
                                                            <img src="/upload/sub_service/{{ $service->sub_service_image }}"
                                                                alt="user-avatar" style="width: 160px; height: 180px;"
                                                                class="rounded-circle img-thumbnail avatar-xl"></a>
                                                        <h5 class="text-danger">{{ $service->service_name }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>
                                        @else
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
                                        @endif
                                    </div>
                                </div>
                            </form>
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
            var serviceid = this.value;
            // var customerid =  $("#customerid").val();
                window.location.href = "{{ url('applyservices') }}/"+serviceid;

        });
    </script>
@endpush
