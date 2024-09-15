<!-- loader-->
<link href="{{ URL::asset('build/css/pace.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('build/js/pace.min.js') }}"></script>

<!--plugins-->
<link href="{{ URL::asset('build/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('build/plugins/metismenu/metisMenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('build/plugins/metismenu/mm-vertical.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('build/plugins/simplebar/css/simplebar.css') }}">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>




<!--bootstrap css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.13.3/sweetalert2.css"
    integrity="sha512-Gebe6n4xsNr0dWAiRsMbjWOYe1PPVar2zBKIyeUQKPeafXZ61sjU2XCW66JxIPbDdEH3oQspEoWX8PQRhaKyBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

@stack('css')

<!--main css-->
<link href="{{ URL::asset('build/css/bootstrap-extended.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/main.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/dark-theme.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/blue-theme.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/semi-dark.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/bordered-theme.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/css/responsive.css') }}" rel="stylesheet">
<link href="{{ URL::asset('livecode/css/style.css') }}" rel="stylesheet">
{{-- <link href="{{ URL::asset('assets/ckeditor5-premium-features/ckeditor5-premium-features-editor.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/ckeditor5-premium-features/ckeditor5-premium-features-content.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/ckeditor5-premium-features/ckeditor5-premium-features.css') }}" rel="stylesheet"> --}}

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@include('sweetalert::alert')
