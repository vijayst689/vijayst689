<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/auth-basic-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Aug 2025 10:06:30 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>Pkrmsolution.com</title>
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

 <style>
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d, #1a2a6c);
    background-size: 400% 400%;
    animation: bgMove 15s ease infinite;
    font-family: 'Roboto', sans-serif;
}

@keyframes bgMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Floating Center Area */
.section-authentication-signin {
    animation: floatPage 6s ease-in-out infinite;
}

@keyframes floatPage {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
}

/* Login Card */
.card {
    border-radius: 25px !important;
    background: rgba(255,255,255,0.92) !important;
    backdrop-filter: blur(12px);
    box-shadow: 0 30px 90px rgba(0,0,0,0.45) !important;
    animation: fadeInZoom 1.2s ease;
    transition: all 0.4s ease;
}

.card:hover {
    box-shadow: 0 0 60px rgba(253,187,45,0.8) !important;
    transform: translateY(-10px) scale(1.03);
}

/* Logo */
.card img {
    filter: drop-shadow(0 0 20px rgba(253,187,45,0.8));
}

/* Inputs */
.form-control {
    border-radius: 16px !important;
    padding: 14px 16px !important;
    border: 2px solid rgba(178,31,31,0.2) !important;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #fdbb2d !important;
    box-shadow: 0 0 18px rgba(253,187,45,0.8) !important;
    transform: scale(1.04);
}

/* Button */
.btn-primary {
    background: linear-gradient(45deg, #fdbb2d, #b21f1f) !important;
    border: none !important;
    border-radius: 18px !important;
    font-weight: 700;
    letter-spacing: 1px;
    box-shadow: 0 12px 35px rgba(178,31,31,0.7);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #b21f1f, #fdbb2d) !important;
    box-shadow: 0 0 45px rgba(253,187,45,1);
    transform: translateY(-4px) scale(1.05);
}

/* Titles */
h5 {
    font-weight: 800;
    background: linear-gradient(45deg, #b21f1f, #fdbb2d);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Links */
a {
    color: #b21f1f !important;
    font-weight: 600;
}

a:hover {
    color: #fdbb2d !important;
}

/* Separater */
.login-separater span {
    color: #b21f1f;
    font-weight: 700;
}

/* Entry Animation */
@keyframes fadeInZoom {
    from {
        opacity: 0;
        transform: scale(0.85) translateY(40px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
</style>


</head>

<body class="">
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=919664389493798&ev=PageView&noscript=1" />
    </noscript>
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('assets/images/logo-icon.png') }}" width="120"
                                            alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Pkrmsolution.com</h5>
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="post" action="{{ route('login.custom') }}">
                                            {{ csrf_field() }}
                                            {{-- <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Phone</label>
                                                <input type="text" maxlength="10" name="phone" id="phone"
                                                    class="form-control number" placeholder="Phone">
                                                <small id="phone-status"></small>
                                            </div> --}}
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    id="inputEmailAddress" placeholder="Email">
                                            </div>

                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name="password"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                         @if ($errors->has('login_error'))
                                                <div class="alert alert-danger text-center">
                                                    {{ $errors->first('login_error') }}
                                                </div>
                                            @endif
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" id="login_error" class="btn btn-primary">Sign in</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Don't have an account yet? <a
                                                            href="{{ url('register') }}">Sign up here</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
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
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
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
    </script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }, {
        'ap': 'cpsh-oh'
    }, {
        'server': 'p3plzcpnl509132'
    }, {
        'dcenter': 'p3'
    }, {
        'cp_id': '10399385'
    }, {
        'cp_cl': '8'
    }) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script>
    document.getElementById('phone').addEventListener('keyup', function() {
        let phone = this.value.trim();
        let status = document.getElementById('phone-status');
        let btn = document.getElementById('signin-btn');

        // If input is empty → disable button & clear status
        if (phone === "") {
            status.innerHTML = "";
            btn.disabled = true;
            return;
        }

        // Call DB check
        fetch("{{ route('check.phonelogin') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    phone: phone
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.exists) {
                    // Phone found in DB → correct
                    status.innerHTML = "<span style='color:green;'>Phone number correct</span>";
                    btn.disabled = false; // Enable button
                } else {
                    // Phone not found → incorrect
                    status.innerHTML = "<span style='color:red;'>Phone number incorrect</span>";
                    btn.disabled = true; // Disable button
                }
            });
    });
</script>
<script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>

</html>
