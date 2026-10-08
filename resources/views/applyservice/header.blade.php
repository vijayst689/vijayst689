<header>
        <div class="home-one">
            <nav class="navbar-details navbar navbar-expand-lg">
                <div class="container">
                    <div class="brand-logo">
                        <a class="navbar-brand" href="{{ url('home') }}"><img src="{{ asset('assets/images/top/Un.png') }}" class="img-fluid"
                                alt="logo"></a>
                    </div>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navigation-link collapse navbar-collapse gap-4" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link fw-normal hover-style" href="{{ url('home') }}" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link fw-normal hover-style" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>About-Us</span>
                                </a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link fw-normal hover-style" href="careers" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Careers</span><i class="bi bi-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('nalavariyam') }}">Nalavariyam</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('internship') }}">Internship</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('website') }}">Web Site</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                   
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-normal" href="contact.html"><span>Contact</span></a>
                            </li>
                        </ul>
                        <div
                            class="getStart-sideMenu d-flex align-items-center align-content-center justify-content-center justify-content-md-between gap-2 ">
                            <div class="d-flex align-items-center ms-sm-0 ms-lg-auto ms-xl-auto ms-xxl-auto cityWall-btn"
                                role="search">

                            </div>
                            <div class="said-navbar ms-2">
                                <a href="#" class="navSidebar-button" onclick="openNav()">
                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                </a>
                                <div id="mySidenav" class="sidenav">
                                    <div class="side-logo-button">
                                        <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
                                    </div>
                                    <div class="our-mission ">
                                        <h4 class="text-white">Welcome to Nalavariyam</h4>
                                        <div class="con-info">
                                            <h4 class="text-white ">Contact Info</h4>
                                            <ul>
                                                <li><a href="#"><i class="bi bi-geo-alt"></i>
                                                0/26 Koothanvilai, Palappallam Post - 629159 Kanniyakumari District</a></li>
                                                <li> <a href="tel:=7598984380">
                                                        <i class="bi bi-telephone phone"></i>
                                                        7598984380
                                                    </a></li>
                                                <li><a href="mailto:k.hawkins019@gmail.com">
                                                        <i class="bi bi-envelope email"></i>
                                                        k.hawkins019@gmail.com  
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="contact">
                                        <div class="con-info">
                                            <h4 class="text-white ">Contact Info</h4>
                                            <ul>
                                                <li><a href="#"><i class="bi bi-geo-alt"></i>523 Vaithiyanathapuram Beach Road Kottar Post - 629002</a></li>
                                                <li> <a href="tel:7598984385">
                                                        <i class="bi bi-telephone phone"></i>
                                                        7598984385
                                                    </a></li>
                                                <li><a href="mailto:shifamoni@gmail.com">
                                                        <i class="bi bi-envelope email"></i>
                                                        ramjitrust039@gmail.com
                                                    </a></li>
                                            </ul>
                                        </div>
                                        <div class="social-link">
                                            <ul>
                                                <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                                <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                                                <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>