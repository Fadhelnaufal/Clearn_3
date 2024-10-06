@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ url('/guru/course') }}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Course" subtitle=" {{ $kelas->mapel }}" />
    </div>
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
                                    <div class="tab-title">Studi Kasus</div>
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
                                                        <a
                                                            href="{{ route('sub-materi.show', [$kelas->id, $materi->id, $subMateri->id, $subMateri->user_type_id]) }}">
                                                            <strong>Materi: {{ $subMateri->judul }} untuk
                                                                {{ $subMateri->userType->name }}</strong>
                                                        </a>
                                                        {{-- <p>{{ $subMateri->isi }}</p> --}}
                                                        @if ($subMateri->lampiran)
                                                            <a href="{{ asset('files/sub_materi/' . $subMateri->lampiran) }}"
                                                                target="_blank">
                                                                | Download Lampiran
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @foreach ($materi->soal as $soas)
                                                    <div class="soal-test-item">
                                                        <a
                                                            href="{{ route('guru.soal.index', ['materi_id' => $materi->id, 'soal_id' => $soas->id]) }}">
                                                            <strong>Soal Quiz: {{ $soas->nama }}</strong>
                                                        </a>
                                                    </div>
                                                @endforeach
                                                <div class="row">

                                                </div>
                                                <div class="mt-2 d-flex gap-2 ">
                                                    <div class="">
                                                        @if (isset($subMateriId))
                                                            <a href="{{ route('sub-materi.show', ['id' => $kelas->id, 'subMateriId' => $subMateriId]) }}"
                                                                class="btn btn-primary ">
                                                                <i class="bi bi-pencil-square"></i> Tambah Materi

                                                            </a>
                                                        @else
                                                            <a href="{{ route('sub-materi.create', ['kelasId' => $kelas->id, 'materiId' => $materi->id]) }}"
                                                                class="btn btn-primary ">
                                                                <i class="bi bi-pencil-square"></i> Tambah Materi

                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#tambahsoalModal{{ $materi->id }}"
                                                            class="btn btn-secondary md-2">
                                                            <i class="bi bi-plus-lg"></i> Tambah Soal
                                                        </button>

                                                        <form id="add-soal-form-{{ $materi->id }}"
                                                            action="{{ route('guru.soal.store', ['materi_id' => $materi->id]) }}"
                                                            method="POST">
                                                            @csrf

                                                            <div class="modal fade"
                                                                id="tambahsoalModal{{ $materi->id }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                                data-bs-backdrop="static">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Tambah Soal</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <label for="nama" class="form-label">Nama
                                                                                Soal</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nama{{ $materi->id }}"
                                                                                name="nama" required>
                                                                            <input type="hidden" name="materi_id"
                                                                                value="{{ $materi->id }}">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Tambah
                                                                                Soal</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="">
                                                        <button type="button" class="btn btn-warning md-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editMateriModal{{ $materi->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit TP
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <form id="delete-form-{{ $materi->id }}"
                                                            action="{{ route('guru.course-detail.destroy', $materi->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger md-2"
                                                                id="hapustp" onclick="">
                                                                <i class="bi bi-trash3"></i> Hapus TP
                                                            </button>
                                                        </form>
                                                    </div>
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
                                                            <button type="submit" class="btn ripple btn-primary px-2"
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
                                                <div class="accordion-body">
                                                    <img src="{{ asset('assets/images/case_studies/' . $caseStudy->image) }}"
                                                        class="w-50 rounded-start" alt="tidak ada gambar">
                                                </div>
                                                <!-- Case Study details here -->
                                                <div class="row">
                                                    <div class="col mt-3 d-flex gap-2">
                                                        <a class="btn btn-primary md-2"
                                                            href="{{ route('guru.result.case.show', ['caseStudyId' => $caseStudy->id]) }}">
                                                            <i class="bi bi-eye"></i> Lihat Hasil
                                                        </a>
                                                        <button type="button" class="btn btn-warning md-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editCaseModal{{ $caseStudy->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit Studi Kasus
                                                        </button>
                                                        <form id="delete-form-{{ $caseStudy->id }}"
                                                            action="{{ route('guru.course-detail.case.destroy', $caseStudy->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger ms-2"
                                                                onclick="confirmDelete({{ $caseStudy->id }})">
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editCaseModal{{ $caseStudy->id }}" tabindex="-1"
                                    aria-labelledby="editMateriLabel{{ $caseStudy->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0 py-2">
                                                <h5 class="modal-title">Edit Studi Kasus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('guru.course-detail.case.update', $caseStudy->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="kelas_id"
                                                            value="{{ $caseStudy->kelas_id }}">
                                                        <label for="title" class="form-label">Nama Studi Kasus</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" value="{{ old('title', $caseStudy->title) }}"
                                                            required>
                                                        <label for="image" class="form-label">Image</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image" accept="image/png, image/gif, image/jpeg"
                                                            value="{{ old('image', $caseStudy->image) }}" required>
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" id="description"
                                                            name="description"
                                                            value="{{ old('description', $caseStudy->description) }}"
                                                            required>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="submit" class="btn ripple btn-primary px-2"
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
                                                <label for="image" class="form-label">Upload Gambar</label>
                                                <input type="file" accept="image/png, image/gif, image/jpeg"
                                                    class="form-control" id="image" name="image">
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
                <div class="row ">
                    <div class="col justify-content-center">
                        <div class="card mx-3 px-3 table-responsive">
                            <table class="table table-responsive table-bordered" id="tabel-leader"
                                style="text-align: center; vertical-align: middle;">
                                <thead style="text-align: center; vertical-align: middle; justify-content: center">
                                    <tr>
                                        <th scope="col" rowspan="2">Nomor</th>
                                        <th scope="col" rowspan="2">Nama</th>
                                        <th scope="col" rowspan="2">Tipe</th>
                                        <th scope="col" colspan="{{ $materis->count() + $case_studies->count() ?? 1 }}">
                                            Tantangan</th>
                                        <th scope="col" rowspan="2">Exp</th>
                                        <th scope="col" rowspan="2">Nilai</th>
                                    </tr>
                                    <tr>
                                        @foreach ($materis as $materi)
                                            <th scope="col">{{ $materi->judul }}</th>
                                        @endforeach
                                        @foreach ($case_studies as $caseStudy)
                                            <th scope="col">{{ $caseStudy->title }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody style="text-align: center; vertical-align: middle; justify-content: center">
                                    @php
                                        // Sort the students by total points in descending order
                                        $sortedSiswas = $siswas->sortByDesc(function ($siswa) {
                                            return $siswa->user_tasks->sum('points');
                                        });
                                    @endphp
                                    @foreach ($sortedSiswas as $siswa)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $siswa->name }}</td>
                                            <td scope="row">{{ optional($siswa->userType)->name ?? 'No UserType' }}
                                            </td>
                                            @foreach ($materis as $materi)
                                                @php
                                                    $jumlahSubmateri = $siswa->user_tasks
                                                        ->where('materi_id', $materi->id)
                                                        ->where('task_type', 'sub_materi')
                                                        ->where('user_type_id', $siswa->user_type_id)
                                                        ->count();
                                                    $jumlahSoal = $siswa->user_tasks
                                                        ->where('materi_id', $materi->id)
                                                        ->where('task_type', 'soal')
                                                        ->where('user_type_id', $siswa->user_type_id)
                                                        ->count();
                                                    $maxPointSubMateri = 50 * $jumlahSubmateri;
                                                    $maxPointSoal = 100 * $jumlahSoal;
                                                    $pointSubMateri =
                                                        $siswa->user_tasks
                                                            ->where('materi_id', $materi->id)
                                                            ->where('task_type', 'sub_materi')
                                                            ->where('user_type_id', $siswa->user_type_id)
                                                            ->sum('points') ?? 0;
                                                    $pointSoal =
                                                        $siswa->user_tasks
                                                            ->where('materi_id', $materi->id)
                                                            ->where('task_type', 'soal')
                                                            ->where('user_type_id', $siswa->user_type_id)
                                                            ->sum('points') ?? 0;
                                                    $jumlahCaseStudy = $siswa->user_tasks
                                                        ->where('task_type', 'case_study')
                                                        ->count();
                                                    $maxPointCaseStudy = 100 * $jumlahCaseStudy;
                                                    $pointCaseStudy =
                                                        $siswa->user_tasks
                                                            ->where('task_type', 'case_study')
                                                            ->where('kelas_id', $kelas->id)
                                                            ->where('user_type_id', $siswa->user_type_id)
                                                            ->sum('points') ?? 0;
                                                    $rataCaseStudy =
                                                        $maxPointCaseStudy > 0
                                                            ? ($pointCaseStudy / $maxPointCaseStudy) * 100
                                                            : 0;

                                                    $pointMateri = $pointSubMateri + $pointSoal;

                                                    $rataSubmateri =
                                                        $maxPointSubMateri > 0
                                                            ? ($pointSubMateri / $maxPointSubMateri) * 100
                                                            : 0;
                                                    $rataSoal =
                                                        $maxPointSoal > 0 ? ($pointSoal / $maxPointSoal) * 100 : 0;

                                                    $average = ($rataSubmateri + $rataSoal) / 2;
                                                    $averageTotal = ($average + $rataCaseStudy) / 2;

                                                @endphp

                                                <td scope="row">
                                                    @if ($siswa->user_tasks->where('materi_id', $materi->id)->sum('points') > 0)
                                                        <span
                                                            class="badge bg-success">{{ $siswa->user_tasks->where('materi_id', $materi->id)->where('user_type_id', $siswa->user_type_id)->sum('points') }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger">{{ $siswa->user_tasks->where('materi_id', $materi->id)->where('user_type_id', $siswa->user_type_id)->sum('points') }}</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <td scope="row">
                                                    @if ($siswa->user_tasks->where('task_type', 'case_study')->where('task_id', $caseStudy->id)->where('student_id', $siswa->id)->where('kelas_id', $kelas->id)->sum('points') > 0)
                                                        <span
                                                            class="badge bg-success">{{ $siswa->user_tasks->where('student_id', $siswa->id)->where('task_type', 'case_study')->where('task_id', $caseStudy->id)->where('kelas_id', $kelas->id)->where('user_type_id', $siswa->user_type_id)->sum('points') }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger">{{ $siswa->user_tasks->where('student_id', $siswa->id)->where('task_type', 'case_study')->where('task_id', $caseStudy->id)->where('kelas_id', $kelas->id)->where('user_type_id', $siswa->user_type_id)->sum('points') ?? 0 }}</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td scope="row">{{ $siswa->user_tasks->sum('points') }}</td>
                                            <td scope="row">{{ $averageTotal ?? 0 }}</td>
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
                                    <button type="button" class="btn btn-primary" data-bs-target="#sertifikatModal"
                                        data-bs-toggle="modal">Tambah Sertifikat <i
                                            class="fa-solid fa-plus ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sertifikat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" id="addCaseStudyForm" method="POST"
                                            action="{{ route('guru.course.store-sertifikat') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                                <label for="title" class="form-label">Nama Sertifikat</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required>
                                                <label for="kelas" class="form-label">Upload gambar</label>
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" id="inputGroupFile02"
                                                        accept="image/png, image/gif, image/jpeg">
                                                </div>
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
            <!-- Anggota Kelas Tab -->
            <div class="tab-pane fade target" id="anggota">
                <div class="row">
                    <div class="col justify-content-center">
                        <div class="card mx-3 px-3 table-responsive">
                            <table class="table" id="anggota-kelas">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Skor</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->name }}</td>
                                            <td>{{ optional($siswa->userType)->name ?? 'No UserType' }}</td>
                                            <td>{{ $siswa->user_tasks->sum('points') }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('guru.course-detail.destroyJoinStudent', [$kelas->id, $siswa->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $siswa->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah kamu yakin ingin menghapus siswa dari kelas ini?')"><i
                                                            class="bi bi-trash"></i>Keluarkan</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                    <label for="input5" class="form-label mt-2">Token </label>
                                    <input type="text" class="form-control" id="input5" name="kelas"
                                        value="{{ $kelas->token }}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="input5" class="form-label">Logo Kelas</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('assets/images/logos/' . $kelas->logo) }}" alt="..."
                                            width="60%">
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
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


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
    <style>
        /* Center text and items */
        #tabel-leader th,
        #tabel-leader td,
        #anggota-kelas th,
        #anggota-kelas td {
            text-align: center;
            vertical-align: middle;
        }

        /* Make header text bold and colorful */
        #tabel-leader th,
        #anggota-kelas th {
            font-weight: bold;
            background-color: #535794;
            /* Green background */
            color: white;
            /* White text */
        }

        /* Colorful alternating rows for tabel-leader */
        #tabel-leader tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
            /* Light grey */
        }

        #tabel-leader tbody tr:nth-child(even) {
            background-color: #e6ffe6;
            /* Light green */
        }

        /* Colorful alternating rows for anggota-kelas */
        #anggota-kelas tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
            /* Light grey */
        }

        #anggota-kelas tbody tr:nth-child(even) {
            background-color: #ffe6e6;
            /* Light pink */
        }

        /* Customize badge colors */
        .badge.bg-success {
            background-color: #28a745 !important;
            /* Green */
            color: white;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
            /* Red */
            color: white;
        }

        /* Customize Exp image size */
        img.exp-image {
            width: 25px;
            height: 25px;
            margin-left: 10px;
        }
    </style>

    <script>
        // Initialize DataTable for #tabel-leader with responsive feature and centered content
        let tableLeader = new DataTable('#tabel-leader', {
            responsive: true,
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center'
                } // Center content in all columns
            ]
        });

        // Initialize DataTable for #anggota-kelas with responsive feature and centered content
        let tableKelas = new DataTable('#anggota-kelas', {
            responsive: true,
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center'
                } // Center content in all columns
            ]
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
