@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add Retailer</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Retailer</li>
                        </ol>
                    </nav>
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
                                    <h5 class="mb-0 fw-bold">Add Retailer</h5>
                                </div>
                            </div>
                            <form class="row g-4" action="{{ url('/saveretailer') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <label for="input1" class="form-label">Name</label>
                                    <input required type="text" name="name" maxlength="30" class="form-control" id="input1"
                                        placeholder="Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="input3" class="form-label">Phone</label>
                                    <input required onkeyup="duplicatephone(0)" id="phone" type="text" name="phone"
                                        maxlength="10" class="form-control" id="input3" placeholder="Phone">
                                    <span id="dupphone" style="color:red"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="input3" class="form-label">Aadhaar No</label>
                                    <input required onkeyup="duplicateaadhar(0)" type="text" id="aadhaar_no" name="aadhaar_no"
                                        maxlength="12" class="form-control number" id="input3" placeholder="Aadhaar No">
                                    <span id="dupaadhar" style="color:red"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="input7" class="form-label">Gender</label>
                                    <select required name="gender" id="input7" class="form-select">
                                        <option selected="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="input4" class="form-label">Email</label>
                                    <input required onkeyup="duplicateemail(0)" id="email" type="email" name="email"
                                        maxlength="40" class="form-control" id="input4" placeholder="Email">
                                    <span id="dupemail" style="color:red"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="input5" class="form-label">Password</label>
                                    <input required type="password" name="password" maxlength="10" class="form-control"
                                        id="input5">
                                </div>
                                <div class="col-md-6">
                                    <label for="input11" class="form-label">Address</label>
                                    <textarea required name="address" maxlength="200" class="form-control" id="input11" placeholder="Address ..."
                                        rows="4" cols="4"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button id="save" type="submit"
                                            class="btn btn-grd-primary px-4">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </main>
@endsection
@push("page_scripts")

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
