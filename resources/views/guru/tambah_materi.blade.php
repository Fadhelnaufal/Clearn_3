@extends('layouts.app')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
@section('title')
    Widgets Data
@endsection
@section('content')
    <x-page-title title="Course" subtitle="Tambah Kelas" />
    <div class="row">
        <form action="">
            <div class="col-md-12 mt-2">
                <div class="col-md-12">
                    <label for="input5" class="form-label mt-2">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="input5" name="judul">
                </div>
                <div class="col-md-12">
                    <label for="input5" class="form-label mt-2">Lampiran Berkas</label>
                    <input type="file" class="form-control" id="lampiran" name="lampiran"
                        accept=".xlsx,.xls,,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
                </div>
                <div class="col-md-12">
                    <label for="input5" class="form-label mt-2">Isi Materi</label>
                    <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mt-4 p-2">Tambah</button>
                <button type="submit" class="btn btn-secondary mt-4 p-2">Batal</button>
            </div>
        </form>
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
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
