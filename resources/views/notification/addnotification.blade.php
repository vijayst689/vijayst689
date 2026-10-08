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
                        <div class="col-auto">
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <a href="{{ url('viewnotification') }}" class="btn-sm btn btn-danger"><i
                                        class=""></i>View Notification</a>
                            </div>
                        </div>
                        <h5 class="card-title">Add Notification</h5>
                        <div class="row">
                            <form class="row g-4" action="{{ url('/savenotification') }}" enctype="multipart/form-data"
                            method="post">
                            {{ csrf_field() }}
                            <div class="col-lg-12">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 form-label"> Content</label>
                                    <div class="col-sm-12">
                                        <textarea required class="form-control" name="notify" maxlength="1000" type="text" id="example-text-input" rows="3"
                                            placeholder="Notification Content"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="col-12">
                                    <div class="mb-0">
                                        <button id="save" type="submit" class="btn btn-primary">Submit</button>
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
@push("page_scripts")

@endpush
