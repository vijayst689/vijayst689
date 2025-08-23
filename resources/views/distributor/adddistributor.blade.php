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
                                            <h5 class="mb-0 fw-bold">Add Distriutor</h5>
                                        </div>
                                    </div>
                                    <form class="row g-4" action="{{ url('/savedistributor') }}"
                                        enctype="multipart/form-data" method="post">
                                        {{ csrf_field() }}
                                        <div class="col-md-6">
                                            <label for="input1" class="form-label">Name</label>
                                            <input type="text" name="name" maxlength="20" class="form-control"
                                                id="input1" placeholder="Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input3" class="form-label">Phone</label>
                                            <input onkeyup="duplicatephone(0)" id="phone" type="text" name="phone"
                                                maxlength="10" class="form-control" id="input3" placeholder="Phone">
                                            <span id="dupphone" style="color:red"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input3" class="form-label">Aadhaar No</label>
                                            <input onkeyup="duplicateaadhar(0)" id="aadhaar_no" type="text"
                                                name="aadhaar_no" maxlength="12" class="form-control number" id="input3"
                                                placeholder="Aadhaar No">
                                            <span id="dupaadhar" style="color:red"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input7" class="form-label">Gender</label>
                                            <select name="gender" id="input7" class="form-select">
                                                <option selected="">Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input4" class="form-label">Email</label>
                                            <input onkeyup="duplicateemail(0)" id="email" type="email" name="email"
                                                maxlength="40" class="form-control" id="input4" placeholder="Email">
                                            <span id="dupemail" style="color:red"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input5" class="form-label">Password</label>
                                            <input type="password" name="password" maxlength="10" class="form-control"
                                                id="input5">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input6" class="form-label">DOB</label>
                                            <input name="date_of_birth" type="date" class="form-control"
                                                id="input6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input6" class="form-label">Profile</label>
                                            <input name="profile" type="file" class="form-control" id="input6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input11" class="form-label">Address</label>
                                            <textarea name="address" maxlength="200" class="form-control" id="input11" placeholder="Address ..."
                                                rows="4" cols="4"></textarea>
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
