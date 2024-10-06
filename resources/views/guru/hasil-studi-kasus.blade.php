@extends('layouts.app')
@section('title', 'Lihat Semua Pengajuan Studi Kasus')

@section('content')
<div class="container d-flex align-items-center mb-5">
    <a href="{{ url('guru/kelas/materi/'.$caseStudy->kelas_id) }}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>
    <x-page-title title="Studi Kasus" subtitle="{{ $caseStudy->title }}" />
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <table id="tabel-leader" class="table table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Email</th>
                        <th>Diselesaikan pada</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $submission->users->name }}</td>
                            <td>{{ $submission->users->email }}</td>
                            <td>{{ $submission->completed_at ?? '-'}}</td>
                            <td>
                                @if ($submission->average_score === 'Belum Dinilai')
                                    {{ $submission->average_score }}
                                @else
                                    {{ $submission->average_score }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('guru.result.case.showSubmission', ['caseStudyId' => $caseStudy->id, 'id' => $submission->student_id]) }}" class="btn btn-primary">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
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
@endpush
