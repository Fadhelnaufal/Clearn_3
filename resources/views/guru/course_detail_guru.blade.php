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
    <!--Tambah TP-->
    <div class="container mt-3">
        <div class="tab-content">
            <div class="tab-pane fade show active target" id="misi">
                <div class="row">
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
                                                {{-- Sub-materis display here --}}
                                                @foreach ($materi->subMateris as $subMateri)
                                                    <div class="sub-materi-item">
                                                        <a href="{{ route('subMateri.show', $subMateri->id) }}">
                                                            <strong>{{ $subMateri->judul }}</strong>
                                                        </a>
                                                        <p>{{ $subMateri->isi }}</p>
                                                        @if ($subMateri->lampiran)
                                                            <a href="{{ asset('storage/' . $subMateri->lampiran) }}"
                                                                target="_blank">
                                                                Download Lampiran
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="col mt-3 d-flex me-2">
                                                    @if (isset($subMateriId))
                                                        <a href="{{ route('sub-materi.show', ['id' => $kelas->id, 'subMateriId' => $subMateriId]) }}"
                                                            class="btn btn-primary md-2">
                                                            <i class="bi bi-pencil-square"></i> Tambah Materi
                                                        </a>
                                                    @else
                                                        <a href="{{ route('sub-materi.create', ['kelasId' => $kelas->id, 'materiId' => $materi->id]) }}"
                                                            class="btn btn-primary md-2">
                                                            <i class="bi bi-pencil-square"></i> Tambah Materi
                                                        </a>
                                                    @endif
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#tambahsoal" class="btn btn-secondary md-2"><i
                                                            class="bi bi-plus-lg"></i> Tambah Soal</button>
                                                    {{-- Edit Button to Open Modal --}}
                                                    <button type="button" class="btn btn-warning md-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editMateriModal{{ $materi->id }}">
                                                        <i class="bi bi-pencil-square"></i> Edit TP
                                                    </button>

                                                    {{-- Delete form --}}
                                                    <form id="delete-form-{{ $materi->id }}"
                                                        action="{{ route('guru.course-detail.destroy', $materi->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger md-2">
                                                            <i class="bi bi-trash3"></i> Hapus TP
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal for Editing This Materi --}}
                                <div class="modal fade" id="editMateriModal{{ $materi->id }}" tabindex="-1"
                                    aria-labelledby="editMateriLabel{{ $materi->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0 py-2">
                                                <h5 class="modal-title">Edit Materi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('guru.course-detail.update', $materi->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="kelas_id"
                                                            value="{{ $kelas->id }}">
                                                        <label for="judul" class="form-label">Nama Materi</label>
                                                        <input type="text" class="form-control"
                                                            id="judul{{ $materi->id }}" name="judul"
                                                            value="{{ old('judul', $materi->judul) }}" required>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="button" class="btn ripple btn-primary px-2"
                                                                onclick="submitForm()">
                                                                Simpan Perubahan
                                                            </button>
                                                            <button type="button"
                                                                class="btn ripple btn-secondary px-2 text-center"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <p class="mx-3 mt-3">Belum ada tujuan pembelajaran</p>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                    <h5 class="modal-title">Tambahkan Materi</h5>
                                    <a href="javascript:;" class="primary-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" id="addMateriForm" method="POST"
                                            action="{{ route('guru.course-detail.store') }}">
                                            @csrf
                                            <div class="col-md-12">
                                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                                <label for="judul" class="form-label">Nama Materi</label>
                                                <input type="text" class="form-control" id="judul" name="judul"
                                                    required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit"
                                                        class="btn ripple btn-primary px-2">Tambah</button>
                                                    <button type="button"
                                                        class="btn ripple btn-secondary px-2 text-center"
                                                        data-bs-dismiss="modal">Batal</button>
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
                        @if ($case_studies->isNotEmpty())
                            @foreach ($case_studies as $caseStudy)
                                <div class="accordion" id="accordionCaseStudy">
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingCaseStudy{{ $caseStudy->id }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseCaseStudy{{ $caseStudy->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapseCaseStudy{{ $caseStudy->id }}">
                                                {{ $caseStudy->title }}
                                            </button>
                                        </h2>
                                        <div id="collapseCaseStudy{{ $caseStudy->id }}"
                                            class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <div class="accordion-body">
                                                    {{ $caseStudy->description }}
                                                </div>
                                                <!-- Case Study details here -->
                                                <div class="row">
                                                    <div class="col mt-3 d-flex">
                                                        @if (isset($subMateriId))
                                                            <a href="{{ route('sub-materi.show', ['id' => $kelas->id, 'subMateriId' => $subMateriId]) }}"
                                                                class="btn btn-primary ">
                                                                <i class="bi bi-pencil-square"></i> Tambah Materi
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                href="{{ route('sub-materi.create', ['kelasId' => $kelas->id, 'materiId' => $materi->id]) }}"
                                                                class="btn btn-primary ">
                                                                <i class="bi bi-pencil-square"></i> Tambah Materi
                                                            </button>
                                                        @endif
                                                        <button type="button" class="btn btn-warning ms-2"
                                                            data-bs-target="#EditModal" data-bs-toggle="modal"><i
                                                                class="bi bi-pencil-square"></i>Edit</button>
                                                        <form id="delete-form-{{ $materi->id }}"
                                                            action="{{ route('guru.course-detail.destroy', $materi->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger ms-2"
                                                                onclick="confirmDelete({{ $materi->id }})">
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <p class="mx-3 mt-3">belum ada studi kasus</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body text-center mt-2 mb-2">
                                <h3 class="mb-3">Jumlah Studi Kasus</h3>
                                <h1 class="mt-3 mb-3">{{ $case_studies->count() }}</h1>
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
                                        <form class="row g-3" id="addCaseStudyForm" method="POST"
                                            action="{{ route('guru.course-detail.case.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                                <label for="title" class="form-label">Nama Studi Kasus</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required>
                                                <label for="description" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" id="description"
                                                    name="description" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
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
            <!-- Leaderboard Tab -->
            <div class="tab-pane fade target" id="leaderboard">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $siswa->name }}</td>
                                            <td>500 xp</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
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
                            </table>                        </div>
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
                            <form action="{{ route('course.update', $kelas->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <label for="input5" class="form-label mt-2">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="input5" name="mapel"
                                        value="{{ $kelas->mapel }}">
                                </div>
                                <div class="mb-2">
                                    <label for="input5" class="form-label mt-2">Nama Kelas </label>
                                    <input type="text" class="form-control" id="input5" name="kelas"
                                        value="{{ $kelas->kelas }}">
                                </div>
                                <div class="mb-2">
                                    <label for="input5" class="form-label">Logo Kelas</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('assets/images/logos/' . $kelas->logo) }}" alt="..." width="60%">
                                    </div>
                                    <input type="file" class="form-control" id="image_kelas" name="logo"
                                        value="{{ $kelas->logo }}" accept="image/png, image/jpeg">
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-warning mt-4 p-2">
                                        <i class="bi bi-pencil-square fs-6 me-2"></i> Edit Kelas
                                    </button>
                                </div>
                            </form>
                            <div class="mb-2">
                                <!-- Delete Form -->
                                <form action="{{ route('course.destroy', $kelas->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-4 me-2 p-2">
                                        <i class="bi bi-trash fs-6 me-2"></i> Hapus
                                    </button>
                                </form>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Set up event listener for the Edit button
            document.querySelectorAll('[data-bs-target="#EditModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const materiId = this.getAttribute('data-materi-id');
                    const materiJudul = this.getAttribute('data-materi-judul');

                    // Set the form action URL
                    const formAction = `{{ route('guru.course-detail.update', '') }}/${materiId}`;
                    const form = document.getElementById('editMateriForm');
                    form.action = formAction;

                    // Set the input values
                    document.getElementById('modalMateriId').value = materiId;
                    document.getElementById('modalMateriJudul').value = materiJudul;
                });
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
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin TP Akan Dihapus?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function submitForm() {
            // Show the toast and submit the form
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

        // Optional: Show success toast if there's a session message
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



    <script>
        $(".data-attributes span").peity("donut");
    </script>

    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
@endpush
