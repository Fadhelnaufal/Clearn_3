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
        <div class="modal fade" id="FormModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title">Tambah Kelas</h5>
                        <a href="javascript:;" class="primary-menu-close" data-bs-dismiss="modal">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" method="POST" action="{{ route('siswa.course.join') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="token" class="form-label">Masukkan Token Kelas</label>
                                    <input type="text" name="token" class="form-control" id="token" required>
                                </div>
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn ripple btn-primary px-2"
                                        onclick="submitForm()">Tambah</button>
                                    <button type="button" class="btn ripple btn-secondary px-2"
                                        data-bs-dismiss="modal">Batal</button>
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
            <div class="col-md-4">
                <div class="card me-3">
                    <div class="row">
                        <div class="col-md-4 border-end">
                            <div class="p-3">
                                <img src="{{ asset('assets/images/logos/' . $course->logo)}}" class="rounded-start" width="100%"
                                    alt="...">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->mapel }}</h5>
                                <p class="card-title">{{ $course->kelas }}</p>
                                <a href="{{ route('siswa.course-detail.show', $course->id) }}" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-8">

    </div>
    {{-- <div class="row g-0">
        @foreach ($kelas as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->mapel }}</h5>
                        <p class="card-text">{{ $course->kelas }}</p>
                        <!-- Add more details or links as needed -->
                        <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
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
    <script>
        // SweetAlert2 toast configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            iconColor: '#a5dc86',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            @elseif (session('toast_error'))
                Swal.fire({
                    icon: 'error',
                    title: "{{ session('toast_error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>

    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
@endpush
