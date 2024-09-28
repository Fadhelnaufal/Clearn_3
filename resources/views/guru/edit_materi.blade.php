@extends('layouts.app')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

@section('title')
    Widgets Data
@endsection

@section('content')
    <x-page-title title="Kelas" subtitle="Materi" />
    <div class="row">
        <div class="container">
            <div class="tab-content">
                @foreach ($userTypes as $userType)
                    <div class="tab-pane" id="kategori{{ $userType->id }}" role="tabpanel">
                        <div class="row">
                            <div class="card">
                                <form
                                    action="{{ route('sub-materi.update', [$kelas->id, $userType->id, $subMateri->id ?? '']) }}"
                                    id="form{{ $userType->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="materi_id" value="{{ $subMateri->id ?? '' }}">
                                    <input type="hidden" name="user_type_id" value="{{ $userType->id }}">
                                    <div class="col-md-12 mt-2">
                                        <h3>Kategori {{ $subMateri->userType->name }}</h3>

                                        <div class="col-md-12 mb-2">
                                            <label for="input5{{ $userType->id }}" class="form-label mt-2">Nama
                                                Materi</label>
                                            <input type="text" class="form-control" id="input5{{ $userType->id }}"
                                                name="judul" value="{{ old('judul', $subMateri->judul) }}" required>
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <label for="lampiran{{ $userType->id }}" class="form-label mt-2">Lampiran
                                                Berkas</label>
                                            <input type="file" class="form-control" id="lampiran{{ $userType->id }}"
                                                name="lampiran" value="{{ old('lampiran', $subMateri->lampiran) }}"
                                                accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" />
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <label for="editor{{ $userType->id }}" class="form-label mt-2">Isi
                                                Materi</label>
                                            <div class="ckeditor form-control" id="editor{{ $userType->id }}"
                                                cols="30" rows="10">
                                                {!! old('isi', $subMateri->isi ?? '') !!}
                                            </div>
                                            <input type="hidden" name="isi" id="isi{{ $userType->id }}">
                                            <input type="hidden" name="id_kategori" value="{{ $userType->id }}">
                                        </div>

                                    </div>

                                    <div class="col">
                                        {{-- <button type="submit" class="btn btn-primary mt-4 p-2">Update</button>
                                        <button type="reset" class="btn btn-secondary mt-4 p-2">Batal</button> --}}
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col">
                    <button type="submit" id="submit-all" class="btn btn-primary mt-4 p-2">Update All</button>
                    <button type="reset" class="btn btn-secondary mt-4 p-2">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
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

        let editorMaster = [];
        // Loop over userTypes and initialize CKEditor for each editor
        userTypes.forEach(function(userType) {
            ClassicEditor
                .create(document.querySelector('#editor' + userType.id), {
                    toolbar: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote', '|', 'insertTable', 'mediaEmbed', 'undo', 'redo', 'imageUpload'
                    ],
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    }
                })
                .then(editor => {
                    console.log('Editor initialized for userType ID: ' + userType.id, editor);
                    editorMaster.push(editor);
                })
                .catch(error => {
                    console.error('Error initializing editor for userType ID: ' + userType.id, error);
                });
        });

        document.querySelector('#submit-all').addEventListener('click', function() {
            let allForm = [];
            let formHidden = document.querySelector('#form-hidden');
            let hiddenFormData = new FormData(formHidden);

            userTypes.forEach(function(userType, i) {
                var form = document.querySelector('#form' + userType.id);
                var formData = new FormData(form);

                // Capture editor data
                formData.set('isi', editorMaster[i].getData());
                formData.set('materi_id', {{ $materi->id }});

                // Handle the file input
                var lampiran = formData.get('lampiran');
                if (lampiran) {
                    hiddenFormData.append('lampiran[' + i + ']', lampiran);
                }
                var formDataJson = Object.fromEntries(formData.entries());
                allForm.push(formDataJson);
            });

            // Store JSON data in the hidden input field
            hiddenFormData.append('all_form', JSON.stringify(allForm));

            // Submit the hidden form along with the files
            var xhr = new XMLHttpRequest();
            xhr.open('POST', formHidden.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = "{{ route('guru.dashboard') }}";
                } else {
                    console.error('Form submission failed: ', xhr.responseText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed.');
            };
            xhr.send(hiddenFormData);
        });

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
@endpush
