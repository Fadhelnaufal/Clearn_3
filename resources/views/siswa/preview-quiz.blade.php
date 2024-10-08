@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ Route('siswa.show-quiz') }}" class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Quiz" subtitle="Preview Quiz" />
    </div>

    <div class="container">
        <div class="card">
            <div class="row">
                <!-- First column with image -->
                <div class="col-md d-flex align-items-center justify-content-center">
                    <dotlottie-player src="https://lottie.host/50bdf00b-510e-4962-b0e1-5f1acf52937b/9YwYqcyQh8.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                        autoplay></dotlottie-player>
                </div>
                <!-- Second column with content -->
                <div class="col-md d-flex align-items-center">
                    <div>
                        <h3 class="mb-4">{{ $quiz->nama }}</h3>
                        <p class="fs-5">
                            Kerjakan quiz <strong>{{ $quiz->nama }}</strong> dengan baik dan teliti. <br>
                        </p>
                        <a class="btn btn-primary"
                            href="{{ $hasTakenQuiz ? Route('siswa.show.result', $quiz->id) : Route('siswa.take-quiz', $quiz->id) }}">
                            {{ $hasTakenQuiz ? 'Lihat Leaderboard' : 'Kerjakan Soal' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Include jQuery, Bootstrap, and SweetAlert -->
    <script src="{{ URL::asset('build/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert for confirmation before closing modal
        $('#addSoalModal').on('hidden.bs.modal', function() {
            Swal.fire({
                icon: 'success',
                title: 'Modal closed successfully!',
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endpush
