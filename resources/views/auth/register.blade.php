<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pragadeesheservice.com</title>
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

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        /* ===== FULL PAGE BACKGROUND ===== */
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #141e30, #243b55);
            font-family: 'Noto Sans', sans-serif;
        }

        /* ===== CENTER MAIN CONTENT ===== */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== SELECT TYPE CARDS ===== */
        .select-card {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            transition: all 0.3s ease;
            color: #fff;
        }

        .select-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .distributor-bg {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
        }

        .retailer-bg {
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: #000;
        }

        .select-card img {
            border-radius: 15px;
        }

        /* ===== ICON STYLE ===== */
        .pricing-icon i {
            font-size: 48px;
            padding: 18px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
        }

        /* ===== BUTTONS ===== */
        .btn-glow {
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        /* ===== MODALS ===== */
        .modal-content {
            border-radius: 25px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }

        .modal-title {
            font-weight: 700;
        }

        /* ===== FORM ===== */
        .form-control {
            border-radius: 12px;
        }

        /* ===== ALERTS ===== */
        .alert {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }
    </style>

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

    <div class="main-wrapper">
        <div class="container">

            <div class="row mb-4">
                <div class="col text-center text-white">
                    <h2 class="fw-bold">Welcome to Pragadeesheservice.com</h2>
                    <p>Select your registration type</p>
                </div>
            </div>

            <div class="row g-4">

                <!-- DISTRIBUTOR -->
                <div class="col-lg-6">
                    <div class="card select-card distributor-bg p-4 text-center">
                        <div class="pricing-icon">
                            <i class="fa fa-user"></i>
                        </div>

                        <h4 class="fw-bold mt-2">Distributor</h4>

                        <img src="assets/images/project-logo/project1.jpg" class="img-fluid my-3">

                        <button class="btn btn-light btn-glow w-100" data-bs-toggle="modal"
                            data-bs-target="#exampleModalform">
                            Register as Distributor
                        </button>
                    </div>
                </div>

                <!-- RETAILER -->
                <div class="col-lg-6">
                    <div class="card select-card retailer-bg p-4 text-center">
                        <div class="pricing-icon">
                            <i class="fa fa-rocket"></i>
                        </div>

                        <h4 class="fw-bold mt-2">Retailer</h4>

                        <img src="assets/images/project-logo/project2.jpg" class="img-fluid my-3">

                        <button class="btn btn-dark btn-glow w-100" data-bs-toggle="modal" data-bs-target="#retailer">
                            Register as Retailer
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="card">
            <div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Distributor
                                Registeration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
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
                                            <input class="form-control check-duplicate" required data-field="phone"
                                                data-url="{{ url('checkphoneregister') }}" type="text"
                                                data-error="#dist_phone_err" data-btn="#dist_submit" maxlength="10"
                                                required>
                                            <span class="spinner"></span>
                                            <small id="dist_phone_err" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-1" class="form-label">Aadhaar No</label>
                                            <input class="form-control check-duplicate" name="aadhaar_no"
                                                data-field="aadhaar_no" data-url="{{ url('checkaadharregister') }}"
                                                data-error="#dist_aadhaar_err" data-btn="#dist_submit" maxlength="12"
                                                required>
                                            <span class="spinner"></span>
                                            <small id="dist_aadhaar_err" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-1" class="form-label">Email</label>
                                            <input class="form-control check-duplicate" name="email"
                                                data-field="email" data-url="{{ url('checkemailregister') }}"
                                                data-error="#dist_email_err" data-btn="#dist_submit" required>
                                            <span class="spinner"></span>
                                            <small id="dist_email_err" class="text-danger"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-2" class="form-label">Password</label>
                                            <input required type="password" maxlength="10" name="password"
                                                class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="dist_submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="modal fade" id="retailer" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Retailer
                                Registeration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ url('/saveretailerregister') }}" method="post"
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
                                            <label for="phone" class="form-label">Phone</label>
                                            <input class="form-control check-duplicate" name="phone"
                                                data-field="phone" data-url="{{ url('checkphoneregisterretailer') }}"
                                                data-error="#ret_phone_err" data-btn="#ret_submit" maxlength="10"
                                                required>
                                            <span class="spinner"></span>
                                            <small id="ret_phone_err" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-1" class="form-label">Aadhaar No</label>
                                            <input required class="form-control check-duplicate" name="aadhaar_no"
                                                data-field="aadhaar_no"
                                                data-url="{{ url('checkaadharregisterretailer') }}"
                                                data-error="#ret_aadhaar_err" data-btn="#ret_submit">
                                            <span class="spinner"></span>
                                            <small id="ret_aadhaar_err" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-1" class="form-label">Email</label>
                                            <input required class="form-control check-duplicate" name="email"
                                                data-field="email" data-url="{{ url('checkemailregisterretailer') }}"
                                                data-error="#ret_email_err" data-btn="#ret_submit" required>
                                            <span class="spinner"></span>
                                            <small id="ret_email_err" class="text-danger"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-2" class="form-label">Password</label>
                                            <input required type="password" maxlength="10" name="password"
                                                class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="ret_submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

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
        let debounceTimer = null;

        $(document).on('keyup', '.check-duplicate', function() {

            let input = $(this);
            let value = input.val().trim();
            let url = input.data('url');
            let field = input.data('field');
            let errorBox = $(input.data('error'));
            let submitBtn = $(input.data('btn'));
            let spinner = input.siblings('.spinner');

            clearTimeout(debounceTimer);

            if (value.length < 3) {
                input.removeClass('is-valid is-invalid');
                errorBox.text('');
                submitBtn.prop('disabled', true);
                return;
            }

            debounceTimer = setTimeout(() => {

                spinner.show();

                $.post(url, {
                    [field]: value,
                    _token: "{{ csrf_token() }}"
                }, function(res) {

                    spinner.hide();

                    if (res.exists) {
                        input.addClass('is-invalid').removeClass('is-valid');
                        errorBox.text(field.replace('_', ' ') + ' already exists');
                        submitBtn.prop('disabled', true);
                    } else {
                        input.addClass('is-valid').removeClass('is-invalid');
                        errorBox.text('');
                        toggleSubmit(submitBtn);
                    }

                });

            }, 500);
        });

        function toggleSubmit(button) {
            let form = button.closest('form');
            button.prop('disabled', form.find('.is-invalid').length > 0);
        }
    </script>

</body>

</html>
