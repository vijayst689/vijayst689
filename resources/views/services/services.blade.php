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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Apply Service</h5>
                                </div>
                            </div>
                            <form class="row g-4" method="post">

                                <div class="col-md-6">
                                    <input type="hidden" id="customerid" name="customerid" value="{{ $customerid }}">
                                    <label for="input7" class="form-label">Service</label>
                                    <select id="serviceid" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
@endsection
@push('page_scripts')
    <script>


        $('#serviceid').on('change', function() {
            var serviceid = this.value;
            var customerid =  $("#customerid").val();
                window.location.href = "{{ url('applyservice') }}/"+serviceid+"/"+customerid;

        });
    </script>
@endpush
