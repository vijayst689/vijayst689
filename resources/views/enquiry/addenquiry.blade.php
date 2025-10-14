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
                    <div class="card-body">
                        <h5 class="card-title">Your Enquirys</h5>
                        <div class="row">
                            <form class="row g-4" action="{{ url('/saveenquiry') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 form-label"> Name</label>
                                        <div class="col-sm-6">
                                            <input required class="form-control" name="name" maxlength="50" type="text" id="example-text-input"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 form-label"> Phone</label>
                                        <div class="col-sm-6">
                                            <input required class="form-control number" name="phone" maxlength="10"
                                                type="text" id="example-text-input" placeholder="Phone No">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 form-label"> Email</label>
                                        <div class="col-sm-6">
                                            <input required class="form-control" name="email" maxlength="100"
                                                type="text" id="example-text-input" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 form-label"> Requirement</label>
                                        <div class="col-sm-6">
                                            <textarea required class="form-control" name="enquiry" maxlength="300" type="text" id="example-text-input"
                                                rows="3" placeholder="Requirement"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-2 form-label">UserName</label>
                                        <div class="col-sm-6">
                                            <select required name="username"class="form-control" id="example-text-input">
                                                <option value="">User</option>
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
@push('page_scripts')
@endpush
