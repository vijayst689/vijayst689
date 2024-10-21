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
                                                <input onkeyup="duplicatephone(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Aadhaar No</label>
                                                <input onkeyup="duplicateaadhar(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Pan No</label>
                                                <input onkeyup="duplicatepan(0)" id="pan_no" type="text"
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
                                                <input onkeyup="duplicateemail(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input type="password" maxlength="10" class="form-control"
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
                                                <input onkeyup="duplicatephone(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Aadhaar No</label>
                                                <input onkeyup="duplicateaadhar(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Pan No</label>
                                                <input onkeyup="duplicatepan(0)" id="pan_no" type="text"
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
                                                <input onkeyup="duplicateemail(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input type="password" maxlength="10" class="form-control"
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
                                                <input type="text" class="form-control" maxlength="20"
                                                    name="name" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Phone</label>
                                                <input onkeyup="duplicatephone(0)" id="phone" type="text"
                                                    maxlength="10" class="form-control number" name="phone"
                                                    placeholder="Phone">
                                                <span id="dupphone" style="color:red"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="aadhaar_no" class="form-label">Aadhaar No</label>
                                                <input onkeyup="duplicateaadhar(0)" id="aadhaar_no" type="text"
                                                    class="form-control number" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                                <span id="dupaadhar" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Aadhaar Image</label>
                                                <input type="file" class="form-control" name="aadhaar_file">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Email</label>
                                                <input onkeyup="duplicateemail(0)" id="email" type="email"
                                                    class="form-control" maxlength="30" name="email"
                                                    placeholder="Email">
                                                <span id="dupemail" style="color:red"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="input2" class="form-label">Password</label>
                                                <input type="password" maxlength="10" class="form-control"
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


  {{-- <div class="section-authentication-cover">
    <div class="">
      <div class="row g-0">

        <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end bg-transparent">

          <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent bg-none">
            <div class="card-body">
              <img src="assets/images/auth/register1.png" class="img-fluid auth-img-cover-login" width="500"
                alt="">
            </div>
          </div>

        </div>

        <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
          <div class="card rounded-0 m-3 border-0 shadow-none bg-none">
            <div class="card-body p-sm-5">
              <img src="{{ asset('assets/images/sidelogo.png') }}" class="mb-4" width="345" alt="">
              <h4 class="fw-bold">Get Started Now</h4>
              <p class="mb-0">Enter your credentials to create your account</p>

              <div class="separator section-padding">
                <div class="line"></div>
                <p class="mb-0 fw-bold">OR</p>
                <div class="line"></div>
              </div>

              <div class="form-body mt-4">
              <form action="{{ url('/saveregister') }}" method="post" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" maxlength="30" name="name" class="form-control"
                                        id="inputUsername" placeholder="Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input onkeyup="duplicatephone(0)" id="phone" type="text" name="phone"
                                        class="form-control number" id="inputUsername" maxlength="10"
                                        placeholder="Phone" required>
                                    <span id="dupphone" style="color:red"></span>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                    <input onkeyup="duplicateemail(0)" id="email" type="email" maxlength="40"
                                        name="email" class="form-control" id="inputEmailAddress" placeholder="Email" required>
                                    <span id="dupemail" style="color:red"></span>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input maxlength="10" type="password" class="form-control border-end-0"
                                            id="inputChoosePassword" name="password" placeholder="Enter Password" required>
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button id="save" type="submit"
                                            class="btn btn-grd-danger">Register</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-start">
                                        <p class="mb-0">Already have an account? <a href="{{ url('/') }}">Signin here</a></p>
                                    </div>
                                </div>
                            </form>
              </div>

          </div>
          </div>
        </div>

      </div>
      <!--end row-->
    </div>
  </div> --}}

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
                        $("#dupemail").html("email alredy exists!");
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
                        $("#dupaadhar").html("aadhar no alredy exists!");
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
                        $("#dupphone").html("mobile no alredy exists!");
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
                url: '{{ url('checkpan') }}',
                data: {
                    id: id,
                    pan_no: pan_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#duppan").html("pan no alredy exists!");
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
    </script>

</body>

</html>
