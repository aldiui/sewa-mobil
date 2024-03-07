@extends('layouts.auth')

@section('title', 'Register')

@push('style')
@endpush

@section('main')
    <form id="register" autocomplete="off">
        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input id="nama" type="text" class="form-control" name="nama">
            <small class="invalid-feedback" id="errornama"></small>
        </div>
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" class="form-control" name="email">
            <small class="invalid-feedback" id="erroremail"></small>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
            <input id="nomor_telepon" type="number" class="form-control" name="nomor_telepon">
            <small class="invalid-feedback" id="errornomor_telepon"></small>
        </div>
        <div class="form-group">
            <label for="nomor_sim">Nomor Sim <span class="text-danger">*</span></label>
            <input id="nomor_sim" type="number" class="form-control" name="nomor_sim">
            <small class="invalid-feedback" id="errornomor_sim"></small>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
            <input id="password" type="password" class="form-control" name="password">
            <small class="invalid-feedback" id="errorpassword"></small>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                    class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            <small class="invalid-feedback" id="errorpassword_confirmation"></small>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea id="alamat" class="form-control" name="alamat"></textarea>
            <small class="invalid-feedback" id="erroralamat"></small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary btn-lg btn-icon icon-right">
                <i class="fas fa-sign-in mr-2"></i> Register
            </button>
        </div>
    </form>
    <div class="text-center">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#register").submit(function(e) {
                setButtonLoadingState("#register .btn.btn-primary", true, "Register");
                e.preventDefault();
                const url = "{{ route('register') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#register .btn.btn-primary", false,
                        "<i class='fas fa-sign-in mr-2'></i>Register");
                    handleSuccess(response, null, null, "/login");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#register .btn.btn-primary", false,
                        "<i class='fas fa-sign-in mr-2'></i>Register");
                    handleValidationErrors(error, "register", ["nama", "alamat", "nomor_telepon",
                        "nomor_sim", "email", "password"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
