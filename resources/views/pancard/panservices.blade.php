@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">PAN SERVICES</div>
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
                    <div class="row g-4">
                        @foreach ($service as $s)
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="card mb-0">
                                    <div class="card-body bg-white">
                                        <div class="position-relative">
                                            <img src="/upload/panservice/{{ $s->ser_image }}" class="img-fluid rounded"
                                            style="width: 200px; height: 150px;" alt="">
                                        </div>
                                        <div class="text-center mt-1 pt-1">
                                            <p class="mb-0 text-success"><b>{{ $s->name }}</b></p>
                                            <hr class="text-black">
                                            <h6 class="mb-2 text-danger">Amount: {{ $s->payment }}</h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ url('/applypanservice',$s->id) }}" class="btn btn-light">Apply</a>
                                            <a href="{{ url('/applypanservice',$s->id) }}" class="btn btn-primary">List</a>
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
    <script></script>
@endpush
