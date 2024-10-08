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
    <!-- Navbar Start -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <a class="logo" href="">
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
                    <li><a href="#home" class="sub-menu-item">Home</a></li>
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="#features">Features</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="#about">About</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="#video">Video</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="#instructors">Instructor</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item">
                        <a href="#testimonials">Testimonials</a>
                    </li>

                    <li class="has-submenu parent-menu-item">
                        <a href="#contact">Contact</a>
                    </li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </header><!--end header-->
    <!-- Navbar End -->

    <!-- Hero Start -->
    <section id="home" class="home-slider position-relative">
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
                    <div id="features" class="features-absolute">
                        <div class="row">
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
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

                            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0" data-aos="fade-up" data-aos-delay="200">
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
            <div id="about" class="row align-items-center">
                <div class="col-lg-5 col-md-6 col-12" data-aos="fade-right">
                    <img src="assets/images/course/about.jpg" class="img-fluid shadow rounded" alt="">
                </div><!--end col-->

                <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0" data-aos="fade-left">
                    <div class="section-title ms-lg-4">
                        <h4 class="title mb-4">Tentang : <span class="text-primary">EdMon</span></h4>
                        <p class="text-muted">EdMon adalah platform pembelajaran pemrograman yang dirancang dengan
                            pendekatan gamifikasi dan live coding. Melalui EdMon, pengguna dapat belajar pemrograman
                            dengan cara yang menyenangkan dan interaktif. Pada EdMon, pengguna akan menemukan berbagai
                            jenis materi pembelajaran pemrograman yang disajikan dengan cara yang interaktif dan
                            menyenangkan. Materi-materi tersebut dapat berupa e-book, video pembelajaran, latihan
                            pemrograman, dan juga quiz interaktif yang dirancang untuk meningkatkan pemahaman dan
                            keterampilan pemrograman.

                            <br><br>Cara belajar yang diusung oleh EdMon dilengkapi dengan elemen gamifikasi seperti
                            penggunaan leaderboard untuk memberikan motivasi pada pengguna untuk terus belajar dan
                            mengasah keterampilan pemrogramannya. Selain itu, EdMon juga menyediakan fitur live coding,
                            dimana pengguna dapat belajar pemrograman secara langsung dengan mengikuti coding session
                            yang dipandu oleh guru pendamping mata pelajaran. Dengan pendekatan yang interaktif dan
                            menyenangkan, EdMon menjadikan belajar pemrograman lebih mudah dan mengasyikkan. Platform
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
    <section id="video" class="section bg-cta"
        style="background: url('assets/images/course/bg02.jpg') center center;" id="cta" data-aos="fade-right">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title text-white mb-4">We Bring New Online Courses</h4>
                        <p class="text-white-50 para-desc mx-auto">Start working with Landrick that can provide
                            everything you need to generate awareness, drive traffic, connect.</p>
                        <a href="" data-type="youtube" data-id="U9SK2dYVFo0?si=lNrkFkRVcPAr_oGr"
                            class="play-btn  mt-4 lightbox">
                            <i data-feather="play" class="fea icon-ex-md text-white"></i>
                        </a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Cta End -->

    <!-- Courses Start -->
    <section class="section" id="instructors">
        <!--end container-->

        <div class="container mt-50 mt-60" id="instructors">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">Instructors</h4>
                        <p class="text-muted para-desc mx-auto mb-0">Meet with our experienced <span
                                class="text-primary fw-bold">instructors</span> who can help you learn programming
                            easily and quickly.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/fadhel.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="https://github.com/Fadhelnaufal"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="github" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/badakmenyelam/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/fadhelna/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
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
                    <div class="card team team-primary text-center rounded border-0"data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/bayu.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="https://github.com/JouskaCha"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="github" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/adf_by.u/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/adfbyu14/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
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
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/client/muiz.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="https://github.com/Muiz1182"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="github" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/muizafdloly/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a
                                            href="https://www.linkedin.com/in/muiz-afdloly-2bb873190/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
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
                    <div class="card team team-primary text-center rounded border-0"data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/dika.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="https://github.com/stellavermillion9"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="github" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/andikacahyad.p/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a
                                            href="https://www.linkedin.com/in/andika-cahya-darmawan-putra-79653028a/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
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
                    <div class="card team team-primary text-center rounded border-0" data-aos="fade-up"
                        data-aos-delay="450">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="assets/images/pakw.png"
                                    class="img-fluid avatar avatar-ex-large rounded-circle shadow" alt="">
                                <ul class="list-unstyled mb-0 team-icon">
                                    <li class="list-inline-item"><a href="https://www.instagram.com/wahyunurh_/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="instagram" class="icons"></i></a></li>
                                    <li class="list-inline-item"><a
                                            href="https://www.linkedin.com/in/wahyu-nur-hidayat-a67410115/"
                                            class="btn btn-primary btn-pills btn-sm btn-icon" target="_blank"><i
                                                data-feather="linkedin" class="icons"></i></a></li>
                                </ul><!--end icon-->
                            </div>
                            <div class="content pt-3">
                                <h5 class="mb-0">
                                    <a href="javascript:void(0)" class="name text-dark">Wahyu Nur
                                        Hidayat</a>
                                </h5>
                                <small class="designation text-muted">Supervisor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->


    <!-- Testi Subscribe Start -->
    <section id="testimonials" class="section">
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
                                    <p class="text-muted mt-2">" Edmon berhasil menggabungkan gamifikasi dengan coding
                                        secara luar biasa! Saya merasa seperti bermain game sambil belajar. Tantangannya
                                        menarik, dan sistem reward-nya memotivasi saya untuk terus maju. "</p>
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
                                    <h6 class="text-primary">- Christa Smith <small class="text-muted">Manager</small>
                                    </h6>
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
                                    <h6 class="text-primary">- Dean Tolle <small class="text-muted">Developer</small>
                                    </h6>
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
    </section><!--end section-->
    <!-- Testi Subscribe End -->

    <!-- Footer Start -->
    <footer id="contact" class="footer">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row d-flex justify-content-center align-items-center w-100">
                <div class="col-12 text-center">
                    <div class="footer-py-20">
                        <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2 mx-auto">
                            <a href="#" class="logo-footer">
                                <img src="assets/images/putihasli.png" height="55" alt="">
                            </a>
                            <p class="mt-4">Platform pembelajaran interaktif dan Learning Management System sebagai
                                sarana media pembelajaran siswa</p>
                            <ul
                                class="list-unstyled social-icon foot-social-icon mb-0 mt-4 d-flex justify-content-center">
                                <li class="list-inline-item mb-0">
                                    <a href="https://www.instagram.com/clearn.id/" target="_blank" class="rounded">
                                        <i class="uil uil-instagram align-middle" title="instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a href="mailto:fadhelnaufal12@gmail.com" class="rounded">
                                        <i class="uil uil-envelope align-middle" title="email"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!--end col-->
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-py-30 footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> EdMon. Design with <i class="mdi mdi-heart text-danger"></i>
                                by <a href="https://www.instagram.com/digitalin.ae/" target="_blank"
                                    class="text-reset">Digitalin</a>.ae
                            </p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div>
    </footer><!--end footer-->
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i data-feather="arrow-up"
            class="fea icon-sm icons align-middle"></i></a>
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
