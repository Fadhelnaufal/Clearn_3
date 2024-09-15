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
                                    <div class="tab-title">Studi Kasus</div>
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
                            <a class="nav-link" data-bs-toggle="pill" href="#anggota_siswa" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bi bi-people-fill me-2 fs-5'></i>
                                    </div>
                                    <div class="tab-title">Anggota Kelas</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#info" role="tab" aria-selected="false">
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
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active target" id="misi">
                <div class="row mx-1">
                    <div class="col-md-7">
                        @if ($materis->isNotEmpty())
                            @foreach ($materis as $materi)
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="heading{{ $materi->id }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $materi->id }}"
                                                aria-expanded="false" aria-controls="collapse{{ $materi->id }}">
                                                {{ $materi->judul }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $materi->id }}" class="accordion-collapse collapse"
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No materi available for this class.</p>
                        @endif
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
                                    <div class="text-center">
                                            <h2 class="mb-1">{{ $materis->count() }}/{{ $materis->count() }}</h2>
                                            <h6 class="mb-0">Tantangan</h6>
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
            <!-- studi kasus Section -->
            <div class="tab-pane fade target" id="livecode">
                <div class="row mx-1">
                    <div class="col-md-7">
                        @if ($case_studies->isNotEmpty())
                            @foreach ($case_studies as $caseStudy)
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $caseStudy->title }}</h2>
                                        <a href="{{ route('siswa.case-submission.show', ['id' => $caseStudy->id]) }}"
                                            style="color: gray;">
                                            <p class="card-text text-neutral-600">
                                                <i class="bi bi-box-arrow-in-up-right ms-3 fs-6"></i>
                                                {{ $caseStudy->description }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Studi Kasus available for this class.</p>
                        @endif
                    </div>
                    <div class="col-md-5">
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
            {{-- leaderboard --}}
            <div class="tab-pane fade target" id="leaderboard">
                <div class="container">
                    <div class="row mx-1">
                        <div class="col-md-7">
                            <div class="card px-2 py-2">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Peringkat</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Perolehan EXP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $xp = 1000;
                                        @endphp
                                        @foreach ($siswas as $siswa)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $siswa->name }}</td>
                                                <td>{{ $xp }}</td>
                                            </tr>
                                            @php
                                                $xp -= 150;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex justify-content-center">
                            <img src="{{ asset('assets/images/leaderboard.png') }}" alt="" class="img-fluid"
                                style="max-width: 80%;">
                        </div>
                        <!-- Sidebar Section -->
                    </div>
                </div>
            </div>

            {{-- sertifikat --}}
            <div class="tab-pane fade target" id="sertifikat">
                <div class="row">
                    <div class="card">
                        <p class="mx-2 my-2">Anda belum menyelesaikan semua tantangan</p>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="card py-3 px-2 text-center">
                            <img src="{{ asset('assets/images/sertifcok.png') }}" alt="" width="40%"
                                class="img-fluid mx-auto d-block">
                            <a class="btn btn-primary btn-block mt-3"
                                href="{{ route('kelas.cetakSertifikat', ['kelasId' => $kelas->id]) }}">
                                Download Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- anggota kelas --}}
            <div class="tab-pane fade target" id="anggota_siswa">
                <div class="card px-2 py-2">
                    <table class="table" id="siswa">
                        <thead>
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $siswa->name }}</td>
                                    <td>{{ $siswa->userType->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- info kelas --}}
            <div class="tab-pane fade target" id="info">
                <div class="card ">
                    <div class="row">
                        <div class="col-md-5  ms-3">
                            <div class="">
                                <label for="input5" class="form-label mt-2">Nama Mata Pelajaran</label>
                                <input disabled type="text" class="form-control" id="input5" name="judul"
                                    value="{{ $kelas->mapel }}">
                            </div>
                            <div class="">
                                <label for="input5" class="form-label mt-2">Nama Kelas </label>
                                <input disabled type="text" class="form-control" id="input5" name="judul"
                                    value="{{ $kelas->kelas }}">
                            </div>
                            <div class="">
                                <label for="input5" class="form-label mt-2">Jumlah Siswa </label>
                                <input disabled type="number" class="form-control" id="input5" name="jumlah_siswa"
                                    value="{{ $kelas->users()->count() }}">
                            </div>
                            <form action="{{ route('siswa.course.leave', $kelas->id) }}" id="leaveClassForm"
                                method="POST">
                                @csrf
                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                <div class="">
                                    <button type="button" class="btn btn-danger mt-4 me-2 p-2 float-end"
                                        onclick="confirmDelete()">
                                        <i class="bx bx-log-out fs-6 me-2"></i>Keluar Kelas
                                    </button>
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

        <script>
            // Function to show confirmation dialog before submitting the "leave class" form
            function confirmDelete() {
                Swal.fire({
                    title: 'Apakah kamu yakin ingin keluar dari kelas ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, keluar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if the user confirms
                        document.getElementById('leaveClassForm').submit();
                    }
                });
            }

            // Function to submit the form with a processing toast
            function submitForm() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Sedang Memproses...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.getElementById('addMateriForm').submit();
                });
            }

            // Set up SweetAlert for toasts
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            // Display success or error toast based on session messages
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session('success') }}",
                        background: '#a5dc86', // Success background color
                    });
                @endif

                @if (session('toast_error'))
                    Toast.fire({
                        icon: 'error',
                        title: "{{ session('toast_error') }}",
                        background: '#f27474', // Error background color
                    });
                @endif
            });
        </script>

        <!-- Include SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{--
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#siswa').DataTable();
            });
        </script> --}}

        <script src="{{ URL::asset('livecode/js/app.js') }}"></script>
    @endpush
