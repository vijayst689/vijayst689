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
						<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: block;">
							<ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a href="{{url('/home')}}" class=" nav-link active">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/about_us')}}" class="nav-link">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/contact_us')}}" class="nav-link">
                                        Contacts
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


        <!-- Start Categories Area -->
        <div class="categories-area pt-136 pb-110">
            <div class="container">
            <div class="section-title text-center" data-cue="slideInUp" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                    <span class="d-inline-block sub-title">Most Featured services</span>
                    <h2>
                        Explore Our 
                        <span class="position-relative">
                            services
                            <img src="{{ asset('assetss//images/shapes/title-shape.svg') }}" alt="shape">
                        </span>
                    </h2>
                </div>
                <div class="row" data-cues="fadeIn">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                            <div>
                            <img  src="{{ asset('assetss/images/service/nalavariyam.png') }}" alt="bg-shape">
                            </div>
                            <h3>Nalavariyam</h3>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                            <img  src="{{ asset('assetss/images/service/images.png') }}" width="61%" alt="bg-shape">
                            </div>
                            <h3>E-aadhar</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                        <div>
                            <img  src="{{ asset('assetss/images/service/utility.png') }}"  width="61%" alt="bg-shape">
                            </div>
                            <h3>Utility Services</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service2.png') }}"  width="61%" alt="bg-shape">
                            </div>
                            <h3>Pancard Services</h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service3.png') }}"  width="61%" alt="bg-shape">
                            </div>
                            <h3>TNeGA</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service4.png') }}"  width="85%" alt="bg-shape">
                            </div>
                            <h3>MSME</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service8.png') }}"  width="61%" alt="bg-shape">
                            </div>
                            <h3>EPFO</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                            <div>
                            <img  src="{{ asset('assetss/images/service/service10.png') }}"  width="61%" alt="bg-shape">
                            </div>
                            <h3>LIC</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                            <div>
                            <img  src="{{ asset('assetss/images/service/service6.png') }}"  width="81%" alt="bg-shape">
                            </div>
                            <h3>FSSAI</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service7.png') }}"  width="92%" alt="bg-shape">
                            </div>
                            <h3>Documentations</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/service5.png') }}"  width="94%" alt="bg-shape">
                            </div>
                            <h3>Passport Services</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-categories-card second-color text-center">
                        <div>
                        <img  src="{{ asset('assetss/images/service/Smart1.png') }}"  width="64%" alt="bg-shape">
                            </div>
                            <h3>Family card</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Categories Area -->
        <!-- Start Footer Area -->
        <footer class="footer-area position-relative z-1 pt-136 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="single-footer-widget logo-info" data-cue="slideInUp">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{ asset('assetss/images/mudiu.png') }}" alt="white-logo">
                                </a>
                            </div>
                            <p>Lorem ipsum amet, consectetur adipiscing elit. Suspendis varius enim eros elementum tristique. Duis cursus.</p>
                            <a href="mailto:themeies3@gmail.com" class="email">
                                support.edugen@email.com
                            </a>
                            <ul class="list-unstyled ps-0 mb-0 social-link">
                                <li class="d-inline-block">
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="https://x.com/home" target="_blank">
                                        <i class="ri-twitter-x-fill"></i>
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="https://www.linkedin.com/" target="_blank">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="https://www.google.com/" target="_blank">
                                        <i class="ri-google-fill"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3">
                        <div class="single-footer-widget links-info" data-cue="slideInUp">
                            <h3>Links</h3>
                            <ul class="list-unstyled ps-0 mb-0">
                                <li>
                                    <a href="index.html">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="about.html">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="courses-list.html">
                                        Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="courses-details.html">
                                        Courses Details
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="single-footer-widget links-info" data-cue="slideInUp">
                            <h3>Legal</h3>
                            <ul class="list-unstyled ps-0 mb-0">
                                <li>
                                    <a href="blog-with-sidebar.html">
                                        Trems of Use
                                    </a>
                                </li>
                                <li>
                                    <a href="terms-conditions.html">
                                        Tearm & Condition
                                    </a>
                                </li>
                                <li>
                                    <a href="courses-details.html">
                                        Payment Method
                                    </a>
                                </li>
                                <li>
                                    <a href="privacy-policy.html">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="blog-standard.html">
                                        Licensencing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget app-info" data-cue="slideInUp">
                            <h3>Install Our App</h3>
                            <span>From App Store Or Google Play</span>
                            <ul class="list-unstyled ps-0 mb-0">
                                <li class="d-inline-block">
                                    <a href="https://play.google.com/store/games?device=windows&amp;pli=1" target="_blank">
                                        <img src="{{ asset('assetss/images/icon/google.svg') }}" alt="google">
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="https://www.apple.com/app-store/" target="_blank">
                                        <img src="{{ asset('assetss/images/icon/app-store.svg') }}" alt="app-store">
                                    </a>
                                </li>
                            </ul>
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
                        <div class="copyright-content" data-cue="slideInUp">
                            <p>© Copyright 2024 | Edugen Template | All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright-list" data-cue="slideInUp">
                            <ul class="list-unstyled ps-0 mb-0">
                                <li class="d-inline-block">
                                    <a href="{{ url('/home') }}" class="active">
                                        Home
                                    </a>
                                </li>
                                <li class="d-inline-block">
                                    <a href="{{ url('about_us') }}">
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
                <a href="#banner">
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
