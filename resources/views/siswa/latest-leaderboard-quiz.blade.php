@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <style>
        .leaderboard {
            background-color: #3A3A7A;
            border: 5px solid #6A6AB8;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
        }

        .leaderboard-header {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .leaderboard-header .stars {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .leaderboard-header .stars i {
            color: yellow;
            font-size: 1.5em;
            margin: 0 5px;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #6A6AB8;
        }

        .table th {
            background-color: #5A5A9A;
            font-size: 1.2em;
            color: white;
        }

        .table td {
            background-color: #4A4A8A;
            font-size: 1em;
            color: white;
        }

        .player-info {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .player-info img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .player-info .trophy {
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .leaderboard {
                width: 95%;
            }

            .table th,
            .table td {
                font-size: 0.9em;
            }

            .leaderboard-header {
                font-size: 1.5em;
            }

            .leaderboard-header .stars i {
                font-size: 1.2em;
            }
        }
    </style>
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ Route('siswa.quiz') }}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Quiz" subtitle="Leaderboard" />
    </div>
    <div class="container">
        <div class="leaderboard">
            <div class="leaderboard-header">
                <div class="stars">
                    <i class="fas fa-star" style="color: yellow;"></i>
                    <i class="fas fa-star" style="color: yellow;"></i>
                    <i class="fas fa-star" style="color: yellow;"></i>
                </div>
                @if($leaderboard->isNotEmpty() && $leaderboard->first()->quiz)
                    <h1 class="text-title text-white">Leaderboard for {{ $leaderboard->first()->quiz->nama }}</h1>
                @else
                    <h1 class="text-title text-white">Leaderboard</h1>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><h5 class="text-white">Rank</h5></th>
                            <th><h5 class="text-white">Nama</h5></th>
                            <th><h5 class="text-white">EXP</h5></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaderboard as $index => $entry)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="player-info">
                                    <p class="mt-2">{{ $entry->user->name }} 
                                        @if ($index === 0)
                                            <i class="fas fa-trophy trophy" style="color: gold;"></i>
                                        @elseif ($index === 1)
                                            <i class="fas fa-trophy trophy" style="color:silver;"></i>
                                        @elseif ($index === 2)
                                            <i class="fas fa-trophy trophy" style="color: #cd7f32;"></i>
                                        @endif
                                    </p>
                                </td>
                                <td>{{ $entry->exp_point }}</td>
                            </tr>
                        @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
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
