@extends('layouts.pdf')

@section('title', 'Rekap Sewa')

@push('style')
@endpush

@section('main')
    <div>
        <center>
            <u>
                <h3>Data @yield('title') {{ $bulanTahun }}</h3>
            </u>
        </center>
        <br>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="10%">Foto</th>
                    <th>Tanggal</th>
                    <th>Mobil</th>
                    <th>Peminjam</th>
                    <th>Biaya Sewa</th>
                </tr>
            </thead>
            <tbody valign="top">
                @php
                    $totalSewa = 0;
                @endphp
                @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td align="center">{{ formatTanggal($peminjaman->created_at) }}</td>
                        <td align="center">
                            {{ $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . ' (' . $peminjaman->mobil->nomor_plat . ')' }}
                        </td>
                        <td align="center">{{ $peminjaman->peminjam->nama }}</td>
                        <td align="center">
                            {{ formatRupiah($peminjaman->pengembalian ? $peminjaman->pengembalian->biaya_sewa + $peminjaman->pengembalian->denda_sewa : 0) }}
                        </td>
                    </tr>
                    @php
                        $totalSewa += $peminjaman->pengembalian
                            ? $peminjaman->pengembalian->biaya_sewa + $peminjaman->pengembalian->denda_sewa
                            : 0;
                    @endphp

                @empty
                    <tr>
                        <td colspan="6" align="center"> Tidak Ada Data</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="5" align="right"><strong>Total:</strong></td>
                    <td align="center"><strong>{{ formatRupiah($totalSewa) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
