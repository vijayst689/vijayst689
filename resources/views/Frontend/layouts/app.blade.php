<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Uncut - The Multipurpose HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetss/img/corporate/logo/favicon.png') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assetss/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assetss/css/main.css') }}">
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader cpr-loading">
        <div class="cpr-loader"></div>
    </div>
    <!-- Preloader End -->

    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn back-to-top-btn-cpr">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->

    <!--subscribe modal area start -->
    <div class="subscribe-popup">
        <div class="tp-subscribe-digi-form tp-subscribe-cpr-form p-relative tp-round-10 text-center">
            <div class="close">
                <i class="fa-light fa-xmark"></i>
            </div>
            <div class="tp-subscribe-cpr-wrap">
                <img class="tp-round-6 w-100" src="{{ asset('assetss/img/corporate/subscribe/subscribe.jpg') }}" alt="subscribe">
                <div class="tp-subscribe-cpr-content">
                    <span class="icon mb-10">
                        <svg width="44" height="64" viewBox="0 0 44 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38.4598 7.55702C37.8386 6.8346 37.1704 6.1538 36.4597 5.51937C27.5263 -2.465 13.8116 -1.69566 5.82724 7.23771C2.77388 10.654 0.8805 14.9493 0.418679 19.508C-0.31839 26.5037 2.4143 33.4174 7.73513 38.0188C9.75014 39.7713 11.3094 41.9868 12.279 44.475H12.2422C11.6431 44.475 11.1574 44.9607 11.1574 45.5597C11.1574 46.1588 11.6431 46.6445 12.2422 46.6445H12.9602C13.2021 47.7124 13.3251 48.8037 13.3269 49.8986V56.407C13.3269 58.2042 14.7838 59.6611 16.581 59.6611H17.6658C17.6658 62.0574 19.6084 64 22.0047 64C24.401 64 26.3436 62.0574 26.3436 59.6611H27.4283C29.2255 59.6611 30.6824 58.2042 30.6824 56.407V49.8986C30.6835 48.8043 30.8028 47.7132 31.0382 46.6445H31.7672C32.3662 46.6445 32.8519 46.1588 32.8519 45.5597C32.8519 44.9607 32.3662 44.475 31.7672 44.475H31.7021C32.6345 42.0195 34.1655 39.8357 36.156 38.1218C45.2324 30.3176 46.2638 16.6334 38.4598 7.55702ZM22.0048 61.8304C20.8066 61.8304 19.8354 60.8592 19.8354 59.661H24.1742C24.1742 60.8592 23.2029 61.8304 22.0048 61.8304ZM28.5131 56.4068C28.5131 57.0059 28.0275 57.4916 27.4284 57.4916H16.5812C15.9821 57.4916 15.4965 57.0059 15.4965 56.4068V55.3221H28.5131V56.4068ZM28.5131 53.1527H15.4965V50.9832H28.5131V53.1527ZM28.5468 48.8138H15.4618C15.4087 48.085 15.3087 47.3602 15.1624 46.6443H28.8386C28.6955 47.3607 28.598 48.0852 28.5468 48.8138ZM36.709 34.5217C36.0997 35.2195 35.4415 35.8729 34.7393 36.4772H34.7404C32.2656 38.6067 30.4201 41.3723 29.4036 44.4749H23.0895V36.8818H24.1742C31.9585 36.8729 38.2667 30.5647 38.2756 22.7804C38.2756 22.1814 37.79 21.6957 37.1909 21.6957H35.0215C30.1705 21.7009 25.663 24.2005 23.0895 28.3125V22.7164C28.0269 22.1594 31.7605 17.9866 31.7673 13.0179C31.7673 12.4189 31.2816 11.9332 30.6826 11.9332C27.0223 11.9381 23.6723 13.99 22.0048 17.2483C20.3373 13.99 16.9873 11.9381 13.327 11.9332C12.728 11.9332 12.2423 12.4189 12.2423 13.0179C12.2491 17.9866 15.9827 22.1594 20.9201 22.7164V28.3125C18.3466 24.2005 13.8391 21.7009 8.98812 21.6957H6.81868C6.21964 21.6957 5.73396 22.1814 5.73396 22.7804C5.74291 30.5647 12.0511 36.8729 19.8354 36.8818H20.9201V44.4749H14.5831C13.527 41.3438 11.6548 38.5512 9.15951 36.385C1.03738 29.292 0.20309 16.9576 7.29623 8.83537C14.3894 0.713101 26.7236 -0.121051 34.8459 6.97209C42.9679 14.0652 43.8022 26.3996 36.709 34.5217ZM23.1383 34.7124C23.7066 28.5718 28.8547 23.8725 35.0215 23.8652H36.0574C35.4891 30.0058 30.341 34.7051 24.1742 34.7124H23.1383ZM23.1806 20.52C23.6962 17.2634 26.2501 14.7094 29.5067 14.1939C28.9912 17.4504 26.4371 20.0045 23.1806 20.52ZM20.829 20.52C17.5723 20.0045 15.0184 17.4505 14.5029 14.1939C17.7593 14.7093 20.3134 17.2634 20.829 20.52ZM20.8713 34.7124H19.8354C13.6686 34.7051 8.52047 30.0056 7.95221 23.8652H8.98812C15.1549 23.8726 20.303 28.5719 20.8713 34.7124Z" fill="#AA3FFF" />
                        </svg>
                    </span>
                    <h3 class="tp-ff-jakarta mb-15 fs-36 ls-m-4 tp-text-common-black-3 fs-xs-30">Keep in touch with us</h3>
                    <p class="tp-ff-jakarta tp-text-grey-3 mb-40">Nam libero tempore, cum soluta nobist eligendi cumque
                        nihil impedit quo minus id quod maxime placeat</p>
                    <a href="contact.html" class="tp-btn-lg tp-btn-gradient tp-btn-switch-animation mr-15 tp-round-10 fs-18 tp-text-common-white hover-text-white fw-700 d-inline-block text-center tp-ff-jakarta">
                        <span class="d-flex align-items-center justify-content-center">
                            <span class="btn-text">Get started now</span>
                            <span class="btn-icon"><i class="ml-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                            <span class="btn-icon"><i class="mr-5 fa-sharp fa-regular fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--subscribe modal area end -->

    <!-- mouse cursor drag start -->
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span><img src="{{ asset('assetss/img/cursor/cursor.svg') }}" alt=""></span></div>
    <!-- mouse cursor drag end -->

    <!-- search popup start -->
    <div class="search__popup tp-search-form-toggle search-form-cpr">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="search__wrapper">
                        <div class="search__top mb-100 d-flex justify-content-between align-items-center">
                            <div class="search__logo">
                                <a href="index.html">
                                    <img data-width="100" src="{{ asset('assetss/img/corporate/logo/logo.png') }}" alt="">
                                </a>
                            </div>
                            <div class="tp-search-close">
                                <button type="button" class="search__close-btn search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="search__form">
                            <form action="#">
                                <div class="search__input">
                                    <input class="search-input-field" type="text" placeholder="Type here to search...">
                                    <span class="search-focus-border"></span>
                                    <button type="submit">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.55556 16.1111C12.7284 16.1111 16.1111 12.7284 16.1111 8.55556C16.1111 4.38274 12.7284 1 8.55556 1C4.38274 1 1 4.38274 1 8.55556C1 12.7284 4.38274 16.1111 8.55556 16.1111Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M18.0001 18.0002L13.8917 13.8918" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search popup end -->


    <!-- tp-offcanvus-area-end -->
    <div class="tp-offcanvas-area">
        <div class="tp-offcanvas-wrapper">
            <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
                <div class="tp-offcanvas-logo">
                    <a href="index.html">
                        <img data-width="100" src="{{ asset('assetss/img/digital/logo/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="tp-offcanvas-close">
                    <button class="tp-offcanvas-close-btn">
                        <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="tp-offcanvas-main">
                <div class="tp-offcanvas-content">
                    <h3 class="tp-offcanvas-title">Hello There!</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                </div>
                <div class="tp-offcanvas-menu d-xl-none">
                    <nav></nav>
                </div>
                <div class="tp-offcanvas-contact">
                    <h3 class="tp-offcanvas-title fs-20">Information</h3>
                    <ul>
                        <li><a href="tel:1245654">+ 4 20 7700 1007</a></li>
                        <li><a href="mailto:hello@diego.com">hello@brizmo.com</a></li>
                        <li><a href="#">Avenue de Roma 158b, Lisboa</a></li>
                    </ul>
                </div>
                <div class="tp-offcanvas-social">
                    <h3 class="tp-offcanvas-title sm">Follow Us</h3>
                    <ul>
                        <li>
                            <a href="#">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.25 1.5H4.75C2.95507 1.5 1.5 2.95507 1.5 4.75V11.25C1.5 13.0449 2.95507 14.5 4.75 14.5H11.25C13.0449 14.5 14.5 13.0449 14.5 11.25V4.75C14.5 2.95507 13.0449 1.5 11.25 1.5Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M10.6016 7.5907C10.6818 8.13166 10.5894 8.68414 10.3375 9.16955C10.0856 9.65497 9.68711 10.0486 9.19862 10.2945C8.71014 10.5404 8.15656 10.6259 7.61663 10.5391C7.0767 10.4522 6.57791 10.1972 6.19121 9.81055C5.80451 9.42385 5.54959 8.92506 5.46271 8.38513C5.37583 7.8452 5.46141 7.29163 5.70728 6.80314C5.95315 6.31465 6.34679 5.91613 6.83221 5.66425C7.31763 5.41238 7.87011 5.31998 8.41107 5.4002C8.96287 5.48202 9.47372 5.73915 9.86817 6.1336C10.2626 6.52804 10.5197 7.0389 10.6016 7.5907Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.5742 4.42578H11.5842" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.50589 12.7494C4.57662 16.336 9.16278 17.5648 12.7494 15.4941C14.2113 14.65 15.2816 13.388 15.8962 11.9461C16.7895 9.85066 16.7208 7.37526 15.4941 5.25063C14.2674 3.12599 12.1581 1.82872 9.89669 1.55462C8.34063 1.366 6.71259 1.66183 5.25063 2.50589C1.66403 4.57662 0.435172 9.16278 2.50589 12.7494Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path
                                        d="M12.7127 15.4292C12.7127 15.4292 12.0086 10.4867 10.5011 7.87559C8.99362 5.26451 5.28935 2.57155 5.28935 2.57155M5.68449 15.6124C6.79553 12.2606 12.34 8.54524 16.3975 9.43537M12.311 2.4082C11.1953 5.72344 5.75732 9.38453 1.71875 8.58915"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 5.5715H6.33342C7.62867 5.5715 8.61917 6.56199 8.61917 7.85725C8.61917 9.15251 7.62867 10.143 6.33342 10.143H1.76192C1.30477 10.143 1 9.83823 1 9.38108V1.76192C1 1.30477 1.30477 1 1.76192 1H5.5715C6.86676 1 7.85725 1.99049 7.85725 3.28575C7.85725 4.58101 6.86676 5.5715 5.5715 5.5715H1Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path
                                        d="M10.9062 7.09454H17.0016C17.0016 5.41832 15.6301 4.04688 13.9539 4.04688C12.2777 4.04688 10.9062 5.41832 10.9062 7.09454ZM10.9062 7.09454C10.9062 8.77076 12.2777 10.1422 13.9539 10.1422H15.2492"
                                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16.1125 1.44434H11.668" stroke="currentColor" stroke-width="1.2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.75 13H5.25C3 13 1.5 11.5 1.5 9.25V4.75C1.5 2.5 3 1 5.25 1H12.75C15 1 16.5 2.5 16.5 4.75V9.25C16.5 11.5 15 13 12.75 13Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.70676 5.14837L10.8006 6.40465C11.5543 6.90716 11.5543 7.66093 10.8006 8.16344L8.70676 9.41972C7.86923 9.92224 7.19922 9.50348 7.19922 8.5822V6.06964C7.19922 4.98086 7.86923 4.64585 8.70676 5.14837Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->


    @include('Frontend.layouts.header')


    @yield('content')

    @include('Frontend.layouts.footer')



    <!-- JS here -->
    <script src="{{ asset('assetss/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assetss/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assetss/js/slider-init.js') }}"></script>
    <script src="{{ asset('assetss/js/main.js') }}"></script>

</body>

</html>