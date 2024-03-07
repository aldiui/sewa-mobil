@extends('layouts.app')

@section('title', 'Mobil')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/dropify/css/dropify.css') }}">
@endpush

@section('main')
    <div class="main-content mb-5 pb-5 text-dark">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-dark">Data @yield('title')</h4>
                                <div class="ml-auto">
                                    <button class="btn btn-success" onclick="getModal('createModal')"><i
                                            class="fas fa-plus mr-2"></i>Tambah Mobil</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="mobil-table" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">#</th>
                                                <th scope="col" width="15%">Foto</th>
                                                <th scope="col">Merek</th>
                                                <th scope="col">Model</th>
                                                <th scope="col">Nomor Plat</th>
                                                <th scope="col">Tarif Sewa</th>
                                                <th scope="col" width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.mobil.modal')
    @include('pages.sewa_mobil.modal')
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('library/dropify/js/dropify.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            datatableCall('mobil-table', '{{ route('mobil.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'img',
                    name: 'img'
                },
                {
                    data: 'merek',
                    name: 'merek'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'nomor_plat',
                    name: 'nomor_plat',
                },
                {
                    data: 'tarif_sewa',
                    name: 'tarif_sewa'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-success", true);
                e.preventDefault();
                const kode = $("#saveData #id").val();
                let url = "{{ route('mobil.store') }}";
                const data = new FormData(this);

                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/mobil/${kode}`;
                }

                const successCallback = function(response) {
                    $('#saveData #image').parent().find(".dropify-clear").trigger('click');
                    setButtonLoadingState("#saveData .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    handleSuccess(response, "mobil-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-success", false,
                        "<i class='fas fa-save mr-2'></i>Simpan");
                    handleValidationErrors(error, "saveData", ["merek", "model", "tipe", "warna",
                        "bahan_bakar", "tahun_keluar", "kapasitas_penumpang", "nomor_plat",
                        "tarif_sewa_perhari", "tarif_denda_perhari", "image"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

        });
    </script>
@endpush
