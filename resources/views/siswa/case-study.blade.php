@extends('layouts.app')
@section('title')
    Livecode
@endsection
@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ url()->previous() }}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>
        <x-page-title title="Studi Kasus" subtitle="Nama Studi Kasus" />
    </div>
    <div class="container">
        <div class="mb-3">
            <div class="card px-2 py-3 text-center">
                <h3>{{ $caseStudy->title }}</h3>
                <p>{{ $caseStudy->description }}</p>
                <img src="{{ asset('assets/images/case_studies/' . $caseStudy->image) }}" class="rounded-start mx-auto"
                    width="50%" alt="tidak ada gambar">
            </div>
        </div>
        <div class="row">
            <form id="submissionForm"
                action="{{ isset($submission) ? route('siswa.case-submission.update', $caseStudy->id) : route('siswa.case-submission.store') }}"
                method="POST">
                @csrf
                @if (isset($submission))
                    @method('PUT')
                @endif
                <input type="hidden" name="case_study_id" value="{{ $caseStudy->id }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> HTML</h3>
                            <textarea class="mb-5" name="html" id="html" cols="30" rows="10" autofocus autocomplete="off"
                                autocorrect="on" autocapitalize="off" spellcheck="false">{{ old('html', $submission->html ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> CSS</h3>
                            <textarea class="mb-5" name="css" id="css" cols="30" rows="10" autofocus autocomplete="off"
                                autocorrect="off" autocapitalize="off" spellcheck="false">{{ old('css', $submission->css ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> JS</h3>
                            <textarea class="mb-5" name="js" id="js" cols="30" rows="10" autofocus autocomplete="off"
                                autocorrect="off" autocapitalize="off" spellcheck="false">{{ old('js', $submission->js ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="card px-2 py-2" style="width: 100%; height: 520px; border: none;">
                            <div class="outputContainer">
                                <iframe id="output" title="output" frameborder="0"
                                    style="width: 100%; height: 500px; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @if ($submission == null)
                            <button class="btn btn-primary" type="button" id="submitCodeBtn">Submit Code</button>
                        @elseif (!$submission->is_submitted)
                            <button class="btn btn-primary" type="button" id="submitCodeBtn">Submit Code</button>
                        @else
                            <button class="btn btn-warning" type="button" id="submitCodeBtn">Update</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Add event listener to the submit button
        document.getElementById('submitCodeBtn').addEventListener('click', function(event) {
            Swal.fire({
                title: "Apakah Sudah Yakin Dengan Jawabanmu?",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable the submit button to prevent multiple clicks
                    // Show success message and submit the form
                    Swal.fire("Jawaban Telah Terkirim!", "", "success").then(() => {
                        document.getElementById('submissionForm').submit();
                    });
                }
            });
        });
    </script>

    <!-- Other Scripts -->
    <script src="{{ URL::asset('build/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('livecode/js/app.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut");
    </script>
    <script src="{{ URL::asset('build/js/main.js') }}"></script>
    <script src="{{ URL::asset('build/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list");
    </script>
    <script>
        $(function() {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    </script>
@endpush
