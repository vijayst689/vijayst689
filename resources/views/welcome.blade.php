<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from bootstrapmade.com/content/demo/Forma/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Nov 2025 08:18:11 GMT -->

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pkrmsolution.com</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="robots" content="noindex, nofollow">

    <!-- Favicons -->
    <link href="https://bootstrapmade.com/content/demo/Forma/assets/img/favicon.png" rel="icon">
    <link href="https://bootstrapmade.com/content/demo/Forma/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://bootstrapmade.com/content/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/aos/aos.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="https://bootstrapmade.com/content/demo/Forma/assets/css/main.css" rel="stylesheet">

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
        #policy,
        #terms {
            background: linear-gradient(135deg, #0f172a, #111827, #1e293b);
            padding: 80px 0;
        }

        #policy .card,
        #terms .card {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .12);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            color: #e5e7eb;
            overflow: hidden;
            transition: .4s;
        }

        #policy .card:hover,
        #terms .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, .35);
        }

        #policy .card-header,
        #terms .card-header {
            border: none;
            padding: 18px 25px;
        }

        #policy .card-header {
            background: linear-gradient(90deg, #2563eb, #0ea5e9) !important;
        }

        #terms .card-header {
            background: linear-gradient(90deg, #9333ea, #6366f1) !important;
        }

        #policy h5,
        #terms h5 {
            color: #60a5fa;
            font-weight: 700;
            margin-top: 22px;
        }

        #policy p,
        #policy li,
        #terms p,
        #terms li {
            color: #d1d5db;
            line-height: 1.8;
        }

        #policy strong,
        #terms strong {
            color: #fff;
        }

        #policy hr,
        #terms hr {
            border-color: rgba(255, 255, 255, .15);
        }
    </style>
</head>

<body class="index-page">
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=919664389493798&ev=PageView&noscript=1" />
    </noscript>
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <img src="{{ asset('assets/images/logo-icon.png') }}" style="max-height: 50px;width: 150px;"
                    alt="" />
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#policy">Privacy Policy</a></li>
                    <li><a href="#terms">Terms & Conditions</a></li>
                    <li><a href="{{ url('register') }}">Register</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ url('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                        <div class="hero-content">
                            <div class="hero-badge">
                                <span class="badge">✨ New Feature</span>
                            </div>
                            <h1>Welcome To Pkrmsolution</h1>
                            <p>Welcome to PKRM Solution — Your One-Stop Digital Service Partner.
                                We simplify e-Sevai, CSC, and business support with trusted, hassle-free service.</p>
                            {{-- <div class="hero-buttons">
                                <a href="#" class="btn btn-primary">
                                    <span>Start Free Trial</span>
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-outline glightbox">
                                    <i class="bi bi-play-circle me-2"></i>
                                    <span>Watch Demo</span>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                        <div class="hero-visual">
                            <div class="product-mockup">
                                <div class="mockup-frame">
                                    <img src="{{ asset('assets/images/logo-icon.png') }}" width="100%" />
                                    {{-- <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/misc/misc-17.webp"
                                        alt="Product Dashboard" class="img-fluid"> --}}
                                </div>
                                <div class="floating-card card-1" data-aos="fade-up" data-aos-delay="400">
                                    <div class="card-icon">
                                        <i class="bi bi-graph-up"></i>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-value">+100%</div>
                                        <div class="card-label">Working Growth</div>
                                    </div>
                                </div>
                                <div class="floating-card card-2" data-aos="fade-up" data-aos-delay="500">
                                    <div class="card-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-value">1k</div>
                                        <div class="card-label">Active Users</div>
                                    </div>
                                </div>
                                <div class="floating-card card-3" data-aos="fade-up" data-aos-delay="600">
                                    <div class="card-icon">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-value">90%</div>
                                        <div class="card-label">Time Saved</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-background">
                <div class="gradient-blob blob-1"></div>
                <div class="gradient-blob blob-2"></div>
                <div class="grid-pattern"></div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="content-wrapper">
                            <div class="section-badge">About Us</div>
                            <ul style="list-style: none; padding-left: 0;">
                                <li>✔ Increase daily customers</li>
                                <li>✔ Earn stable monthly income</li>
                                <li>✔ Provide fast, reliable services</li>
                                <li>✔ Grow into a complete digital service hub</li>
                            </ul>
                            <h2 class="lead">🌟 Our Mission

                                To empower every rural and small-town service center to earn ₹30,000 – ₹50,000+ per
                                month with a powerful combination of:

                                High-demand services

                                Tamil support

                                Easy-to-use portal

                                Business guidance

                                Marketing support</h2>
                            <h2 class="lead">🌟 Our Vision

                                To become India’s No.1 Rural Digital Business Support Platform,
                                giving every small service center the tools and systems needed to grow into a stable,
                                successful digital business.</h2>
                            {{-- 
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="150" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Projects Delivered</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="85" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Happy Clients</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="12" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Years Experience</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="95" data-purecounter-duration="1">%</div>
                                    <div class="stat-label">Client Retention</div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-stack">
                            <div class="image-card image-primary">
                                <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/about/about-7.webp"
                                    alt="Team collaboration" class="img-fluid">
                            </div>
                            <div class="image-card image-secondary">
                                <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/about/about-square-5.webp"
                                    alt="Digital workspace" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Services</h2>
                <div><span>Check Our</span> <span class="description-title">Services</span></div>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="section-intro">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <h2 class="intro-title">Pkrmsolution</h2>
                            <p class="intro-text">👉 PKRM Solution is a multi–service platform that provides all
                                government and citizen services in one place with a single ID.
                                Our goal is to deliver maximum benefits to customers and service center owners with easy
                                access and reliable support.</p>
                        </div>
                    </div>
                </div>

                <div class="row gy-4">

                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/tn.png') }}" width="100%" />
                                    <p class="text-primary">TNEGA</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/nal.jpg') }}" width="100%" />
                                    <p class="text-primary">Nalavariyam</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/soft.jpg') }}" width="100%" />
                                    <p class="text-primary">Software Keys</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/dij.jpg') }}" width="100%" />
                                    <p class="text-primary">Digital Banner</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/msme.png') }}" width="100%" />
                                    <p class="text-primary">MSME</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/gst.jpg') }}" width="100%" />
                                    <p class="text-primary">GST</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/fastag.png') }}" width="100%" />
                                    <p class="text-primary">Fast Tag</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/voter.jpg') }}" width="100%" />
                                    <p class="text-primary">Voter ID</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/pass.png') }}" width="100%" />
                                    <p class="text-primary">Passport</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/pdf.jpg') }}" width="100%" />
                                    <p class="text-primary">PDF Services</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/dhar.jpg') }}" width="100%" />
                                    <p class="text-primary">Dharsan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/patta.jpg') }}" width="100%" />
                                    <p class="text-primary">பட்டா சேவை</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/pm.jpg') }}" width="100%" />
                                    <p class="text-primary">PM Kissan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/birth.jpg') }}" width="100%" />
                                    <p class="text-primary">Birth & Death</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/fssai.jpg') }}" width="100%" />
                                    <p class="text-primary">FSSAI</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/cert.jpg') }}" width="100%" />
                                    <p class="text-primary">Certificate Courses</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/empl.jpg') }}" width="100%" />
                                    <p class="text-primary">EMPLOYMENT SERVICES</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/tne.jpg') }}" width="100%" />
                                    <p class="text-primary">TNEB</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/gaz.jpg') }}" width="100%" />
                                    <p class="text-primary">GAZETTE</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/rto.jpg') }}" width="100%" />
                                    <p class="text-primary">RTO Services</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/cm.jpg') }}" width="100%" />
                                    <p class="text-primary">முதலமைச்சரின் விரிவான காப்பீடு</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/cibil.webp') }}" width="100%" />
                                    <p class="text-primary">CIBIL SCORE</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/aeps.jpg') }}" width="100%" />
                                    <p class="text-primary">AEPS</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/lic.jpg') }}" width="100%" />
                                    <p class="text-primary">LIC</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/nsdl.jpg') }}" width="100%" />
                                    <p class="text-primary">Nsdl Pan Card</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/insu.jpg') }}" width="100%" />
                                    <p class="text-primary">Vechile Insurance</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/health.jpg') }}" width="100%" />
                                    <p class="text-primary">HEALTH INSURANCE</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/tours.jpg') }}" width="100%" />
                                    <p class="text-primary">TOURS & TRAVELS</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/sch.jpg') }}" width="100%" />
                                    <p class="text-primary">SCHOLARSHIP</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/sho.jpg') }}" width="100%" />
                                    <p class="text-primary">SHOPPPING</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/admis.jpg') }}" width="100%" />
                                    <p class="text-primary">ADMISSION</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/food.jpg') }}" width="100%" />
                                    <p class="text-primary">FOOD</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/matri.jpg') }}" width="100%" />
                                    <p class="text-primary">MATRIMONY</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/event.jpg') }}" width="100%" />
                                    <p class="text-primary">EVENT MANAGEMENT</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/police.jpg') }}" width="100%" />
                                    <p class="text-primary">Police Verification</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 mb-3 category_data">
                        <div class="card p-2 h-100">
                            <a>
                                <div class="mb-1">
                                    <img src="{{ asset('assets/images/mylogo/pstm.jpg') }}" width="100%" />
                                    <p class="text-primary">PSTM Certificate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="cta-banner" data-aos="fade-up" data-aos-delay="300">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="cta-content">
                                <div class="cta-badge">Ready to Start?</div>
                                <h3>Transform Your Pkrmsolution Today</h3>
                                <p>Partner with us to create Pkrmsolution solutions that drive real services results.
                                    Let's build something extraordinary together.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="" class="btn-primary">Get Started <i class="bi bi-arrow-right"></i></a>
                            <a href="" class="btn-secondary">Pkrmsolution</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Services Section -->

        <section class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Privacy Policy & Terms</h2>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <!-- =========================
             PRIVACY POLICY
        ========================== -->
                <div id="policy" class="mb-5">

                    <div class="card shadow border-0">

                        <div class="card-header bg-primary text-white py-3">
                            <h3 class="mb-0">
                                <i class="bi bi-shield-lock me-2"></i>
                                Privacy Policy
                            </h3>
                        </div>

                        <div class="card-body p-4">

                            <p><strong>Effective Date:</strong> 09 July 2026</p>

                            <p>
                                Welcome to <strong>PKRM Solution</strong>.
                                We respect your privacy and are committed to protecting
                                your personal information.
                            </p>

                            <hr>

                            <h5>Information We Collect</h5>

                            <ul>
                                <li>Name</li>
                                <li>Mobile Number</li>
                                <li>Email Address</li>
                                <li>Business Information</li>
                                <li>Information submitted through contact or registration forms</li>
                            </ul>

                            <hr>

                            <h5>How We Use Your Information</h5>

                            <ul>
                                <li>Respond to enquiries</li>
                                <li>Provide our products and services</li>
                                <li>Offer customer support</li>
                                <li>Improve our website</li>
                                <li>Send service updates</li>
                            </ul>

                            <hr>

                            <h5>Information Sharing</h5>

                            <p>
                                We do not sell, rent or share your personal information
                                with third parties except when required by law or to
                                provide our services.
                            </p>

                            <hr>

                            <h5>Cookies</h5>

                            <p>
                                Our website may use cookies and analytics tools to improve
                                website performance and user experience.
                            </p>

                            <hr>

                            <h5>Data Security</h5>

                            <p>
                                We take reasonable measures to protect your information.
                                However, no internet transmission is completely secure.
                            </p>

                            <hr>

                            <h5>Your Consent</h5>

                            <p>
                                By using our website, you agree to this Privacy Policy.
                            </p>

                            <hr>

                            <h5>Contact Us</h5>

                            <p>
                                If you have any questions regarding this Privacy Policy,
                                please contact PKRM Solution through the contact details
                                available on our website.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- =========================
             TERMS & CONDITIONS
        ========================== -->
                <div id="terms">

                    <div class="card shadow border-0">

                        <div class="card-header bg-dark text-white py-3">
                            <h3 class="mb-0">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                Terms & Conditions
                            </h3>
                        </div>

                        <div class="card-body p-4">

                            <p><strong>Effective Date:</strong> 09 July 2026</p>

                            <p>
                                By accessing and using the PKRM Solution website,
                                you agree to the following Terms & Conditions.
                            </p>

                            <hr>

                            <h5>Website Usage</h5>

                            <ul>
                                <li>Use this website only for lawful purposes.</li>
                                <li>Provide accurate information when submitting forms.</li>
                                <li>Do not attempt unauthorized access or misuse of the website.</li>
                            </ul>

                            <hr>

                            <h5>Intellectual Property</h5>

                            <p>
                                All website content including text, images, graphics,
                                logos and trademarks belongs to PKRM Solution.
                            </p>

                            <hr>

                            <h5>Service Availability</h5>

                            <p>
                                PKRM Solution may modify, update or discontinue any
                                service without prior notice.
                            </p>

                            <hr>

                            <h5>Limitation of Liability</h5>

                            <p>
                                PKRM Solution is not responsible for any direct or
                                indirect loss arising from the use of this website.
                            </p>

                            <hr>

                            <h5>Applicable Law</h5>

                            <p>
                                These Terms & Conditions are governed by the laws of India.
                            </p>

                            <hr>

                            <h5>Acceptance</h5>

                            <p>
                                By continuing to use this website, you accept these
                                Terms & Conditions.
                            </p>

                            <hr>

                            <h5>Contact Us</h5>

                            <p>
                                For any questions regarding these Terms & Conditions,
                                please contact PKRM Solution.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <div><span>Need Help?&nbsp;</span> <span class="description-title">Contact Us</span></div>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6">
                        <div class="contact-intro">
                            <div class="intro-badge">
                                <i class="bi bi-rocket-takeoff"></i>
                                <span>Let's Build Something Amazing</span>
                            </div>
                            <h2>Ready to Transform Your Pkrmsolution.com</h2>
                            <p>🌐 PKRM Solution
                                Empowering Digital Services with Trust, Speed & Professional Excellence</p>
                        </div>

                        <div class="contact-channels">
                            <div class="channel-card">
                                <div class="channel-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="channel-info">
                                    <h5>Email</h5>
                                    <p><a href="" class="__cf_email__">pkrmsolution@gmail.com</a>
                                    </p>
                                </div>
                            </div>

                            <div class="channel-card">
                                <div class="channel-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="channel-info">
                                    <h5>Phone</h5>
                                    <p>9843161942</p>
                                    <span class="channel-meta">Mon-Sat, 9AM-6PM</span>
                                </div>
                            </div>

                            <div class="channel-card">
                                <div class="channel-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="channel-info">
                                    <h5>Office</h5>
                                    <p>40/4 , KRM Car Parking,Narasingapuram(Po),Attur(Tk), Salem(Dt),Tamilnadu-636108
                                    </p>
                                    <span class="channel-meta">Visit us anytime</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-wrapper">
                            <div class="form-header">
                                <h3>Your Querys</h3>
                                <p>Tell us about your Details.</p>
                            </div>

                            <form action="{{ url('/savequery') }}" method="post" enctype="multipart/form-data"
                                class="bg-dark">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="company">Subject</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="form-control" rows="3"placeholder="Message"></textarea>
                                </div>
                                <div class="error-message"></div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="" class="logo d-flex align-items-center">
                        <span class="sitename">Pkrmsolution.com</span>
                    </a>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>40/4 , KRM Car Parking,</p>
                    <p>Narasingapuram(Po),Attur(Tk), Salem(Dt),</p>
                    <p>Tamilnadu-636108</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>9843161942</span></p>
                    <p><strong>Email:</strong> <span><a href="">pkrmsolution@gmail.com</a></span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Maran Software Solution</strong> <span>All Rights
                    Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href=""></a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script data-cfasync="false"
        src="https://bootstrapmade.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/php-email-form/validate.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/aos/aos.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/glightbox/js/glightbox.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/purecounter/purecounter_vanilla.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="https://bootstrapmade.com/content/demo/Forma/assets/js/main.js"></script>

    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"version":"2024.11.0","token":"68c5ca450bae485a842ff76066d69420","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>
</body>


<!-- Mirrored from bootstrapmade.com/content/demo/Forma/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Nov 2025 08:18:11 GMT -->

</html>
