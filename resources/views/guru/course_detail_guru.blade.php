@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <x-page-title title="Course" subtitle="Detail Kelas {{ $kelas->mapel }}" />
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
                                    <div class="tab-icon"><i class="bi bi-gear fs-5 me-2"></i></div>
                                    <div class="tab-title">Pengaturan Kelas</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="tab-content">
            <div class="tab-pane fade show active target" id="misi">
                <div class="row">
                    <div class="col-md-7">
                        <div class="accordion" id="accordionExample">
                            @if ($materis->isNotEmpty())
                                @foreach ($materis as $materi)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $materi->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $materi->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $materi->id }}">
                                                {{ $materi->judul }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $materi->id }}" class="accordion-collapse collapse show"
                                            aria-labelledby="heading{{ $materi->id }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($materi->subMateris as $subMateri)
                                                    <div class="sub-materi-item">
                                                        <a
                                                            href="{{ route('subMateri.show', $subMateri->id) }}"><strong>{{ $subMateri->judul }}</strong></a>
                                                        <p>{{ $subMateri->isi }}</p>
                                                        @if ($subMateri->lampiran)
                                                            <a href="{{ asset('storage/' . $subMateri->lampiran) }}"
                                                                target="_blank">Download Lampiran</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="col mt-3">
                                                    <button type="button" class="btn btn-primary mt-2"><i
                                                            class="bi bi-plus-lg"></i> Tambah Materi</button>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#tambahsoal" class="btn btn-secondary mt-2"><i
                                                            class="bi bi-plus-lg"></i> Tambah Soal</button>
                                                    <button type="button" class="btn btn-warning mt-2"><i
                                                            class="bi bi-pencil-square"></i> Edit TP</button>
                                                    <button type="button" class="btn btn-danger mt-2"><i
                                                            class="bi bi-trash3"></i> Hapus TP</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No materi available for this class.</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal fade" id="tambahsoal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nama</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <label for="input5" class="form-label">Nama Materi</label>
                                            <input type="text" class="form-control" id="input5">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body text-center mt-2 mb-2">
                                <h3 class="mb-3">Jumlah TP</h3>
                                <h1 class="mt-3 mb-3">{{ $materis->count() }}</h1>
                                <div class="parent-icon mb-3 mt-3">
                                    <button type="button" class="btn btn-primary" data-bs-target="#FormModal"
                                        data-bs-toggle="modal">Tambah TP <i class="fa-solid fa-plus ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="FormModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2">
                                    <h5 class="modal-title">Tambah Materi</h5>
                                    <a href="javascript:;" class="primary-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" id="addMateriForm" method="POST" action="{{route('guru.course-detail.store')}}">
                                            @csrf
                                            <div class="col-md-12">
                                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                                <label for="judul" class="form-label">Nama Materi</label>
                                                <input type="text" class="form-control" id="judul" name="judul" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn ripple btn-primary px-2">Tambah</button>
                                                    <button type="button" class="btn ripple btn-secondary px-2 text-center" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Live Code Tab -->
            <div class="tab-pane fade target" id="livecode">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card mx-2">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Studi Kasus 1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <a href=""><strong>Studi Kasus</strong></a> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use to
                                            style each element.
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary mt-4 p-2 btn-sm me-2"><i
                                                        class="bi bi-plus-lg"></i> Tambah
                                                    Materi</button>
                                                <button type="submit" data-bs-toggle="modal"
                                                    data-bs-target="#tambahsoal"
                                                    class="btn btn-secondary mt-4 p-2 btn-sm me-2"><i
                                                        class="bi bi-plus-lg"></i> Tambah
                                                    Soal</button>
                                                <button type="submit" class="btn btn-warning mt-4 p-2 btn-sm me-2"><i
                                                        class="bi bi-pencil-square"></i> Edit
                                                    TP</button>
                                                <button type="submit" class="btn btn-danger mt-4 p-2 btn-sm me-2"><i
                                                        class="bi bi-trash3"></i> Hapus
                                                    TP</button>
                                            </div>
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
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body text-center mt-2 mb-2">
                                <h3 class="mb-3">Jumlah Studi Kasus</h3>
                                <h1 class="mt-3 mb-3">0</h1>
                                <div class="parent-icon mb-3 mt-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Tambah Studi Kasus<i class="fa-solid fa-plus ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Studi Kasus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3">
                                            <div class="col-md-12">
                                                <label for="input5" class="form-label">Nama Materi</label>
                                                <input type="text" class="form-control" id="input5">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Leaderboard Tab -->
            <div class="tab-pane fade target" id="leaderboard">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <p class="mx-3 mt-3">belum ada rekap nilai</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sertifikat Tab -->
            <div class="tab-pane fade target" id="sertifikat">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <p class="mx-3 mt-3">belum ada sertifikat yang dibuat</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body text-center mt-2 mb-2">
                                <h3 class="mb-3">Jumlah Sertifikat</h3>
                                <h1 class="mt-3 mb-3">0</h1>
                                <div class="parent-icon mb-3 mt-3">
                                    <button type="button" class="btn btn-primary" data-bs-target="#FormModal"
                                        data-bs-toggle="modal">Tambah Sertifikat <i
                                            class="fa-solid fa-plus ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Anggota Kelas Tab -->
            <div class="tab-pane fade target" id="anggota">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <p class="mx-3 mt-3">belum ada anggota kelas</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Informasi Kelas Tab -->
            <div class="tab-pane fade target" id="pengaturan">
                <div class="card">
                    <div class="row">
                        <div class="col">
                            <p class="mx-3 mt-3">ini adalah informasi kelas</p>
                        </div>
                        <div class="col mx-3 mt-3 mb-3">
                            <form action="">
                                <div class="">
                                    <label for="input5" class="form-label mt-2">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="input5" name="judul">
                                </div>
                                <div class="">
                                    <label for="input5" class="form-label mt-2">Nama Kelas </label>
                                    <input type="text" class="form-control" id="input5" name="judul">
                                </div>
                                <div class="">
                                    <label for="input5" class="form-label">Logo Kelas</label>
                                    <input type="file" class="form-control" id="image_kelas" name="image_kelas"
                                        accept="image/png, image/jpeg">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-danger mt-4 me-2 p-2"><i
                                            class="bi bi-trash fs-6 me-2"></i>Hapus</button>
                                    <button type="submit" class="btn btn-warning mt-4 p-2"><i
                                            class="bi bi-pencil-square fs-6 me-2"></i>Edit Kelas</button>
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
