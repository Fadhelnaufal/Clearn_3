@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Hasil Studi Kasus" />
    <div class="container mt-4">
        <div class="row">
            <div class="card">
                <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>mark@gmail.com</td>
                        <td>junior front end</td>
                        <td>100</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm me-2"><i class="bi bi-eye me-1"></i>Lihat</a>
                            <a href="" class="btn btn-success btn-sm"><i class="bi bi-pencil-square me-1"></i>Nilai</a>
                        </td>
                      </tr>
                      <!-- Add more rows as needed -->
                    </tbody>
                  </table>
            </div>
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
