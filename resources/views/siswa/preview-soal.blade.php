@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ url('/siswa/course-detail/'.$materi->kelas_id) }}" class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Materi" subtitle="Preview Soal" />
    </div>

    <div class="container">
        <div class="card">
            <div class="row">
                <!-- First column with image -->
                <div class="col-md d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/soal.png') }}" width="80%">
                </div>
                <!-- Second column with content -->
                <div class="col-md d-flex align-items-center">
                    <div>
                        <h3 class="mb-4">{{ $soal->nama }}</h3>
                        <p class="fs-5">
                            Kerjakan soal <strong>{{ $soal->nama }}</strong> dengan baik dan teliti. <br>
                            Jika ada pertanyaan, silakan bertanya kepada pengajar. <br>
                            TIdak ada batas waktu, silahkan kerjakan soal sampai selesai.
                        </p>
                        @if ($userTask && $userTask->is_completed)
                            <a class="btn btn-secondary" href="{{ route('siswa.soal.hasil', ['materi_id' => $materi->id, 'soalId' => $soal->id]) }}">Lihat Preview Soal</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('siswa.soal.show.soal', ['materi_id' => $materi->id, 'soalId' => $soal->id]) }}">Kerjakan Soal</a>
                        @endif

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
