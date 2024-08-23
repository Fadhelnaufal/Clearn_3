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
                            <form class="row g-3">
                                <div class="col-md-12">
                                    <label for="input5" class="form-label">Masukkan Token Kelas</label>
                                    <input type="password" class="form-control" id="input5">
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="button" class="btn ripple btn-primary px-2">Tambah</button>
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
        <div class="col-md-4">
            {{-- <a href=""> --}}
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
                                <p class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore eligendi blanditiis facilis molestiae nemo praesentium rerum neque ab voluptas necessitatibus, natus suscipit laboriosam.</p>
                                <button type="button" class="btn ripple btn-primary px-2 font-12">Lanjutkan Materi</button>
                            </div>
                        </div>
                    </div>
            {{-- </a> --}}
            </div>
        </div>
        <div class="col-md-8">
        </div>
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
