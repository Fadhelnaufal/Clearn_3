@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Materi" subtitle="Tambah Soal" />
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
                                        <p>
                                            {{ chr(65 + $loop->index) }}. {{ $jawaban->opsi }}
                                            @if ($jawaban->is_correct)
                                                <span class="text-success">&#10004;</span>
                                            @else
                                                <span class="text-danger">&#10008;</span>
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <p>No answer options available</p>
                                @endif
                                <div class="mb-4">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-pertanyaan-id="{{ $pertanyaan->id }}"
                                        data-pertanyaan="{{ $pertanyaan->pertanyaan->pertanyaan }}"
                                        data-gambar="{{ asset('assets/images/soal/' . $pertanyaan->pertanyaan->gambar) }}"
                                        data-opsi="{{ json_encode($pertanyaan->pertanyaan->opsiPertanyaan) }}">
                                        <i class="bi bi-pencil-square me-2 fs-6"></i>Edit
                                    </button>
                                    <button class="btn btn-danger"><i class="bi bi-trash3 me-2 fs-6"></i>Hapus</button>
                                </div>
                                {{-- edit modal --}}
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="EditModalLabel"
                                    aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0 py-2">
                                                <h5 class="modal-title" id="FormModalLabel">Edit Soal nomor</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <form class="row g-3"
                                                        action="{{ route('guru.soal.update', ['materi_id' => $materi->id, 'soal_id' => $soal->id]) }}"
                                                        method="POST" enctype="multipart/form-data" id="kelasForm">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="pertanyaan_id" id="pertanyaan_id" value="{{ old('pertanyaan_id') }}">
                                                        <div class="col-md-12">
                                                            <label for="mapel" class="form-label">Soal</label>
                                                            <textarea id="pertanyaan" name="pertanyaan" class="form-control" rows="3" required>{{ old('pertanyaan') }}</textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="kelas" class="form-label">Upload Gambar</label>
                                                            <div class="input-group">
                                                                <input id="gambar" name="gambar" type="file"
                                                                    class="form-control"
                                                                    accept="image/png, image/gif, image/jpeg">
                                                            </div>
                                                            @if ($pertanyaan->pertanyaan->gambar)
                                                                <div class="mt-2">
                                                                    <img src="{{ asset('assets/images/soal/' . $pertanyaan->pertanyaan->gambar) }}"
                                                                        alt="Existing Image"
                                                                        style="max-width: 20%; height: auto;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <!-- Container for the dynamically added "Jawaban" inputs -->
                                                        <div class="col-md-12" id="jawabanContainer">
                                                            <label for="kelas" class="form-label">Jawaban</label>
                                                            @foreach ($pertanyaan->pertanyaan->opsiPertanyaan as $index => $jawaban)
                                                                <div class="d-flex mt-2 align-items-center jawaban-row">
                                                                    <input id="opsi_{{ $index + 1 }}" type="text"
                                                                        class="form-control me-2"
                                                                        placeholder="Masukkan jawaban"
                                                                        name="jawaban[{{ $index + 1 }}][opsi]"
                                                                        value="{{ old('jawaban.' . ($index + 1) . '.opsi', $jawaban->opsi) }}">
                                                                    <div class="form-check">
                                                                        <input id="is_correct_{{ $index + 1 }}"
                                                                            class="form-check-input" type="checkbox"
                                                                            value="1"
                                                                            name="jawaban[{{ $index + 1 }}][is_correct]"
                                                                            {{ old('jawaban.' . ($index + 1) . '.is_correct', $jawaban->is_correct) ? 'checked' : '' }}>
                                                                        <label class="form-check-label me-2"
                                                                            for="is_correct_{{ $index + 1 }}">Benar</label>
                                                                    </div>
                                                                    <button type="button"
                                                                        class="btn ripple btn-danger px-2"
                                                                        onclick="removeRow(this)">Hapus</button>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <!-- Button to add more options -->
                                                        <div class="col-md-12">
                                                            <div class="d-inline-block mt-1">
                                                                <button type="button" class="btn btn-dark"
                                                                    id="addOptionButton"><i
                                                                        class="bi bi-plus me-1 fs-6"></i>Opsi</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="d-md-flex d-grid align-items-center gap-3 mt-3">
                                                                <button type="submit"
                                                                    class="btn ripple btn-primary px-2">Save
                                                                    Changes</button>
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
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-8">
                        <div class="card pt-2 px-2">
                            <p class="mt-2">Belum ada Soal ditambahkan</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card py-2 px-2 text-center">
                    <h1>Soal</h1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn ripple btn-primary px-4 mb-2 " data-bs-toggle="modal"
                        data-bs-target="#FormModal"> <i class="bi bi-plus-lg me-2 fs-6"></i>Tambah Soal
                    </button>
                    <button class="btn btn-success"><i class="bi bi-eye me-2 fs-6"></i>Lihat Hasil</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title" id="FormModalLabel">Tambah Soal</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3"
                                action="{{ route('guru.soal.store.pertanyaan', ['materi_id' => $materi->id, 'soal_id' => $soal->id]) }}"
                                method="POST" enctype="multipart/form-data" id="kelasForm">
                                @csrf
                                <div class="col-md-12">
                                    <label for="mapel" class="form-label">Soal</label>
                                    <textarea id="pertanyaan" name="pertanyaan" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="kelas" class="form-label">Upload gambar</label>
                                    <div class="input-group">
                                        <input id="gambar" name="gambar" type="file" class="form-control"
                                            accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                                <!-- Container for the dynamically added "Jawaban" inputs -->
                                <div class="col-md-12" id="jawabanContainerCreate">
                                    <label for="kelas" class="form-label">Jawaban</label>
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
        <!-- Modal -->
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
        // Initialize index for dynamic answers for editing
        let jawabanIndexEdit = 1; // Index for editing existing answers

        // Add new answer option when clicking the button in the edit modal
        document.getElementById('addOptionButton').addEventListener('click', function() {
            jawabanIndexEdit++;
            const jawabanContainer = document.getElementById('jawabanContainer');

            // Create new answer input row
            const newRow = document.createElement('div');
            newRow.classList.add('d-flex', 'mt-2', 'align-items-center', 'jawaban-row');
            newRow.id = 'row_' + jawabanIndexEdit;

            newRow.innerHTML = `
        <input id="opsi_${jawabanIndexEdit}" type="text" class="form-control me-2" placeholder="Masukkan jawaban" name="jawaban[${jawabanIndexEdit}][opsi]" required>
        <div class="form-check">
            <input id="is_correct_${jawabanIndexEdit}" class="form-check-input" type="checkbox" value="1" name="jawaban[${jawabanIndexEdit}][is_correct]">
            <label class="form-check-label me-2" for="is_correct_${jawabanIndexEdit}">Benar</label>
        </div>
        <button type="button" class="btn ripple btn-danger px-2" onclick="removeRow(this)">Hapus</button>
    `;

            jawabanContainer.appendChild(newRow); // Append new row to container
        });

        // Remove the row when "Hapus" is clicked
        function removeRow(button) {
            const row = button.parentElement;
            row.remove();
        }

        // Event listener for the edit button
        document.querySelectorAll('[data-bs-target="#editModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const pertanyaanId = this.getAttribute('data-pertanyaan-id');
                const pertanyaan = this.getAttribute('data-pertanyaan');
                const gambar = this.getAttribute('data-gambar');
                const opsi = JSON.parse(this.getAttribute('data-opsi'));

                // Set the pertanyaan_id in the hidden input field
                document.querySelector('#pertanyaan_id').value = pertanyaanId;

                // Set the pertanyaan text area value
                document.querySelector('#pertanyaan').value = pertanyaan;

                // Set the existing image src
                const existingImageContainer = document.querySelector('.modal-body img');
                if (existingImageContainer) {
                    existingImageContainer.src = gambar; // Update the image source
                }

                // Clear the existing jawaban rows
                const jawabanContainer = document.getElementById('jawabanContainer');
                jawabanContainer.innerHTML = ''; // Clear existing rows

                // Populate the jawaban fields with dynamic options
                opsi.forEach((jawaban, index) => {
                    const jawabanRow = document.createElement('div');
                    jawabanRow.classList.add('d-flex', 'mt-2', 'align-items-center', 'jawaban-row');
                    jawabanRow.innerHTML = `
                <input id="opsi_${index + 1}" type="text" class="form-control me-2" placeholder="Masukkan jawaban" name="jawaban[${index + 1}][opsi]" value="${jawaban.opsi}" required>
                <div class="form-check">
                    <input id="is_correct_${index + 1}" class="form-check-input" type="checkbox" value="1" name="jawaban[${index + 1}][is_correct]" ${jawaban.is_correct ? 'checked' : ''}>
                    <label class="form-check-label me-2" for="is_correct_${index + 1}">Benar</label>
                </div>
                <button type="button" class="btn ripple btn-danger px-2" onclick="removeRow(this)">Hapus</button>
            `;
                    jawabanContainer.appendChild(jawabanRow);
                });

                // Update the jawabanIndexEdit based on the number of options populated
                jawabanIndexEdit = opsi.length; // Set to the current number of options
            });
        });

        // JavaScript to dynamically add answer options in the create form
        let jawabanIndexCreate = 1; // Initialize index for dynamic answers in create form

        document.getElementById('addOptionButtonCreate').addEventListener('click', function() {
            jawabanIndexCreate++;
            const jawabanContainerCreate = document.getElementById('jawabanContainerCreate');

            // Create a new row for answer option
            const newJawabanRowCreate = document.createElement('div');
            newJawabanRowCreate.classList.add('d-flex', 'mt-2', 'align-items-center', 'jawaban-row-create');
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

        // Function to remove a specific answer option in the create form
        function removeRowCreate(button) {
            const row = button.parentElement;
            row.remove(); // Remove the answer row
        }
    </script>
@endpush
