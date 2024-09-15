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
                <div class="card pt-2 px-2">
                    <p class="mt-2">Anda Belum Membuat Soal</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card py-2 px-2 text-center">
                    <h1>Soal</h1>
                    <p>Belum Ada Soal yang Ditambahkan</p>
                    <!-- Button trigger modal -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn ripple btn-primary px-4 " data-bs-toggle="modal"
                        data-bs-target="#FormModal">Tambah Soal
                    </button>
                </div>
                
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title" id="FormModalLabel">Tambah Soal</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" action="{{ route('course.store') }}" method="POST"
                                enctype="multipart/form-data" id="kelasForm">
                                @csrf
                                <div class="col-md-12">
                                    <label for="mapel" class="form-label">Soal</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="kelas" class="form-label">Upload gambar</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="kelas" class="form-label">Jawaban</label>
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn ripple btn-primary me-2" disabled>A</button>
                                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                                        </div>
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn ripple btn-primary me-2" disabled>B</button>
                                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                                        </div>
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn ripple btn-primary me-2"disabled>C</button>
                                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                                        </div>
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn ripple btn-primary me-2"disabled>D</button>
                                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                                        </div>
                                        <label for="kelas" class="form-label">Jawaban Benar</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">C</option>
                                            <option value="4">D</option>
                                          </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="button" class="btn ripple btn-primary px-2"
                                            onclick="tambahkelas()">Tambah</button>
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

    <!-- Modal -->
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
