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
                                    <div class="tab-icon"><i class="bi bi-house-door me-2 fs-5"></i></div>
                                    <div class="tab-title">Misi</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#livecode" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-code-square me-2 fs-5"></i></div>
                                    <div class="tab-title">Live Code</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#leaderboard" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-list-ol me-2 fs-5"></i></div>
                                    <div class="tab-title">Rekap Nilai</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#sertifikat" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-patch-check me-2 fs-5"></i></div>
                                    <div class="tab-title">Sertifikat</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#anggota" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-people-fill fs-5 me-2"></i></div>
                                    <div class="tab-title">Anggota Kelas</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#pengaturan" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-gear fs-5 me-2"></i></i></div>
                                    <div class="tab-title">Pengaturan Kelas</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="col">
                <div class="card">
                    <h1 class="mx-3 my-3">Quiz: </h1>
                    <div class="row">
                        <div class="col my-3 ms-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahsoal"><i class="fa-solid fa-plus "></i> Tambah Soal</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i
                                class="bi bi-pencil-square"></i> Edit Soal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tambahsoal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Tambah Soal</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <label for="">Pertanyaan</label>
                            <textarea class="form-control mb-3" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="col-7">
                <div class="card">
                    <p class="mt-3 ms-3">Anda Belum Membuat Soal</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Plugins -->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/chartjs/js/chartjs-custom.js') }}"></script>

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

    <script>
        $(".data-attributes span").peity("donut");
    </script>

    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
@endpush
