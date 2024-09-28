@extends('layouts.app')

@section('title')
    Widgets Data
@endsection

@section('content')
    <div class="container d-flex align-items-center mb-5">
        <button class="btn "><i class='bx bx-left-arrow-alt fs-2'></i></button>
        <x-page-title title="Materi" subtitle="Tambah Soal" />
    </div>

    <div class="container">
        <div class="card">
            <div class="row">
                <!-- First column with image -->
                <div class="col-md d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/soal.png') }}" width="80%">
                </div>
                <!-- Second column with content -->
                <div class="col-md d-flex align-items-center">
                    <div>
                        <h3 class="mb-4">Judul Soal </h3>
                        <p>Deskripsi tentang soal Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit sunt ipsum asperiores? Quo, labore at quisquam fugiat temporibus sequi nesciunt voluptatum aut reprehenderit inventore earum hic quasi, vel laborum sunt?</p>
                        <button type="button" class="btn btn-primary">Kerjakan Soal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
