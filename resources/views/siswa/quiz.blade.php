@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <div class="row mb-4">
        <x-page-title title="Quiz" subtitle="Halaman Quiz" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-warning-subtle">
                    <div class="card-body d-flex flex-column align-items-center">
                        <dotlottie-player src="https://lottie.host/b1f20903-e770-4c11-8805-8b614309ba01/wBJwaFw6XF.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                            autoplay></dotlottie-player>
                        <h5 class="card-title text-center">Gabung Quiz</h5>
                        <p class="card-text text-center">Silahkan masukkan kode quiz yang telah diberikan oleh guru.</p>
                        <a href="{{Route('siswa.show-quiz')}}" class="btn btn-primary">Gabung Quiz</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-dark-subtle">
                    <div class="card-body d-flex flex-column align-items-center">
                        <dotlottie-player src="https://lottie.host/3c915391-166d-4227-90dc-974d9d64aa52/Bf4mxEv7xK.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                            autoplay></dotlottie-player>
                        <h5 class="card-title text-center">Check Leaderboard</h5>
                        <p class="card-text text-center">Lihat Leaderboard terkini</p>
                        <a href="{{Route('siswa.show.latest-leaderboard')}}" class="btn btn-primary">Lihat Leaderboard</a>
                    </div>
                </div>
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
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
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
