    @extends('layouts.app')
    @section('title')
        Livecode
    @endsection
    @section('content')
        <x-page-title title="Live Code" subtitle="Live Code" />
        <div class="row">
            <div class="col-md-4">
                <form action="">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                code
                            </i> HTML</h3>
                        <textarea name="html" id="html" cols="auto" rows="auto" autofocus autocomplete="off" autocorrect="on"
                            autocapitalize="off" spellcheck="false"></textarea>
                        <div class="col mt-2 mb-2 mx-2">
                            <button class="copy-btn copy-html btn btn-primary">
                                Submit
                            </button>
                            <button class="clear html btn btn-secondary">clear</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form action="">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                code
                            </i>CSS</h3>
                        <textarea name="css" id="css" cols="auto" rows="auto" autofocus autocomplete="off" autocorrect="off"
                            autocapitalize="off" spellcheck="false"></textarea>
                        <div class="col mt-2 mb-2 mx-2">
                            <button class="copy-btn copy-html btn btn-primary">
                                Submit
                            </button>
                            <button class="clear css btn btn-secondary">clear</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form action="">
                    <div class="card">
                        <h3 class="mx-2 my-2"><i class="material-icons-outlined mx-2">
                                code
                            </i>JS</h3>
                        <textarea name="js" id="js" cols="auto" rows="auto" autofocus autocomplete="off" autocorrect="off"
                            autocapitalize="off" spellcheck="false"></textarea>
                        <div class="col mt-2 mb-2 mx-2">
                            <button class="clear js btn btn-secondary">clear</button>
                            <button class="copy-btn copy-html btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
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
                        url: "{{ route('siswa.store.answers') }}",
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!--plugins-->
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
