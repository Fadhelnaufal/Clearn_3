<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Clearn : Website Pembelajaran Pemrograman Berbasis Gamifikasi dan Live Coding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template">
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern">
    <meta name="author" content="Shreethemes">
    <meta name="email" content="support@shreethemes.in">
    <meta name="website" content="https://shreethemes.in">
    <meta name="Version" content="v4.8.0">

    <!-- favicon -->
    <link rel="icon" href="{{ URL::asset('build/images/logo-clearn.png') }}" type="image/png">

    <!-- Css -->
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" class="theme-opt" rel="stylesheet"
        type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet">
    <!-- Style Css-->
    <link href="{{ asset('assets/css/style.min.css') }}" id="color-opt" class="theme-opt" rel="stylesheet"
        type="text/css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <!-- Loader -->
    <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
    <!-- Loader -->



    <!-- Navbar Start -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <a class="logo" href="index.html">
                <span class="logo-light-mode">
                    <img src="assets/images/edmondsh.png" class="l-dark" height="55" alt="">
                    <img src="assets/images/putihasli.png" class="l-light" height="55" alt="">
                </span>
                <img src="assets/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
            </a>

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            <ul class="buy-button list-inline mb-0">
                @guest
                    <li class="list-inline-item mb-0">
                        <a href="{{ url('/login') }}">
                            <div class="login-btn-primary">
                                <span class="btn btn-icon btn-pills btn-soft-primary">
                                    <i data-feather="log-in" class="fea icon-sm"></i>
                                </span>
                            </div>
                            <div class="login-btn-light">
                                <span class="btn btn-icon btn-pills btn-light">
                                    <i data-feather="log-in" class="fea icon-sm"></i>
                                </span>
                            </div>
                        </a>
                    </li>
                @else
                    @php
                        $user = Auth::user();
                        $redirectUrl = '/dashboard'; // Default URL
                        if ($user->hasRole('admin')) {
                            $redirectUrl = '/admin/dashboard';
                        } elseif ($user->hasRole('guru')) {
                            $redirectUrl = '/guru/dashboard';
                        } elseif ($user->hasRole('siswa')) {
                            $redirectUrl = '/siswa/dashboard';
                        }
                    @endphp
                    <li class="list-inline-item mb-0">
                        <a href="{{ url($redirectUrl) }}">
                            <div class="login-btn-primary">
                                <span class="btn btn-icon btn-pills btn-soft-primary">
                                    <i data-feather="home" class="fea icon-sm"></i>
                                </span>
                            </div>
                            <div class="login-btn-light">
                                <span class="btn btn-icon btn-pills btn-light">
                                    <i data-feather="home" class="fea icon-sm"></i>
                                </span>
                            </div>
                        </a>
                    </li>
                @endguest
            </ul>
            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu nav-light">
                    <li><a href="" class="sub-menu-item">Home</a></li>
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="">Features</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">About</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">Instructor</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li>
                                        <a href="index-corporate.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/corporate.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Corporate</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-crypto.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/crypto.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Cryptocurrency <span
                                                        class="badge text-bg-dark ms-2">Dark</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-real-estate.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/real.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Real Estate</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li>
                                        <a href="index-shop.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/shop.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Shop</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-portfolio.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/portfolio.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Portfolio </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-photography.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/photography.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Photography <span
                                                        class="badge text-bg-dark ms-2">Dark</span></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li>
                                        <a href="helpcenter-overview.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/help-center.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Help Center</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-hosting.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/hosting.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Hosting & Domain</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-video-studio.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/video-studio.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Video Studio </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li>
                                        <a href="index-job.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img src="assets/images/demos/job.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Job & Career</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-ai.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img src="assets/images/demos/ai.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">AI Tools <span
                                                        class="badge text-bg-danger ms-2">New</span></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forums.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/forums.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Forums</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li>
                                        <a href="index-blog.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img
                                                        src="assets/images/demos/blog.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">Blog</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index-nft.html" class="sub-menu-item">
                                            <div class="text-lg-center">
                                                <span class="d-none d-lg-block"><img src="assets/images/demos/nft.png"
                                                        class="img-fluid rounded shadow-md" alt=""></span>
                                                <span class="mt-lg-2 d-block">NFT Marketplace</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">Components</a><span class="menu-arrow"></span>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="ui-button.html" class="sub-menu-item"><i
                                                class="uil uil-cube fs-6 align-middle me-1"></i> Buttons</a></li>
                                    <li><a href="ui-badges.html" class="sub-menu-item"><i
                                                class="uil uil-award fs-6 align-middle me-1"></i> Badges</a></li>
                                    <li><a href="ui-alert.html" class="sub-menu-item"><i
                                                class="uil uil-info-circle fs-6 align-middle me-1"></i> Alert</a></li>
                                    <li><a href="ui-dropdown.html" class="sub-menu-item"><i
                                                class="uil uil-layers fs-6 align-middle me-1"></i> Dropdowns</a></li>
                                    <li><a href="ui-typography.html" class="sub-menu-item"><i
                                                class="uil uil-align-center-alt fs-6 align-middle me-1"></i>
                                            Typography</a></li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li><a href="ui-background.html" class="sub-menu-item"><i
                                                class="uil uil-palette fs-6 align-middle me-1"></i> Background</a></li>
                                    <li><a href="ui-text.html" class="sub-menu-item"><i
                                                class="uil uil-text fs-6 align-middle me-1"></i> Text Color</a></li>
                                    <li><a href="ui-accordion.html" class="sub-menu-item"><i
                                                class="uil uil-list-ui-alt fs-6 align-middle me-1"></i> Accordions</a>
                                    </li>
                                    <li><a href="ui-card.html" class="sub-menu-item"><i
                                                class="uil uil-postcard fs-6 align-middle me-1"></i> Cards</a></li>
                                    <li><a href="ui-tooltip-popover.html" class="sub-menu-item"><i
                                                class="uil uil-backspace fs-6 align-middle me-1"></i> Tooltips &
                                            Popovers</a></li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li><a href="ui-shadow.html" class="sub-menu-item"><i
                                                class="uil uil-square-full fs-6 align-middle me-1"></i> Shadows</a>
                                    </li>
                                    <li><a href="ui-border.html" class="sub-menu-item"><i
                                                class="uil uil-border-out fs-6 align-middle me-1"></i> Border</a></li>
                                    <li><a href="ui-carousel.html" class="sub-menu-item"><i
                                                class="uil uil-slider-h-range fs-6 align-middle me-1"></i> Carousel</a>
                                    </li>
                                    <li><a href="ui-form.html" class="sub-menu-item"><i
                                                class="uil uil-notes fs-6 align-middle me-1"></i> Form Elements</a>
                                    </li>
                                    <li><a href="ui-breadcrumb.html" class="sub-menu-item"><i
                                                class="uil uil-sort-amount-down fs-6 align-middle me-1"></i>
                                            Breadcrumb</a></li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li><a href="ui-pagination.html" class="sub-menu-item"><i
                                                class="uil uil-copy fs-6 align-middle me-1"></i> Pagination</a></li>
                                    <li><a href="ui-avatar.html" class="sub-menu-item"><i
                                                class="uil uil-image fs-6 align-middle me-1"></i> Avatars</a></li>
                                    <li><a href="ui-nav-tabs.html" class="sub-menu-item"><i
                                                class="uil uil-bars fs-6 align-middle me-1"></i> Nav Tabs</a></li>
                                    <li><a href="ui-modals.html" class="sub-menu-item"><i
                                                class="uil uil-vector-square fs-6 align-middle me-1"></i> Modals</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <ul>
                                    <li><a href="ui-tables.html" class="sub-menu-item"><i
                                                class="uil uil-table fs-6 align-middle me-1"></i> Tables</a></li>
                                    <li><a href="ui-icons.html" class="sub-menu-item"><i
                                                class="uil uil-icons fs-6 align-middle me-1"></i> Icons</a></li>
                                    <li><a href="ui-progressbar.html" class="sub-menu-item"><i
                                                class="uil uil-brackets-curly fs-6 align-middle me-1"></i>
                                            Progressbar</a></li>
                                    <li><a href="ui-lightbox.html" class="sub-menu-item"><i
                                                class="uil uil-play-circle fs-6 align-middle me-1"></i> Lightbox</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">Docs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="documentation.html" class="sub-menu-item">Documentation</a></li>
                            <li><a href="changelog.html" class="sub-menu-item">Changelog</a></li>
                            <li><a href="widget.html" class="sub-menu-item">Widget</a></li>
                        </ul>
                    </li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </header><!--end header-->
    <!-- Navbar End -->

    <!-- Hero Start -->
    <section class="home-slider position-relative">
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="bg-home d-flex align-items-center"
                        style="background-image:url('assets/images/course/bg01.jpg')">
                        <div class="bg-overlay"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <div class="title-heading text-white mt-4">
                                        <h1 class="display-4 text-white fw-bold mb-3">You Can Learn Anything With Us
                                        </h1>
                                        <p class="para-desc text-white-50 mx-auto">Di sini, tidak ada batasan untuk apa
                                            yang bisa Anda pelajari. Apapun minat atau tujuan Anda, kami siap membantu
                                            Anda menguasai keterampilan baru dan memperluas wawasan Anda.</p>
                                        <div class="mt-4">
                                            <a href="#courses" class="btn btn-primary mt-2"><i
                                                    class="uil uil-book-open"></i> Join Now</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="3000">
                    <div class="bg-home d-flex align-items-center"
                        style="background-image:url('assets/images/course/bg02.jpg')">
                        <div class="bg-overlay"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <div class="title-heading text-white mt-4">
                                        <h1 class="display-4 text-white fw-bold mb-3">Better Education For A Better
                                            Future </h1>
                                        <p class="para-desc text-white-50 mx-auto">Setiap langkah menuju pendidikan
                                            yang lebih baik adalah investasi dalam masa depan yang lebih cerah. Kami
                                            berkomitmen untuk memberikan pendidikan berkualitas yang mempersiapkan Anda
                                            untuk menghadapi tantangan dunia dan menciptakan perubahan positif.</p>
                                        <div class="mt-4">
                                            <a href="#admission" class="btn btn-primary mt-2"><i
                                                    class="uil uil-graduation-cap"></i> Get Started</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="3000">
                    <div class="bg-home d-flex align-items-center"
                        style="background-image:url('assets/images/course/bg03.jpg')">
                        <div class="bg-overlay"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <div class="title-heading text-white mt-4">
                                        <h1 class="display-4 text-white fw-bold mb-3">Education Is The Key of Success
                                        </h1>
                                        <p class="para-desc text-white-50 mx-auto">Dalam setiap langkah menuju
                                            keberhasilan, pendidikan adalah langkah pertama.</p>
                                        <div class="mt-4">
                                            <a href="#instructors" class="btn btn-primary mt-2"><i
                                                    class="uil uil-user"></i> Instructors</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next me" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section><!--end section-->
    <!-- Hero End -->

    <!-- FEATURES START -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="features-absolute">
                        <div class="row">
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100" >
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-arrow  rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark"> Live Coding</a>
                                        <p class="text-muted mt-2">Belajar lebih cepat dengan pengalaman coding
                                            real-time yang mendalam dan mendukung. </p>

                                        <i class="uil uil-arrow full-img"></i>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0" data-aos="fade-up" data-aos-delay="200" >
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-graduation-cap rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark"> Gamifikasi</a>
                                        <p class="text-muted mt-2">Dengan mengintegrasikan elemen permainan ke dalam
                                            proses belajar membantu kamu mencapai tujuan dengan cara yang lebih
                                            interaktif dan memotivasi. Nikmati tantangan,dan kemajuan yang dirancang
                                            untuk meningkatkan motivasi dan produktivitas belajarmu.</p>

                                        <i class="uil uil-graduation-cap full-img"></i>
                                    </div>
                                </div>
                            </div><!--end col-->

                            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0" data-aos="fade-up" data-aos-delay="300">
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-book-reader rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark"> Expert Teachers</a>
                                        <p class="text-muted mt-2">Dengan pengetahuan mendalam dan metode pengajaran
                                            inovatif,akan membantu kamu menguasai keterampilan baru dan mencapai tujuan
                                            akademis atau profesionalmu.</p>

                                        <i class="uil uil-book-reader full-img"></i>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- FEATURES END -->

    <!-- About Start -->
    <section class="section pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6 col-12" data-aos="fade-right">
                    <img src="assets/images/course/about.jpg" class="img-fluid shadow rounded" alt="">
                </div><!--end col-->

                <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0" data-aos="fade-left">
                    <div class="section-title ms-lg-4">
                        <h4 class="title mb-4">Tentang : <span class="text-primary">CLearn</span></h4>
                        <p class="text-muted">Clearn adalah platform pembelajaran pemrograman yang dirancang dengan
                            pendekatan gamifikasi dan live coding. Melalui Clearn, pengguna dapat belajar pemrograman
                            dengan cara yang menyenangkan dan interaktif. Pada Clearn, pengguna akan menemukan berbagai
                            jenis materi pembelajaran pemrograman yang disajikan dengan cara yang interaktif dan
                            menyenangkan. Materi-materi tersebut dapat berupa e-book, video pembelajaran, latihan
                            pemrograman, dan juga quiz interaktif yang dirancang untuk meningkatkan pemahaman dan
                            keterampilan pemrograman.
                            <br> <br>Cara belajar yang diusung oleh Clearn dilengkapi dengan elemen gamifikasi seperti
                            penggunaan leaderboard untuk memberikan motivasi pada pengguna untuk terus belajar dan
                            mengasah keterampilan pemrogramannya. Selain itu, Clearn juga menyediakan fitur live coding,
                            dimana pengguna dapat belajar pemrograman secara langsung dengan mengikuti coding session
                            yang dipandu oleh guru pendamping mata pelajaran.Dengan pendekatan yang interaktif dan
                            menyenangkan, Clearn menjadikan belajar pemrograman lebih mudah dan mengasyikkan. Platform
                            ini cocok untuk siswa yang ingin mempelajari pemrograman secara efektif dan efisien, serta
                            untuk pengembang yang ingin meningkatkan keterampilan pemrograman mereka secara
                            terus-menerus.
                        </p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--enc container-->
    </section><!--end section-->
    <!-- About End -->

    <!-- Cta Start -->
    <section class="section bg-cta" style="background: url('assets/images/course/bg02.jpg') center center;"
        id="cta" data-aos="fade-right">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title text-white mb-4">We Bring New Online Courses</h4>
                        <p class="text-white-50 para-desc mx-auto">Start working with Landrick that can provide
                            everything you need to generate awareness, drive traffic, connect.</p>
                        <a href="#!" data-type="youtube" data-id="yba7hPeTSjk" class="play-btn  mt-4 lightbox">
                            <i data-feather="play" class="fea icon-ex-md text-white"></i>
                        </a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Cta End -->

    <!-- Courses Start -->
    <section class="section" id="courses">
        <!--end container-->

        <div class="container mt-50 mt-60" id="instructors">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">Instructors</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Meet with our experienced <span
                                class="text-primary fw-bold">instructors</span> who can help you learn programming easily and quickly.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/fadhel.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">Fadhel Naufal
                                        A</a></h5>
                                <small class="designation text-muted">Frontend Developer</small>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0"data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/bayu.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">Adiftya Bayu
                                        P</a></h5>
                                <small class="designation text-muted">Backend Developer</small>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/muiz.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">Mochammad
                                        Mu'iz A</a></h5>
                                <small class="designation text-muted">Web Designer</small>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0"data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/dika.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">Andika Cahya
                                        Darmawan P</a></h5>
                                <small class="designation text-muted">Backend Developer</small>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up" data-aos-delay="450">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/pakw.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="facebook" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="twitter" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)"
                                            class="btn btn-primary btn-pills btn-sm btn-icon"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3" >
                                <h5 class="mb-0">
                                    <a href="javascript:void(0)" class="name text-dark">Wahyu Nur
                                        Hidayat</a></h5>
                                <small class="designation text-muted">Supervisor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->


    <!-- Testi Subscribe Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">What They Say ?</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Here's what they have to say about the <span
                                class="text-primary fw-bold">EdMon</span>.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-lg-12 mt-4">
                    <div class="tiny-three-item">
                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/avatar_2.svg"
                                    class="avatar avatar-small client-image rounded-3 shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                    </ul>
                                    <p class="text-muted mt-2">" Edmon berhasil menggabungkan gamifikasi dengan coding secara luar biasa! Saya merasa seperti bermain game sambil belajar. Tantangannya menarik, dan sistem reward-nya memotivasi saya untuk terus maju. "</p>
                                    <h6 class="text-primary">- Kusuma Khoironi <small class="text-muted">Guru</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/client/02.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star-half text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">" One disadvantage of Lorum Ipsum is that in Latin
                                        certain letters appear more frequently than others. "</p>
                                    <h6 class="text-primary">- Barbara McIntosh <small class="text-muted">M.D</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/client/03.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                    </ul>
                                    <p class="text-muted mt-2">" The most well-known dummy text is the 'Lorem Ipsum',
                                        which is said to have originated in the 16th century. "</p>
                                    <h6 class="text-primary">- Carl Oliver <small class="text-muted">P.A</small></h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/client/04.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                    </ul>
                                    <p class="text-muted mt-2">" According to most sources, Lorum Ipsum can be traced
                                        back to a text composed by Cicero. "</p>
                                    <h6 class="text-primary">- Christa Smith <small
                                            class="text-muted">Manager</small></h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/client/05.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                    </ul>
                                    <p class="text-muted mt-2">" There is now an abundance of readable dummy texts.
                                        These are usually used when a text is required. "</p>
                                    <h6 class="text-primary">- Dean Tolle <small
                                            class="text-muted">Developer</small></h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/images/client/06.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                    </ul>
                                    <p class="text-muted mt-2">" Thus, Lorem Ipsum has only limited suitability as a
                                        visual filler for German texts. "</p>
                                    <h6 class="text-primary">- Jill Webb <small class="text-muted">Designer</small>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        {{-- <div class="container mt-100 mt-60">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <div class="section-title mb-4 pb-2">
                            <h4 class="title mb-4">Sign up for our Newsletter</h4>
                            <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary fw-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row justify-content-center mt-4 pt-2">
                    <div class="col-lg-7 col-md-10">
                        <div class="text-center subcribe-form">
                            <form>
                                <input name="email" id="email" type="email" class="form-control rounded-pill shadow" placeholder="Your email :" required aria-describedby="newssubscribebtn">
                                <button type="submit" class="btn btn-pills btn-primary" id="newssubscribebtn">Subscribe</button>
                            </form><!--end form-->
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> --}}
    </section><!--end section-->
    <!-- Testi Subscribe End -->

    <!-- Partners Start -->
    {{-- <section class="py-4 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/amazon.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->

                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/google.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->

                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/lenovo.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->

                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/paypal.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->

                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/shopify.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->

                    <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                        <img src="assets/images/client/spotify.svg" class="avatar avatar-ex-sm" alt="">
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section--> --}}
    <!-- Partners End -->


    <!-- Footer Start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-py-60">
                        <div class="row">
                            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                                <a href="#" class="logo-footer">
                                    <img src="assets/images/putihasli.png" height="55" alt="">
                                </a>
                                <p class="mt-4">Start working with Landrick that can provide everything you need to
                                    generate awareness, drive traffic, connect.</p>
                                <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                    <li class="list-inline-item mb-0"><a href="https://1.envato.market/landrick"
                                            target="_blank" class="rounded"><i
                                                class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a>
                                    </li>
                                    <li class="list-inline-item mb-0"><a href="https://dribbble.com/shreethemes"
                                            target="_blank" class="rounded"><i
                                                class="uil uil-dribbble align-middle" title="dribbble"></i></a></li>
                                    <li class="list-inline-item mb-0"><a href="https://www.behance.net/shreethemes"
                                            target="_blank" class="rounded"><i
                                                class="uil uil-behance align-middle" title="behance"></i></a></li>
                                    <li class="list-inline-item mb-0"><a href="https://www.facebook.com/shreethemes"
                                            target="_blank" class="rounded"><i
                                                class="uil uil-facebook-f align-middle" title="facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item mb-0"><a
                                            href="https://www.instagram.com/shreethemes/" target="_blank"
                                            class="rounded"><i class="uil uil-instagram align-middle"
                                                title="instagram"></i></a></li>
                                    <li class="list-inline-item mb-0"><a href="https://twitter.com/shreethemes"
                                            target="_blank" class="rounded"><i
                                                class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                                    <li class="list-inline-item mb-0"><a href="mailto:support@shreethemes.in"
                                            class="rounded"><i class="uil uil-envelope align-middle"
                                                title="email"></i></a></li>
                                </ul><!--end icon-->
                            </div><!--end col-->

                            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <h5 class="footer-head">Company</h5>
                                <ul class="list-unstyled footer-list mt-4">
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> About us</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Services</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Team</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Pricing</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Project</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Careers</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Blog</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Login</a></li>
                                </ul>
                            </div><!--end col-->

                            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <h5 class="footer-head">Usefull Links</h5>
                                <ul class="list-unstyled footer-list mt-4">
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Terms of Services</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Privacy Policy</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Documentation</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Changelog</a></li>
                                    <li><a href="javascript:void(0)" class="text-foot"><i
                                                class="uil uil-angle-right-b me-1"></i> Components</a></li>
                                </ul>
                            </div><!--end col-->

                            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <h5 class="footer-head">Newsletter</h5>
                                <p class="mt-4">Sign up and receive the latest tips via email.</p>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="foot-subscribe mb-3">
                                                <label class="form-label">Write your email <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input type="email" name="email" id="emailsubscribe"
                                                        class="form-control ps-5 rounded"
                                                        placeholder="Your email : " required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-grid">
                                                <input type="submit" id="submitsubscribe" name="send"
                                                    class="btn btn-soft-primary" value="Subscribe">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-py-30 footer-bar">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-start">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> EdMon. Design with <i class="mdi mdi-heart text-danger"></i>
                                by <a href="https://shreethemes.in/" target="_blank"
                                    class="text-reset">Digitalin</a>.ae
                            </p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div>
    </footer><!--end footer-->
    <!-- Footer End -->


    <!-- Cookies Start -->

    <!--Note: Cookies Js including in plugins.init.js (path like; js/plugins.init.js) and Cookies css including in _helper.scss (path like; scss/_helper.scss)-->
    <!-- Cookies End -->


    <!-- Offcanvas Start -->
    <div class="offcanvas offcanvas-end shadow border-0" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header p-4 border-bottom">
            <h5 id="offcanvasRightLabel" class="mb-0">
                <img src="assets/images/logo-dark.png" height="24" class="light-version" alt="">
                <img src="assets/images/logo-light.png" height="24" class="dark-version" alt="">
            </h5>
            <button type="button" class="btn-close d-flex align-items-center text-dark"
                data-bs-dismiss="offcanvas" aria-label="Close"><i class="uil uil-times fs-4"></i></button>
        </div>
        <div class="offcanvas-body p-4">
            <div class="row">
                <div class="col-12">
                    <img src="assets/images/contact.svg" class="img-fluid d-block mx-auto" alt="">
                    <div class="card border-0 mt-4" style="z-index: 1">
                        <div class="card-body p-0">
                            <h4 class="card-title text-center">Login</h4>
                            <form class="login-form mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input type="email" class="form-control ps-5"
                                                    placeholder="Email" name="email" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control ps-5"
                                                    placeholder="Password" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <p class="forgot-pass mb-0"><a href="auth-cover-re-password.html"
                                                    class="text-dark fw-bold">Forgot password ?</a></p>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Sign in</button>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-12 text-center">
                                        <p class="mb-0 mt-3"><small class="text-dark me-2">Don't have an account
                                                ?</small> <a href="auth-cover-signup.html"
                                                class="text-dark fw-bold">Sign Up</a></p>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas-footer p-4 border-top text-center">
            <ul class="list-unstyled social-icon social mb-0">
                <li class="list-inline-item mb-0"><a href="https://1.envato.market/landrick" target="_blank"
                        class="rounded"><i class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a>
                </li>
                <li class="list-inline-item mb-0"><a href="https://dribbble.com/shreethemes" target="_blank"
                        class="rounded"><i class="uil uil-dribbble align-middle" title="dribbble"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://www.behance.net/shreethemes" target="_blank"
                        class="rounded"><i class="uil uil-behance align-middle" title="behance"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://www.facebook.com/shreethemes" target="_blank"
                        class="rounded"><i class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                        class="rounded"><i class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://twitter.com/shreethemes" target="_blank"
                        class="rounded"><i class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                <li class="list-inline-item mb-0"><a href="mailto:support@shreethemes.in" class="rounded"><i
                            class="uil uil-envelope align-middle" title="email"></i></a></li>
                <li class="list-inline-item mb-0"><a href="https://shreethemes.in" target="_blank"
                        class="rounded"><i class="uil uil-globe align-middle" title="website"></i></a></li>
            </ul><!--end icon-->
        </div>
    </div>
    <!-- Offcanvas End -->
    <!-- Switcher Start -->

    <!-- Switcher End -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i
            data-feather="arrow-up" class="fea icon-sm icons align-middle"></i></a>
    <!-- Back to top -->

    <!-- Javascript -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SLIDER -->
    <script src="assets/libs/tiny-slider/min/tiny-slider.js"></script>
    <!-- Lightbox -->
    <script src="assets/libs/tobii/js/tobii.min.js"></script>
    <!-- Main Js -->
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="assets/js/app.js"></script>
    <!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    <script>
        AOS.init();
    </script>
</body>

</html>
