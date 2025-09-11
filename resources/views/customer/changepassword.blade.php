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
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                            <a href="{{ url('customers') }}" class="btn btn-grd btn-grd-info px-3"><i
                                    class="bi bi-chat me-2"></i>ChangePassword</a>
                        </div>
                    </div>
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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Update Customer</h5>
                                </div>
                            </div>
                           <form action="{{ url('/updatepassword') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Old Password</label>
                                            <input type="text" class="form-control" name="oldpassword"
                                                required="required" id="oldpassword" placeholder="Enter Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="text" class="form-control" name="new_password"
                                                required="required" id="password" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="text" class="form-control" name="confirm_password"
                                                required="required" id="password" placeholder="Enter Confirm Password">
                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-md-12 text-center">
                                                <a href="" class="btn btn-info">Back</a>
                                                <input id="save" class="btn btn-info" type="submit" name="submit"
                                                    value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
@endsection
@push('page_scripts')
  
@endpush
