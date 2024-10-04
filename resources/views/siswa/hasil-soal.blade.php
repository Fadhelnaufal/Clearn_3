@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Materi" subtitle="Preview Jawaban" />
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($pertanyaans->isNotEmpty())
                    @foreach ($pertanyaans as $pertanyaan)
                        <div class="card pt-2 px-2">
                            <div class="ms-3">
                                <strong>
                                    <p class="mt-2">{{ $loop->iteration }}. {{ $pertanyaan->pertanyaan->pertanyaan }}</p>
                                </strong>
                            </div>
                            @if ($pertanyaan->pertanyaan->gambar)
                                <div class="ms-5 mb-2">
                                    <img src="{{ asset('assets/images/soal/' . $pertanyaan->pertanyaan->gambar) }}"
                                        alt="gambar" style="max-width: 40%; height: auto;">
                                </div>
                            @endif
                            <div class="ms-5">
                                @if ($pertanyaan->pertanyaan->opsiPertanyaan->isNotEmpty())
                                    @foreach ($pertanyaan->pertanyaan->opsiPertanyaan as $index => $jawaban)
                                        <p style="{{ $jawaban->is_correct ? 'background-color: rgba(76, 175, 80, 0.5);' : '' }}">
                                            {{ chr(65 + $loop->index) }}. {{ $jawaban->opsi }}
                                            @if ($jawaban->is_correct && in_array($jawaban->id, $jawabanSiswaIds)) 
                                                <span class="text-success">&#10004;</span>
                                            @elseif (! $jawaban->is_correct && in_array($jawaban->id, $jawabanSiswaIds)) 
                                                <span class="text-danger">&#10008;</span>
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <p>No answer options available</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card pt-2 px-2">
                        <p class="mt-2">Belum ada Soal ditambahkan</p>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card py-2 px-2 text-center">
                    <h1>Preview</h1>
                    <!-- Button trigger modal -->
                    <p class="fs-4">Nilai: {{ $userTask->points }} / 100</p>
                    <p>Jawaban benar: {{ $jawabanBenars }}</p>
                    <a href="{{ url('/siswa/course-detail/'. $soal->materi->kelas_id) }}" type="button" class="btn btn-primary">Kembali</a>
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
