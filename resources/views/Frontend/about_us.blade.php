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
                                <li class="nav-item">
                                    <a href="{{ url('/admin')}}" class="nav-link">
                                        Login
                                    </a>
                                </li>
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
           <div id="banner" class="page-title-area position-relative z-1" data-cue="slideInUp">
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
                        <div class="about-image style-2" data-cue="slideInUp">
                            <div class="image-one text-end">
                                <img src="{{ asset('assetss/images/about/about5.jpg') }}" alt="about-image">
                            </div>
                            <div class="image-two">
                                <img src="{{ asset('assetss/images/about/about6.jpg') }}" alt="about-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content style-2" data-cue="slideInUp">
                            <div class="section-title">
                                <span class="d-inline-block sub-title">About Edugen</span>
                                <h2>
                                    Discover Our Vision for Digital 
                                    <span class="position-relative">
                                        Education
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
                                <div class="icon">
                                    <a target="_blank" data-fslightbox="gallery" href="https://www.youtube.com/watch?v=3nQNiWdeH2Q">
                                        <img src="{{ asset('assetss/images/icon/video-play.svg') }}" alt="icon">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3>All Classes Video Provided</h3>
                                    <p>There are many variations of passages of but the majority have suffered.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Area -->

        <!-- Start Choose Area -->
        <div class="choose-area position-relative z-1 pt-136">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="choose-content" data-cue="slideInUp">
                            <div class="section-title">
                                <span class="d-inline-block sub-title">Why Choose Us</span>
                                <h2>
                                    One Platform & Many  
                                    <span class="position-relative">
                                        Courses
                                        <img src="{{ asset('assetss/images/shapes/title-shape.svg') }}" alt="shape">
                                    </span>
                                    For You
                                </h2>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown </p>
                            <div class="choose-progress">
                                <div class="ce-ixelgen-progress-bar block">
                                    <div class="progress-bar text-start">
                                        <div class="progress-bar-item">
                                            <h3>Skill Mastery Levels</h3>
                                            <div class="item-value">0%</div>
                                            <div class="item-bar">
                                                <div class="progress" data-progress="90"></div>
                                            </div>
                                        </div>
                                        <div class="progress-bar-item">
                                            <h3>Learning Milestones</h3>
                                            <div class="item-value">0%</div>
                                            <div class="item-bar">
                                                <div class="progress" data-progress="92"></div>
                                            </div>
                                        </div>
                                        <div class="progress-bar-item">
                                            <h3>Digital Proficiency Journey</h3>
                                            <div class="item-value">0%</div>
                                            <div class="item-bar">
                                                <div class="progress" data-progress="92"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="choose-image position-relative z-1" data-cue="slideInUp">
                            <img src="{{ asset('assetss/images/choose/choose1.png') }}" alt="choose-image">
                            <div class="bg-shape">
                                <img src="{{ asset('assetss/images/choose/choose-image-shape.svg') }}" alt="">
                            </div>
                            <div class="shape4">
                                <img src="{{ asset('assetss/images/shapes/shape4.svg') }}" alt="shape">
                            </div>
                            <div class="shape5">
                                <img src="{{ asset('assetss/images/shapes/shape5.svg') }}" alt="shape">
                            </div>
                            <div class="shape6">
                                <img src="{{ asset('assetss/images/shapes/shape6.svg') }}" alt="shape">
                            </div>
                            <div class="shape7">
                                <img src="{{ asset('assetss/images/shapes/shape7.svg') }}" alt="shape">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shapes">
                <div class="shape3">
                    <img src="{{ asset('assetss/images/shapes/shape3.svg') }}" alt="shape">
                </div>
            </div>
        </div>
        <!-- End Choose Area -->


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
        
        <!-- Start Testimonials Area -->
        <div class="testimonial-area pt-136 pb-110">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="testimonial-image position-relative z-1" data-cue="slideInUp">
                            <div class="image position-relative z-1">
                                <img src="{{ asset('assetss/images/testimonial/bg-shape.svg') }}" alt="shape">
                                <img class="main-image" src="{{ asset('assetss/images/testimonial/testimonial1.jpg') }}" alt="">
                            </div>
                            <div class="user-image">
                                <div class="image1">
                                    <img src="{{ asset('assetss/images/testimonial/testimonial2.jpg') }}" alt="testimonial-image">
                                </div>
                                <div class="image2">
                                    <img src="{{ asset('assetss/images/testimonial/testimonial3.jpg') }}" alt="testimonial-image">
                                </div>
                                <div class="image3">
                                    <img src="{{ asset('assetss/images/testimonial/testimonial4.jpg') }}" alt="testimonial-image">
                                </div>
                                <div class="image4">
                                    <img src="{{ asset('assetss/images/testimonial/testimonial5.jpg') }}" alt="testimonial-image">
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-responsive-image d-md-none">
                            <img src="{{ asset('assetss/images/testimonial/testimonial7.png') }}" alt="testimonial-image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial-content" data-cue="slideInUp">
                            <div class="section-title">
                                <span class="d-inline-block sub-title">Testimonials</span>
                                <h2>
                                    Voices of Success: Hear from Our
                                    <span class="position-relative">
                                        Students
                                        <img src="{{ asset('assetss/images/shapes/title-shape.svg') }}" alt="shape">
                                    </span>
                                </h2>
                            </div>
                            <div class="testimonial-slider-info owl-carousel owl-theme">
                                <div class="item">
                                    <p>Enrolling in courses at Edugen was the best decision I made for my career. The instructors were incredibly knowledgeable and supportive, guiding me through every step of the learning process. Thanks to their expert guidance, I was able to land a job in my desired field even before completing the course. I highly recommend [Institute Name] to anyone looking to upskill and advance their career in the digital world.</p>
                                    <div class="users-info d-flex align-items-center">
                                        <div class="image">
                                            <img src="{{ asset('assetss/images/testimonial/testimonial6.jpg') }}" alt="testimonial-image">
                                        </div>
                                        <div class="content">
                                            <h3>Krystal France</h3>
                                            <span>Ex-Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <p>Enrolling in courses at Edugen was the best decision I made for my career. The instructors were incredibly knowledgeable and supportive, guiding me through every step of the learning process. Thanks to their expert guidance, I was able to land a job in my desired field even before completing the course. I highly recommend [Institute Name] to anyone looking to upskill and advance their career in the digital world.</p>
                                    <div class="users-info d-flex align-items-center">
                                        <div class="image">
                                            <img src="{{ asset('assetss/images/testimonial/testimonial6.jpg') }}" alt="testimonial-image">
                                        </div>
                                        <div class="content">
                                            <h3>Krystal France</h3>
                                            <span>Ex-Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <p>Enrolling in courses at Edugen was the best decision I made for my career. The instructors were incredibly knowledgeable and supportive, guiding me through every step of the learning process. Thanks to their expert guidance, I was able to land a job in my desired field even before completing the course. I highly recommend [Institute Name] to anyone looking to upskill and advance their career in the digital world.</p>
                                    <div class="users-info d-flex align-items-center">
                                        <div class="image">
                                            <img src="{{ asset('assetss/images/testimonial/testimonial6.jpg') }}" alt="testimonial-image">
                                        </div>
                                        <div class="content">
                                            <h3>Krystal France</h3>
                                            <span>Ex-Student</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonials Area -->
        
        <!-- Start Team Area -->
        <div class="team-area style-2 position-relative z-1 pt-136 pb-110">
            <div class="container">
                <div class="section-title text-center mx-auto" data-cue="slideInUp">
                    <span class="d-inline-block sub-title">Team Members</span>
                    <h2>
                        Meet Out 
                        <span class="position-relative">
                            Instructors
                            <img src="{{ asset('assetss/images/shapes/title-shape.svg') }}" alt="shape">
                        </span>
                    </h2>
                </div>
                <div class="row" data-cues="fadeIn">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-info">
                            <div class="content">
                                <h3>Karl Clarkson</h3>
                                <p>Instructor</p>
                            </div>
                            <div class="image position-relative">
                                <img src="{{ asset('assetss/images/team/team4.jpg') }}" alt="team-image">
                                <div class="social-list">
                                    <div class="share-icon">
                                        <img src="{{ asset('assetss/images/icon/share.svg') }}" alt="icon">
                                    </div>
                                    <ul class="list-unstyled ps-0 mb-0 icons">
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://x.com/home" target="_blank">
                                                <i class="ri-twitter-x-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-info">
                            <div class="content">
                                <h3>Gloria Bush</h3>
                                <p>Instructor</p>
                            </div>
                            <div class="image position-relative">
                                <img src="{{ asset('assetss/images/team/team5.jpg') }}" alt="team-image">
                                <div class="social-list">
                                    <div class="share-icon">
                                        <img src="{{ asset('assetss/images/icon/share.svg') }}" alt="icon">
                                    </div>
                                    <ul class="list-unstyled ps-0 mb-0 icons">
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://x.com/home" target="_blank">
                                                <i class="ri-twitter-x-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-info">
                            <div class="content">
                                <h3>Teresa Ransom</h3>
                                <p>Instructor</p>
                            </div>
                            <div class="image position-relative">
                                <img src="{{ asset('assetss/images/team/team6.jpg') }}" alt="team-image">
                                <div class="social-list">
                                    <div class="share-icon">
                                        <img src="{{ asset('assetss/images/icon/share.svg') }}" alt="icon">
                                    </div>
                                    <ul class="list-unstyled ps-0 mb-0 icons">
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://x.com/home" target="_blank">
                                                <i class="ri-twitter-x-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-team-info">
                            <div class="content">
                                <h3>Debra Webster</h3>
                                <p>Instructor</p>
                            </div>
                            <div class="image position-relative">
                                <img src="{{ asset('assetss/images/team/team7.jpg') }}" alt="team-image">
                                <div class="social-list">
                                    <div class="share-icon">
                                        <img src="{{ asset('assetss/images/icon/share.svg') }}" alt="icon">
                                    </div>
                                    <ul class="list-unstyled ps-0 mb-0 icons">
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://x.com/home" target="_blank">
                                                <i class="ri-twitter-x-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shapes">
                <div class="shape10">
                    <img src="{{ asset('assetss/images/shapes/shape10.svg') }}" alt="shape">
                </div>
                <div class="shape25">
                    <img src="{{ asset('assetss/images/shapes/shape25.svg') }}" alt="shape">
                </div>
            </div>
        </div>
        <!-- End Team Area -->

    <!-- Start Footer Area -->
    <footer class="footer-area position-relative z-1 pt-136 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-footer-widget logo-info" data-cue="slideInUp">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('assetss/images/white-logo.svg') }}" alt="white-logo">
                            </a>
                        </div>
                        <p>Lorem ipsum amet, consectetur adipiscing elit. Suspendis varius enim eros elementum
                            tristique. Duis cursus.</p>
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
                                <a href="blog-details.html" class="active">
                                    Company
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="mailto:themeies3@gmail.com">
                                    Support
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="privacy-policy.html">
                                    Privacy
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="contact.html">
                                    Contact
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