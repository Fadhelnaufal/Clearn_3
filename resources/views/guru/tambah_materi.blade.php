@extends('layouts.app')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

@section('title')
    Widgets Data
@endsection

@section('content')
    <x-page-title title="Kelas" subtitle="Materi" />
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body px-2">
                    <ul class="nav nav-pills mb-0" role="tablist">
                        @foreach ($userTypes as $userType)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill"
                                    href="#kategori{{ $userType->id }}" role="tab"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="bi bi-{{ $loop->index + 1 }}-circle me-2 fs-5"></i>
                                        </div>
                                        <div class="tab-title">Kategori {{ $userType->name }}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                @foreach ($userTypes as $userType)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="kategori{{ $userType->id }}"
                        role="tabpanel">
                        <div class="row">
                            <div class="card">
                                <form action="{{ route('sub-materi.store', [$kelas->id, $userType->id]) }}" id="form1"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="materi_id" value="{{ $kelas->materi->first()->id }}">
                                    <input type="hidden" name="user_type_id" value="{{ $userType->id }}">
                                    <div class="col-md-12 mt-2">
                                        <h3>Kategori {{ $userType->name }}</h3>

                                        <div class="col-md-12 mb-2">
                                            <label for="input5" class="form-label mt-2">Nama Materi</label>
                                            <input type="text" class="form-control" id="input5" name="judul"
                                                required>
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <label for="lampiran" class="form-label mt-2">Lampiran Berkas</label>
                                            <input type="file" class="form-control" id="lampiran" name="lampiran"
                                                accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" />
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <label for="editor{{ $userType->id }}" class="form-label mt-2">Isi
                                                Materi</label>
                                            <div class="ckeditor form-control" id="editor{{ $userType->id }}"
                                                cols="30" rows="10">
                                                <p></p>
                                            </div>
                                            <input type="hidden" name="isi" id="isi{{ $userType->id }}">
                                        </div>

                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary mt-4 p-2">Tambah</button>
                                        <button type="reset" class="btn btn-secondary mt-4 p-2">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Additional plugins -->
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
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>




    <script>
        // Pass the userTypes data to JavaScript as a JSON array
        var userTypes = @json($userTypes);
        let editorMaster = {};
        // Loop over userTypes and initialize CKEditor for each editor
        userTypes.forEach(function(userType) {
            // import { ClassicEditor, Base64UploadAdapter } from 'ckeditor5';
            ClassicEditor
                .create(document.querySelector('#editor' + userType.id), {
                    toolbar: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote', '|', 'insertTable', 'mediaEmbed', 'undo', 'redo', 'imageUpload'
                    ],
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    }
                    // You can uncomment and add the ckfinder config if needed
                    // ckfinder: {
                    //     uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    // }
                })
                .then(editor => {
                    console.log('Editor was initialized for userType ID: ' + userType.id, editor);

                    // Handle form submission
                    editorMaster[userType.id] = editor;
                    // document.querySelector('form').addEventListener('submit', function() {
                    //     // Get the content of CKEditor and fill the hidden input
                    //     var editorData = editor.getData();
                    //     document.querySelector('#isi' + userType.id).value = editorData;
                    // });
                })
                .catch(error => {
                    console.error('Error initializing editor for userType ID: ' + userType.id, error);
                });
        });
        document.querySelector('#form1').addEventListener('submit', function(e) {
            // Get the content of CKEditor and fill the hidden input
            // e.preventDefault();
            userTypes.forEach(function(userType) {
                var editorData = editorMaster[userType.id].getData();
                console.log('Data from editor for userType ID ' + userType.id + ': ', editorData);

                // Fill the hidden input with the editor data
                document.querySelector('#isi' + userType.id).value = editorData;
            });
            // var editorData = editorMaster.getData();
            // console.log(editorData);
            // document.querySelector('#isi1'.value = editorData;
        });
    </script>



    <script>
        jQuery(function() {
            // Initially hide all tab content
            jQuery('.tab-content .tab-pane').removeClass('show active');

            // Show the first tab's content by default
            jQuery('#kategori1').addClass('show active');

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
    <script></script>
@endpush
