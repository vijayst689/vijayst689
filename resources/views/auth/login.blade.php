<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pragadeesheservice.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        /* Sliding Background Animation */
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(270deg,
                    #134e5e,
                    #71b280,
                    #2c3e50,
                    #4ca1af,
                    #1f4037,
                    #200122,
                    #6f0000,
                    #ff512f,
                    #dd2476,
                    #3a1c71);
            background-size: 1500% 1500%;
            animation: gradientSlide 30s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientSlide {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Center Login Form with Glassmorphism Effect */
        .login-card {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            padding: 40px 30px;
            width: 350px;
            color: #fff;
        }

        .login-card h4,
        .login-card p {
            color: #fff;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            box-shadow: none;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff512f, #dd2476);
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        a {
            color: #ffd700;
        }
    </style>
</head>

<body>

    <div class="login-card text-center">
        <h4 class="mb-3">Welcome Back!</h4>
        <p>Sign in to continue to <strong>Pragadeesheservice.com</strong></p>

        <form method="POST" action="{{ route('login.custom') }}">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
            </div>

            <div class="mb-3 text-start">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger text-center">
                    {{ $errors->first('login_error') }}
                </div>
            @endif
            <button class="btn btn-primary w-100" id="login_error" type="submit">Log In <i
                    class="fas fa-sign-in-alt ms-1"></i></button>
        </form>

        <p class="mt-3">Don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
    </div>

</body>

</html>
