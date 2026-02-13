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
                                            <h5 class="mb-0 fw-bold">Add Retailer</h5>
                                        </div>
                                    </div>
                                  <form class="row g-4" action="{{ url('/saveretailer') }}" enctype="multipart/form-data"
                                        method="post">
                                        {{ csrf_field() }}
                                        <div class="col-md-6">
                                            <label for="input1" class="form-label">Name</label>
                                            <input required type="text" name="name" maxlength="30"
                                                class="form-control" id="input1" placeholder="Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input3" class="form-label">Phone</label>
                                            <input class="form-control dup-check" data-field="phone" id="phone" type="text" name="phone"
                                                maxlength="10" class="form-control" id="input3" placeholder="Phone">
                                            <small class="text-danger dup-msg"></small>
                                        <div class="spinner-border spinner-border-sm text-primary d-none loader"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input3" class="form-label">Aadhaar No</label>
                                            <input class="form-control dup-check" data-field="aadhaar_no" id="aadhaar_no" type="text"
                                                name="aadhaar_no" maxlength="12" class="form-control number" id="input3"
                                                placeholder="Aadhaar No">
                                            <small class="text-danger dup-msg"></small>
                                         <div class="spinner-border spinner-border-sm text-primary d-none loader"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input4" class="form-label">Email</label>
                                            <input class="form-control dup-check" data-field="email" id="email" type="email" name="email"
                                                maxlength="40" class="form-control" id="input4" placeholder="Email">
                                            <small class="text-danger dup-msg"></small>
                                         <div class="spinner-border spinner-border-sm text-primary d-none loader"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input5" class="form-label">Password</label>
                                            <input required type="password" name="password" maxlength="10"
                                                class="form-control" id="input5" placeholder="Password">
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
            @endsection
            @push('page_scripts')
                <script>
                    function duplicateemail(id) {
                        var email = $("#email").val().trim();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            type: "post",
                            url: '{{ url('checkemail') }}',
                            data: {
                                id: id,
                                email: email,
                                _token: _token
                            },

                            success: function(res) {
                                if (res.exists) {
                                    $("#save").prop('disabled', true);
                                    $("#dupemail").html("email alredy exit!");
                                } else {
                                    $("#save").prop('disabled', false);
                                    $("#dupemail").html("");
                                }
                            },

                            error: function(jqXHR, exception) {
                                console.log(exception);
                            }
                        });
                    }

                    function duplicateaadhar(id) {
                        var aadhaar_no = $("#aadhaar_no").val().trim();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            type: "post",
                            url: '{{ url('checkaadhar') }}',
                            data: {
                                id: id,
                                aadhaar_no: aadhaar_no,
                                _token: _token
                            },

                            success: function(res) {
                                if (res.exists) {
                                    $("#save").prop('disabled', true);
                                    $("#dupaadhar").html("aadhar no alredy exit!");
                                } else {
                                    $("#save").prop('disabled', false);
                                    $("#dupaadhar").html("");
                                }
                            },
                            error: function(jqXHR, exception) {
                                console.log(exception);
                            }
                        });
                    }

                    function duplicatephone(id) {
                        var phone = $("#phone").val().trim();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            type: "post",
                            url: '{{ url('checkphone') }}',
                            data: {
                                id: id,
                                phone: phone,
                                _token: _token
                            },

                            success: function(res) {
                                if (res.exists) {
                                    $("#save").prop('disabled', true);
                                    $("#dupphone").html("mobile no alredy exit!");
                                } else {
                                    $("#save").prop('disabled', false);
                                    $("#dupphone").html("");
                                }
                            },

                            error: function(jqXHR, exception) {
                                console.log(exception);
                            }
                        });
                    }
                </script>
            @endpush
