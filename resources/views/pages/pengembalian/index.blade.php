@extends('layouts.app')

@section('title', 'Pengembalian')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                                    <button class="btn btn-success" onclick="cleanModal(); getModal('createModal')"><i
                                            class="fas fa-plus mr-2"></i>Pengembalian Mobil</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="pengembalian-table"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">#</th>
                                                <th scope="col" width="15%">Foto</th>
                                                <th scope="col">Kode Pengembalian</th>
                                                <th scope="col">Mobil</th>
                                                <th scope="col">Tanggal Pengembalian</th>
                                                <th scope="col">Jumlah Hari</th>
                                                <th scope="col">Biaya Sewa</th>
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
    @include('pages.pengembalian.modal')
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            datatableCall('pengembalian-table', '{{ route('pengembalian.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'img',
                    name: 'img'
                },
                {
                    data: 'kode_pengembalian',
                    name: 'kode_pengembalian'
                },
                {
                    data: 'mobil',
                    name: 'mobil'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'jumlah_hari',
                    name: 'jumlah_hari'
                },
                {
                    data: 'biaya',
                    name: 'biaya'
                }
            ]);
        });

        $("#saveData").submit(function(e) {
            setButtonLoadingState("#saveData .btn.btn-success", true, "Pengembalian Mobil");
            e.preventDefault();
            const url = "{{ route('pengembalian.store') }}";
            const data = new FormData(this);

            const successCallback = function(response) {
                setButtonLoadingState("#saveData .btn.btn-success", false,
                    "<i class='fas fa-car mr-2'></i>Pengembalian Mobil");
                handleSuccess(response, "pengembalian-table", "createModal");
            };

            const errorCallback = function(error) {
                setButtonLoadingState("#saveData .btn.btn-success", false,
                    "<i class='fas fa-car mr-2'></i>Pengembalian Mobil");
                handleValidationErrors(error, "saveData", []);
            };

            ajaxCall(url, "POST", data, successCallback, errorCallback);
        });
    </script>
@endpush
