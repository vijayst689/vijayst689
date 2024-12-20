<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pkrm Solutions</title>
    <link rel="icon" type="image/png" href="{{ asset('assetss/images/pkrm.png') }}') }}">

    <!-- Link of CSS files -->
    <link rel="stylesheet" href="{{ asset('assetss/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/fonts/regular/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/fonts/fill/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/fonts/bold/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/scrollCue.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/responsive.css') }}">
</head>

<body>

    <!-- Preloader -->
    <div class="preloader-area position-fixed start-0 top-0 end-0 bottom-0 text-center">
        <div class="preloader">
            <img src="{{ asset('assetss/images/pkrm.png') }}" alt="preloader">
            <div class="waviy fw-bold">
                <span class="position-relative d-inline-block">P</span>
                <span class="position-relative d-inline-block">k</span>
                <span class="position-relative d-inline-block">r</span>
                <span class="position-relative d-inline-block">m</span>
                <span class="position-relative d-inline-block">S</span>
                <span class="position-relative d-inline-block">o</span>
                <span class="position-relative d-inline-block">l</span>
                <span class="position-relative d-inline-block">u</span>
                <span class="position-relative d-inline-block">t</span>
                <span class="position-relative d-inline-block">i</span>
                <span class="position-relative d-inline-block">o</span>
                <span class="position-relative d-inline-block">n</span>
                <span class="position-relative d-inline-block">s</span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Start Navbar Area -->
    <div class="navbar-area fixed-top is-sticky" style="background-color: floralwhite;">
        <div class="mobile-responsive-nav">
            <div class="container">
                <div class="mobile-responsive-menu">
                    <div class="logo">
                        <a href="{{ url('login') }}">
                            <img src="{{ asset('assetss/images/mudiu.png') }}" width="400%" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="desktop-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <img src="{{ asset('assetss/images/mudiu.png') }}" width="15%" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: block;" id="top">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a href="{{url('/home')}}" class="nav-link">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/about_us') }}" class="nav-link active">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/contact_us')}}" class="nav-link">
                                    Contact us
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                    <a href="{{ url('/admin')}}" class="nav-link">
                                        Login
                                    </a>
                                </li> -->
                        </ul>
                        <div class="others-option position-relative d-flex align-items-center">
                            <div class="option-item">
                                <a href="{{ url('/admin')}}" class="default-btn2">
                                    Admin Login
                                    <img src="{{ asset('assetss/images/icon/left-small.svg') }}" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="option-inner">
                        <div class="others-options justify-content-center d-flex align-items-center">
                            <div class="option-item">
                                <a href="{{ url('/admin')}}" class="default-btn2">
                                    Admin Login
                                    <img src="{{ asset('assetss/images/icon/left-small.svg') }}" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->

    <!-- Start Page Title Area -->
    <div id="banner" class="page-title-area position-relative z-1">
        <div class="container">
            <div class="page-title-content text-center">
                <h2>About Us</h2>
                <ul class="list-unstyled ps-0 mb-0">
                    <li class="d-inline-block">
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li class="d-inline-block">
                        About Us
                    </li>
                </ul>
            </div>
        </div>
        <div class="pages1">
            <img src="{{ asset('assetss/images/shapes/pages1.png') }}" alt="shape">
        </div>
        <div class="pages2">
            <img src="{{ asset('assetss/images/shapes/pages2.png') }}" alt="shape">
        </div>
        <div class="pages3">
            <img src="{{ asset('assetss/images/shapes/pages3.png') }}" alt="shape">
        </div>
        <div class="pages4">
            <img src="{{ asset('assetss/images/shapes/pages4.svg') }}" alt="shape">
        </div>
        <div class="pages5">
            <img src="{{ asset('assetss/images/shapes/pages5.svg') }}" alt="shape">
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start About Area -->
    <div class="about-area style-2 pt-136 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-image style-2">
                        <div class="image-one text-end">
                            <img src="{{ asset('assetss/images/about/eSevai_trans.png') }}" alt="about-image">
                        </div>
                        <div class="image-two">
                            <img src="{{ asset('assetss/images/about/eseavai.jpg') }}" alt="about-image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content style-2">
                        <div class="section-title">
                            <span class="d-inline-block sub-title">About Pkrm Solutions</span>
                            <h2>
                                Discover Our Vision for Online
                                <span class="position-relative">
                                    Services
                                    <img src="{{ asset('assetss/images/shapes/title-shape.svg') }}" alt="shape">
                                </span>
                            </h2>
                        </div>
                        <div class="awards-info">
                            <div class="row">
                                <div class="col-lg-7 col-sm-7">
                                    <div class="awards-list">
                                        <ul class="list-unstyled ps-0 mb-0">
                                            <li>
                                                Digital skill empowerment
                                                <img src="{{ asset('assetss/images/about/check.svg') }}" alt="icon">
                                            </li>
                                            <li>
                                                Expert-led courses
                                                <img src="{{ asset('assetss/images/about/check.svg') }}" alt="icon">
                                            </li>
                                            <li>
                                                Career-focused education
                                                <img src="{{ asset('assetss/images/about/check.svg') }}" alt="icon">
                                            </li>
                                            <li>
                                                Supportive learning
                                                <img src="{{ asset('assetss/images/about/check.svg') }}" alt="icon">
                                            </li>
                                            <li>
                                                Life-changing digital education
                                                <img src="{{ asset('assetss/images/about/check.svg') }}" alt="icon">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-5">
                                    <div class="awards-card text-center">
                                        <div class="icon">
                                            <img src="{{ asset('assetss/images/about/awards-logo.svg') }}" alt="logo">
                                        </div>
                                        <h3>25+</h3>
                                        <p>Winning Awards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="video-info d-flex align-items-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->




    <!-- Start Funfact Area -->
    <div class="funfact-area position-relative z-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-funfact-info">
                        <div class="image">
                            <img src="{{ asset('assetss/images/funfact/funfact1.jpg') }}" alt="funfact-image">
                        </div>
                        <div class="content d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/funfact1.svg') }}" alt="icon">
                            </div>
                            <div class="text">
                                <h3>
                                    <span class="counter">75K</span>
                                    +
                                </h3>
                                <p>Enrolled Students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-funfact-info">
                        <div class="image">
                            <img src="{{ asset('assetss/images/funfact/funfact1.jpg') }}" alt="funfact-image">
                        </div>
                        <div class="content d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/funfact2.svg') }}" alt="icon">
                            </div>
                            <div class="text">
                                <h3>
                                    <span class="counter">324</span>
                                    +
                                </h3>
                                <p>Enrolled Students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-funfact-info">
                        <div class="image">
                            <img src="{{ asset('assetss/images/funfact/funfact1.jpg') }}" alt="funfact-image">
                        </div>
                        <div class="content d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/funfact3.svg') }}" alt="icon">
                            </div>
                            <div class="text">
                                <h3>
                                    <span class="counter">22</span>
                                    K+
                                </h3>
                                <p>Certified Students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-funfact-info">
                        <div class="image">
                            <img src="{{ asset('assetss/images/funfact/funfact1.jpg') }}" alt="funfact-image">
                        </div>
                        <div class="content d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/funfact4.svg') }}" alt="icon">
                            </div>
                            <div class="text">
                                <h3>
                                    <span class="counter">30</span>
                                    +
                                </h3>
                                <p>Skilled Instructor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Funfact Area -->



    <!-- Start Footer Area -->
    <footer class="footer-area position-relative z-1 pt-136 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-footer-widget logo-info">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('assetss/images/mudiu.png') }}" alt="white-logo">
                            </a>
                        </div>
                        <!-- <p>The Common Services Centres (CSCs) are key to India's National e-Governance Plan (NeGP). They offer government and private services digitally, focusing on rural and remote areas.</p> -->
                        <a href="mailto:pkrmsolution@gmail.com" class="email">
                            pkrmsolution@gmail.com
                        </a>
                        <ul class="list-unstyled ps-0 mb-0 social-link">
                            <li class="d-inline-block">
                                <a href="https://www.facebook.com/pkrmsolutioncsc" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="https://www.instagram.com/pkrm.solution/profilecard/?igsh=ODlmZXoyZHN2djA=" target="_blank">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-md-3">
                    <div class="single-footer-widget links-info">
                        <h3>Links</h3>
                        <ul class="list-unstyled ps-0 mb-0">
                            <li>
                                <a href="{{ url('/home') }}">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/about_us') }}">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/contact_us') }}">
                                    Contact us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="single-footer-widget links-info">
                        <p>The Common Services Centres (CSCs) are key to India's National e-Governance Plan (NeGP). They offer government and private services digitally, focusing on rural and remote areas.</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget app-info">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('assetss/images/mudiu.png') }}" alt="white-logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shapes">
            <div class="shape12">
                <img src="{{ asset('assetss/images/shapes/shape12.svg') }}" alt="shape">
            </div>
            <div class="shape13">
                <img src="{{ asset('assetss/images/shapes/shape13.svg') }}" alt="shape">
            </div>
            <div class="shape14">
                <img src="{{ asset('assetss/images/shapes/shape14.svg') }}" alt="shape">
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->

    <!-- Start Copyright Area -->
    <div class="copyright-area position-relative z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5">
                    <div class="copyright-content">
                        <p>© Copyright 2024 | Maran Software Solutions | All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="copyright-list">
                        <ul class="list-unstyled ps-0 mb-0">
                            <li class="d-inline-block">
                                <a href="{{ url('/home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ url('about_us') }}" class="active">
                                    About us
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ url('contact_us') }}">
                                    Contact us
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ url('login') }}">
                                    Login
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="icon-info">
            <a href="#top">
                <img src="{{ asset('assetss/images/icon/up-icon.svg') }}" alt="icon">
            </a>
        </div>
    </div>
    <!-- End Copyright Area -->


    <!-- Link of JS files -->
    <script src="{{ asset('assetss/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assetss/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetss/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('assetss/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assetss/js/scrollCue.min.js') }}"></script>
    <script src="{{ asset('assetss/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assetss/js/main.js') }}"></script>
</body>

</html>