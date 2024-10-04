@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Hasil Studi Kasus" />
    <div class="container mt-4">
        {{-- <h4>Results for Case Study ID: {{ $caseStudyId ?? 'Not Provided' }}</h4> --}}
        <div class="row">
            <div class="card">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Email</th>
                            <th scope="col">Diselesaikan pada</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submission as $submissions)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $submissions->users->name }}</td>
                                <td>{{ $submissions->users->email }}</td>
                                <td>{{ $submissions->completed_at ?? '-' }}</td>
                                <td>
                                    @if ($submissions->score_message === 'Belum Dinilai')
                                        {{ $submissions->score_message }}
                                    @else
                                        {{ $submissions->score_message ?? '-' }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('guru.result.case.showSubmission', ['caseStudyId' => $caseStudyId, 'id' => $submissions->student_id]) }}"
                                        class="btn btn-primary btn-sm me-2">
                                        <i class="bi bi-eye me-1"></i>Lihat
                                    </a>                                </td>
                            </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
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
@endpush
