@extends('layouts.app')

@section('title')
    Quiz
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ Route('guru.tambah-quiz') }}" class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Quiz" subtitle="{{ $quiz->nama }}" />
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($quiz->questions->isNotEmpty())
                    @foreach ($quiz->questions as $quizzes)
                        <!-- Corrected loop -->
                        <div class="card pt-2 px-2">
                            <div class="ms-3">
                                <strong>
                                    <p class="mt-2">{{ $loop->iteration }}. {{ $quizzes->question_text }}</p>
                                </strong>
                            </div>
                            @if ($quizzes->question_image)
                                <div class="ms-5 mb-2">
                                    <img src="{{ asset('quiz/assets/images/question/' . $quizzes->question_image) }}"
                                        alt="gambar" style="max-width: 40%; height: auto;">
                                </div>
                            @endif
                            <div class="ms-5">
                                @if ($quizzes->options->isNotEmpty())
                                    @foreach ($quizzes->options as $index => $option)
                                        <p>
                                            {{ chr(65 + $loop->index) }}. {{ $option->option_text }}
                                            @if ($option->is_correct)
                                                <span class="text-success">&#10004;</span>
                                            @else
                                                <span class="text-danger">&#10008;</span>
                                            @endif
                                        </p>
                                    @endforeach
                                    <div class="mb-4 d-flex gap-2">
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $quizzes->id }}" data-bs-id="{{ $quizzes->id }}"
                                            data-questions-quiz="{{ $quizzes->question_text }}"
                                            data-questions-image="{{ asset('quiz/assets/images/question/' . $quizzes->question_image) }}"
                                            data-bs-options="{{ $quizzes->options }}">
                                            <i class="bi bi-pencil-square me-2 fs-6"></i>Edit
                                        </button>
                                        <form
                                            action="{{ route('guru.question.destroy', ['id' => $quiz->id, 'questionId' => $quizzes->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash3 me-2 fs-6"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModal{{ $quizzes->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Soal</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('guru.question.update', ['id' => $quiz->id, 'questionId' => $quizzes->id]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="question_id" id="question_id"
                                                            value="{{ $quizzes->id }}">

                                                        <div class="mb-2">
                                                            <label for="question_text" class="form-label">Soal</label>
                                                            <textarea class="form-control" id="question_text" name="question_text">{{ old('question_text', $quizzes->question_text) }}</textarea>
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="question_image" class="form-label">Gambar
                                                                Soal</label>
                                                            <input type="file" class="form-control" id="question_image"
                                                                name="question_image">
                                                        </div>

                                                        <div class="mb-2" id="jawabanContainer">
                                                            <label for="options" class="form-label">Pilihan Jawaban</label>
                                                            @foreach ($quizzes->options as $option)
                                                                <div class="d-flex mt-2 align-items-center jawaban-row">
                                                                    <input type="text" class="form-control me-2"
                                                                        placeholder="Masukkan pilihan jawaban"
                                                                        name="options[{{ $option->id }}][option_text]"
                                                                        value="{{ old('options.' . $option->id . '.option_text', $option->option_text) }}">
                                                                    <div class="form-check">
                                                                        <input type="hidden"
                                                                            name="options[{{ $option->id }}][is_correct]"
                                                                            value="0"> <!-- Hidden field -->
                                                                        <input id="is_correct_{{ $option->id }}"
                                                                            class="form-check-input" type="checkbox"
                                                                            value="1"
                                                                            name="options[{{ $option->id }}][is_correct]"
                                                                            {{ $option->is_correct ? 'checked' : '' }}>
                                                                        <label class="form-check-label me-2"
                                                                            for="is_correct_{{ $option->id }}">Benar</label>
                                                                    </div>
                                                                    <button type="button"
                                                                        class="btn ripple btn-danger px-2"
                                                                        onclick="removeRowEdit(this)">Hapus</button>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="mb-4 d-flex gap-2">
                                                            <button type="button" class="btn btn-dark"
                                                                id="addOptionButtonEdit">
                                                                <i class="bi bi-plus me-1 fs-6"></i>Opsi
                                                            </button>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card pt-2 px-2">
                        <p class="mt-2">Belum ada Soal Quiz yang ditambahkan</p>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card py-2 px-2 text-center">
                    <h1>Quiz</h1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn ripple btn-primary px-4 mb-2" data-bs-toggle="modal"
                        data-bs-target="#FormModal">
                        <i class="bi bi-plus-lg me-2 fs-6"></i>Tambah Quiz
                    </button>
                    <button class="btn btn-success"><i class="bi bi-eye me-2 fs-6"></i>Lihat Hasil</button>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title" id="FormModalLabel">Tambah Quiz</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" action="{{ route('guru.question.store', $quiz->id) }}" method="POST"
                                enctype="multipart/form-data" id="quizForm">
                                @csrf
                                <div class="col-md-12">
                                    <label for="question_text" class="form-label">Soal</label>
                                    <textarea id="question_text" name="question_text" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="question_image" class="form-label">Upload gambar</label>
                                    <div class="input-group">
                                        <input id="question_image" name="question_image" type="file"
                                            class="form-control" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>

                                <!-- Container for the dynamically added "Jawaban" inputs -->
                                <div class="col-md-12" id="jawabanContainerCreate">
                                    <label for="jawaban" class="form-label">Jawaban</label>
                                    <div class="d-flex mt-2 align-items-center jawaban-row-create">
                                        <input id="opsi_1" type="text" class="form-control me-2"
                                            placeholder="Masukkan jawaban" name="jawaban[1][opsi]" required>
                                        <div class="form-check">
                                            <input id="is_correct_1" class="form-check-input" type="checkbox"
                                                value="1" name="jawaban[1][is_correct]">
                                            <label class="form-check-label me-2" for="is_correct_1">Benar</label>
                                        </div>
                                        <button type="button" class="btn ripple btn-danger px-2"
                                            onclick="removeRowCreate(this)">Hapus</button>
                                    </div>
                                </div>

                                <!-- Button to add more options -->
                                <div class="col-md-12">
                                    <div class="d-inline-block mt-1">
                                        <button type="button" class="btn btn-dark" id="addOptionButtonCreate"><i
                                                class="bi bi-plus me-1 fs-6"></i>Opsi</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3 mt-3">
                                        <button type="submit" class="btn ripple btn-primary px-2">Tambah</button>
                                        <button type="button" class="btn ripple btn-secondary px-2"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
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

    <!-- JavaScript to handle dynamic option addition -->
    <script>
        @if($quiz->options && $quiz->options->count() > 0)
            {{ $quiz->options->count() }}
        @else
            null
        @endif; // Initialize with existing options count

        document.getElementById('addOptionButtonEdit').addEventListener('click', function() {
            jawabanIndexEdit++;
            const jawabanContainer = document.getElementById('jawabanContainer');

            // Create new answer input row
            const newRow = document.createElement('div');
            newRow.classList.add('d-flex', 'mt-2', 'align-items-center', 'jawaban-row');

            newRow.innerHTML = `
                <input id="opsi_${jawabanIndexEdit}" type="text" class="form-control me-2" placeholder="Masukkan pilihan jawaban" name="options[${jawabanIndexEdit}][option_text]" required>
                <div class="form-check">
                    <input id="is_correct_${jawabanIndexEdit}" class="form-check-input" type="checkbox" value="1" name="options[${jawabanIndexEdit}][is_correct]">
                    <label class="form-check-label me-2" for="is_correct_${jawabanIndexEdit}">Benar</label>
                </div>
                <button type="button" class="btn ripple btn-danger px-2" onclick="removeRowEdit(this)">Hapus</button>
            `;

            jawabanContainer.appendChild(newRow); // Append new row to container
        });

        // Remove the row when "Hapus" is clicked
        function removeRowEdit(button) {
            const row = button.parentElement;
            row.remove();
        }

        // Event listener for the edit button to set up the modal
        document.querySelectorAll('[data-bs-target="#editModal{{ $quiz->id }}"]').forEach(button => {
            button.addEventListener('click', function() {
                const questionId = this.getAttribute('data-question-id');
                const questionText = this.getAttribute('data-question-text');
                const questionImage = this.getAttribute('data-question-image');
                const options = JSON.parse(this.getAttribute('data-options'));

                // Set the question_id in the hidden input field
                document.querySelector('#question_id').value = questionId;

                // Set the question text area value
                document.querySelector('#question_text').value = questionText;

                // Clear the existing jawaban rows
                const jawabanContainer = document.getElementById('jawabanContainer');
                jawabanContainer.innerHTML = ''; // Clear existing rows

                // Populate the jawaban fields with dynamic options
                options.forEach((option, index) => {
                    const jawabanRow = document.createElement('div');
                    jawabanRow.classList.add('d-flex', 'mt-2', 'align-items-center', 'jawaban-row');
                    jawabanRow.innerHTML = `
                        <input id="opsi_${index + 1}" type="text" class="form-control me-2" placeholder="Masukkan pilihan jawaban" name="options[${option.id}][option_text]" value="${option.option_text}" required>
                        <div class="form-check">
                            <input id="is_correct_${option.id}" class="form-check-input" type="checkbox" value="1" name="options[${option.id}][is_correct]" ${option.is_correct ? 'checked' : ''}>
                            <label class="form-check-label me-2" for="is_correct_${option.id}">Benar</label>
                        </div>
                        <button type="button" class="btn ripple btn-danger px-2" onclick="removeRowEdit(this)">Hapus</button>
                    `;
                    jawabanContainer.appendChild(jawabanRow);
                });

                // Update the jawabanIndexEdit based on the number of options populated
                jawabanIndexEdit = options.length; // Set to the current number of options
            });
        });
    </script>
    <!-- JavaScript for creating dynamic option addition -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let jawabanIndexCreate = 1; // Initialize index for dynamic answers in the create form

            // Ensure the button exists
            const addOptionButtonCreate = document.getElementById('addOptionButtonCreate');
            if (addOptionButtonCreate) {
                addOptionButtonCreate.addEventListener('click', function() {
                    jawabanIndexCreate++;
                    const jawabanContainerCreate = document.getElementById('jawabanContainerCreate');

                    // Create a new row for answer option
                    const newJawabanRowCreate = document.createElement('div');
                    newJawabanRowCreate.classList.add('d-flex', 'mt-2', 'align-items-center',
                        'jawaban-row-create');
                    newJawabanRowCreate.innerHTML = `
                    <input id="opsi_${jawabanIndexCreate}" type="text" class="form-control me-2" placeholder="Masukkan jawaban" name="jawaban[${jawabanIndexCreate}][opsi]" required>
                    <div class="form-check">
                        <input id="is_correct_${jawabanIndexCreate}" class="form-check-input" type="checkbox" value="1" name="jawaban[${jawabanIndexCreate}][is_correct]">
                        <label class="form-check-label me-2" for="is_correct_${jawabanIndexCreate}">Benar</label>
                    </div>
                    <button type="button" class="btn ripple btn-danger px-2" onclick="removeRowCreate(this)">Hapus</button>
                `;
                    jawabanContainerCreate.appendChild(newJawabanRowCreate);
                });
            } else {
                console.error('Add Option button not found!');
            }
        });

        // Function to remove a specific answer option in the create form
        function removeRowCreate(button) {
            const row = button.parentElement;
            row.remove(); // Remove the answer row
        }
    </script>
@endpush
