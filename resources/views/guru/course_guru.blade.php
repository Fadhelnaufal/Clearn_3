@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Kelas" />
    <!-- Check if the session has a success message -->
    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Kelas Berhasil Dibuat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $message = session('success');
                        $mapel = Str::between($message, 'Kelas "', '"');
                        $token = Str::afterLast($message, 'token: ');
                    @endphp
                    Kelas <strong>{{ $mapel }}</strong> berhasil dibuat dengan token: <strong>{{ $token }}</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                keyboard: false
            });
            successModal.show();
        }
    </script>
@endif


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
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" action="{{ route('course.store') }}" method="POST"
                                enctype="multipart/form-data">
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
    </div>


    {{-- <div class="row g-0">
        <div class="col-md-4">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 border-end">
                            <div class="p-3">
                                <img src="{{ URL::asset('build/images/laravel.png') }}" class="w-100 rounded-start" alt="...">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Pemrograman Web</h5>
                                <p class="card-title">Kelas XI RPL</p>
                                <p class="card-title">Token Kelas : a145wd</p>
                                <button type="button" class="btn ripple btn-primary px-2 font-12">Lanjutkan Materi</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-8">
        </div>
    </div> --}}

    <div class="row g-0">
        @foreach ($kelas as $k)
            <div class="col-md-4 me-3">
                {{-- <a href=""> --}}
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 border-end">
                            <div class="p-3">
                                <img src="{{ asset('storage/' . $k->logo) }}" class="w-100 rounded-start" alt="...">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $k->mapel }}</h5>
                                <p class="card-title">{{ $k->kelas }}</p>
                                <p class="card-title">Token Kelas :{{ $k->token }}</p>
                                <a href="{{ route('guru.course-detail.show', $k->id) }}" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    {{-- </a> --}}
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
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.5/build/spline-viewer.js"></script>
@endpush
