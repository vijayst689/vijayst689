@extends('Frontend.layouts.app')
@section('content')

<main>
    <div class="tp-team-area pb-95">
        <div class="container container-1230">
            <div class="row">
                <div class="col-12">
                    <div class="text-center mb-60 appear anime-child anime-complete" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [30, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;:0, &quot;staggervalue&quot;: 300, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
                        <h2 class="tp-ff-jakarta fs-60 fs-lg-45 fs-xs-35 lh-1 ls-m-4 tp-text-common-black-3">Passionate professionals<br> driving excellence</h2>
                    </div>
                </div>
            </div>
            <div class="row appear anime-child anime-complete" data-anime="{ &quot;el&quot;: &quot;childs&quot;, &quot;translateY&quot;: [50, 0], &quot;opacity&quot;: [0,1], &quot;duration&quot;: 600, &quot;delay&quot;:0, &quot;staggervalue&quot;: 150, &quot;easing&quot;: &quot;easeOutQuad&quot; }">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="tp-team-cpr-thumb mb-30 tp-fade-up-hover fix tp-img-hover mb-30">
                        <div class="tp-team-cpr-inner fix mb-20 tp-round-10 p-relative">
                            <img class="w-100 tp-round-10 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/team/team.jpg') }}" alt="team">
                            <div class="tp-team-cpr-social d-flex align-items-center justify-content-between">
                                <a class="tp-team-cpr-link tp-fade-up-15 tp-ff-manrope fw-700 fs-12 text-uppercase text-white" href="#">VIEW <i class="fa-regular fa-arrow-up-right"></i></a>
                                <a class="tp-team-cpr-link-2 tp-fade-up-10" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="tp-team-cpr-content">
                            <span class="tp-ff-jakarta fs-14 fw-500 ">Owner &amp; Founder</span>
                            <h3 class="tp-ff-jakarta tp-text-common-black-3 fs-24 ls-m-2"><a class="underline-black" href="#">James Warren</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="tp-team-cpr-thumb mb-30 tp-fade-up-hover fix tp-img-hover mb-30">
                        <div class="tp-team-cpr-inner fix mb-20 tp-round-10 p-relative">
                            <img class="w-100 tp-round-10 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/team/team-2.jpg') }}" alt="team">
                            <div class="tp-team-cpr-social d-flex align-items-center justify-content-between">
                                <a class="tp-team-cpr-link tp-fade-up-15 tp-ff-manrope fw-700 fs-12 text-uppercase text-white" href="#">VIEW <i class="fa-regular fa-arrow-up-right"></i></a>
                                <a class="tp-team-cpr-link-2 tp-fade-up-10" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="tp-team-cpr-content">
                            <span class="tp-ff-jakarta fs-14 fw-500 ">Project Manager</span>
                            <h3 class="tp-ff-jakarta tp-text-common-black-3 fs-24 ls-m-2"><a class="underline-black" href="#">Kristin Watson</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="tp-team-cpr-thumb mb-30 tp-fade-up-hover fix tp-img-hover mb-30">
                        <div class="tp-team-cpr-inner fix mb-20 tp-round-10 p-relative">
                            <img class="w-100 tp-round-10 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/team/team-3.jpg') }}" alt="team">
                            <div class="tp-team-cpr-social d-flex align-items-center justify-content-between">
                                <a class="tp-team-cpr-link tp-fade-up-15 tp-ff-manrope fw-700 fs-12 text-uppercase text-white" href="#">VIEW <i class="fa-regular fa-arrow-up-right"></i></a>
                                <a class="tp-team-cpr-link-2 tp-fade-up-10" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="tp-team-cpr-content">
                            <span class="tp-ff-jakarta fs-14 fw-500 ">Developer</span>
                            <h3 class="tp-ff-jakarta tp-text-common-black-3 fs-24 ls-m-2"><a class="underline-black" href="#">Droupadi Murmu</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="tp-team-cpr-thumb mb-30 tp-fade-up-hover fix tp-img-hover mb-30">
                        <div class="tp-team-cpr-inner fix mb-20 tp-round-10 p-relative">
                            <img class="w-100 tp-round-10 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/team/team-4.jpg') }}" alt="team">
                            <div class="tp-team-cpr-social d-flex align-items-center justify-content-between">
                                <a class="tp-team-cpr-link tp-fade-up-15 tp-ff-manrope fw-700 fs-12 text-uppercase text-white" href="#">VIEW <i class="fa-regular fa-arrow-up-right"></i></a>
                                <a class="tp-team-cpr-link-2 tp-fade-up-10" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </div>
                        </div>
                        <div class="tp-team-cpr-content">
                            <span class="tp-ff-jakarta fs-14 fw-500 ">Manager</span>
                            <h3 class="tp-ff-jakarta tp-text-common-black-3 fs-24 ls-m-2"><a class="underline-black" href="#">Jimmy Piterson</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tp-about-area-start -->
    <div class="tp-about-area pt-140 pb-110">
        <div class="container-1230 container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tp-about-cpr-thumb-wrap mb-30">
                        <div class="tp-about-cpr-thumb p-relative mr-200">
                            <img class="w-100 tp-round-10" src="{{ asset('assetss/img/corporate/about/about-2.jpg') }}" alt="thumb">
                            <div class="tp-about-cpr-round" data-parallax='{"y": -50, "smoothness": 30}'>
                                <div class="tp-about-cpr-round-text tp-bg-common-white p-relative d-inline-block rounded-circle">
                                    <img class="rotate-infinite-2" src="{{ asset('assetss/img/corporate/about/text-shape.png') }}" alt="">
                                    <span class="tp-funfact-digi-round-icon rounded-circle rotate-infinite">
                                        <img src="{{ asset('assetss/img/corporate/about/about-shae.png') }}" alt="">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="tp-about-cpr-thumb-2 p-relative z-index-1 ml-200 mr-80">
                            <img class="w-100 tp-round-10" data-parallax='{"y": -50, "smoothness": 30}' src="{{ asset('assetss/img/corporate/about/about.jpg') }}" alt="thumb">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tp-about-cpr-content mb-15" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-pisces fw-700 fs-14 ls-2 tp-ff-jakarta">LET’S KNOW ABOUT US</span>
                        <h2 class="tp-ff-jakarta fs-58 fs-lg-45 fs-xs-35 lh-1 ls-m-4 tp-text-common-black-3 mb-25">Creating innovative solutions for business.</h2>
                        <p class="tp-text-grey-3 mb-30 lh-32 tp-ff-jakarta fs-17">Chesterton, a writer of paradoxical stories, is the contrarian on our list.
                            He speaks for the pig-headed and visionary alike. Sometimes one
                            must buck the conventional wisdom.</p>
                        <div class="tp-about-cpr-feature-list mb-55">
                            <ul>
                                <li>
                                    <span>
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.54528 1.27356L3.92028 7.04896L1.36346 4.42378" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Responsible for leading project team
                                </li>
                                <li>
                                    <span>
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.54528 1.27356L3.92028 7.04896L1.36346 4.42378" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Conduct business research & analysis
                                </li>
                                <li>
                                    <span>
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.54528 1.27356L3.92028 7.04896L1.36346 4.42378" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Specific areas such as corporate
                                </li>
                            </ul>
                        </div>
                        <div class="tp-about-cpr-btn">
                            <a href="about.html" class="tp-btn-lg mb-15 tp-btn-gradient tp-btn-switch-animation mr-15 tp-round-10 fs-18 tp-text-common-white hover-text-white fw-700 d-inline-block text-center tp-ff-jakarta">
                                <span class="d-flex align-items-center justify-content-center">
                                    <span class="btn-text">Get started now</span>
                                    <span class="btn-icon"><i class="ml-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                                    <span class="btn-icon"><i class="mr-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                                </span>
                            </a>
                            <a href="tel:+441236547890" class="tp-btn-lg mb-15 tp-btn-cpr-border-2 d-inline-block tp-round-10 fs-18 tp-text-common-pisces fw-600 text-center tp-ff-jakarta">
                                +44 123 654 7890
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-about-area-end -->

    <!-- tp-success-area-start -->
    <div class="tp-success-area pb-135">
        <div class="container container-1230">
            <div class="row" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 500, "easing": "easeOutQuad" }'>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="tp-success-digi-item tp-success-cpr-item text-center mb-30">
                        <span class="tp-success-digi-icon mb-25 tp-ff-jakarta fw-600 fs-30 ls-m-4 tp-text-grey-3">01</span>
                        <h3 class="tp-text-common-black-3 fw-700 fs-20 tp-ff-jakarta mb-10">Planning project</h3>
                        <p class="lh-24 tp-text-grey-3 tp-ff-jakarta">We love to bring designs to life<br>
                            developer, and I aim to</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="tp-success-digi-item tp-success-cpr-item text-center mb-30">
                        <span class="tp-success-digi-icon mb-25 tp-ff-jakarta fw-600 fs-30 ls-m-4 tp-text-grey-3">02</span>
                        <h3 class="tp-text-common-black-3 fw-700 fs-20 tp-ff-jakarta mb-10">Team working</h3>
                        <p class="lh-24 tp-text-grey-3 tp-ff-jakarta">We love to bring designs to life<br>
                            developer, and I aim to</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="tp-success-digi-item tp-success-cpr-item text-center mb-30">
                        <span class="tp-success-digi-icon mb-25 tp-ff-jakarta fw-600 fs-30 ls-m-4 tp-text-grey-3">03</span>
                        <h3 class="tp-text-common-black-3 fw-700 fs-20 tp-ff-jakarta mb-10">Follow flowchart</h3>
                        <p class="lh-24 tp-text-grey-3 tp-ff-jakarta">We love to bring designs to life<br>
                            developer, and I aim to</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="tp-success-digi-item tp-success-cpr-item text-center mb-30">
                        <span class="tp-success-digi-icon mb-25 tp-ff-jakarta fw-600 fs-30 ls-m-4 tp-text-grey-3">04</span>
                        <h3 class="tp-text-common-black-3 fw-700 fs-20 tp-ff-jakarta mb-10">User testing</h3>
                        <p class="lh-24 tp-text-grey-3 tp-ff-jakarta">We love to bring designs to life<br>
                            developer, and I aim to</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-success-area-end -->

    <!-- tp-servce-area-start -->
    <div class="tp-service-area tp-gradient-bg pt-140 pb-80 p-relative z-index-1">
        <img class="tp-service-cpr-shape" data-parallax='{"y": 200, "smoothness": 30}' src="{{ asset('assetss/img/corporate/service/shape.png') }}" alt="shape">
        <div class="container-1230 container">
            <div class="row align-items-end mb-30">
                <div class="col-lg-9">
                    <div class="tp-service-title-wrap" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-pisces fw-700 fs-14 ls-2 tp-ff-jakarta">SERVICE WE PROVIDE</span>
                        <h2 class="tp-ff-jakarta fs-58 fs-xs-35 lh-1 ls-m-4 tp-text-common-black-3 mb-25">Our excellent service</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tp-service-cpr-navigation text-right mb-30">
                        <span class="tp-service-cpr-prev d-inline-block">
                            <svg width="31" height="16" viewBox="0 0 31 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.11216 5.33156L6.01804 0.374974C6.13588 0.256158 6.27609 0.16185 6.43057 0.0974922C6.58504 0.0331343 6.75073 0 6.91808 0C7.08543 0 7.25112 0.0331343 7.4056 0.0974922C7.56007 0.16185 7.70028 0.256158 7.81812 0.374974C8.05423 0.612488 8.18675 0.93378 8.18675 1.26868C8.18675 1.60358 8.05423 1.92487 7.81812 2.16239L3.30523 6.71332H29.153C29.4892 6.71332 29.8116 6.84687 30.0494 7.08461C30.2871 7.32234 30.4207 7.64478 30.4207 7.98099V7.98099C30.4207 8.31719 30.2871 8.63963 30.0494 8.87736C29.8116 9.1151 29.4892 9.24865 29.153 9.24865H3.22916L7.81812 13.8249C7.93694 13.9428 8.03125 14.083 8.09561 14.2375C8.15996 14.3919 8.1931 14.5576 8.1931 14.725C8.1931 14.8923 8.15996 15.058 8.09561 15.2125C8.03125 15.367 7.93694 15.5072 7.81812 15.625C7.70028 15.7438 7.56007 15.8382 7.4056 15.9025C7.25112 15.9669 7.08543 16 6.91808 16C6.75073 16 6.58504 15.9669 6.43057 15.9025C6.27609 15.8382 6.13588 15.7438 6.01804 15.625L1.11216 10.7065C0.399979 9.99341 -4.3869e-05 9.02681 -4.3869e-05 8.01901C-4.3869e-05 7.01122 0.399979 6.04462 1.11216 5.33156Z" fill="currentColor" fill-opacity="1" />
                            </svg>
                        </span>
                        <span class="tp-service-cpr-next ml-15 d-inline-block">
                            <svg width="31" height="16" viewBox="0 0 31 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.3085 5.33156L24.4026 0.374974C24.2848 0.256158 24.1446 0.16185 23.9901 0.0974922C23.8356 0.0331343 23.6699 0 23.5026 0C23.3352 0 23.1695 0.0331343 23.0151 0.0974922C22.8606 0.16185 22.7204 0.256158 22.6025 0.374974C22.3664 0.612488 22.2339 0.93378 22.2339 1.26868C22.2339 1.60358 22.3664 1.92487 22.6025 2.16239L27.1154 6.71332H1.26767C0.931462 6.71332 0.609025 6.84687 0.371292 7.08461C0.133558 7.32234 0 7.64478 0 7.98099H0C0 8.31719 0.133558 8.63963 0.371292 8.87736C0.609025 9.1151 0.931462 9.24865 1.26767 9.24865H27.1915L22.6025 13.8249C22.4837 13.9428 22.3894 14.083 22.325 14.2375C22.2607 14.3919 22.2276 14.5576 22.2276 14.725C22.2276 14.8923 22.2607 15.058 22.325 15.2125C22.3894 15.367 22.4837 15.5072 22.6025 15.625C22.7204 15.7438 22.8606 15.8382 23.0151 15.9025C23.1695 15.9669 23.3352 16 23.5026 16C23.6699 16 23.8356 15.9669 23.9901 15.9025C24.1446 15.8382 24.2848 15.7438 24.4026 15.625L29.3085 10.7065C30.0207 9.99341 30.4207 9.02681 30.4207 8.01901C30.4207 7.01122 30.0207 6.04462 29.3085 5.33156Z" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tp-service-cpr-slider-wrap">
                    <div class="swiper-container tp-service-cpr-slider" data-anime='{ "translateX": [100, 0], "opacity": [0,1], "duration": 800, "delay": 100, "staggervalue": 250, "easing": "easeOutQuad" }'>
                        <div class="swiper-wrapper mb-60">
                            <div class="swiper-slide">
                                <div class="tp-service-cpr-item tp-round-10 tp-bg-common-white tp-img-hover">
                                    <div class="fix tp-round-6 mb-25">
                                        <img class="tp-round-6 w-100 tp-img-hover-inner-up" src="{{ asset('assetss/img/corporate/service/service.jpg') }}" alt="">
                                    </div>
                                    <div class="tp-service-cpr-content">
                                        <h3 class="tp-service-cpr-title mb-15 tp-ff-jakarta fs-600 fs-22 tp-text-common-black-3 ls-m-2"><a class="underline-black" href="service-details.html">Social media marketing</a></h3>
                                        <div class="tp-service-cpr-btn d-flex align-items-center justify-content-between">
                                            <a class="d-inline-block text-center rounded-circle hover-text-white" href="service-details.html">
                                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.24264 9.24267L9.72792 0.757385M9.72792 0.757385H1.24264M9.72792 0.757385V9.24267" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            <span class="tp-service-cpr-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-service-cpr-item tp-round-10 tp-bg-common-white tp-img-hover">
                                    <div class="fix tp-round-6 mb-25">
                                        <img class="tp-round-6 w-100 tp-img-hover-inner-up" src="{{ asset('assetss/img/corporate/service/service-2.jpg') }}" alt="">
                                    </div>
                                    <div class="tp-service-cpr-content">
                                        <h3 class="tp-service-cpr-title mb-15 tp-ff-jakarta fs-600 fs-22 tp-text-common-black-3 ls-m-2"><a class="underline-black" href="service-details.html">Digital marketing</a></h3>
                                        <div class="tp-service-cpr-btn d-flex align-items-center justify-content-between">
                                            <a class="d-inline-block text-center rounded-circle hover-text-white" href="service-details.html">
                                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.24264 9.24267L9.72792 0.757385M9.72792 0.757385H1.24264M9.72792 0.757385V9.24267" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            <span class="tp-service-cpr-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-service-cpr-item tp-round-10 tp-bg-common-white tp-img-hover">
                                    <div class="fix tp-round-6 mb-25">
                                        <img class="tp-round-6 w-100 tp-img-hover-inner-up" src="{{ asset('assetss/img/corporate/service/service-3.jpg') }}" alt="">
                                    </div>
                                    <div class="tp-service-cpr-content">
                                        <h3 class="tp-service-cpr-title mb-15 tp-ff-jakarta fs-600 fs-22 tp-text-common-black-3 ls-m-2"><a class="underline-black" href="service-details.html">Business consulting</a></h3>
                                        <div class="tp-service-cpr-btn d-flex align-items-center justify-content-between">
                                            <a class="d-inline-block text-center rounded-circle hover-text-white" href="service-details.html">
                                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.24264 9.24267L9.72792 0.757385M9.72792 0.757385H1.24264M9.72792 0.757385V9.24267" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            <span class="tp-service-cpr-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-service-cpr-item tp-round-10 tp-bg-common-white tp-img-hover">
                                    <div class="fix tp-round-6 mb-25">
                                        <img class="tp-round-6 w-100 tp-img-hover-inner-up" src="{{ asset('assetss/img/corporate/service/service-2.jpg') }}" alt="">
                                    </div>
                                    <div class="tp-service-cpr-content">
                                        <h3 class="tp-service-cpr-title mb-15 tp-ff-jakarta fs-600 fs-22 tp-text-common-black-3 ls-m-2"><a class="underline-black" href="service-details.html">Market research</a></h3>
                                        <div class="tp-service-cpr-btn d-flex align-items-center justify-content-between">
                                            <a class="d-inline-block text-center rounded-circle hover-text-white" href="service-details.html">
                                                <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.24264 9.24267L9.72792 0.757385M9.72792 0.757385H1.24264M9.72792 0.757385V9.24267" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            <span class="tp-service-cpr-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-servce-area-end -->

    <!-- tp-cta-area-start -->
    <div class="tp-cta-area pt-45 pb-25 tp-gradient-bg-2">
        <div class="container container-1230">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="tp-cta-cpr-content d-flex align-items-center flex-wrap" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <img class="mr-50 mb-20" src="{{ asset('assetss/img/corporate/cta/cta.png') }}" alt="cta">
                        <h2 class="tp-ff-jakarta mb-20 fs-30 ls-m-2 tp-text-common-white">Need any types of business<br> consulting help</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tp-cta-cpr-btn text-right mb-20" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="contact.html" class="tp-btn-lg tp-bg-common-white tp-btn-switch-animation mr-15 tp-round-10 fs-18 tp-text-common-black-3 hover-text-black fw-700 d-inline-block text-center tp-ff-jakarta">
                            <span class="d-flex align-items-center justify-content-center">
                                <span class="btn-text">Contact us</span>
                                <span class="btn-icon"><i class="ml-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                                <span class="btn-icon"><i class="mr-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-cta-area-end -->

    <!-- tp-chose-area-start -->
    <div class="tp-chose-area pt-140 pb-110 fix p-relative">
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-7">
                    <div class="tp-service-title-wrap mb-65" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-pisces fw-700 fs-14 ls-2 tp-ff-jakarta">WHY CHOOSE OUR UNCUT</span>
                        <h2 class="tp-ff-jakarta fs-58 fs-lg-47 fs-xs-35 lh-1 ls-m-4 tp-text-common-black-3">You should choose us to move on your business system with bizon</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="tp-chose-cpr-thumb mb-30">
                        <div class="atropos" data-atropos>
                            <div class="atropos-scale">
                                <div class="atropos-rotate">
                                    <div class="atropos-inner">
                                        <div data-atropos-offset="-5">
                                            <img class="tp-round-6 w-100" src="{{ asset('assetss/img/corporate/chose/thumb.jpg') }}" alt="thumb">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 align-items-end d-flex">
                    <div class="tp-chose-cpr-content counter-style-01 ml-100 mb-55" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="d-inline-block">
                            <span class="fw-600 lh-110-per vertical-counter tp-text-common-black-3 ls-m-4 d-inline-flex fs-80 fs-sm-50 tp-ff-jakarta mb-5" data-text="%" data-to="93"></span>
                        </div>
                        <p class="tp-ff-jakarta fw-600 fs-22 lh-28 tp-text-common-black-3 mb-35">Track and analysis<br> business reports</p>
                        <div class="tp-about-progress tp-about-progress-purple mb-50">
                            <div class="progress-bar " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="Value for results"></div>
                        </div>
                        <div class="tp-about-cpr-feature-list">
                            <ul>
                                <li>
                                    <span>
                                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.9998 1L4.12482 7.875L0.999817 4.75" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Visual project management
                                </li>
                                <li>
                                    <span>
                                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.9998 1L4.12482 7.875L0.999817 4.75" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Monitoring information
                                </li>
                                <li>
                                    <span>
                                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.9998 1L4.12482 7.875L0.999817 4.75" stroke="#AA3FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    Team collabration
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="tp-chose-cpr-chart mb-30">
                        <img class="w-100" src="{{ asset('assetss/img/corporate/chose/chart.png') }}" alt="chart">
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-chose-cpr-big-text text-center p-absolute">
            <img data-parallax='{"x": 100, "smoothness": 30}' src="{{ asset('assetss/img/corporate/chose/wow.png') }}" alt="">
            <h2 data-parallax='{"x": -200, "smoothness": 30}' class="tp-ff-jakarta ls-m-4">Bizon</h2>
        </div>
    </div>
    <!-- tp-chose-area-end -->

    <!-- tp-pricing-area-start -->
    <div class="tp-pricing-area tp-bg-common-black-3 p-relative pt-140 pb-110 z-index-1">
        <img class="tp-price-cpr-shape p-absolute" src="{{ asset('assetss/img/corporate/pricing/shape.png') }}" alt="shape">
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-price-cpr-title mb-55 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-white fw-700 fs-14 ls-2 tp-ff-jakarta">OUR SUITABLE PRICING PLAN</span>
                        <h2 class="tp-ff-jakarta fs-60 fs-sm-45 fs-xs-35 lh-1 ls-m-4 tp-text-common-white">Choose the right plan for<br> your business</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-price-cpr-item mb-30">
                        <div class="tp-price-cpr-head">
                            <div class="tp-price-cpr-icon mb-20">
                                <img src="{{ asset('assetss/img/corporate/pricing/icon-1.png') }}" alt="">
                            </div>
                            <h5 class="tp-ff-jakarta fs-24 ls-m-2 tp-text-common-white">Individual</h5>
                            <p class="tp-text-grey-3 mb-25 tp-ff-jakarta fs-17 fw-500 ls-m-2 tp-text-common-white">Perfect for your small business</p>
                            <div class="d-flex align-items-end mb-40">
                                <h3 class="tp-text-common-white fs-42 ls-m-4 tp-ff-jakarta mb-0">$55</h3>
                                <span class="tp-ff-jakarta fs-17 ls-m-2 tp-text-common-white mb-5">/month</span>
                            </div>
                        </div>
                        <div class="tp-about-cpr-btn mb-20">
                            <a href="contact.html" class="tp-btn-cpr-border-3 w-100 d-block hover-bg-white hover-text-black tp-round-6 fs-18 tp-text-common-white fw-600 text-center tp-ff-jakarta">
                                Choose plan
                            </a>
                        </div>
                        <div class="tp-price-digi-list tp-price-cpr-list tp-round-6">
                            <ul>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Marketing strategy</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Social media share audit</span>
                                </li>
                                <li class="disable">
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Web and mobile optimize</span>
                                </li>
                                <li class="disable">
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Software update timely</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-price-cpr-item tp-price-cpr-item-main mb-30">
                        <div class="tp-price-cpr-head">
                            <div class="tp-price-cpr-icon mb-20">
                                <img src="{{ asset('assetss/img/corporate/pricing/icon-2.png') }}" alt="">
                            </div>
                            <h5 class="tp-ff-jakarta fs-24 ls-m-2 tp-text-common-white">Business</h5>
                            <p class="tp-text-grey-3 mb-25 tp-ff-jakarta fs-17 fw-500 ls-m-2 tp-text-common-white">Perfect for your small business</p>
                            <div class="d-flex align-items-end mb-40">
                                <h3 class="tp-text-common-white fs-42 ls-m-4 tp-ff-jakarta mb-0">$65</h3>
                                <span class="tp-ff-jakarta fs-17 ls-m-2 tp-text-common-white mb-5">/month</span>
                            </div>
                        </div>
                        <div class="tp-about-cpr-btn mb-20">
                            <a href="contact.html" class="tp-btn-cpr-border-3 d-block w-100 tp-btn-gradient mr-15 tp-round-6 fs-18 tp-text-common-white hover-text-white fw-700 d-inline-block text-center tp-ff-jakarta">
                                Choose plan
                            </a>
                        </div>
                        <div class="tp-price-digi-list tp-price-cpr-list tp-round-6">
                            <ul>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Marketing strategy</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Social media share audit</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Web and mobile optimize</span>
                                </li>
                                <li class="disable">
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Software update timely</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-price-cpr-item mb-30">
                        <div class="tp-price-cpr-head">
                            <div class="tp-price-cpr-icon mb-20">
                                <img src="{{ asset('assetss/img/corporate/pricing/icon-3.png') }}" alt="">
                            </div>
                            <h5 class="tp-ff-jakarta fs-24 ls-m-2 tp-text-common-white">Corporate</h5>
                            <p class="tp-text-grey-3 mb-25 tp-ff-jakarta fs-17 fw-500 ls-m-2 tp-text-common-white">Perfect for your small business</p>
                            <div class="d-flex align-items-end mb-40">
                                <h3 class="tp-text-common-white fs-42 ls-m-4 tp-ff-jakarta mb-0">$75</h3>
                                <span class="tp-ff-jakarta fs-17 ls-m-2 tp-text-common-white mb-5">/month</span>
                            </div>
                        </div>
                        <div class="tp-about-cpr-btn mb-20">
                            <a href="contact.html" class="tp-btn-cpr-border-3 w-100 d-block hover-bg-white hover-text-black tp-round-6 fs-18 tp-text-common-white fw-600 text-center tp-ff-jakarta">
                                Choose plan
                            </a>
                        </div>
                        <div class="tp-price-digi-list tp-price-cpr-list tp-round-6">
                            <ul>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Marketing strategy</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Social media share audit</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Web and mobile optimize</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5451 1.27295L3.9201 7.04835L1.36328 4.42317" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span> Software update timely</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-pricing-area-end -->

    <!-- tp-faq-area-start -->
    <div class="tp-faq-area pt-140 pb-80">
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-7">
                    <div class="tp-faq-cpr-title mb-30" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-pisces fw-700 fs-14 ls-2 tp-ff-jakarta">OUR CAPABLITIES</span>
                        <h2 class="tp-ff-jakarta fs-36 fw-600 ls-m-4 tp-text-common-black-3 lh-117-per">We take any challenge of the<br> digital world to create your<br> corporate shape.</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="tp-faq-digi-wrap tp-faq-cpr-wrap mb-30" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <div class="tp-faq-digi-wrap-accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-items">
                                    <h2 class="accordion-header tp-ff-jakarta fs-20 lh-1">
                                        <button class="accordion-buttons collapsed fw-600" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Website & mobile app design
                                            <span class="accordion-icon"></span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="fs-17 tp-text-grey-3 tp-ff-jakarta">
                                                Chesterton, a writer of paradoxical stories, is the
                                                on our list. He speaks for the pig-headed
                                                must buck the conventional wisdom.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-items">
                                    <h2 class="accordion-header tp-ff-jakarta fs-20 lh-1">
                                        <button class="accordion-buttons fw-600" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Motion graphics & animations
                                            <span class="accordion-icon"></span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="fs-17 tp-text-grey-3 tp-ff-jakarta">
                                                Chesterton, a writer of paradoxical stories, is the
                                                on our list. He speaks for the pig-headed
                                                must buck the conventional wisdom.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-items">
                                    <h2 class="accordion-header tp-ff-jakarta fs-20 lh-1">
                                        <button class="accordion-buttons collapsed fw-600" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            User experience
                                            <span class="accordion-icon"></span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="fs-17 tp-text-grey-3 tp-ff-jakarta">
                                                Chesterton, a writer of paradoxical stories, is the
                                                on our list. He speaks for the pig-headed
                                                must buck the conventional wisdom.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-faq-area-end -->

    <!-- brand area start -->
    <div class="tp-brand-area tp-brand-ptb pb-95">
        <div class="container container-1230">
            <div class="tp-brand-slide-box-2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-brand-cpr-slider">
                            <div class="swiper-container tp-brand-digi-slider-active">
                                <div class="swiper-wrapper slide-transtion">
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-1.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-2.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-3.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-4.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-5.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tp-brand-item text-center">
                                            <img src="{{ asset('assetss/img/corporate/brand/logo-3.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand area end -->

    <!-- tp-video-area-start -->
    <div class="tp-video-area">
        <div class="container container-1230">
            <div class="tp-video-cpr-wrap fix p-relative tp-round-10 bg-position jarallax" data-background="{{ asset('assetss/img/corporate/video/video.jpg') }}">
                <h3 class="tp-video-cpr-big-title tp-ff-jakarta ls-m-2 tp-text-common-white" data-parallax='{"x": -200, "smoothness": 30}'>Corporate</h3>
                <span class="tp-video-cpr-tag tp-ff-jakarta tp-round-17 d-inline-block fw-600 fs-14 text-uppercase tp-text-common-white">CORPORATE</span>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="tp-video-cpr-content mb-60">
                            <h3 class="tp-ff-jakarta fs-36 ls-m-4 tp-text-common-white lh-117-per mb-20">Together we can make<br> world creative</h3>
                            <div class="tp-video-cpr-inner d-flex align-items-center">
                                <a class="tp-btn-video popup-video d-inline-block text-center mr-15"
                                    href="https://www.youtube.com/watch?v=go7QYaQR494">
                                    <span class="tp-text-common-white"><i class="fa-sharp fa-solid fa-play"></i></span>
                                </a>
                                <div class="d-block">
                                    <span class="tp-ff-jakarta fs-14 ls-m-2 tp-text-common-white fw-600">Click to watch</span>
                                    <h6 class="fs-20 tp-ff-jakarta tp-text-common-white lh-1 mb-0">See how it works</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-video-area-end -->

    <!-- tp-testimonial-area-start -->
    <div class="tp-testimonial-area tp-testimonial-cpr-bg pt-145 pb-90 p-relative z-index-1">
        <img class="tp-testimonial-cpr-shape-2 p-absolute" src="{{ asset('assetss/img/corporate/testimonial/map.png') }}" alt="map">
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-testimonial-title-wrap text-center mb-65" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="lh-1 fs-60 fs-lg-45 tp-text-common-black-3 tp-ff-jakarta ls-m-2">1500k happy clients</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="swiper-container tp-testimonial-digi-slide mb-55 tp-cursor-point-area" data-anime='{ "translateX": [100, 0], "opacity": [0,1], "duration": 800, "delay": 100, "staggervalue": 250, "easing": "easeOutQuad" }'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="tp-testimonial-cpr-item tp-bg-common-white z-index-1 p-relative tp-round-10">
                                    <div class="tp-testimonial-cpr-shape p-absolute">
                                        <span>
                                            <svg width="210" height="211" viewBox="0 0 210 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M169.699 153.299L173.599 184.898C174.599 193.198 165.699 198.998 158.599 194.698L116.7 169.798C112.1 169.798 107.6 169.498 103.2 168.898C110.6 160.199 115 149.198 115 137.298C115 108.899 90.4 85.8994 60.0003 85.8994C48.4005 85.8994 37.7006 89.1991 28.8007 94.9991C28.5007 92.4991 28.4006 89.999 28.4006 87.3991C28.4006 41.8995 67.9002 5 116.7 5C165.499 5 204.999 41.8995 204.999 87.3991C204.999 114.399 191.099 138.299 169.699 153.299Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M114.999 137.293C114.999 149.192 110.599 160.193 103.199 168.893C93.2992 180.892 77.5993 188.592 59.9994 188.592L33.8997 204.092C29.4997 206.792 23.8998 203.092 24.4998 197.992L26.9997 178.293C13.5999 168.993 5 154.092 5 137.293C5 119.693 14.4 104.193 28.7998 94.9932C37.6997 89.1933 48.3996 85.8936 59.9994 85.8936C90.3991 85.8936 114.999 108.893 114.999 137.293Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="tp-testimonial-digi-ratings d-flex mb-15">
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="lh-26 tp-ff-jakarta fs-17 tp-text-common-black-3 fw-500 mb-35">We've been working with Evolve for
                                        over a year now and we're happy
                                        with the results.</p>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-20" src="{{ asset('assetss/img/corporate/testimonial/tes-1.png') }}" alt="">
                                        <div class="info">
                                            <span class="fs-14 tp-ff-jakarta tp-text-grey-3">Co founder</span>
                                            <h5 class="tp-ff-jakarta fs-17 tp-text-common-black-3 ls-m-2 fw-600 lh-1 mb-0">Allison George </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-testimonial-cpr-item tp-bg-common-white z-index-1 p-relative tp-round-10">
                                    <div class="tp-testimonial-cpr-shape p-absolute">
                                        <span>
                                            <svg width="210" height="211" viewBox="0 0 210 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M169.699 153.299L173.599 184.898C174.599 193.198 165.699 198.998 158.599 194.698L116.7 169.798C112.1 169.798 107.6 169.498 103.2 168.898C110.6 160.199 115 149.198 115 137.298C115 108.899 90.4 85.8994 60.0003 85.8994C48.4005 85.8994 37.7006 89.1991 28.8007 94.9991C28.5007 92.4991 28.4006 89.999 28.4006 87.3991C28.4006 41.8995 67.9002 5 116.7 5C165.499 5 204.999 41.8995 204.999 87.3991C204.999 114.399 191.099 138.299 169.699 153.299Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M114.999 137.293C114.999 149.192 110.599 160.193 103.199 168.893C93.2992 180.892 77.5993 188.592 59.9994 188.592L33.8997 204.092C29.4997 206.792 23.8998 203.092 24.4998 197.992L26.9997 178.293C13.5999 168.993 5 154.092 5 137.293C5 119.693 14.4 104.193 28.7998 94.9932C37.6997 89.1933 48.3996 85.8936 59.9994 85.8936C90.3991 85.8936 114.999 108.893 114.999 137.293Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="tp-testimonial-digi-ratings d-flex mb-15">
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="lh-26 tp-ff-jakarta fs-17 tp-text-common-black-3 fw-500 mb-35">We've been working with Evolve for
                                        over a year now and we're happy
                                        with the results.</p>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-20" src="{{ asset('assetss/img/corporate/testimonial/tes-2.png') }}" alt="">
                                        <div class="info">
                                            <span class="fs-14 tp-ff-jakarta tp-text-grey-3">Designer</span>
                                            <h5 class="tp-ff-jakarta fs-17 tp-text-common-black-3 ls-m-2 fw-600 lh-1 mb-0">Harshal Mitra</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-testimonial-cpr-item tp-bg-common-white z-index-1 p-relative tp-round-10">
                                    <div class="tp-testimonial-cpr-shape p-absolute">
                                        <span>
                                            <svg width="210" height="211" viewBox="0 0 210 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M169.699 153.299L173.599 184.898C174.599 193.198 165.699 198.998 158.599 194.698L116.7 169.798C112.1 169.798 107.6 169.498 103.2 168.898C110.6 160.199 115 149.198 115 137.298C115 108.899 90.4 85.8994 60.0003 85.8994C48.4005 85.8994 37.7006 89.1991 28.8007 94.9991C28.5007 92.4991 28.4006 89.999 28.4006 87.3991C28.4006 41.8995 67.9002 5 116.7 5C165.499 5 204.999 41.8995 204.999 87.3991C204.999 114.399 191.099 138.299 169.699 153.299Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M114.999 137.293C114.999 149.192 110.599 160.193 103.199 168.893C93.2992 180.892 77.5993 188.592 59.9994 188.592L33.8997 204.092C29.4997 206.792 23.8998 203.092 24.4998 197.992L26.9997 178.293C13.5999 168.993 5 154.092 5 137.293C5 119.693 14.4 104.193 28.7998 94.9932C37.6997 89.1933 48.3996 85.8936 59.9994 85.8936C90.3991 85.8936 114.999 108.893 114.999 137.293Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="tp-testimonial-digi-ratings d-flex mb-15">
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="lh-26 tp-ff-jakarta fs-17 tp-text-common-black-3 fw-500 mb-35">We've been working with Evolve for
                                        over a year now and we're happy
                                        with the results.</p>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-20" src="{{ asset('assetss/img/corporate/testimonial/tes-3.png') }}" alt="">
                                        <div class="info">
                                            <span class="fs-14 tp-ff-jakarta tp-text-grey-3">Manager</span>
                                            <h5 class="tp-ff-jakarta fs-17 tp-text-common-black-3 ls-m-2 fw-600 lh-1 mb-0">Richard Vanman</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tp-testimonial-cpr-item tp-bg-common-white z-index-1 p-relative tp-round-10">
                                    <div class="tp-testimonial-cpr-shape p-absolute">
                                        <span>
                                            <svg width="210" height="211" viewBox="0 0 210 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M169.699 153.299L173.599 184.898C174.599 193.198 165.699 198.998 158.599 194.698L116.7 169.798C112.1 169.798 107.6 169.498 103.2 168.898C110.6 160.199 115 149.198 115 137.298C115 108.899 90.4 85.8994 60.0003 85.8994C48.4005 85.8994 37.7006 89.1991 28.8007 94.9991C28.5007 92.4991 28.4006 89.999 28.4006 87.3991C28.4006 41.8995 67.9002 5 116.7 5C165.499 5 204.999 41.8995 204.999 87.3991C204.999 114.399 191.099 138.299 169.699 153.299Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M114.999 137.293C114.999 149.192 110.599 160.193 103.199 168.893C93.2992 180.892 77.5993 188.592 59.9994 188.592L33.8997 204.092C29.4997 206.792 23.8998 203.092 24.4998 197.992L26.9997 178.293C13.5999 168.993 5 154.092 5 137.293C5 119.693 14.4 104.193 28.7998 94.9932C37.6997 89.1933 48.3996 85.8936 59.9994 85.8936C90.3991 85.8936 114.999 108.893 114.999 137.293Z" stroke="#FBFBFB" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="tp-testimonial-digi-ratings d-flex mb-15">
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                        <span><i class="fa-sharp fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="lh-26 tp-ff-jakarta fs-17 tp-text-common-black-3 fw-500 mb-35">We've been working with Evolve for
                                        over a year now and we're happy
                                        with the results.</p>
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-20" src="{{ asset('assetss/img/corporate/testimonial/tes-2.png') }}" alt="">
                                        <div class="info">
                                            <span class="fs-14 tp-ff-jakarta tp-text-grey-3">Designer</span>
                                            <h5 class="tp-ff-jakarta fs-17 tp-text-common-black-3 ls-m-2 fw-600 lh-1 mb-0">Harshal Mitra</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <div class="tp-testimonial-cpr-navigation mb-30">
                        <span class="tp-testimonial-digi-prev">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="tp-testimonial-digi-next">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-8">
                    <div class="tp-testimonial-cpr-customers counter-style-01 d-flex align-items-center justify-content-end mb-30">
                        <div class="d-inline-block mr-15">
                            <span class="fw-700 lh-110-per vertical-counter tp-text-common-pisces ls-m-4 d-inline-flex fs-60 fs-sm-50 tp-ff-jakarta" data-text="%" data-to="98"></span>
                        </div>
                        <h3 class="tp-ff-jakarta fw-500 fs-17 tp-text-common-black-2 lh-26">Genuine repeated<br> happy customers</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-testimonial-area-end -->

    <!-- tp-blog-area-start -->
    <div class="tp-blog-area pt-140 pb-110">
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-blog-cpr-title mb-55" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="tp-cpr-section-subtitle mb-20 d-inline-block tp-round-17 tp-text-common-pisces fw-700 fs-14 ls-2 tp-ff-jakarta">FROM OUR BLOG POST</span>
                        <h2 class="tp-ff-jakarta fs-58 fs-sm-45 lh-1 ls-m-4 tp-text-common-black-3">Content, production and<br> our strategy</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-blog-cpr-item tp-round-10 tp-img-hover p-relative mb-30">
                        <span class="tp-blog-cpr-tag tp-ff-jakarta z-index-2 fw-600 tp-round-20 tp-bg-common-white d-inline-block fs-14 text-uppercase tp-text-common-black-3">CORPORATE</span>
                        <div class="tp-blog-cpr-thumb tp-round-6 fix">
                            <img class="w-100 tp-round-6 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/blog/blog-1.jpg') }}" alt="blog">
                        </div>
                        <div class="tp-blog-cpr-content">
                            <h3 class="tp-ff-jakarta fw-600 mb-30 fs-22 ls-m-2 lh-26 tp-text-common-black-3"><a href="blog-details.html" class="underline-black">The highly creative workflow from a silicon valley</a></h3>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mr-10" src="{{ asset('assetss/img/corporate/blog/blog-sm-1.png') }}" alt="blog">
                                    <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3">Shalini Gautam</span>
                                </div>
                                <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3"><i class="fa-regular fa-clock"></i> 14 July, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-blog-cpr-item tp-round-10 p-relative tp-img-hover mb-30">
                        <span class="tp-blog-cpr-tag tp-ff-jakarta z-index-2 fw-600 tp-round-20 tp-bg-common-white d-inline-block fs-14 text-uppercase tp-text-common-black-3">AGENCY</span>
                        <div class="tp-blog-cpr-thumb tp-round-6 fix">
                            <img class="w-100 tp-round-6 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/blog/blog-2.jpg') }}" alt="blog">
                        </div>
                        <div class="tp-blog-cpr-content">
                            <h3 class="tp-ff-jakarta fw-600 mb-30 fs-22 ls-m-2 lh-26 tp-text-common-black-3"><a href="blog-details.html" class="underline-black">Corporate agencies bring a wealth of knowledge</a></h3>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mr-10" src="{{ asset('assetss/img/corporate/blog/blog-sm-2.png') }}" alt="blog">
                                    <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3">Teena Patil</span>
                                </div>
                                <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3"><i class="fa-regular fa-clock"></i> 14 July, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="tp-blog-cpr-item tp-round-10 tp-img-hover p-relative mb-30">
                        <span class="tp-blog-cpr-tag tp-ff-jakarta z-index-2 fw-600 tp-round-20 tp-bg-common-white d-inline-block fs-14 text-uppercase tp-text-common-black-3">BUSINESS </span>
                        <div class="tp-blog-cpr-thumb tp-round-6 fix">
                            <img class="w-100 tp-round-6 tp-img-hover-inner" src="{{ asset('assetss/img/corporate/blog/blog-3.jpg') }}" alt="blog">
                        </div>
                        <div class="tp-blog-cpr-content">
                            <h3 class="tp-ff-jakarta fw-600 mb-30 fs-22 ls-m-2 lh-26 tp-text-common-black-3"><a href="blog-details.html" class="underline-black">A leading global marketing and communications agency</a></h3>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mr-10" src="{{ asset('assetss/img/corporate/blog/blog-sm-3.png') }}" alt="blog">
                                    <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3">Vishal Pandey</span>
                                </div>
                                <span class="tp-ff-jakarta fw-500 fs-14 tp-text-common-black-3"><i class="fa-regular fa-clock"></i> 14 July, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-blog-area-end -->

</main>


@endsection