@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <div class=" d-flex align-items-center mb-5">
        <a href="{{ Route('guru.quiz') }}" class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Quiz" subtitle="Tambah Quiz" />
    </div>
    <div class="col-12 col-xl-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn ripple btn-primary px-4 mb-4" data-bs-toggle="modal"
            data-bs-target="#FormModal">Tambah Quiz
        </button>
        <!-- Modal -->
        <div class="modal fade" id="FormModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2">
                        <h5 class="modal-title">Tambah Quiz</h5>
                        <a href="javascript:;" class="primary-menu-close" data-bs-dismiss="modal">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" method="POST" action="{{ Route('guru.quiz.store') }}" id="">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Masukkan Nama Quiz</label>
                                    <input type="text" name="nama" id="nama" class="form-control" id=""
                                        required>
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
    <div class="row">
        @foreach ($quizzes as $quiz)
            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body"><dotlottie-player
                            src="https://lottie.host/d38ebfe1-b80a-4422-8ab8-c287edbab88b/gsKn7K93Sw.json"
                            background="transparent" speed="1" style="width: 180px; height: 180px;" loop autoplay
                            class="d-flex mx-auto"></dotlottie-player>

                        <h5 class="card-title">{{ $quiz->nama }}</h5>
                        <p class="card-text">{{ $quiz->access_token }}</p>
                        <a href="{{ Route('guru.detail-quiz', $quiz->id) }}" class="btn btn-sm btn-primary">Masuk</a>
                    </div>
                </div>
            </div>
        @endforeach
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
