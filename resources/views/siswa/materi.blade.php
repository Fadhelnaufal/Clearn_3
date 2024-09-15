@extends('layouts.app')
@section('title')
    Widgets Data
@endsection
@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Nama Materi" subtitle="Materi" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card py-2 px-2">
                    <img src="{{ asset('assets/images/gambar_html.png') }}" alt="">
                    <h1 class="text-center">Pengertian HTML</h1>
                    <p class="mx-2 my-2 text-justify">Pengertian Dan Fungsi HTML (HyperText Markup Language) - HTML adalah
                        singkatan dari HyperText Markup Language yaitu bahasa pemrograman standar yang digunakan untuk
                        membuat sebuah halaman web, yang kemudian dapat diakses untuk menampilkan berbagai informasi di
                        dalam sebuah penjelajah web Internet (Browser). HTML dapat juga digunakan sebagai link link antara
                        file-file dalam situs atau dalam komputer dengan menggunakan localhost, atau link yang menghubungkan
                        antar situs dalam dunia internet. <br><br>
                        Supaya dapat menghasilkan tampilan wujud yang terintegerasi Pemformatan hiperteks sederhana ditulis
                        dalam berkas format ASCII sehingga menjadi halaman web dengan perintah-perintah HTML.
                        HTML merupakan sebuah bahasa yang bermula bahasa yang sebelumnya banyak dipakai di dunia percetakan
                        dan penerbirtan yang disebut Standard Generalized Markup Language (SGML).</p>
                    <div class="d-grid ">
                        <button class="btn btn-primary" type="button">Saya Telah Menyelesaikan Materi</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card  py-2 px-2 text-center">
                    <h1>Lampiran</h1>
                    <p>Tidak Ada Lampiran</p>
                    <div class="d-grid ">
                        <button class="btn btn-primary" type="button" disabled>Download Lampiran</button>
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
