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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://bootstrapmade.com/content/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://bootstrapmade.com/content/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://bootstrapmade.com/content/vendors/aos/aos.css" rel="stylesheet">
  <link href="https://bootstrapmade.com/content/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="https://bootstrapmade.com/content/demo/Forma/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Forma
  * Template URL: https://bootstrapmade.com/forma-bootstrap-agency-template/
  * Updated: Nov 08 2025 with Bootstrap v5.3.8
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

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
              <p>Our powerful SaaS platform helps modern teams increase productivity by 40% and reduce operational costs. Join over 10,000+ companies already transforming their workflow.</p>
              <div class="hero-buttons">
                <a href="#" class="btn btn-primary">
                  <span>Start Free Trial</span>
                  <i class="bi bi-arrow-right ms-2"></i>
                </a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-outline glightbox">
                  <i class="bi bi-play-circle me-2"></i>
                  <span>Watch Demo</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
            <div class="hero-visual">
              <div class="product-mockup">
                <div class="mockup-frame">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/misc/misc-17.webp" alt="Product Dashboard" class="img-fluid">
                </div>
                <div class="floating-card card-1" data-aos="fade-up" data-aos-delay="400">
                  <div class="card-icon">
                    <i class="bi bi-graph-up"></i>
                  </div>
                  <div class="card-content">
                    <div class="card-value">+127%</div>
                    <div class="card-label">Revenue Growth</div>
                  </div>
                </div>
                <div class="floating-card card-2" data-aos="fade-up" data-aos-delay="500">
                  <div class="card-icon">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="card-content">
                    <div class="card-value">2.4k</div>
                    <div class="card-label">Active Users</div>
                  </div>
                </div>
                <div class="floating-card card-3" data-aos="fade-up" data-aos-delay="600">
                  <div class="card-icon">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div class="card-content">
                    <div class="card-value">40%</div>
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
              <h2>We Build Digital Products That Drive Growth</h2>
              <p class="lead">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

              <div class="stats-grid">
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"></div>
                  <div class="stat-label">Projects Delivered</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1"></div>
                  <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"></div>
                  <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="1">%</div>
                  <div class="stat-label">Client Retention</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-stack">
              <div class="image-card image-primary">
                <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/about/about-7.webp" alt="Team collaboration" class="img-fluid">
              </div>
              <div class="image-card image-secondary">
                <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/about/about-square-5.webp" alt="Digital workspace" class="img-fluid">
              </div>
              <div class="floating-badge">
                <div class="badge-icon">
                  <i class="bi bi-award-fill"></i>
                </div>
                <div class="badge-text">
                  <div class="badge-title">Award Winning</div>
                  <div class="badge-subtitle">Digital Agency 2024</div>
                </div>
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
              <p class="intro-text">We deliver end-to-end digital services that drive growth, enhance user experience, and transform your business vision into reality.</p>
            </div>
          </div>
        </div>

        <div class="row gy-4">
             
 <div class="col-4 col-md-3 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a>
                                    <div class="mb-1">
                                        <img src="{{ asset('assets/images/mylogo/tn.png') }}"
                                             width="100%"/>
                                        <p class="text-primary">TNEGA</p>
                                    </div>
                                </a>
                            </div>
                        </div>
 <div class="col-4 col-md-3 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a>
                                    <div class="mb-1">
                                        <img src="{{ asset('assets/images/mylogo/nal.jpg') }}"
                                             width="100%"/>
                                        <p class="text-primary">Nalavariyam</p>
                                    </div>
                                </a>
                            </div>
                        </div>
 <div class="col-4 col-md-3 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a>
                                    <div class="mb-1">
                                        <img src="{{ asset('assets/images/mylogo/soft.jpg') }}"
                                             width="100%"/>
                                        <p class="text-primary">Software Keys</p>
                                    </div>
                                </a>
                            </div>
                        </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-phone"></i>
                </div>
              </div>
              <h3>Digital Banner</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-megaphone"></i>
                </div>
              </div>
              <h3>MSME</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Smart Card</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Micro Finance</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>GST</h3>
            </div>
          </div>

           <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>TEC Exam</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Adhaar Card Services</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>CAN EDIT</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Fast Tag</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>பதிவு துறை</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Voter ID</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Passport</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Nalavariyam PDF Services</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Dharsan</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>பட்டா சேவை</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>PM Kisan</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Birth & Death</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>FSSAI</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Certificate Courses</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>EMPLOYMENT SERVICES</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>COVID - 19</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>TNEB</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>GAZETTE</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>RTO Services</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>முதலமைச்சரின் விரிவான காப்பீடு</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>CIBIL SCORE</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>AEPS</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>LIC</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Kavi Bharathi Micro-Finance</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Nsdl Pan Card</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Vechile Insurance</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>HEALTH INSURANCE</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>DIGITAL GOLD</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>TOURS & TRAVELS</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>SCHOLARSHIP</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>SHOPPPING</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>ADMISSION</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>FOOD</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>MATRIMONY</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>EVENT MANAGEMENT</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>SERVICES</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>FOR SALE</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>Police Verification</h3>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-header">
                <div class="icon-wrapper">
                  <i class="bi bi-search"></i>
                </div>
              </div>
              <h3>PSTM Certificate</h3>
            </div>
          </div>
        </div>

        <div class="cta-banner" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="cta-content">
                <div class="cta-badge">Ready to Start?</div>
                <h3>Transform Your Digital Presence Today</h3>
                <p>Partner with us to create innovative solutions that drive real business results. Let's build something extraordinary together.</p>
              </div>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="https://bootstrapmade.com/content/demo/Forma/service-details.html" class="btn-primary">Get Started <i class="bi bi-arrow-right"></i></a>
              <a href="https://bootstrapmade.com/content/demo/Forma/service-details.html" class="btn-secondary">Schedule Consultation</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Why Us</h2>
        <div><span>Why</span> <span class="description-title">Choose Us</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center mb-5">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="intro-content">
              <span class="badge">Why Choose Us</span>
              <h2>Partner with a Team That Delivers Real Results</h2>
              <p class="lead">We don't just create digital experiences—we build solutions that drive measurable growth. Our data-driven approach combines creativity with performance to help your business thrive in the digital landscape.</p>
              <div class="stats-grid">
                <div class="stat-item">
                  <div class="stat-number" data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="2">150</div>
                  <div class="stat-label">Projects Delivered</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number" data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="2">98</div>
                  <div class="stat-label">% Client Retention</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number" data-purecounter-start="0" data-purecounter-end="250" data-purecounter-duration="2">250</div>
                  <div class="stat-label">% Avg ROI Increase</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="showcase-image">
              <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/illustration/illustration-18.webp" alt="Digital Solutions" class="img-fluid">
            </div>
          </div>
        </div>

        <div class="row g-4 mb-5">
          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="value-card">
              <div class="icon-box">
                <i class="bi bi-lightning-charge-fill"></i>
              </div>
              <h4>Fast Turnaround</h4>
              <p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor.</p>
              <a href="#" class="learn-more">Learn more <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="value-card featured">
              <div class="featured-badge">Most Popular</div>
              <div class="icon-box">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <h4>Data-Driven Strategy</h4>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam.</p>
              <a href="#" class="learn-more">Learn more <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="value-card">
              <div class="icon-box">
                <i class="bi bi-shield-check"></i>
              </div>
              <h4>Proven Expertise</h4>
              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni.</p>
              <a href="#" class="learn-more">Learn more <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="200">
            <div class="capabilities-content">
              <h3>Our Core Capabilities</h3>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>

              <div class="capability-list">
                <div class="capability-item">
                  <div class="capability-header">
                    <i class="bi bi-check-circle-fill"></i>
                    <h5>Strategic Planning &amp; Consulting</h5>
                  </div>
                  <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates.</p>
                </div>

                <div class="capability-item">
                  <div class="capability-header">
                    <i class="bi bi-check-circle-fill"></i>
                    <h5>Custom Development Solutions</h5>
                  </div>
                  <p>Nam libero tempore cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime.</p>
                </div>

                <div class="capability-item">
                  <div class="capability-header">
                    <i class="bi bi-check-circle-fill"></i>
                    <h5>Ongoing Support &amp; Optimization</h5>
                  </div>
                  <p>Itaque earum rerum hic tenetur a sapiente delectus ut aut reiciendis voluptatibus maiores alias.</p>
                </div>
              </div>

              <div class="cta-buttons">
                <a href="#" class="btn btn-primary">Start Your Project</a>
                <a href="#" class="btn btn-secondary">View Case Studies</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="300">
            <div class="process-visual">
              <div class="process-step" data-aos="fade-up" data-aos-delay="400">
                <div class="step-number">01</div>
                <div class="step-content">
                  <h6>Discovery</h6>
                  <p>Understanding your goals</p>
                </div>
              </div>
              <div class="process-step" data-aos="fade-up" data-aos-delay="450">
                <div class="step-number">02</div>
                <div class="step-content">
                  <h6>Strategy</h6>
                  <p>Planning the approach</p>
                </div>
              </div>
              <div class="process-step" data-aos="fade-up" data-aos-delay="500">
                <div class="step-number">03</div>
                <div class="step-content">
                  <h6>Execution</h6>
                  <p>Bringing ideas to life</p>
                </div>
              </div>
              <div class="process-step" data-aos="fade-up" data-aos-delay="550">
                <div class="step-number">04</div>
                <div class="step-content">
                  <h6>Optimization</h6>
                  <p>Continuous improvement</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <div><span>Check Our</span> <span class="description-title">Testimonials</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="testimonials-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "slidesPerView": 1,
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>

          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Sed ut perspiciatis unde omnis</h2>
                    <p>
                      Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                    </p>
                    <p>
                      Beatae magnam dolore quia ipsum. Voluptatem totam et qui dolore dignissimos. Amet quia sapiente laudantium nihil illo et assumenda sit cupiditate. Nam perspiciatis perferendis minus consequatur. Enim ut eos quo.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-7.webp" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Saul Goodman</h3>
                        <span>Client</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-7.webp" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Nemo enim ipsam voluptatem</h2>
                    <p>
                      Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                    </p>
                    <p>
                      Dolorem excepturi esse qui amet maxime quibusdam aut repellendus voluptatum. Corrupti enim a repellat cumque est laborum fuga consequuntur. Dolorem nostrum deleniti quas voluptatem iure dolorum rerum. Repudiandae doloribus ut repellat harum vero aut. Modi aut velit aperiam aspernatur odit ut vitae.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-8.webp" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Sara Wilsson</h3>
                        <span>Designer</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-8.webp" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>
                      Labore nostrum eos impedit
                    </h2>
                    <p>
                      Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                    </p>
                    <p>
                      Itaque ut explicabo vero occaecati est quam rerum sed. Numquam tempora aut aut quaerat quia illum. Nobis quia autem odit ipsam numquam. Doloribus sit sint corporis eius totam fuga. Hic nostrum suscipit corrupti nam expedita adipisci aut optio.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-9.webp" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Matt Brandon</h3>
                        <span>Freelancer</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-9.webp" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="row">
                  <div class="col-lg-8">
                    <h2>Impedit dolor facilis nulla</h2>
                    <p>
                      Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                    </p>
                    <p>
                      Omnis aspernatur accusantium qui delectus praesentium repellendus. Facilis sint odio aspernatur voluptas commodi qui qui qui pariatur. Corrupti deleniti itaque quaerat ipsum deleniti culpa tempora tempore. Et consequatur exercitationem hic aspernatur nobis est voluptatibus architecto laborum.
                    </p>
                    <div class="profile d-flex align-items-center">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-10.webp" class="profile-img" alt="">
                      <div class="profile-info">
                        <h3>Jena Karlis</h3>
                        <span>Store Owner</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="featured-img-wrapper">
                      <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-10.webp" class="featured-img" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Item -->

          </div>

          <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Team Section -->
    <section id="team" class="team section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <div><span>Check Our</span> <span class="description-title">Team</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="team-header" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h2>Our Professional Team</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus luctus nec ullamcorper mattis pulvinar dapibus leo.</p>
            </div>
            <div class="col-lg-6 d-flex justify-content-lg-end">
              <div class="team-controls">
                <button class="team-control-btn team-prev"><i class="bi bi-chevron-left"></i></button>
                <button class="team-control-btn team-next"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="team-slider swiper init-swiper" data-aos="fade-up" data-aos-delay="300">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 700,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 1,
              "spaceBetween": 30,
              "navigation": {
                "nextEl": ".team-next",
                "prevEl": ".team-prev"
              },
              "breakpoints": {
                "576": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "992": {
                  "slidesPerView": 3,
                  "spaceBetween": 30
                },
                "1200": {
                  "slidesPerView": 4,
                  "spaceBetween": 30
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-3.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Marcus Wilson</h3>
                  <span>Chief Technology Officer</span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-5.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Sophia Reynolds</h3>
                  <span>Product Designer</span>
                  <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-8.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Daniel Chen</h3>
                  <span>Marketing Specialist</span>
                  <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-9.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Olivia Thompson</h3>
                  <span>Lead Developer</span>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-m-12.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Jason Parker</h3>
                  <span>UI/UX Designer</span>
                  <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</p>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="team-member">
                <div class="member-image">
                  <img src="https://bootstrapmade.com/content/demo/Forma/assets/img/person/person-f-7.webp" class="img-fluid" alt="" loading="lazy">
                  <div class="member-social">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-content">
                  <h3>Emily Rodriguez</h3>
                  <span>Project Manager</span>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.</p>
                </div>
              </div>
            </div><!-- End slide item -->

          </div>
        </div>

      </div>
    </section><!-- /Team Section -->

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
              <h2>Ready to Transform Your Digital Presence?</h2>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>

            <div class="contact-channels">
              <div class="channel-card">
                <div class="channel-icon">
                  <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="channel-info">
                  <h5>Email</h5>
                  <p><a href="https://bootstrapmade.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="066e636a6a6946637e676b766a632865696b">[email&#160;protected]</a></p>
                  <span class="channel-meta">We reply within 4 hours</span>
                </div>
              </div>

              <div class="channel-card">
                <div class="channel-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="channel-info">
                  <h5>Phone</h5>
                  <p>+1 (555) 234-5678</p>
                  <span class="channel-meta">Mon-Fri, 9AM-6PM EST</span>
                </div>
              </div>

              <div class="channel-card">
                <div class="channel-icon">
                  <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="channel-info">
                  <h5>Office</h5>
                  <p>5632 Market Street, San Francisco, CA 94102</p>
                  <span class="channel-meta">Visit us anytime</span>
                </div>
              </div>
            </div>

            <div class="trust-indicators">
              <div class="indicator-item">
                <div class="indicator-value">2.5k+</div>
                <div class="indicator-label">Happy Clients</div>
              </div>
              <div class="indicator-item">
                <div class="indicator-value">4.9/5</div>
                <div class="indicator-label">Client Rating</div>
              </div>
              <div class="indicator-item">
                <div class="indicator-value">15min</div>
                <div class="indicator-label">Avg Response</div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-wrapper">
              <div class="form-header">
                <h3>Start Your Project</h3>
                <p>Tell us about your project and we'll get back to you with a tailored solution.</p>
              </div>

              <form action="https://bootstrapmade.com/content/demo/Forma/forms/contact.php" method="post" class="php-email-form">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" name="name" class="form-control" required="">
                </div>

                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" name="email" class="form-control" required="">
                </div>

                <div class="form-group">
                  <label for="company">Subject</label>
                  <input type="text" name="ubject" class="form-control" required="">
                </div>

                <div class="form-group">
                  <label>Message</label>
                  <textarea name="message" class="form-control" rows="5" required=""></textarea>
                </div>
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit" class="submit-btn">
                  <span>Send Message</span>
                  <i class="bi bi-arrow-right"></i>
                </button>

                <div class="form-footer">
                  <i class="bi bi-shield-check"></i>
                  <span>Your information is secure and will never be shared</span>
                </div>
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
          <a href="https://bootstrapmade.com/content/demo/Forma/index.html" class="logo d-flex align-items-center">
            <span class="sitename">Forma</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
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
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span><a href="https://bootstrapmade.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="80e9eee6efc0e5f8e1edf0ece5aee3efed">[email&#160;protected]</a></span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Forma</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script data-cfasync="false" src="https://bootstrapmade.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://bootstrapmade.com/content/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/php-email-form/validate.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/aos/aos.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/glightbox/js/glightbox.min.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/purecounter/purecounter_vanilla.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="https://bootstrapmade.com/content/vendors/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="https://bootstrapmade.com/content/demo/Forma/assets/js/main.js"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"68c5ca450bae485a842ff76066d69420","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>


<!-- Mirrored from bootstrapmade.com/content/demo/Forma/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Nov 2025 08:18:11 GMT -->
</html>