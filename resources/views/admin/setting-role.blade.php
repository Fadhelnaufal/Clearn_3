@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    @php
        $user = auth()->user(); // Get the logged-in user
        $role = $user->roles->pluck('name')->first(); // Get the user's role name
    @endphp
    <x-page-title title="Dashboard" subtitle="Setting Role {{ ucfirst($role) }}" />
    <div class="container my-4">
        <div class="row ">
            <div class="parent-icon">
                <button type="submit" class="btn btn-primary" data-bs-target="#TambahUserModal" data-bs-toggle="modal">Tambah
                    User <i class="fa-solid fa-plus ms-2"></i></button>
            </div>
            <div class="modal fade" id="TambahUserModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0 py-2">
                            <h5 class="modal-title">Tambahkan User</h5>
                            <a href="javascript:;" class="primary-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form class="row g-3" id="addUserForm" method="POST"
                                    action="{{ route('setting-role.store') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>

                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span type="button" class="btn btn-outline-secondary"
                                                    id="toggleConfirmPassword">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required>
                                        </div>
                                        <div class="input-group">
                                            <label for="role" class="form-label">Role</label>
                                            <div class="input-group">
                                                <select class="form-control" id="role" name="role" required>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->hasRole($role->id) ? 'selected' : '' }}>
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-text">
                                                    <i class="bi bi-caret-down-fill"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" class="btn ripple btn-primary px-2">
                                                    Tambah
                                                </button>
                                                <button type="button" class="btn ripple btn-secondary px-2 text-center"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card px-3 py-2">
                    <table class="table" id="roleuser" >
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%; text-align:center;">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning md-2" data-bs-toggle="modal"
                                            data-bs-target="#EditUserModal{{ $user->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <form action="{{ route('setting-role.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bi bi-trash3"></i>Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal" id="EditUserModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="EditUserLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0 py-2">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('setting-role.update', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ $user->id }}">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="text" class="form-control"
                                                            id="name{{ $user->id }}" name="name"
                                                            value="{{ old('name', $user->name) }}" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control"
                                                            id="email{{ $user->id }}" name="email"
                                                            value="{{ old('email', $user->email) }}" required>
                                                        <div class="input-group">
                                                            <label for="role" class="form-label">Role</label>
                                                            <div class="input-group">
                                                                <select class="form-control" id="role"
                                                                    name="role" required>
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->name }}"
                                                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                            {{ ucfirst($role->name) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="input-group-text">
                                                                    <i class="bi bi-caret-down-fill"></i>
                                                                    <!-- Bootstrap Icon for dropdown -->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                                <button type="submit" class="btn ripple btn-primary px-2"
                                                                    onclick="submitForm()">
                                                                    Simpan Perubahan
                                                                </button>
                                                                <button type="button"
                                                                    class="btn ripple btn-secondary px-2 text-center"
                                                                    data-bs-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#roleuser').DataTable();
        });
    </script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle visibility for password field
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const toggleIcon = this.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });

        // Toggle visibility for confirm password field
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordField = document.getElementById('password_confirmation');
            const toggleIcon = this.querySelector('i');

            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                confirmPasswordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
    });
</script>
