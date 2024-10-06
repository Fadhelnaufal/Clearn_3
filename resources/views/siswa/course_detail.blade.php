@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
<div class="row mb-4">
    <x-page-title title="Course" subtitle="Detail Kelas" />
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
                                                @foreach ($materi->subMateris->where('user_type_id', $user->user_type_id) as $subMateri)
                                                    <div class="sub-materi-item">
                                                        <a href="{{ route('siswa.sub-materi.show', [$kelas->id, $materi->id, $subMateri->id, $subMateri->user_type_id]) }}" style="color: #7964EF">
                                                            <strong>Materi: {{ $subMateri->judul }}</strong>
                                                            @if (isset($userTasks[$subMateri->id]) && $userTasks[$subMateri->id]->is_completed)
                                                                <span class="text-success">&#10004;</span> <!-- Checkmark if completed -->
                                                            @endif
                                                        </a>
                                                        @if ($subMateri->lampiran)
                                                            <a href="{{ asset('files/sub_materi/' . $subMateri->lampiran) }}" target="_blank" style="color: #7964EF">
                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach

                                                @foreach ($materi->soal as $soas)
                                                    <div class="soal-test-item">
                                                        <a href="{{ route('siswa.soal.preview', ['materi_id' => $materi->id, 'soalId' => $soas->id]) }}" style="color: #7964EF">
                                                            <strong>Soal Quiz: {{ $soas->nama }}</strong>
                                                            @if (isset($userTasks[$soas->id]) && $userTasks[$soas->id]->is_completed)
                                                                <span class="text-success">&#10004;</span> <!-- Checkmark if completed -->
                                                            @endif
                                                        </a>
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
                                        <h2 class="mb-1">{{ $completedChallenges }}/{{ $totalChallenges }}</h2>
                                        <h6 class="mb-0">Tantangan</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-content">
                                <h4 class="mt-3">Total Perolehan EXP</h4>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="lead mb-0" style="font-size: 1.5rem;">{{ $totalPoints ?? 0 }}</p>
                                    <img src="{{asset('assets/images/exp.png')}}" alt="EXP Image" style="width: 40px; height: 40px; margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- studi kasus Section -->
            <div class="tab-pane fade target" id="livecode">
                <div class="row mx-1">
                    <div class="col-md-7">
                        @if ($case_studies->isNotEmpty())
                            @foreach ($case_studies as $caseStudy)
                            <div class="accordion mb-2" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $caseStudy->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $caseStudy->id }}" aria-expanded="false" aria-controls="collapse{{ $caseStudy->id }}">
                                            {{ $caseStudy->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $caseStudy->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $caseStudy->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <a href="{{ route('siswa.case-submission.show', ['id' => $caseStudy->id]) }}" style="color: #7964EF">
                                                <p class="card-text text-neutral-600">
                                                    <i class="bi bi-caret-right-fill ms-3 fs-6"></i>
                                                    {{ $caseStudy->description }}
                                                    @if (isset($userTasks[$caseStudy->id]) && $userTasks[$caseStudy->id]->is_completed)
                                                        <span class="text-success">&#10004;</span> <!-- Checkmark if completed -->
                                                    @endif
                                                </p>
                                            </a>
                                        </div>
                                    </div>
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
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="lead mb-0" style="font-size: 1.5rem;">{{ $totalPoints ?? 0 }}</p>
                                    <img src="{{asset('assets/images/exp.png')}}" alt="EXP Image" style="width: 40px; height: 40px; margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Section -->
                </div>
            </div>
            {{-- leaderboard --}}
            <div class="tab-pane fade target" id="leaderboard">
                <div class="container">
                    {{-- Overachiever Leaderboard --}}
                        @if ($siswas->where('user_type_id',1)->isNotEmpty())
                        <div class="col-md-12 justify-content-center">
                            <div class="card px-2 py-2 table-responsive mx-3 my-3">
                                <h4>Overachiever Leaderboard</h4>
                                <table id="tabel-leader" class="table table-striped table-bordered  table-hover text-center">
                                    <thead class="thead-light text-center align-middle" style="text-align: center; vertical-align: middle;">
                                        <tr>
                                            <th scope="col" rowspan="2">Peringkat</th>
                                            <th scope="col" rowspan="2">Nama</th>
                                            <th scope="col" colspan="{{ $materis->count() + $case_studies->count() }}">Tantangan</th>
                                            <th scope="col" colspan="4">Perolehan</th>
                                            <th scope="col" rowspan="2">Total EXP</th>
                                        </tr>
                                        <tr>
                                            @foreach ($materis as $materi )
                                                <th scope="col">{{ $materi->judul }}</th>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <th scope="col">{{ $caseStudy->title }}</th>
                                            @endforeach
                                            <th scope="col">Emas</th>
                                            <th scope="col">Perak</th>
                                            <th scope="col">Perunggu</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center align-middle" style="text-align: center; vertical-align: middle;">
                                        @php
                                            // Filter and sort the students by total points for user_type_id = 1
                                            $overachievers = $siswas->where('user_type_id', 1)->sortByDesc(function ($siswa) {
                                                return $siswa->user_tasks->sum('points');
                                            });
                                        @endphp
                                        @foreach ($overachievers as $siswa)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $siswa->name }}</td>
                                            @php
                                                // Initialize medal counters
                                                $totalGold = 0;
                                                $totalSilver = 0;
                                                $totalBronze = 0;
                                            @endphp
                                            @foreach ($materis as $materi )
                                                <td scope="row">
                                                    @php
                                                        $jumlahSubmateri = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->where('user_type_id', $siswa->user_type_id)->count();
                                                        $jumlahSoal = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->where('user_type_id', $siswa->user_type_id)->count();
                                                        $maxPointSubMateri = 50 * $jumlahSubmateri;
                                                        $maxPointSoal = 100 * $jumlahSoal;
                                                        $pointSubMateri = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->where('user_type_id', $siswa->user_type_id)->sum('points') ?? 0;
                                                        $pointSoal = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->where('user_type_id', $siswa->user_type_id)->sum('points') ?? 0;

                                                        $pointMateri = $pointSubMateri + $pointSoal;

                                                        $rataSubmateri = $maxPointSubMateri > 0 ? ($pointSubMateri / $maxPointSubMateri) * 100 : 0;
                                                        $rataSoal = $maxPointSoal > 0 ? ($pointSoal / $maxPointSoal) * 100 : 0;

                                                        $average = ($rataSubmateri + $rataSoal) / 2;
                                                        // dd($jumlahSubmateri, $jumlahSoal, $maxPointSubMateri, $maxPointSoal, $pointSubMateri, $pointSoal, $rataSubmateri, $rataSoal, $average);

                                                        $category ='';
                                                        $image = '';
                                                        // Determine category based on points
                                                        if ($average >= 50 && $average <= 75) {
                                                            $category = 'Perunggu'; // Bronze
                                                            $image = asset('assets/images/medals/bronze.png'); // Replace with your image path
                                                            $totalBronze++;
                                                        } elseif ($average >= 76 && $average <= 85) {
                                                            $category = 'Silver'; // Silver
                                                            $image = asset('assets/images/medals/silver.png'); // Replace with your image path
                                                            $totalSilver++;
                                                        } elseif ($average >= 86 && $average <= 100) {
                                                            $category = 'Emas'; // Gold
                                                            $image = asset('assets/images/medals/gold.png'); // Replace with your image path
                                                            $totalGold++;
                                                        }elseif ($average < 0) {
                                                            $category = 'Tidak Ada Perolehan'; // Nilai negatif tidak valid
                                                            $image = null;
                                                        } else {
                                                            $category = 'Tidak Ada Perolehan';
                                                            $image = null;
                                                        }
                                                    @endphp
                                                    @if($image)
                                                        <img src="{{ $image }}" alt="{{ $category }}" width="20%" height="auto" class="ml-2" />
                                                    @endif
                                                    <br>
                                                    {{ $pointMateri }} Point <br> ({{ $category }})
                                                </td>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <td scope="row">
                                                    @php
                                                        $pointCaseStudy = $siswa->user_tasks
                                                        ->where('task_type', 'case_study')
                                                        ->where('task_id', $caseStudy->id)
                                                        ->where('kelas_id', $kelas->id)
                                                        ->sum('points') ?? 0;

                                                        $category ='';
                                                        $image = '';
                                                        // Determine category based on points
                                                        if ($pointCaseStudy >= 50 && $pointCaseStudy <= 75) {
                                                            $category = 'Perunggu'; // Bronze
                                                            $image = asset('assets/images/medals/bronze.png'); // Replace with your image path
                                                            $totalBronze++;
                                                        } elseif ($pointCaseStudy >= 76 && $pointCaseStudy <= 85) {
                                                            $category = 'Silver'; // Silver
                                                            $image = asset('assets/images/medals/silver.png'); // Replace with your image path
                                                            $totalSilver++;
                                                        } elseif ($pointCaseStudy >= 86 && $pointCaseStudy <= 100) {
                                                            $category = 'Emas'; // Gold
                                                            $image = asset('assets/images/medals/gold.png'); // Replace with your image path
                                                            $totalGold++;
                                                        }elseif ($average < 0) {
                                                            $category = 'Tidak Ada Perolehan'; // Nilai negatif tidak valid
                                                            $image = null;
                                                        } else {
                                                            $category = 'Tidak Ada Perolehan';
                                                            $image = null;
                                                        }
                                                    @endphp
                                                    @if($image)
                                                        <img src="{{ $image }}" alt="{{ $category }}" width="20%" height="auto" class="ml-2" />
                                                    @endif
                                                    <br>
                                                    {{ $pointCaseStudy }} Point <br> ({{ $category }})
                                                </td>
                                            @endforeach

                                            <td scope="row">{{ $totalGold }}</td>
                                            <td scope="row">{{ $totalSilver }}</td>
                                            <td scope="row">{{ $totalBronze }}</td>
                                            <td scope="row">{{ $totalGold+$totalSilver+$totalBronze }}</td>
                                            <td scope="row">
                                                <img src="{{asset('assets/images/exp.png')}}" alt="EXP Image" style="width: 25px; height: 25px; align-item: center"><br>
                                                <span>{{ $siswa->user_tasks->sum('points') }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        {{-- Mastery-Expert Leaderboard --}}
                        @if ($siswas->where('user_type_id', 2)->isNotEmpty())
                        <div class="col-md-12 d-flex justify-content-center">
                            <h4>Mastery-Expert Leaderboard</h4>
                            <div class="card px-2 py-2 table-responsive">
                                <table id="tabel-leader" class="table table-striped table-bordered table-hover text-center">
                                    <thead class="thead-light" style="text-align: center; vertical-align: middle;">
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tipe</th>
                                            @foreach ($materis as $materi)
                                                <th scope="col">{{ $materi->judul }}</th>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <th scope="col">{{ $caseStudy->title }}</th>
                                            @endforeach
                                            <th scope="col">Perolehan EXP</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center; vertical-align: middle;">
                                        @php
                                            // Get the first student with user_type_id = 2
                                            $masteryexpert = Auth::user();
                                        @endphp
                                        @if ($masteryexpert->user_type_id == 2) <!-- Check if there is a mastery expert -->
                                        <tr>
                                            <td scope="row">{{ $masteryexpert->name }}</td>
                                            <td scope="row">{{ $masteryexpert->userType->name }}</td>
                                            @foreach ($materis as $materi)
                                                <td scope="row">
                                                    @php
                                                        $jumlahSubmateri = $masteryexpert->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->count();
                                                        $jumlahSoal = $masteryexpert->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->count();
                                                        $maxPointSubMateri = 50 * $jumlahSubmateri;
                                                        $maxPointSoal = 100 * $jumlahSoal;
                                                        $pointSubMateri = $masteryexpert->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->sum('points') ?? 0;
                                                        $pointSoal = $masteryexpert->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->sum('points') ?? 0;

                                                        $rataSubmateri = $maxPointSubMateri > 0 ? ($pointSubMateri / $maxPointSubMateri) * 100 : 0;
                                                        $rataSoal = $maxPointSoal > 0 ? ($pointSoal / $maxPointSoal) * 100 : 0;

                                                        $totalPointMateri = $pointSubMateri + $pointSoal;

                                                        $average = ($rataSubmateri + $rataSoal) / 2;

                                                        $category = '';
                                                        $image = '';
                                                        // Determine category based on points
                                                        if ($average >= 50 && $average <= 75) {
                                                            $category = 'Perunggu'; // Bronze
                                                            $image = asset('assets/images/medals/bronze.png'); // Gambar medali perunggu
                                                        } elseif ($average >= 76 && $average <= 85) {
                                                            $category = 'Silver'; // Silver
                                                            $image = asset('assets/images/medals/silver.png'); // Gambar medali perak
                                                        } elseif ($average >= 86 && $average <= 100) {
                                                            $category = 'Emas'; // Gold
                                                            $image = asset('assets/images/medals/gold.png'); // Gambar medali emas
                                                        } elseif ($average < 0) {
                                                            $category = 'Tidak Ada Perolehan'; // Nilai negatif tidak valid
                                                            $image = null;
                                                        } else {
                                                            $category = 'Tidak Ada Perolehan';
                                                            $image = null;
                                                        }
                                                    @endphp
                                                    @if($image)
                                                        <img src="{{ $image }}" alt="{{ $category }}" width="20%" height="auto" class="ml-2" />
                                                    @endif
                                                    <br>
                                                    {{ $totalPointMateri }} <br> ({{ $category }})
                                                </td>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <td scope="row">
                                                    @php
                                                        $pointCaseStudy = $masteryexpert->user_tasks
                                                        ->where('task_type', 'case_study')
                                                        ->where('task_id', $caseStudy->id)
                                                        ->where('kelas_id', $kelas->id)
                                                        ->sum('points') ?? 0;

                                                        $category = '';
                                                        $image = '';
                                                        // Determine category based on points
                                                        if ($pointCaseStudy >= 50 && $pointCaseStudy <= 75) {
                                                            $category = 'Perunggu'; // Bronze
                                                            $image = asset('assets/images/medals/bronze.png'); // Gambar medali perunggu
                                                        } elseif ($pointCaseStudy >= 76 && $pointCaseStudy <= 85) {
                                                            $category = 'Silver'; // Silver
                                                            $image = asset('assets/images/medals/silver.png'); // Gambar medali perak
                                                        } elseif ($pointCaseStudy >= 86 && $pointCaseStudy <= 100) {
                                                            $category = 'Emas'; // Gold
                                                            $image = asset('assets/images/medals/gold.png'); // Gambar medali emas
                                                        } elseif ($average < 0) {
                                                            $category = 'Tidak Ada Perolehan'; // Nilai negatif tidak valid
                                                            $image = null;
                                                        } else {
                                                            $category = 'Tidak Ada Perolehan';
                                                            $image = null;
                                                        }
                                                    @endphp
                                                    @if($image)
                                                        <img src="{{ $image }}" alt="{{ $category }}" width="20%" height="auto" class="ml-2" />
                                                    @endif
                                                    <br>
                                                    {{ $pointCaseStudy }} Point <br> ({{ $category }})
                                                </td>
                                            @endforeach
                                            <td scope="row">
                                                <img src="{{ asset('assets/images/exp.png') }}" alt="EXP Image" style="width: 25px; height: 25px; align-item:center"> <br>
                                                <span>{{ $masteryexpert->user_tasks->sum('points') }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                        {{-- Best-Performance Leaderboard --}}
                        @if ($siswas->where('user_type_id',3)->isNotEmpty())
                        <div class="col-md-12 d-flex justify-content-center">
                            <h4>Best-Performance Leaderboard</h4>
                            <div class="card px-2 py-2 table-responsive">
                                <table id="tabel-leader" class="table table-striped table-bordered table-hover text-center">
                                    <thead class="thead-light" style="text-align: center; vertical-align: middle;">
                                        <tr>
                                            <th scope="col" rowspan="2">Peringkat</th>
                                            <th scope="col" rowspan="2">Nama</th>
                                            <th scope="col" colspan="{{ count($materis) + count($case_studies) }}">Tantangan</th>
                                            <th scope="col" rowspan="2">Perolehan EXP</th>
                                        </tr>
                                        <tr>
                                            @foreach ($materis as $materi )
                                                <th scope="col">{{ $materi->judul }}</th>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <th scope="col">{{ $caseStudy->title }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center; vertical-align: middle;">
                                        @php
                                            // Sort the students by total points in descending order
                                            // Filter and sort the students by total points for user_type_id = 1
                                            $bestPerformers = $siswas->where('user_type_id', 3)->sortByDesc(function ($siswa) {
                                                return $siswa->user_tasks->sum('points');
                                            });
                                        @endphp
                                        @foreach ($bestPerformers as $siswa)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $siswa->name }}</td>
                                            @foreach ($materis as $materi )
                                                <td scope="row">
                                                    @php
                                                        $jumlahSubmateri = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->count();
                                                        $jumlahSoal = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->count();
                                                        $maxPointSubMateri = 50 * $jumlahSubmateri;
                                                        $maxPointSoal = 100 * $jumlahSoal;
                                                        $pointSubMateri = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->sum('points') ?? 0;
                                                        $pointSoal = $siswa->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->sum('points') ?? 0;

                                                        $rataSubmateri = $maxPointSubMateri > 0 ? ($pointSubMateri / $maxPointSubMateri) * 100 : 0;
                                                        $rataSoal = $maxPointSoal > 0 ? ($pointSoal / $maxPointSoal) * 100 : 0;

                                                        $average = ($rataSubmateri + $rataSoal) / 2;
                                                        // dd($jumlahSubmateri, $jumlahSoal, $maxPointSubMateri, $maxPointSoal, $pointSubMateri, $pointSoal, $rataSubmateri, $rataSoal, $average);

                                                        $category ='';
                                                    @endphp
                                                    {{ $average }} Point
                                                </td>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <td scope="row">
                                                    @php
                                                        $pointCaseStudy = $siswa->user_tasks
                                                        ->where('task_type', 'case_study')
                                                        ->where('task_id', $caseStudy->id)
                                                        ->where('kelas_id', $kelas->id)
                                                        ->sum('points') ?? 0;

                                                        $category ='';
                                                    @endphp
                                                    {{ $pointCaseStudy }} Point
                                                </td>
                                            @endforeach
                                            <td scope="row" class="d-flex align-items-center justify-content-center">
                                                <span>{{ $siswa->user_tasks->sum('points') }}</span>
                                                <img src="{{asset('assets/images/exp.png')}}" alt="EXP Image" style="width: 25px; height: 25px;">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        {{-- Non-Achiever Leaderboard --}}
                        @if ($siswas->where('user_type_id', 4)->isNotEmpty())
                        <div class="col-md-12 d-flex justify-content-center">
                            <h4>Non-Achiever Leaderboard</h4>
                            <div class="card px-2 py-2 table-responsive">
                                <table id="tabel-leader" class="table table-striped table-hover text-center">
                                    <thead class="thead-light" style="text-align: center; vertical-align: middle;">
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tipe</th>
                                            @foreach ($materis as $materi)
                                                <th scope="col">{{ $materi->judul }}</th>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <th scope="col">{{ $caseStudy->title }}</th>
                                            @endforeach
                                            <th scope="col">Perolehan EXP</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center; vertical-align: middle;">
                                        @php
                                            // Get the first student with user_type_id = 2
                                            $nonAchiever = Auth::user();
                                        @endphp
                                        @if ($nonAchiever->user_type_id == 4) <!-- Check if there is a mastery expert -->
                                        <tr>
                                            <td scope="row">{{ $nonAchiever->name }}</td>
                                            <td scope="row">{{ $nonAchiever->userType->name }}</td>
                                            @foreach ($materis as $materi)
                                                <td scope="row">
                                                    @php
                                                        $jumlahSubmateri = $nonAchiever->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->count();
                                                        $jumlahSoal = $nonAchiever->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->count();
                                                        $maxPointSubMateri = 50 * $jumlahSubmateri;
                                                        $maxPointSoal = 100 * $jumlahSoal;
                                                        $pointSubMateri = $nonAchiever->user_tasks->where('materi_id', $materi->id)->where('task_type', 'sub_materi')->sum('points') ?? 0;
                                                        $pointSoal = $nonAchiever->user_tasks->where('materi_id', $materi->id)->where('task_type', 'soal')->sum('points') ?? 0;

                                                        $rataSubmateri = $maxPointSubMateri > 0 ? ($pointSubMateri / $maxPointSubMateri) * 100 : 0;
                                                        $rataSoal = $maxPointSoal > 0 ? ($pointSoal / $maxPointSoal) * 100 : 0;

                                                        $average = ($rataSubmateri + $rataSoal) / 2;

                                                        $category = '';
                                                    @endphp
                                                    {{ $average }}
                                                </td>
                                            @endforeach
                                            @foreach ($case_studies as $caseStudy)
                                                <td scope="row">
                                                    @php
                                                        $pointCaseStudy = $nonAchiever->user_tasks
                                                        ->where('task_type', 'case_study')
                                                        ->where('task_id', $caseStudy->id)
                                                        ->where('kelas_id', $kelas->id)
                                                        ->sum('points') ?? 0;

                                                        $category = '';
                                                    @endphp
                                                    {{ $pointCaseStudy }} Point
                                                </td>
                                            @endforeach
                                            <td scope="row" class="d-flex justify-content-center align-items-center">
                                                <span>{{ $nonAchiever->user_tasks->sum('points') }}</span>
                                                <img src="{{ asset('assets/images/exp.png') }}" alt="EXP Image" style="width: 25px; height: 25px; margin-left: 10px;">
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <!-- Sidebar Section -->
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
            <div class="tab-pane fade target justify-content-center" id="anggota_siswa">
                <div class="card px-2 py-2 table-responsive">
                    <table id="anggota-kelas" class="table">
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
                                    <td scope="row">{{ $loop->iteration }}</td>
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
                        <div class="col-md-5 mt-5 ms-3">
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
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $(".accordion-button").on('click', function() {
                    var target = $(this).data("target");
                    $(".accordion-collapse").not(target).collapse('hide'); // Hide other collapses
                    $(target).collapse('toggle'); // Toggle the clicked collapse
                });
            });
        </script>
        <style>
            /* Center text and items */
            #tabel-leader th, #tabel-leader td,
            #anggota-kelas th, #anggota-kelas td {
                text-align: center;
                vertical-align: middle;
            }

            /* Make header text bold and colorful */
            #tabel-leader th, #anggota-kelas th {
                font-weight: bold;
                background-color: #535794; /* Green background */
                color: white; /* White text */
            }

            /* Colorful alternating rows for tabel-leader */
            #tabel-leader tbody tr:nth-child(odd) {
                background-color: #DDDDEA; /* Light grey */
                color: grey;
            }
            #tabel-leader tbody tr:nth-child(even) {
                background-color: #afb0c9; /* Light green */
                color: white;
            }

            /* Colorful alternating rows for anggota-kelas */
            #anggota-kelas tbody tr:nth-child(odd) {
                background-color: #f9f9f9; /* Light grey */
            }
            #anggota-kelas tbody tr:nth-child(even) {
                background-color: #999ab6; /* Light pink */
            }

            /* Customize badge colors */
            .badge.bg-success {
                background-color: #28a745; !important; /* Green */
                color: white;
            }
            .badge.bg-danger {
                background-color: #dc3545 !important; /* Red */
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
                columnDefs: [
                    { targets: '_all', className: 'dt-center' }  // Center content in all columns
                ]
            });

            // Initialize DataTable for #anggota-kelas with responsive feature and centered content
            let tableKelas = new DataTable('#anggota-kelas', {
                responsive: true,
                columnDefs: [
                    { targets: '_all', className: 'dt-center' }  // Center content in all columns
                ]
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

        {{-- @if (session('removed_from_class'))
            <script>
                Swal.fire({
                    title: 'Removed from Class',
                    text: "{{ session('removed_from_class') }}",
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif --}}


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
