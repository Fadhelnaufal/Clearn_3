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
                            <a class="nav-link active" data-bs-toggle="pill" href="#alltopic" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon">
                                    </div>
                                    <div class="tab-title">Semua</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " data-bs-toggle="pill" href="#pengumuman" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon">
                                    </div>
                                    <div class="tab-title">Pengumuman</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#tugasrumah" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon">
                                    </div>
                                    <div class="tab-title">Tugas Rumah</div>
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
            <div class="tab-pane fade show active target" id="alltopic">
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            CSS
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample">
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
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
            <!-- pengumuman Section -->
            <div class="tab-pane fade target" id="pengumuman">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h4>Penilaian</h4>
                                <p class="card-text">Struktur Dasar HTML</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="button" disabled>Lihat Code</button>
                                </div>
                                <h4 class="mt-3">Kriteria Penilaian</h4>
                                <div class="row">
                                    <div class="col">
                                        <p class="">Struktur Dasar HTML</p>
                                        <input type="text" class="form-control" placeholder="Exp"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <p class="">Penggunaan Tag HTML</p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <p class="">Penggunaan Atribut HTML</p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <p class="">Penataan Konten</p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <p class="">Kesesuaian Konten </p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-primary" type="button">Simpan Penilaian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                Preview Hasil
                            </div>
                            <div class="card-body">
                                <div class="outputContainer">
                                    <iframe id="output" title="output" frameborder="0" width="100%"
                                        height="100%"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i> HTML</h3>
                                <textarea name="html" id="html" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="on" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                    <button class="clear html btn btn-secondary">clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i>CSS</h3>
                                <textarea name="css" id="css" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                    <button class="clear css btn btn-secondary">clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i>JS</h3>
                                <textarea name="js" id="js" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="clear js btn btn-secondary">clear</button>
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade target" id="tugasrumah">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h4>Penilaian</h4>
                                <p class="card-text">Struktur Dasar HTML</p>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="button" disabled>Lihat Code</button>
                                </div>
                                <h4 class="mt-3">Kriteria Penilaian</h4>
                                <div class="row">
                                    <div class="col">
                                        <p class="">Struktur Dasar HTML</p>
                                        <input type="text" class="form-control" placeholder="Exp"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <p class="">Penggunaan Tag HTML</p>
                                        <input type="text" class="form-control" placeholder="EXP" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <p class="">Penggunaan Atribut HTML</p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <p class="">Penataan Konten</p>
                                        <input type="text" class="form-control" placeholder="EXP" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <p class="">Kesesuaian Konten </p>
                                        <input type="text" class="form-control" placeholder="EXP"
                                            aria-label="First name">
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-primary" type="button">Simpan Penilaian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                Preview Hasil
                            </div>
                            <div class="card-body">
                                <div class="outputContainer">
                                    <iframe id="output" title="output" frameborder="0" width="100%"
                                        height="100%"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i> HTML</h3>
                                <textarea name="html" id="html" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="on" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                    <button class="clear html btn btn-secondary">clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i>CSS</h3>
                                <textarea name="css" id="css" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                    <button class="clear css btn btn-secondary">clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <div class="card">
                                <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                        code
                                    </i>JS</h3>
                                <textarea name="js" id="js" cols="auto" rows="auto" autofocus autocomplete="off"
                                    autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                                <div class="col mt-2 mb-2 mx-2">
                                    <button class="clear js btn btn-secondary">clear</button>
                                    <button class="copy-btn copy-html btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
            jQuery('#alltopic').addClass('show active');

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
