@extends('layouts.app')
@section('title')
    Livecode
@endsection
@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Studi Kasus" subtitle="Nama Studi Kasus" />
    </div>
    <div class="container">
        <div class="mb-3">
            <div class="card px-2 py-3 text-center items-center justify-center flex flex-col">
                <h3></h3>
                <p></p>
                <img src="{{ asset('assets/images/case_studies/') }}" class="rounded-start mx-auto" width="50%" alt="tidak ada gambar">
            </div>
        </div>
        <div class="row">
                <input type="hidden" name="case_study_id">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> HTML</h3>
                            <textarea class="mb-5" name="html" id="html" cols="auto" rows="auto" autofocus autocomplete="off"
                                autocorrect="on" autocapitalize="off" spellcheck="false"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> CSS</h3>
                            <textarea class="mb-5" name="css" id="css" cols="auto" rows="auto" autofocus autocomplete="off"
                                autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> JS</h3>
                            <textarea class="mb-5" name="js" id="js" cols="auto" rows="auto" autofocus autocomplete="off"
                                autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="outputContainer">
                                <iframe id="output" title="output" frameborder="0" width="100%"
                                    height="100%"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" type="submit" id="submitCodeBtn">Submit Code</button>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('submitCodeBtn').addEventListener('click', function() {
            Swal.fire({
                title: "Apakah Sudah Yakin Dengan Jawabanmu?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Simpan",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Jawaban Telah Terkirim!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    </script>

    <!-- Plugins -->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('livecode/js/app.js') }}"></script>
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
