@extends('layouts.app')

@section('title', 'Peminjaman')

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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="peminjaman-table" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">#</th>
                                                <th scope="col" width="15%">Foto</th>
                                                <th scope="col">Kode Peminjaman</th>
                                                <th scope="col">Mobil</th>
                                                <th scope="col">Tanggal</th>
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
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            datatableCall('peminjaman-table', '{{ route('peminjaman.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'img',
                    name: 'img'
                },
                {
                    data: 'kode_peminjaman',
                    name: 'kode_peminjaman'
                },
                {
                    data: 'mobil',
                    name: 'mobil'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
            ]);
        });
    </script>
@endpush
