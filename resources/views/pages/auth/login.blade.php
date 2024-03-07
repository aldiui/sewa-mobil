@extends('layouts.auth')

@section('title', 'Login')

@push('style')
@endpush

@section('main')
    <form id="login" autocomplete="off">
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" type="email" class="form-control" name="email">
            <small class="invalid-feedback" id="erroremail"></small>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
            <input id="password" type="password" class="form-control" name="password">
            <small class="invalid-feedback" id="errorpassword"></small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary btn-lg btn-icon icon-right">
                <i class="fas fa-sign-in mr-2"></i> Login
            </button>
        </div>
    </form>
    <div class="text-center">
        Belum punya akun? <a href="{{ route('register') }}">Registrasi</a>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#login").submit(function(e) {
                setButtonLoadingState("#login .btn.btn-primary", true, "Login");
                e.preventDefault();
                const url = "{{ route('login') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#login .btn.btn-primary", false,
                        "<i class='fas fa-sign-in mr-2'></i>Login");
                    handleSuccess(response, null, null, "/");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#login .btn.btn-primary", false,
                        "<i class='fas fa-sign-in mr-2'></i>Login");
                    handleValidationErrors(error, "login", ["email", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
