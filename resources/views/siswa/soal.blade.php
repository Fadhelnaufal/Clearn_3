@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Materi" subtitle="Tambah Soal" />
    </div>

    <div class="container">
        <form action="{{ route('siswa.soal.store.jawaban', ['materi_id' => $materi->id, 'soalId' => $soal->id]) }}" method="POST" id="quiz-form">
            @csrf
            <input type="hidden" name="soal_id" value="{{ $soal->id }}">
            @if($pertanyaans && $pertanyaans->isNotEmpty())
                <div id="pertanyaan-container">
                    @foreach ($pertanyaans as $index => $pertanyaan)
                        <div class="card pertanyaan-slide" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                            <div class="row">
                                <div class="col-md d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/soal.png') }}" width="80%">
                                </div>
                                <div class="col-md d-flex align-items-center me-3">
                                    <div>
                                        <h3 class="mb-4">{{ $pertanyaan->pertanyaan->pertanyaan }}</h3>
                                        <!-- Input tersembunyi untuk pertanyaan_id -->
                                        <input type="hidden" name="pertanyaan_id[]" value="{{ $pertanyaan->id }}">
                                        <div class="d-grid gap-2 me-2">
                                            @foreach ($pertanyaan->pertanyaan->opsiPertanyaan as $opsi)
                                                <button type="button" class="btn btn-outline-primary pilih-opsi" data-pertanyaan-id="{{ $pertanyaan->id }}" data-opso-id="{{ $opsi->id }}">
                                                    {{ $opsi->opsi }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button id="next-btn" class="btn btn-primary">Selanjutnya</button>
                    <button id="submit-btn" class="btn btn-success" style="display: none;">Submit</button>
                </div>
            @else
                <p>No questions available for this section.</p>
            @endif
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ URL::asset('build/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.pertanyaan-slide');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        const jawaban = []; // Store answers as an array

        // Event listener for option buttons
        document.querySelectorAll('.pilih-opsi').forEach(button => {
            button.addEventListener('click', function () {
                const pertanyaanId = this.getAttribute('data-pertanyaan-id'); // ID pertanyaan
                const opsiId = this.getAttribute('data-opso-id'); // ID opsi

                // Ensure we initialize this index if it doesn't exist
                const existingJawabanIndex = jawaban.findIndex(j => j.pertanyaan_id === pertanyaanId);

                if (existingJawabanIndex === -1) {
                    // If not exist, push a new answer object
                    jawaban.push({
                        opsi_id: opsiId,
                        pertanyaan_id: pertanyaanId,
                        siswa_id: '{{ Auth::user()->id }}', // Getting siswa_id directly from the template
                    });
                } else {
                    // If exist, update the existing answer
                    jawaban[existingJawabanIndex].opsi_id = opsiId;
                }

                // Update button states
                document.querySelectorAll(`.pilih-opsi[data-pertanyaan-id='${pertanyaanId}']`).forEach(btn => {
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-outline-primary');
                });
                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-primary');
            });
        });

        nextBtn.addEventListener('click', (event) => {
            event.preventDefault();

            const currentQuestionId = slides[currentSlide].querySelector('.pilih-opsi').getAttribute('data-pertanyaan-id');

            if (!jawaban.find(j => j.pertanyaan_id === currentQuestionId)) {
                alert('Silakan pilih jawaban sebelum melanjutkan!');
                return;
            }

            slides[currentSlide].style.display = 'none';
            currentSlide++;

            if (currentSlide < slides.length) {
                slides[currentSlide].style.display = 'block';
                restoreSelectedAnswer(slides[currentSlide].querySelector('.pilih-opsi').getAttribute('data-pertanyaan-id'));
            }

            if (currentSlide === slides.length - 1) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            }
        });

        function restoreSelectedAnswer(pertanyaanId) {
            const selectedJawaban = jawaban.find(j => j.pertanyaan_id === pertanyaanId);
            if (selectedJawaban) {
                const selectedOpsiId = selectedJawaban.opsi_id;
                const selectedButton = document.querySelector(`.pilih-opsi[data-pertanyaan-id='${pertanyaanId}'][data-opso-id='${selectedOpsiId}']`);
                if (selectedButton) {
                    selectedButton.classList.remove('btn-outline-primary');
                    selectedButton.classList.add('btn-primary');
                }
            }
        }

        submitBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form submission

            // Check if there are answers before submitting
            if (jawaban.length === 0) {
                alert('Please answer at least one question.');
                return;
            }

            // Create a hidden input to hold the structured answers
            const jawabanInput = document.createElement('input');
            jawabanInput.type = 'hidden';
            jawabanInput.name = 'jawaban'; // Ensure this is named correctly
            jawabanInput.value = JSON.stringify(jawaban); // Convert to JSON string

            document.getElementById('quiz-form').appendChild(jawabanInput);

            // Submit the form
            document.getElementById('quiz-form').submit();
        });
    </script>

@endpush
