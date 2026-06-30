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
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '919664389493798');
        fbq('track', 'PageView');
    </script>

    <!-- Facebook Domain Verification -->
    <meta name="facebook-domain-verification" content="o7tjuxul606tpvrxq094bhwog98hc5" />
</head>

<body class="">
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=919664389493798&ev=PageView&noscript=1" />
    </noscript>
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

                                                            <input type="text"
                                                                class="form-control check-duplicate number"
                                                                name="phone" data-field="phone"
                                                                data-url="{{ url('checkphoneregister') }}"
                                                                data-error="#dist_phone_err" data-btn="#dist_submit"
                                                                maxlength="10" required>

                                                            <span class="spinner"></span>

                                                            <small id="dist_phone_err" class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Aadhaar No</label>
                                                            <input type="text" required
                                                                class="form-control check-duplicate number"
                                                                name="aadhaar_no" data-field="aadhaar_no"
                                                                data-url="{{ url('checkaadharregister') }}"
                                                                data-error="#ret_aadhaar_err" data-btn="#ret_submit"
                                                                maxlength="12">
                                                            <span class="spinner"></span>
                                                            <small id="dist_aadhaar_err" class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Email</label>
                                                            <input class="form-control check-duplicate" name="email"
                                                                data-field="email"
                                                                data-url="{{ url('checkemailregister') }}"
                                                                data-error="#dist_email_err" data-btn="#dist_submit"
                                                                required>
                                                            <span class="spinner"></span>
                                                            <small id="dist_email_err" class="text-danger"></small>
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
                                                    <button type="submit" id="dist_submit" class="btn btn-primary"
                                                        disabled>Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a
                                                            href="{{ url('login') }}">Sign in here</a></p>
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
                                                            <label for="field-2" class="form-label">Phone</label>

                                                            <input type="text"
                                                                class="form-control check-duplicate number"
                                                                name="phone" data-field="phone"
                                                                data-url="{{ url('checkphoneregisterretailer') }}"
                                                                data-error="#dist_phone_err" data-btn="#dist_submit"
                                                                maxlength="10" required>

                                                            <span class="spinner"></span>

                                                            <small id="dist_phone_err" class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Aadhaar
                                                                No</label>
                                                            <input type="text" required
                                                                class="form-control check-duplicate number"
                                                                name="aadhaar_no" data-field="aadhaar_no"
                                                                data-url="{{ url('checkaadharregisterretailer') }}"
                                                                data-error="#ret_aadhaar_err" data-btn="#ret_submit"
                                                                maxlength="12">
                                                            <span class="spinner"></span>
                                                            <small id="ret_aadhaar_err" class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="field-1" class="form-label">Email</label>
                                                            <input class="form-control check-duplicate" name="email"
                                                                data-field="email"
                                                                data-url="{{ url('checkemailregisterretailer') }}"
                                                                data-error="#ret_email_err" data-btn="#ret_submit"
                                                                required>
                                                            <span class="spinner"></span>
                                                            <small id="ret_email_err" class="text-danger"></small>
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
                                                    <button type="submit" id="ret_submit" class="btn btn-primary"
                                                        disabled>Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a
                                                            href="{{ url('login') }}">Sign in here</a></p>
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

        $(".number").on("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
