@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
                    @foreach ($profile as $pro)
                        <div class="card rounded-4">
                            <div class="card-body p-4">
                                <div class="position-relative mb-5">
                                    <div class="profile-avatar position-absolute top-100 start-50 translate-middle">
                                        <img src="/upload/profile_photo/{{ $pro->profile }}"
                                            class="img-fluid rounded-circle p-1 bg-grd-danger shadow" width="170"
                                            height="170" alt="">
                                    </div>
                                </div>
                                <div class="profile-info pt-5 d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <h3>{{ $pro->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                            <div class="">
                                                <h5 class="mb-0 fw-bold">Update Profile</h5>
                                            </div>
                                        </div>
                                        <form action="{{ url('/updateprofile') }}" method="post"
                                            enctype="multipart/form-data" class="row g-4">
                                            {{ csrf_field() }}
                                            <div class="col-md-6">
                                                <input type="hidden" name="id" value="{{ $pro->id }}" />
                                                <label for="input1" class="form-label">Name</label>
                                                <input type="text" maxlength="30" name="name" class="form-control"
                                                    id="input1" value="{{ $pro->name }}" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input3" class="form-label">Phone</label>
                                                <input type="text" name="phone" maxlength="10"
                                                    class="form-control number" id="input3" value="{{ $pro->phone }}"
                                                    placeholder="Phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input3" class="form-label">Aadhaar No</label>
                                                <input type="text" maxlength="12" name="aadhaar_no"
                                                    class="form-control number" id="input3"
                                                    value="{{ $pro->aadhaar_no }}" placeholder="Aadhaar No">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input4" class="form-label">Email</label>
                                                <input readonly maxlength="40" type="email" name="email"
                                                    class="form-control" value="{{ $pro->email }}" id="input4"
                                                    placeholder="Email">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input6" class="form-label">DOB</label>
                                                <input type="date" value="{{ $pro->date_of_birth }}"
                                                    name="date_of_birth" class="form-control" id="input6">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input9" class="form-label">Gender</label>
                                                <select id="input9" name="gender" class="form-select">
                                                    <option value="">Select</option>
                                                    <option @if ($pro->gender == 'Male') selected @endif
                                                        value="Male">Male</option>
                                                    <option @if ($pro->gender == 'Female') selected @endif
                                                        value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input6" class="form-label">Profile</label>
                                                <input type="file" name="profile" class="form-control"
                                                    id="input6">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input11" class="form-label">Address</label>
                                                <textarea name="address" maxlength="200" class="form-control" id="input11" placeholder="Address ..."
                                                    rows="3" cols="3">{{ $pro->address }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary px-4">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div><!--end row-->
    </div>
@endsection
