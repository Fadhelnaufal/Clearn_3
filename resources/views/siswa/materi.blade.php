@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ url('/siswa/course-detail/'.$kelas->id) }}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="{{ $subMateri->materi->judul }}" subtitle="Materi{{ $subMateri->judul }}" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card py-2 px-2">
                    {{-- <img src="{{ asset('assets/images/gambar_html.png') }}" alt=""> --}}
                    <h1 class="text-center">{{ $subMateri->judul }}</h1>
                    <p class="mx-2 my-2 text-justify">{!! $subMateri->isi !!}</p>
                    <div class="d-grid ">
                    <input type="text" hidden id="kelas_id" name="kelas_id" value="{{ $kelas->id }}">
                    <input type="hidden" id="materi_id" name="materi_id" value="{{ $materi->id }}">
                        @if ($task === null)
                            <button id="completed_task" class="btn btn-primary" type="button"
                                data-submateri-id="{{ $subMateri->id }}" data-materi-id="{{ $materi->id }}"
                                data-url="{{ route('siswa.sub-materi.mark-as-read', ['id' => $kelas->id, 'materiId' => $materi->id, 'subMateriId' => $subMateri->id]) }}">
                                Saya Telah Menyelesaikan Materi
                            </button>
                        @elseif (!$task->is_completed)
                            <button id="completed_task" class="btn btn-primary" type="button"
                                data-submateri-id="{{ $subMateri->id }}" data-materi-id="{{ $materi->id }}"
                                data-url="{{ route('siswa.sub-materi.mark-as-read', ['id' => $kelas->id, 'materiId' => $materi->id, 'subMateriId' => $subMateri->id]) }}">
                                Saya Telah Menyelesaikan Materi
                            </button>
                        @else
                            <button id="completed_task" class="btn btn-primary" type="button" disabled>
                                Materi telah selesai dibaca
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card  py-2 px-2 text-center items-center d-flex justify-content-center">
                    <h1>Lampiran</h1>
                    @if ($subMateri->lampiran)
                        <iframe class="w-100" style="height: 60vh; width: 100%;"
                            src="{{ asset('files/sub_materi/' . $subMateri->lampiran) }}"></iframe>
                        <div class="d-grid ">
                            <a class="btn btn-primary" type="button"
                                href="{{ asset('files/sub_materi/' . $subMateri->lampiran) }}" target="_blank">Download
                                Lampiran</a>
                        </div>
                    @else
                        <p>Tidak Ada Lampiran</p>
                        <div class="d-grid ">
                            <button class="btn btn-primary" type="button" disabled>Download Lampiran</button>
                        </div>
                    @endif
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
        <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/chartjs/js/chart.js') }}"></script>
        <script src="{{ URL::asset('build/plugins/chartjs/js/chartjs-custom.js') }}"></script>
        <script src="{{ URL::asset('build/js/main.js') }}"></script>
        <script src="{{ URL::asset('build/js/data-widgets.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#completed_task').on('click', function() {
                    var url = $(this).data('url'); // Get the URL from the button
                    var kelasId = $('#kelas_id').val(); // Get the kelas ID from the button
                    var materiId = $(this).data('materi-id');

                    console.log('Kelas ID:', kelasId);
                    console.log('Materi ID:', materiId);

                    // SweetAlert confirmation
                    Swal.fire({
                        title: 'Apakah kamu yakin telah menyelesaikan materi ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Selesaikan!',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If confirmed, make the AJAX request
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    kelas_id: kelasId,
                                    materi_id: materiId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Materi berhasil diselesaikan!',
                                            text: response.success,
                                            showConfirmButton: false,
                                            timer: 2000,
                                        }).then(() => {
                                            window.location.href = "{{ url()->previous() }}"; // Redirect to the previous page
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: `Error marking as completed! ${response.error}`,
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log("XHR:", xhr);
                                    console.log("Status:", status);
                                    console.log("Error:", error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat memproses permintaan!',
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                $(".accordion-button").on('click', function() {
                    var target = $(this).data("target");
                    $(".accordion-collapse").not(target).collapse('hide'); // Hide other collapses
                    $(target).collapse('toggle'); // Toggle the clicked collapse
                });
            });
        </script>

        <script>
            jQuery(function() {
                // Initially hide all tab content
                jQuery('.tab-content .tab-pane').removeClass('show active');

                // Show the first tab's content by default
                jQuery('#misi').addClass('show active');

                // Handle nav-link clicks
                jQuery('.nav-link').click(function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    jQuery('.tab-pane').removeClass('show active'); // Hide all tab panes

                    var targetId = jQuery(this).attr(
                        'href'); // Get the href attribute which corresponds to the tab-pane ID
                    jQuery(targetId).addClass('show active'); // Show the corresponding tab-pane
                });
            });
        </script>

        <script>
            // Function to show confirmation dialog before submitting the "leave class" form
            function confirmDelete() {
                Swal.fire({
                    title: 'Apakah kamu yakin ingin keluar dari kelas ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, keluar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if the user confirms
                        document.getElementById('leaveClassForm').submit();
                    }
                });
            }

            // Function to submit the form with a processing toast
            function submitForm() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Sedang Memproses...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.getElementById('addMateriForm').submit();
                });
            }

            // Set up SweetAlert for toasts
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

            // Display success or error toast based on session messages
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

        <!-- Include SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script></script>

        <script src="{{ URL::asset('livecode/js/app.js') }}"></script>
    @endpush
