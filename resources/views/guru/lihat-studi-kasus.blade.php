@extends('layouts.app')
@section('title')
    Livecode
@endsection
@section('content')
    <div class="container d-flex align-items-center mb-5">
        <a href="{{ route('guru.result.case.index')}}" class="btn"><i class='bx bx-left-arrow-alt fs-2'></i></a>        
        <x-page-title title="Studi Kasus" subtitle="Nama Studi Kasus" />
    </div>
    <div class="container">
        <div class="mb-3">
            <div class="card px-2 py-3 text-center items-center justify-center flex flex-col">
                <h3>{{ $submission->caseStudy->title }}</h3>
                <p>{{ $submission->caseStudy->description }}</p>
                <img src="{{ asset('assets/images/case_studies/' . $submission->caseStudy->image) }}"
                    class="rounded-start mx-auto" width="50%" alt="tidak ada gambar">
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="case_study_id" value="{{ $submission->caseStudy->id }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> HTML</h3>
                        <textarea class="mb-5" name="html" id="html" cols="auto" rows="auto" autofocus autocomplete="off"
                            autocorrect="on" autocapitalize="off" spellcheck="false">{{ old('html', $submission->html) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> CSS</h3>
                        <textarea class="mb-5" name="css" id="css" cols="auto" rows="auto" autofocus autocomplete="off"
                            autocorrect="off" autocapitalize="off" spellcheck="false">{{ old('css', $submission->css) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">code</i> JS</h3>
                        <textarea class="mb-5" name="js" id="js" cols="auto" rows="auto" autofocus autocomplete="off"
                            autocorrect="off" autocapitalize="off" spellcheck="false">{{ old('js', $submission->js) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="outputContainer">
                        <iframe id="output" title="output" frameborder="0" width="100%" height="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Beri Nilai</button>
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
                aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Penilaian</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{ isset($submission->nilai_case_studies) ? route('guru.result.case.update', $submission->student_id) : route('guru.result.case.store', $submission->student_id) }}" method="POST">
                        @csrf
                        @if(isset($submission->nilai_case_studies))
                            @method('PUT') <!-- Add this line for the update method -->
                        @endif
                
                        <div class="mb-3">
                            <input type="hidden" name="case_study_id" value="{{ $submission->caseStudy->id }}">
                            <input type="hidden" name="student_id" value="{{ $submission->student_id }}">
                            
                            <label for="kategori_1" class="form-label"><strong>Kesesuaian dengan Studi Kasus</strong></label>
                            <input type="number" class="form-control" id="kategori_1" name="kategori_1" min="0" max="100"
                                value="{{ old('kategori_1', $submission->nilai_case_studies->kategori_1 ?? '') }}">
                                
                            <label for="kategori_2" class="form-label"><strong>Desain dan Tata Letak</strong></label>
                            <input type="number" class="form-control" id="kategori_2" name="kategori_2" min="0" max="100"
                                value="{{ old('kategori_2', $submission->nilai_case_studies->kategori_2 ?? '') }}">
                                
                            <label for="kategori_3" class="form-label"><strong>Fungsionalitas</strong></label>
                            <input type="number" class="form-control" id="kategori_3" name="kategori_3" min="0" max="100"
                                value="{{ old('kategori_3', $submission->nilai_case_studies->kategori_3 ?? '') }}">
                                
                            <label for="kategori_4" class="form-label"><strong>Kualitas Kode</strong></label>
                            <input type="number" class="form-control" id="kategori_4" name="kategori_4" min="0" max="100"
                                value="{{ old('kategori_4', $submission->nilai_case_studies->kategori_4 ?? '') }}">
                                
                            <label for="kategori_5" class="form-label"><strong>Inovasi dan Kreativitas</strong></label>
                            <input type="number" class="form-control" id="kategori_5" name="kategori_5" min="0" max="100"
                                value="{{ old('kategori_5', $submission->nilai_case_studies->kategori_5 ?? '') }}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">{{ isset($submission->nilai_case_studies) ? 'Update' : 'Simpan' }}</button>
                    </form>
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
