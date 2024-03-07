@extends('layouts.app')

@section('title', 'Sewa Mobil')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content mb-5 pb-5 text-dark">
        <section class="section">
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Cari @yield('title')</h4>
                        @if (Auth::user())
                            <div class="ml-auto">
                                <a href="{{ route('mobil.index') }}" class="btn btn-success"><i class="fas fa-car mr-2"></i>
                                    Tawarkan
                                    Mobil</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search" name="search"
                                        placeholder="Cari Mobil...">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="semua">Semua</option>
                                        <option value="1">Tersedia</option>
                                        <option value="0">Tidak Tersedia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="mobils">
                    @include('pages.sewa_mobil.data')
                </div>
            </div>
        </section>
    </div>
    @include('pages.sewa_mobil.modal')
    @if (Auth::user())
        @include('pages.peminjaman.modal')
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#search, #status').on('input change', function() {
                getMenus(1);
            });

            getMenus(1);

            @if (Auth::user())
                $("#saveData").submit(function(e) {
                    setButtonLoadingState("#saveData .btn.btn-success", true, "Sewa Mobil");
                    e.preventDefault();
                    const kode = $("#saveData #id").val();
                    const url = "{{ route('peminjaman.store') }}";
                    const data = new FormData(this);

                    const successCallback = function(response) {
                        $('#saveData #image').parent().find(".dropify-clear").trigger('click');
                        setButtonLoadingState("#saveData .btn.btn-success", false,
                            "<i class='fas fa-car mr-2'></i>Sewa Mobil");
                        handleSuccess(response, null, null, "/peminjaman");
                    };

                    const errorCallback = function(error) {
                        setButtonLoadingState("#saveData .btn.btn-success", false,
                            "<i class='fas fa-car mr-2'></i>Sewa Mobil");
                        handleValidationErrors(error, "saveData", ["tanggal_mulai",
                            "tanggal_selesai"
                        ]);
                    };

                    ajaxCall(url, "POST", data, successCallback, errorCallback);
                });
            @endif
        });
    </script>
@endpush
