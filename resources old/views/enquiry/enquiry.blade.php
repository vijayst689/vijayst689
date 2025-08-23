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
            
            <div class="row mt-5">
                <div class="col-2 col-xl-2"></div>
                <div class="col-8 col-xl-8 ">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Enquiry Form</h5>
                                </div>
                            </div>
                            <form class="row g-4" action="{{ url('/saveenquiry') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-3 form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control" name="name" maxlength="100"
                                                type="text" id="example-text-input" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-month-input" class="col-sm-3 form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input required  class="form-control number"
                                                type="email" name="email" maxlength="100" 
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-url-input" class="col-sm-3 form-label">Users</label>
                                        <div class="col-sm-9">
                                        <select id="user_name" name="user_name" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Distributor">Distributor</option>
                                            <option value="Retailer">Retailer</option>
                                            
                                        </select>
                                        </div>
                                        </div>

                                </div>

                                <div class="col-lg-6">
                                    
                                    <div class="mb-3 row">
                                        <label for="example-month-input" class="col-sm-3 form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input required  class="form-control number"
                                                type="text" name="mobile" maxlength="10" id="mobile"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                  
                                    <div class="mb-3 row">
                                    <label for="example-url-input" class="col-sm-3 form-label">Requirement</label>
                                    <div class="col-sm-9">
                                    <select id="requirement" name="requirement" class="form-control">
                                        <option value="">Select Requirement</option>
                                        <option value="Pdf Services">Pdf Services.</option>
                                        <option value="Pan Agent Id">Pan Agent Id.</option>
                                        <option value="Recharge">Recharge.</option>
                                        <option value="Nalavariyam">Nalavariyam.</option>
                                        <option value="Tnega">Tnega.</option>
                                        <option value="Can Work">Can Work.</option>
                                        <option value="Own Website">Own Website(whitelable).</option>
                                    </select>
                                    </div>
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
            </div><!--end row-->
    

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
