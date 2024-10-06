<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('assets/css/fontAwesome/all.min.css')}}" />

    <!-- Swiper Slider -->
    <link rel="stylesheet" href="{{asset('quiz/assets/css/swiperSlider/swiper-bundle.min.css')}}" />

    <!-- theme colors -->
    <link rel="stylesheet" href="{{asset('quiz/assets/css/colors.css')}}" />

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{asset('quiz/assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('quiz/assets/css/animation.css')}}" />
    <link rel="stylesheet" href="{{asset('quiz/assets/css/responsive.css')}}" />
    <!-- thankyou -->
    <link rel="stylesheet" href="{{asset('quiz/assets/css/thankyou.css')}}" />
</head>

<body>
    <section class="HorizontalQuiz">
        <!-- header -->
        <header>
            <!-- Total Quiz -->
            <div class="totalQuiz">
                Quesions <span class="ms-2" id="current">1/</span><span id="total">3</span>
                <div class="bar">
                    <div class="progress"></div>
                </div>
            </div>

            <!-- Logo  -->

        </header>
        <main class="overflow-hidden">
            <!-- Timer -->
            <div class="timer" id="timer">60</div>
            <div class="container  pt-md-4">
                <!-- Form -->
                <form novalidate onsubmit="return false">
                    <!-- Slider -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <!-- Step 1 -->
                                <fieldset id="step1">
                                    <h1 class="mainHeading">
                                        <span>1.</span>
                                        It's meant to represent development inclusivity, as well
                                        as secularism and plurality.
                                    </h1>

                                    <div class="radioField animate">
                                        <input type="radio" name="op1" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField animate delay-100">
                                        <input type="radio" name="op1" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField animate delay-200">
                                        <input type="radio" name="op1" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField animate delay-300">
                                        <input type="radio" name="op1" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField animate delay-300">
                                        <input type="radio" name="op1" />
                                        <label>secularism only</label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="swiper-slide">
                                <!-- Step 2 -->
                                <fieldset id="step2">
                                    <h1 class="mainHeading">
                                        <span>2.</span>
                                        It's meant to represent development inclusivity, as well
                                        as secularism and plurality.
                                    </h1>

                                    <div class="radioField">
                                        <input type="radio" name="op2" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op2" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op2" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op2" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op2" />
                                        <label>secularism only</label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="swiper-slide">
                                <!-- Step 3 -->
                                <fieldset id="step3">
                                    <h1 class="mainHeading">
                                        <span>3.</span>
                                        It's meant to represent development inclusivity, as well
                                        as secularism and plurality.
                                    </h1>

                                    <div class="radioField">
                                        <input type="radio" name="op3" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op3" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op3" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op3" />
                                        <label>secularism only</label>
                                    </div>
                                    <div class="radioField">
                                        <input type="radio" name="op3" />
                                        <label>secularism only</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

    </section>
    <!-- result -->
    <div class="loadingresult">
        <img src="assets/images/loading.gif" alt="loading" />
    </div>

    <div class="thankyou-page">
        <main class="thankyou-page-inner">
            <img src="assets/images/thankyou-check.png" alt="" />
            <span>Your answer has been submitted</span>
            <h1>Thankyou for taking Quiz</h1>
            <button type="button" class="btn btn-link">Back To Menu</button>
        </main>
    </div>
    <!-- jQuery -->
    <script src="{{asset('quiz/assets/js/jQuery/jquery-3.7.1.min.js')}}"></script>

    <!-- Swiper SLider -->
    <script src="{{asset('quiz/assets/js/swiperSlider/swiperSlider.js')}}"></script>

    <!-- bootstrap -->
    <script src="{{asset('quiz/assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- ThankyouJS -->
    <script src="{{asset('quiz/assets/js/thankyou.js')}}"></script>

    <!-- Theme JS -->
    <script src="{{asset('quiz/assets/js/custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
