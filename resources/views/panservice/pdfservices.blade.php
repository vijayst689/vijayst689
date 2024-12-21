@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">PDF SERVICES</div>
            </div>
            <div class="card mt-4">
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
                    <div class="row g-4">
                        @foreach ($service as $s)
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="card mb-0">
                                    <div class="card-body bg-white">
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
    </main>
@endsection
@push('page_scripts')
    <script></script>
@endpush
