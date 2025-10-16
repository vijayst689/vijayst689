@extends('Frontend.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ms-auto">
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
                        <div class="col-6 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="">
                                            <h5 class="mb-0 fw-bold">Your Enquirys</h5>
                                        </div>
                                    </div>
                                    <form class="row g-4" action="{{ url('/saveenquiry') }}" enctype="multipart/form-data"
                                        method="post">
                                        {{ csrf_field() }}
                                        <div class="col-lg-12">
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-2 form-label">
                                                    Name</label>
                                                <div class="col-sm-6">
                                                    <input required class="form-control" name="name" maxlength="50"
                                                        type="text" id="example-text-input" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-2 form-label">
                                                    Phone</label>
                                                <div class="col-sm-6">
                                                    <input required class="form-control number" name="mobile"
                                                        maxlength="10" type="text" id="example-text-input"
                                                        placeholder="Phone No">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-2 form-label">
                                                    Email</label>
                                                <div class="col-sm-6">
                                                    <input required class="form-control" name="email" maxlength="100"
                                                        type="text" id="example-text-input" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 form-label">Requirement</label>
                                                <div class="col-sm-6">
                                                    <select required name="requirement"class="form-control"
                                                        id="example-text-input">
                                                        <option value="">Select</option>
                                                        @foreach ($requirement as $e)
                                                            <option value="{{ $e->requirement_name }}">
                                                                {{ $e->requirement_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-sm-2 form-label">UserName</label>
                                                <div class="col-sm-6">
                                                    <select required name="username"class="form-control"
                                                        id="example-text-input">
                                                        <option value="">Select</option>
                                                        <option value="Distributor">Distributor</option>
                                                        <option value="Retailler">Retailler</option>
                                                        <option value="Customer">Customer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <button id="save" type="submit"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection
