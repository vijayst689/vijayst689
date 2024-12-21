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
                                    <a href="{{ url('/about_us') }}" class="nav-link">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/contact_us')}}" class=" nav-link active">
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
    <div id="banner" class="page-title-area position-relative z-1" >
        <div class="container">
            <div class="page-title-content text-center">
                <h2>Contact Us</h2>
                <ul class="list-unstyled ps-0 mb-0">
                    <li class="d-inline-block">
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li class="d-inline-block">
                        Contact
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

    <!-- Start Contact Area -->
    <div class="contact-area pt-136 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-contact-content">
                        <div class="section-title">
                            <span class="d-inline-block sub-title">Contact Us</span>
                            <h2>
                                Get In
                                <span class="position-relative">
                                    Touch
                                    <img src="{{ asset('assetss/images/shapes/title-shape.svg') }}" alt="shape">
                                </span>
                            </h2>
                        </div>
                        <div class="contact-list d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/contact1.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h3>Email-Us :</h3>
                                <a href="mailto:pkrmsolution@gmail.com">
                                pkrmsolution@gmail.com
                                </a>
                            </div>
                        </div>
                        <div class="contact-list d-flex align-items-center">
                            <div class="icon bg-2">
                                <img src="{{ asset('assetss/images/icon/contact2.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h3>Call Us :</h3>
                                <a href="tel:+91 98431 61942">
                                +91 98431 61942
                                </a>
                            </div>
                        </div>
                        <div class="contact-list d-flex align-items-center">
                            <div class="icon">
                                <img src="{{ asset('assetss/images/icon/contact3.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h3>Office :</h3>
                                <span>Attur (Tk) , Salem (Dt), Tamilnadu -636108</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="single-contact-form style-2">
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name*">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Website Address">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control textarea" placeholder="Your Message*"></textarea>
                            </div>
                            <button class="default-btn2 style-3 border-0">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->

    <!-- Start Contact Map -->
    <div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d62532.92932298285!2d78.54452806791127!3d11.601370731974905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s40%2F4%20%2C%20Sarkar%20Udaiyam%20patti%20%2C%20Narasingapuram%20%2C%20Attur%20%2C%20Salem%2C%20Tamilnadu%20-636108!5e0!3m2!1sen!2sin!4v1734343019348!5m2!1sen!2sin" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- End Contact Map -->
    <!-- Start Footer Area -->
    <footer class="footer-area position-relative z-1 pt-136 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="single-footer-widget logo-info" >
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
                        <div class="single-footer-widget links-info" >
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
                        <div class="single-footer-widget links-info" >
                            <p>The Common Services Centres (CSCs) are key to India's National e-Governance Plan (NeGP). They offer government and private services digitally, focusing on rural and remote areas.</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget app-info" >
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
                        <div class="copyright-content" >
                            <p>© Copyright 2024 | Maran Software Solutions | All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright-list" >
                            <ul class="list-unstyled ps-0 mb-0">
                                <li class="d-inline-block">
                                    <a href="{{ url('/home') }}">
                                        Home
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="{{ url('about_us') }}">
                                        About us
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="{{ url('contact_us') }}" class="active">
                                        Contact us
                                    </a>
                                </li>
                                <li class="d-inline-block" >
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