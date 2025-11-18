<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>pkrmsolution.com</title>
</head>

<body class="">
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
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">pkrmsolution.com</h5>
                                        <button type="button" class="btn btn-info">Distributor</button>
                                    </div>
                                    <div class="form-body">
                                        <form action="{{ url('/savedistributorregister') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Name</label>
                                                            <input required type="text" name="name" maxlength="30"
                                                                class="form-control" placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-2" class="form-label">Phone</label>
                                                            <input required onkeyup="duplicatephone(0)" id="phone"
                                                                type="text" name="phone"
                                                                class="form-control number" id="field-2"
                                                                maxlength="10" placeholder="Phone">
                                                            <span id="dupphone" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Aadhaar No</label>
                                                            <input required onkeyup="duplicateaadhar(0)" id="aadhaar_no"
                                                                type="text" name="aadhaar_no"
                                                                class="form-control number" maxlength="12"
                                                                placeholder="Aadhaar No">
                                                            <span id="dupaadhar" style="color:red"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">District</label>
                                                            <select required name="dist_id" id="dist_ids"
                                                                class="form-control">
                                                                <option value="">Select District</option>
                                                                @foreach ($districts as $d)
                                                                    <option value="{{ $d->id }}">
                                                                        {{ $d->district_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="taluk" class="form-label">Taluk</label>
                                                            <select required name="taluk_id" id="taluks"
                                                                class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Email</label>
                                                            <input required onkeyup="duplicateemail(0)" id="email"
                                                                type="text" name="email" class="form-control"
                                                                maxlength="30" placeholder="Email">

                                                        </div>
                                                        <span id="dupemail" style="color:red"></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-2" class="form-label">Password</label>
                                                            <input required type="password" maxlength="10"
                                                                name="password" class="form-control"
                                                                placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                        read and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" id="save"
                                                        class="btn btn-primary">Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a
                                                            href="{{ url('login') }}">Sign</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="login-separater text-center mb-5"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- image --}}
                    <div
                        class="col-12 col-xl-2 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="assets/images/login-images/register-cover.svg"
                                    class="img-fluid auth-img-cover-login" width="550" alt="" />
                            </div>
                        </div>
                    </div>
                    {{-- image end --}}

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0 bg-dark">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">pkrmsolution.com</h5>
                                        <button type="button" class="btn btn-info">Retailer</button>
                                    </div>
                                    <div class="form-body">
                                        <form action="{{ url('/saveretailerregister') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Name</label>
                                                            <input required type="text" name="name"
                                                                maxlength="30" class="form-control"
                                                                placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone</label>
                                                            <input required onkeyup="duplicatephone1(0)"
                                                                id="phone1" type="text" name="phone"
                                                                class="form-control number" maxlength="10"
                                                                placeholder="Phone">
                                                            <span id="dupphone1" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Aadhaar
                                                                No</label>
                                                            <input required onkeyup="duplicateaadhar1(0)"
                                                                id="aadhaar_no1" type="text" name="aadhaar_no"
                                                                class="form-control number" maxlength="12"
                                                                placeholder="Aadhaar No">
                                                            <span id="dupaadhar1" style="color:red"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                           <label for="field-1" class="form-label">District</label>
                                                            <select required name="dist_id" id="dist_id"
                                                                class="form-control">
                                                                <option value="">Select District</option>
                                                                @foreach ($districts as $d)
                                                                    <option value="{{ $d->id }}">
                                                                        {{ $d->district_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="taluk" class="form-label">Taluk</label>
                                                            <select required name="taluk_id" id="taluk"
                                                                class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Email</label>
                                                            <input required onkeyup="duplicateemail1(0)"
                                                                id="email1" type="text" name="email"
                                                                class="form-control" maxlength="30"
                                                                placeholder="Email">
                                                            <span id="dupemail1" style="color:red"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-2" class="form-label">Password</label>
                                                            <input required type="password" maxlength="10"
                                                                name="password" class="form-control"
                                                                placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                        read and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" id="save1"
                                                        class="btn btn-primary">Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a
                                                            href="{{ url('login') }}">Sign in</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="login-separater text-center mb-5"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });

        //Distributor Script

        function duplicateemail(id) {
            var email = $("#email").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkemailregister') }}',
                data: {
                    id: id,
                    email: email,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupemail").html("email id already exists!");
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
                url: '{{ url('checkaadharregister') }}',
                data: {
                    id: id,
                    aadhaar_no: aadhaar_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupaadhar").html("aadhar no already exists!");
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
                url: '{{ url('checkphoneregister') }}',
                data: {
                    id: id,
                    phone: phone,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupphone").html("mobile no already exists!");
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

        function duplicatepan(id) {
            var pan_no = $("#pan_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkpanregister') }}',
                data: {
                    id: id,
                    pan_no: pan_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#duppan").html("pan no already exists!");
                    } else {
                        $("#duppan").html("");
                    }
                    if ($("#dupphone").html() == "" && $("#duppan").html() == "" && $("#duppan").html() ==
                        "") {
                        $("#save").prop('disabled', false);
                    } else {
                        $("#save").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }

            });
        }

        //Retailer Script

        function duplicateaadhar1(id) {
            var aadhaar_no = $("#aadhaar_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkaadharregisterretailer') }}',
                data: {
                    id: id,
                    aadhaar_no: aadhaar_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupaadhar1").html("aadhar no already exists!");
                    } else {
                        $("#dupaadhar1").html("");
                    }
                    if ($("#dupaadhar1").html() == "" && $("#dupaadhar1").html() == "" && $("#dupemail1")
                    .html() ==
                        "") {
                        $("#save1").prop('disabled', false);
                    } else {
                        $("#save1").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicatephone1(id) {
            var phone = $("#phone").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkphoneregisterretailer') }}',
                data: {
                    id: id,
                    phone: phone,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupphone1").html("mobile no already exists!");
                    } else {
                        $("#dupphone1").html("");
                    }
                    if ($("#dupphone1").html() == "" && $("#dupaadhar1").html() == "" && $("#dupemail1")
                    .html() ==
                        "") {
                        $("#save1").prop('disabled', false);
                    } else {
                        $("#save1").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicateemail1(id) {
            var email = $("#email").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkemailregisterretailer') }}',
                data: {
                    id: id,
                    email: email,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupemail1").html("email id already exists!");
                    } else {
                        $("#dupemail1").html("");
                    }
                    if ($("#dupemail1").html() == "" && $("#dupemail1").html() == "" && $("#dupemail1")
                    .html() ==
                        "") {
                        $("#save1").prop('disabled', false);
                    } else {
                        $("#save1").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicatepan1(id) {
            var pan_no = $("#pan_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkpanregisterretailer') }}',
                data: {
                    id: id,
                    pan_no: pan_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#duppan1").html("pan no already exists!");
                    } else {
                        $("#duppan1").html("");
                    }
                    if ($("#dupphone1").html() == "" && $("#duppan1").html() == "" && $("#duppan1").html() ==
                        "") {
                        $("#save1").prop('disabled', false);
                    } else {
                        $("#save1").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }



        //Register Script

        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
            var url = "{{ url('register/get_taluk_register') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('register/get_panchayath_register') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });

        $('#dist_ids').on('change', function() {
            var dist_id = this.value;
            $("#taluks").html('');
            var url = "{{ url('register/get_taluk_register') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluks').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluks").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayaths').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluks').on('change', function() {
            var taluk_id = this.value;
            $("#panchayaths").html('');
            var url = "{{ url('register/get_panchayath_register') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayaths').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayaths").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });

        $('#dist_idc').on('change', function() {
            var dist_id = this.value;
            $("#talukc").html('');
            var url = "{{ url('register/get_taluk_register') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#talukc').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#talukc").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayathc').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#talukc').on('change', function() {
            var taluk_id = this.value;
            $("#panchayathc").html('');
            var url = "{{ url('register/get_panchayath_register') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayathc').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayathc").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
