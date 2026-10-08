@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @foreach ($profile as $pro)
            <div class="card rounded-4">
                <div class="card-body p-4">
                    <div class="position-relative mb-5 mt-5">
                        <div class="profile-avatar position-absolute top-100 start-50 translate-middle">
                            <img src="/upload/profile_photo/{{ $pro->profile }}"
                                class="img-fluid rounded-circle p-1 bg-grd-danger shadow" width="150" height="150"
                                alt="">
                        </div>
                    </div>
                    <div class="profile-info pt-5 d-flex align-items-center justify-content-between">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <strong> {{ session('success') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <strong> {{ session('error') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="text-center">
                            <h2 class="card-title">Update Profile</h2>
                            </div>
                            <div class="row">
                                <form action="{{ url('/updateprofile') }}" method="post" enctype="multipart/form-data"
                                    class="row g-4">
                                    {{ csrf_field() }}
                                    <div class="col-lg-6">
                                        <input type="hidden" name="id" value="{{ $pro->id }}" />
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" maxlength="30" name="name" class="form-control"
                                                    id="input1" value="{{ $pro->name }}" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-email-input" class="col-sm-2 form-label">Aadhaar No</label>
                                            <div class="col-sm-10">
                                                <input type="text" maxlength="12" name="aadhaar_no"
                                                    class="form-control number" id="input3"
                                                    value="{{ $pro->aadhaar_no }}" placeholder="Aadhaar No">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input readonly maxlength="40" type="email" name="email"
                                                    class="form-control" value="{{ $pro->email }}" id="input4"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea name="address" maxlength="200" class="form-control" id="input11" placeholder="Address ..."
                                                    rows="3" cols="3">{{ $pro->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-sm-2 form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="phone" maxlength="10"
                                                    class="form-control number" id="input3" value="{{ $pro->phone }}"
                                                    placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">DOB</label>
                                            <div class="col-sm-10">
                                                <input type="date" value="{{ $pro->date_of_birth }}"
                                                    name="date_of_birth" class="form-control" id="input6">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">Gender</label>
                                            <div class="col-sm-10">
                                                <select id="input9" name="gender"
                                                    class="form-select">
                                                    <option value="">Select</option>
                                                    <option @if( $pro->gender == 'Male') selected @endif value="Male">Male</option>
                                                    <option @if( $pro->gender == 'Female') selected @endif value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">Profile</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" maxlength="10" type="file" name="profile"
                                                    placeholder="Profile" id="example-text-input-lg">
                                            </div>
                                        </div>
                                        @if (Auth::user()->user_type_id == 2)
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-sm-2 form-label">QR Image</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control mb-3" type="file" name="qrimage"
                                                        id="qrimage">
                                                    @if (!empty($pro->qrimage))
                                                        <div class="text-center mt-4">
                                                            <img src="{{ asset('upload/qrimage/' . $pro->qrimage) }}"
                                                                class="img-fluid rounded-circle shadow" width="100"
                                                                height="100" alt="QR Image">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
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
                </div>
        @endforeach
    </div>
    </div>
@endsection
