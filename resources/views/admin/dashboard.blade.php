@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    @php
        $user = auth()->user(); // Get the logged-in user
        $role = $user->roles->pluck('name')->first(); // Get the user's role name
    @endphp
    <x-page-title title="Dashboard" subtitle="Dashboard {{ ucfirst($role) }}" />



    <div class="row">
        <div class="col-sm-3">
            <div class="card bg-primary">
                <div class="card-content">
                    <div class="card-body text-white">
                        <div class="media d-flex">
                            <div class="align-self-center me-3">
                                <i class="bi bi-people float-start fs-1"></i>
                            </div>
                            <div class="media-body float-end">
                                <h3 class="text-white">{{ $userCount }}</h3>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card bg-success">
                <div class="card-content">
                    <div class="card-body text-white">
                        <div class="media d-flex">
                            <div class="align-self-center me-3">
                                <i class="bi bi-people float-start fs-1"></i>
                            </div>
                            <div class="media-body float-end">
                                <h3 class="text-white">{{ $siswaCount }}</h3>
                                <span>Siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card bg-warning">
                <div class="card-content">
                    <div class="card-body ">
                        <div class="media d-flex">
                            <div class="align-self-center me-3">
                                <i class="bi bi-people float-start fs-1"></i>
                            </div>
                            <div class="media-body float-end">
                                <h3>{{ $guruCount }}</h3>
                                <span>Guru</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card bg-dark">
                <div class="card-content">
                    <div class="card-body text-white">
                        <div class="media d-flex">
                            <div class="align-self-center me-3">
                                <i class="bi bi-people float-start fs-1"></i>
                            </div>
                            <div class="media-body  ">
                                <h3 class="text-white">{{ $adminCount }}</h3>
                                <span>Admin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
    <script src="{{ URL::asset('build/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list")
    </script>
    <script>
        $(function() {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    </script>
@endpush
