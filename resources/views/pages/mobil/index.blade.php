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
                <ul class="nav nav-pills gap-1" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="mobil-tab" data-toggle="tab" href="#mobil" role="tab"
                            aria-controls="mobil" aria-selected="true"><i class="fas fa-car mr-2"></i>Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="laporan-tab" data-toggle="tab" href="#laporan" role="tab"
                            aria-controls="laporan" aria-selected="true"><i class="fas fa-file-invoice mr-2"></i>Laporan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="mobil" role="tabpanel" aria-labelledby="mobil-tab">
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
                                            <table class="table table-bordered table-striped" id="mobil-table"
                                                width="100%">
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
                    <div class="tab-pane fade show" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-dark">Laporan Sewa @yield('title')</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="bulan_filter" class="form-label">Bulan</label>
                                                    <select name="bulan_filter" id="bulan_filter" class="form-control">
                                                        @foreach (bulan() as $key => $value)
                                                            <option value="{{ $key + 1 }}"
                                                                {{ $key + 1 == date('m') ? 'selected' : '' }}>
                                                                {{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="tahun_filter" class="form-label">Tahun</label>
                                                    <select name="tahun_filter" id="tahun_filter" class="form-control">
                                                        @for ($i = now()->year; $i >= now()->year - 4; $i--)
                                                            <option value="{{ $i }}"
                                                                {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <a id="downloadPdf" class="btn btn-sm px-3 btn-danger mr-1"
                                                        target="_blank"><i class="fas fa-file-pdf mr-2"></i>Pdf</a>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="laporan-table"
                                                        width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="5%">#</th>
                                                                <th scope="col" width="10%">Foto</th>
                                                                <th scope="col">Tanggal</th>
                                                                <th scope="col">Mobil</th>
                                                                <th scope="col">Peminjam</th>
                                                                <th scope="col">Biaya Sewa</th>
                                                                <th scope="col">Aksi</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.mobil.modal')
    @include('pages.sewa_mobil.modal')
    @include('pages.laporan.show')
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

            let laporanTableInitialized = false;

            $("#laporan-tab").on("click", function() {
                if (!laporanTableInitialized) {
                    renderData();
                    datatableCall('laporan-table', '{{ route('laporan.index') }}', [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'img',
                            name: 'img'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'mobil',
                            name: 'mobil'
                        },
                        {
                            data: 'peminjam',
                            name: 'peminjam'
                        },
                        {
                            data: 'biaya',
                            name: 'biaya'
                        },
                        {
                            data: 'detail',
                            name: 'detail'
                        }
                    ]);

                    laporanTableInitialized = true;
                }
            });


            $("#bulan_filter, #tahun_filter").on("change", function() {
                $("#laporan-table").DataTable().ajax.reload();
                renderData();
            });

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

        const renderData = () => {
            const downloadPdf =
                `/laporan?mode=pdf&bulan=${$("#bulan_filter").val()}&tahun=${$("#tahun_filter").val()}`;
            $("#downloadPdf").attr("href", downloadPdf);
        }
    </script>
@endpush
