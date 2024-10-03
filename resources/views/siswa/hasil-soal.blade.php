@extends('layouts.app')

@section('title')
    Hasil Soal
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Materi" subtitle="Hasil Soal" />
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card pt-2 px-2">
                    <p class="mt-2">1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nulla aspernatur
                        enim nam mollitia ipsam! Eos et, cupiditate necessitatibus repudiandae minus pariatur? Corporis,
                        odio. Atque delectus minima voluptate aliquid necessitatibus.</p>
                    <div class="ms-5">
                        <p>A.wkwkwk<i class="bi bi-x ms-2 fs-6"></i></p>
                        <p>B.ahaha<i class="bi bi-check ms-2 fs-6 text-success"></i></p>
                        <p> c.jajaja<i class="bi bi-x ms-2 fs-6"></i></p>
                        <p> D.lukuluku<i class="bi bi-x ms-2 fs-6"></i></p>
                    </div>
                </div>
                <div class="card pt-2 px-2">
                    <p class="mt-2">2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nulla aspernatur
                        enim nam mollitia ipsam! Eos et, cupiditate necessitatibus repudiandae minus pariatur? Corporis,
                        odio. Atque delectus minima voluptate aliquid necessitatibus.</p>
                    <div class="ms-5">
                        <p>A.wkwkwk<i class="bi bi-check ms-2 fs-6 text-success"></i></p>
                        <p>B.ahaha<i class="bi bi-x ms-2 fs-6 "></i></p>
                        <p> c.jajaja<i class="bi bi-x ms-2 fs-6"></i></p>
                        <p> D.lukuluku<i class="bi bi-x ms-2 fs-6"></i></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card py-2 px-2 text-center">
                    <h3>Jawaban</h3>
                    <h4>4/5</h4>
                    <p>total EXP yang diperoleh adalah <b>80 EXP</b></p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
@endsection

@push('script')
    <!-- Include jQuery, Bootstrap, and SweetAlert -->
    <script src="{{ URL::asset('build/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert for confirmation before closing modal
        $('#addSoalModal').on('hidden.bs.modal', function() {
            Swal.fire({
                icon: 'success',
                title: 'Modal closed successfully!',
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endpush
