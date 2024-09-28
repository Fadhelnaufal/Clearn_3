@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row mb-4 mt-2">
    <x-page-title title="Dashboard" subtitle="Dashboard"/>
</div>
    <!-- Modal -->

    <!-- Modal -->
    {{-- <div class="modal fade" id="questions-modal" tabindex="-1" role="dialog" aria-labelledby="questionsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionsModalLabel">Quesioner Achievement Goals</h5>
                    </button>
                </div>
                <div class="modal-body mx-3 mt-2">
                    <p class="text-justify">
                        Sebelum Memasuki Dashboard,anda harus mengisi quesioner dibawah ini untuk mengetahui tujuan belajar
                        anda.
                    </p>
                    <form id="questions-form" action="{{ route('store.answers') }}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="question-cell">Pernyataan</th>
                                    <th class="options-cell">1</th>
                                    <th class="options-cell">2</th>
                                    <th class="options-cell">3</th>
                                    <th class="options-cell">4</th>
                                    <th class="options-cell">5</th>
                                </tr>
                            </thead>
                            </thead>
                            <tbody>
                                @foreach ($questions as $index => $question)
                                    <tr>
                                        <td>{{ $question->text }}</td>
                                        <td><input type="radio" name="answers[{{ $index }}][answer_value]"
                                                value="1" required></td>
                                        <td><input type="radio" name="answers[{{ $index }}][answer_value]"
                                                value="2" required></td>
                                        <td><input type="radio" name="answers[{{ $index }}][answer_value]"
                                                value="3" required></td>
                                        <td><input type="radio" name="answers[{{ $index }}][answer_value]"
                                                value="4" required></td>
                                        <td><input type="radio" name="answers[{{ $index }}][answer_value]"
                                                value="5" required></td>
                                        <input type="hidden" name="answers[{{ $index }}][question_id]"
                                            value="{{ $question->id }}">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Submit Jawaban</button>
                    </form>
                    <div id="loader" style="display:none;">Loading...</div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Result Modal -->
    <div class="modal fade" id="result-modal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Result</h5>
                </div>
                <div class="modal-body">
                    <p>Your type is: <span id="user-category"></span></p>
                    <img id="user-category-image" src="{{ session('result.type_user_image') }}" alt="User Type Image"
                        style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-8 d-flex align-items-stretch mt-4">
            <div class="card w-100 overflow-hidden rounded-4">
                <div class="card-body position-relative p-4">
                    <div class="row">
                        <div class="col-12 col-sm-7 ps-3">
                            <div class="d-flex align-items-center gap-3 mb-5">
                                <img src="https://placehold.co/110x110/png" class="rounded-circle bg-grd-info p-1"
                                    width="60" height="60" alt="user">
                                <div class="">
                                    <p class="mb-0 fw-semibold">Selamat Datang</p>
                                    <h4 class="fw-semibold fs-4 mb-0">{{ Auth::user()->name }}</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-5">
                                <div class="">
                                    <p class="mb-3">Level</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">1<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>

                                </div>
                                <div class="">
                                    <p class="mb-3">EXP Points</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">1180<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-5">
                                <div class="">
                                    <p class="mb-3">Misi</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">4/15<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>

                                </div>
                                <div class="">
                                    <p class="mb-3">Kelas Diikuti</p>
                                    <h4 class="mb-1 fw-semibold d-flex align-content-center">2/2<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="welcome-back-img pt-4 pe-5">
                                <img src="{{ URL::asset('build/images/tampan.png') }}" height="300" alt="">
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-4 d-flex align-items-stretch">
            <div class="card w-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center">
                            <h5 class="mb-2 ">Lencana</h5>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="Beginner" data-bs-content="Anda Telah Mencapai 1000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/beginner.png') }}" width="50"
                                        alt="">
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="Intermediate" data-bs-content="Anda belum Mencapai 2000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/intermediate_lock.png') }}" width="50"
                                        alt="">

                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="High" data-bs-content="Anda Belum Mencapai 3000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/high_lock.png') }}" width="50"
                                        alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="Platinum" data-bs-content="Anda Belum Mencapai 4000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/platinum_lock.png') }}" width="50"
                                        alt="">

                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="Diamond" data-bs-content="Anda Belum Mencapai 5000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/diamond_lock.png') }}" width="50"
                                        alt="">
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <span data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-toggle="popover"
                                    title="Master" data-bs-content="Anda Belum Mencapai 6000 EXP"
                                    data-bs-placement="top">
                                    <img src="{{ URL::asset('build/images/master_lock.png') }}" width="50"
                                        alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <span class="text-success">Senior Frontend Developer</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="continue">
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        Continue class
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card" >
                    <img src="{{ asset('build/images/laravel.png') }}" class="card-img-top" alt="..." >
                    <div class="card-body">
                        <h5 class="card-title">Materi 1</h5>
                        <p class="card-text"id="deskripsi">Nam libero tempore, cum soluta nobis est
                            eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.</p>
                        <button type="button" class="btn ripple btn-primary px-5">Lanjutkan</button>
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

    <script>
        $(document).ready(function() {
            // Make the questions modal static and then show it
            $('#questions-modal').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show'); // Automatically show the modal

            $('#questions-form').on('submit', function(e) {
                e.preventDefault();

                // Show loader
                $('#loader').show();

                $.ajax({
                    url: "{{ route('store.answers') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hide loader
                        $('#loader').hide();

                        if (response.success) {
                            $('#questions-modal').modal('hide');
                            $('#user-category-name').text(response.user_type.name);
                            $('#user-category-image').attr('src', response.user_type.image);
                            $('#result-modal').modal('show');
                        }
                    },
                    error: function() {
                        $('#loader').hide();
                        alert('An error occurred while processing your request.');
                    }
                });
            });

            $('#result-modal').on('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>


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
    <script>
        const maxLength = 30; // Panjang maksimum teks yang ditampilkan
        const element = document.getElementById("deskripsi");
        const originalText = element.textContent;

        if (originalText.length > maxLength) {
            const truncatedText = originalText.substring(0, maxLength) + "...";
            element.textContent = truncatedText;
        }
    </script>
@endpush
