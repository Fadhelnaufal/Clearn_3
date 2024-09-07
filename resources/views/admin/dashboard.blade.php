@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <x-page-title title="Dashboard" subtitle="Dashboard Guru" />



    <div class="row">
        <div class="col-xxl-8   align-items-stretch">
            <div class="card w-100 overflow-hidden rounded-4">
                <div class="card-body position-relative p-4">
                    <div class="row">
                        <div class="col-12 col-sm-7 ps-3">
                            <div class="d-flex align-items-center gap-3 mb-5">
                                <img src="https://placehold.co/110x110/png" class="rounded-circle bg-grd-info p-1"
                                    width="60" height="60" alt="user">
                                <div class="">
                                    <p class="mb-0 fw-semibold">Selamat Datang</p>
                                    <h4 class="fw-semibold fs-4 mb-0"> Pak {{ Auth::user()->name }}</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-5">
                                <div class="">
                                    <p class="mb-3">Kelas</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">1<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>

                                </div>
                                <div class="">
                                    <p class="mb-3">Siswa</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">1180<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-5">
                                <div class="">
                                    <p class="mb-3">Materi</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">4/15<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="welcome-back-img pt-4 pe-5">
                                <img src="{{ URL::asset('build/images/tampan.png') }}" height="300" alt="">
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
        <div class="col-xxl-4 d-flex  align-items-stretch">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Course</h5>
                                <button class="btn btn-primary w-100 raised">Mulai <i class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Discussion</h5>
                                <button class="btn btn-primary w-100 raised">Mulai <i class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Live Code</h5>
                                <button class="btn btn-primary w-100 raised">Mulai <i class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Quiz</h5>
                                <button class="btn btn-secondary w-100 disabled">Coming Soon </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="continue">
        <div class="row">
            <div class="col-md-12">
                <h4>
                    Kelas Terbaru
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <img src="{{ asset('build/images/laravel.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Pemrograman Web</h5>
                    <p class="card-text">Nam libero tempore, cum soluta nobis est
                        eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus,
                        omnis.</p>
                    <button type="button" class="btn ripple btn-primary px-5">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Make the questions modal static and then show it
            $('#questions-modal').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show'); // Automatically show the modal

            $('#questions-form').on('submit', function(e) {
                e.preventDefault();

                // Show loader
                $('#loader').show();

                $.ajax({
                    url: "{{ route('store.answers') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hide loader
                        $('#loader').hide();

                        if (response.success) {
                            $('#questions-modal').modal('hide');
                            $('#user-category-name').text(response.user_type.name);
                            $('#user-category-image').attr('src', response.user_type.image);
                            $('#result-modal').modal('show');
                        }
                    },
                    error: function() {
                        $('#loader').hide();
                        alert('An error occurred while processing your request.');
                    }
                });
            });

            $('#result-modal').on('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>


    <!--plugins-->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list")
    </script>
    <script>
        $(function() {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    </script>
@endpush
