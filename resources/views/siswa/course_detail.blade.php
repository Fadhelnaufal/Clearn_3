@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Detail Kelas" />
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body px-2">
                    <ul class="nav nav-pills mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#misi" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-house-door me-2 fs-5"></i>
                                    </div>
                                    <div class="tab-title">Misi</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " data-bs-toggle="pill" href="#livecode" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-code-square me-2 fs-5"></i>
                                    </div>
                                    <div class="tab-title">Live Code</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#leaderboard" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-bar-chart me-2 fs-5"></i>
                                    </div>
                                    <div class="tab-title">Leaderboard</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#sertifikat" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bi bi-patch-check me-2 fs-5'></i>
                                    </div>
                                    <div class="tab-title">Sertifikat</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#anggota_kelas" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bi bi-people-fill me-2 fs-5'></i>
                                    </div>
                                    <div class="tab-title">Anggota Kelas</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#info_kelas" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bi bi-gear me-2 fs-5'></i>
                                    </div>
                                    <div class="tab-title">Informasi Kelas</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tab-content">
            <div class="tab-pane fade show active target" id="misi">
                <div class="row mx-1">
                    <div class="col-md-7">
                        <!-- Accordion Section -->
                        <div class="card mx-2">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            HTML
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body mt-2">
                                            <a href="">
                                                <strong>1. Pengertian HTML</strong>
                                            </a><br>
                                            <a>
                                                <strong>2. Kegunaan HTML</strong>
                                            </a><br>
                                            <a>
                                                <strong>3. Mengenal Tag, Element, Atribut HTML</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mx-2">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                            aria-controls="collapseTwo">
                                            CSS
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse "
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <a href="">
                                                <strong>1. Pengertian CSS</strong>
                                            </a><br>
                                            <a>
                                                <strong>2. Kegunaan CSS</strong>
                                            </a><br>
                                            <a>
                                                <strong>3. Mengenal Selector, Property, dan Value CSS</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mx-2">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="true" aria-controls="collapseThree">
                                            JS
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse "
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>1. Pengertian JavaScript</strong><br>
                                            <strong>2. Kegunaan JavaScript</strong><br>
                                            <strong>3. Dasar-dasar Pemrograman dengan JavaScript</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="">
                                            <h5 class="mb-0">Tantangan</h5>
                                        </div>
                                    </div>
                                    <div class="position-relative">
                                        <div class="piechart-legend">
                                            <h2 class="mb-1">4/7</h2>
                                            <h6 class="mb-0">Tantangan</h6>
                                        </div>
                                        <div id="chart11"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-content">
                                <h4 class="mt-3">Total Perolehan EXP</h4>
                                <h5>0</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Section -->
                </div>
            </div>
            <!-- livecode Section -->
            <div class="tab-pane fade target" id="livecode">
                <div class="card">
                    <p class="mx-2 my-2">belum ada studi kasus</p>
                </div>
            </div>
            <div class="tab-pane fade target" id="leaderboard">
                <div class="card">
                    <p class="mx-2 my-2">belum ada leaderboard</p>
                </div>
            </div>
            <div class="tab-pane fade target" id="sertifikat">
                <div class="card">
                    <p class="mx-2 my-2">belum ada sertifikat</p>
                </div>
            </div>
            <div class="tab-pane fade target" id="anggota_kelas">
                <div class="card">
                    <p class="mx-2 my-2">belum ada anggota kelas</p>
                </div>
            </div>
            <div class="tab-pane fade target" id="info_kelas">
                <div class="card ">
                        <div class="row">
                        <div class="col-md-5 mt-5 ms-3">
                            <form action="">
                                <div class="">
                                    <label for="input5" class="form-label mt-2">Nama Mata Pelajaran</label>
                                    <input disabled type="text" class="form-control" id="input5" name="judul">
                                </div>
                                <div class="">
                                    <label for="input5" class="form-label mt-2">Nama Kelas </label>
                                    <input disabled type="text" class="form-control" id="input5" name="judul">
                                </div>
                                <div class="">
                                    <label for="input5" class="form-label mt-2">Jumlah Siswa </label>
                                    <input disabled type="number" class="form-control" id="input5"
                                        name="jumlah_siswa">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-danger mt-4 me-2 p-2 float-end"><i
                                            class="bx bx-log-out fs-6 me-2"></i>Keluar Kelas</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5 m-3">
                            <img src="{{ asset('build/images/infokelas.svg') }}" alt="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <!--plugins-->
        <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/chartjs/js/chart.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/chartjs/js/chartjs-custom.js') }}"></script>
        <script src="{{ URL::asset('build/js/main.js') }}"></script>
        <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".accordion-button").on('click', function() {
                    var target = $(this).data("target");
                    $(".accordion-collapse").not(target).collapse('hide'); // Hide other collapses
                    $(target).collapse('toggle'); // Toggle the clicked collapse
                });
            });
        </script>
        <script>
            jQuery(function() {
                // Initially hide all tab content
                jQuery('.tab-content .tab-pane').removeClass('show active');

                // Show the first tab's content by default
                jQuery('#misi').addClass('show active');

                // Handle nav-link clicks
                jQuery('.nav-link').click(function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    jQuery('.tab-pane').removeClass('show active'); // Hide all tab panes

                    var targetId = jQuery(this).attr(
                        'href'); // Get the href attribute which corresponds to the tab-pane ID
                    jQuery(targetId).addClass('show active'); // Show the corresponding tab-pane
                });
            });
        </script>
        <script src="{{ URL::asset('livecode/js/app.js') }}"></script>
    @endpush
