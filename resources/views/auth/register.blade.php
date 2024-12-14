<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pkrmsolutions</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/responsive.css') }}" rel="stylesheet">

</head>

<body>
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
      <!--authentication-->

      <div class="modal-content mt-3 ps-2 pe-2">
        <div class="row row-cols-1 row-cols-lg-4">
            <div class="col-lg-4">
                <div class="card rounded-4">
                    <div class="card-body">
                        <img src="assets/images/auth/login1.png" class="img-fluid rounded-4" alt="">
                        <div class="d-grid mt-2">
                            <button type="button" class="btn btn-grd-danger rounded-4" data-bs-toggle="modal"
                                data-bs-target="#FormModal">Distributor</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-4">
                    <div class="card-body">
                        <img src="assets/images/auth/register1.png" class="img-fluid rounded-4" style="width: 500px; height: 400px;" alt="">
                        <div class="d-grid mt-2">
                            <button type="button" class="btn btn-grd-success rounded-4" data-bs-toggle="modal"
                                data-bs-target="#retailler">Retailler</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-4">
                    <div class="card-body">
                        <img src="assets/images/auth/reset-password1.png" class="img-fluid rounded-4" alt="">
                        <div class="d-grid mt-2">
                            <button type="button" class="btn btn-grd-warning rounded-4" data-bs-toggle="modal"
                                data-bs-target="#customer">Customer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>

    <div class="col-12 col-xl-6">
        <div class="card rounded-4">
            <div class="">
                <div class="modal fade" id="FormModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                <h5 class="modal-title">Distributor Registration</h5>
                                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form action="{{ url('/savedistributorregister') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Name</label>
                                                <input type="text" class="form-control" maxlength="20"
                                                    name="name" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Phone</label>
                                                <input required onkeyup="duplicatephone(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Aadhaar No</label>
                                                <input required onkeyup="duplicateaadhar(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input required type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Pan No</label>
                                                <input required onkeyup="duplicatepan(0)" id="pan_no" type="text"
                                                    class="form-control" maxlength="10" name="pan_no"
                                                    placeholder="Pan No">
                                                <span id="duppan" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Pan Image</label>
                                                <input type="file" class="form-control" name="pan_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Email</label>
                                                <input required onkeyup="duplicateemail(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input required type="password" maxlength="10" class="form-control"
                                                    name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" id="save"
                                                    class="btn btn-grd-danger px-4">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="card rounded-4">
            <div class="">
                <div class="modal fade" id="retailler">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                <h5 class="modal-title">Retailer Registration</h5>
                                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form action="{{ url('/saveretailerregister') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Name</label>
                                                <input type="text" class="form-control" maxlength="20"
                                                    name="name" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Phone</label>
                                                <input required onkeyup="duplicatephone1(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone1" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Aadhaar No</label>
                                                <input required onkeyup="duplicateaadhar1(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar1" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input required type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Pan No</label>
                                                <input required onkeyup="duplicatepan1(0)" id="pan_no" type="text"
                                                    class="form-control" maxlength="10" name="pan_no"
                                                    placeholder="Pan No">
                                                <span id="duppan1" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Pan Image</label>
                                                <input required type="file" class="form-control" name="pan_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Email</label>
                                                <input required onkeyup="duplicateemail1(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail1" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input required type="password" maxlength="10" class="form-control"
                                                    name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" id="save1"
                                                    class="btn btn-grd-danger px-4">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="card rounded-4">
            <div class="">
                <div class="modal fade" id="customer">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                <h5 class="modal-title">Customer Registration</h5>
                                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form action="{{ url('/saveregister') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Name</label>
                                                <input required type="text" class="form-control" maxlength="20"
                                                    name="name" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Phone</label>
                                                <input required onkeyup="duplicatephone2(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone2" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="aadhaar_no" class="form-label">Aadhaar No</label>
                                                <input required onkeyup="duplicateaadhar2(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar2" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input required type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Email</label>
                                                <input required onkeyup="duplicateemail2(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail2" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input required type="password" maxlength="10" class="form-control"
                                                    name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" id="save2"
                                                    class="btn btn-grd-danger px-4">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!--authentication-->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
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
                    if ($("#dupaadhar1").html() == "" && $("#dupaadhar1").html() == "" && $("#dupemail1").html() ==
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
                    if ($("#dupphone1").html() == "" && $("#dupaadhar1").html() == "" && $("#dupemail1").html() ==
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
                    if ($("#dupemail1").html() == "" && $("#dupemail1").html() == "" && $("#dupemail1").html() ==
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

//Customer Script

function duplicateaadhar2(id) {
            var aadhaar_no = $("#aadhaar_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkaadharregistercustomer') }}',
                data: {
                    id: id,
                    aadhaar_no: aadhaar_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupaadhar2").html("aadhar no already exists!");
                    } else {
                        $("#dupaadhar2").html("");
                    }
                    if ($("#dupaadhar2").html() == "" && $("#dupaadhar2").html() == "" && $("#dupemail2").html() ==
                        "") {
                        $("#save2").prop('disabled', false);
                    } else {
                        $("#save2").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicatephone2(id) {
            var phone = $("#phone").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkphoneregistercustomer') }}',
                data: {
                    id: id,
                    phone: phone,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupphone2").html("mobile no already exists!");
                    } else {
                        $("#dupphone2").html("");
                    }
                    if ($("#dupphone2").html() == "" && $("#dupphone2").html() == "" && $("#dupemail2").html() ==
                        "") {
                        $("#save2").prop('disabled', false);
                    } else {
                        $("#save2").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicateemail2(id) {
            var email = $("#email").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkemailregistercustomer') }}',
                data: {
                    id: id,
                    email: email,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupemail2").html("email id already exists!");
                    } else {
                        $("#dupemail2").html("");
                    }
                    if ($("#dupemail2").html() == "" && $("#dupemail2").html() == "" && $("#dupemail2").html() ==
                        "") {
                        $("#save2").prop('disabled', false);
                    } else {
                        $("#save2").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }
    </script>

</body>

</html>
