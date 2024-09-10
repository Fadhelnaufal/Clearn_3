@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Kelas" />

    <div class="col-12 col-xl-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn ripple btn-primary px-4 mb-4" data-bs-toggle="modal"
            data-bs-target="#FormModal">Tambah Kelas
        </button>
        <!-- Modal -->
        <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title" id="FormModalLabel">Tambah Kelas</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" action="{{ route('course.store') }}" method="POST"
                                enctype="multipart/form-data" id="kelasForm">
                                @csrf
                                <div class="col-md-12">
                                    <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="mapel" name="mapel" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas" required>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="logo" class="form-label">Logo Kelas</label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        accept="image/png, image/jpeg" required>
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

    <div class="row g-0">
        @foreach ($kelas as $course)
            <div class="col-md-4 me-2">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 border-end">
                            <div class="p-3">
                                <img src="{{ asset('/images/logos' . $course->logo) }}" class="w-100 rounded-start"
                                    alt="...">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->mapel }}</h5>
                                <p class="card-title">{{ $course->kelas }}</p>
                                <p class="card-title">Token Kelas :{{ $course->token }}</p>
                                <a href="{{ route('guru.course-detail.show', $course->id) }}" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-8"></div>
    </div>
@endsection

@push('script')
    <!--plugins-->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function tambahkelas() {
            // Show the toast and submit the form
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Sedang Memproses...',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.getElementById('kelasForm').submit();
            });
        }

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

        // Optional: Show success toast if there's a session message
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
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
@endpush
