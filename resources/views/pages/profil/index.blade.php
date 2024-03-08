@extends('layouts.app')

@section('title', 'Profil')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/dropify/css/dropify.css') }}">
@endpush

@section('main')
    <div class="main-content mb-5 pb-5 text-dark">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-dark">Data @yield('title')</h4>
                            </div>
                            <div class="card-body">
                                <form id="updateData">
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="image" class="form-label">Foto </label>
                                        <input type="file" name="image" id="image" class="dropify"
                                            data-height="200">
                                        <small class="invalid-feedback" id="errorimage"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ Auth::user()->nama }}">
                                        <small class="invalid-feedback" id="errornama"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}">
                                        <small class="invalid-feedback" id="erroremail"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input id="nomor_telepon" type="number" class="form-control" name="nomor_telepon"
                                            value="{{ Auth::user()->nomor_telepon }}">
                                        <small class="invalid-feedback" id="errornomor_telepon"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_sim">Nomor Sim <span class="text-danger">*</span></label>
                                        <input id="nomor_sim" type="number" class="form-control" name="nomor_sim"
                                            value="{{ Auth::user()->nomor_sim }}">
                                        <small class="invalid-feedback" id="errornomor_sim"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                        <textarea id="alamat" class="form-control" name="alamat">{{ Auth::user()->alamat }}</textarea>
                                        <small class="invalid-feedback" id="erroralamat"></small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-save mr-2"></i>Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-dark">Ubah Password</h4>
                            </div>
                            <div class="card-body">
                                <form id="updatePassword">
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="password_lama" class="form-label">Password Lama <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_lama" name="password_lama">
                                        <small class="invalid-feedback" id="errorpassword_lama"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password Baru <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="invalid-feedback" id="errorpassword"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                        <small class="invalid-feedback" id="errorpassword_confirmation"></small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save mr-2"></i>Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/dropify/js/dropify.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $("#updateData").submit(function(e) {
                setButtonLoadingState("#updateData .btn.btn-success", true);
                e.preventDefault();
                const url = `{{ route('profil') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    $('#image').parent().find(".dropify-clear").trigger('click');
                    setButtonLoadingState("#updateData .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    $(".img-navbar").css("background-image",
                        `url('/storage/image/user/${response.data.image}')`);
                    handleSuccess(response, null, null, "no");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updateData .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    handleValidationErrors(error, "updateData", ["nama", "alamat", "nomor_telepon",
                        "nomor_sim", "email", "image"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $("#updatePassword").submit(function(e) {
                setButtonLoadingState("#updatePassword .btn.btn-success", true);
                e.preventDefault();
                const url = `{{ route('profil.password') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updatePassword .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    handleSuccess(response, null, null, "no");
                    $('#updatePassword .form-control').removeClass("is-invalid").val("");
                    $('#updatePassword .invalid-feedback').html("");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updatePassword .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    handleValidationErrors(error, "updatePassword", ["password_lama", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
