@if ($peminjaman->pengembalian)
    <div style="background-image: url('{{ asset('storage/image/mobil/' . $peminjaman->mobil->image) }}');"
        class="custom-image-modal mb-3 d-flex justify-content-end align-items-end">
        <div class="p-2">
            <span
                class="badge badge-primary">{{ $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . '( ' . $peminjaman->mobil->nomor_plat . ' )' }}</span>
        </div>
    </div>
    <table class="table table-striped w-100">
        <tr>
            <td class="font-weight-semibold" width="40%">Kode Pengembalian</td>
            <td>{{ $peminjaman->pengembalian->kode_pengembalian }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Penyewa</td>
            <td>{{ $peminjaman->peminjam->nama }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tanggal Mulai</td>
            <td>{{ formatTanggal($peminjaman->tanggal_mulai) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tanggal Selesai</td>
            <td>{{ formatTanggal($peminjaman->tanggal_selesai) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tanggal Pengembalian</td>
            <td>{{ formatTanggal($peminjaman->tanggal_pengembalian) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Jumlah Hari</td>
            <td>{{ $peminjaman->pengembalian->jumlah_hari }} Hari </td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Jumlah Denda Hari</td>
            <td>{{ $peminjaman->pengembalian->jumlah_denda_hari }} Hari</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Biaya Sewa</td>
            <td>{{ formatRupiah($peminjaman->pengembalian->biaya_sewa) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Biaya Denda Sewa</td>
            <td>{{ formatRupiah($peminjaman->pengembalian->denda_sewa) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Total Biaya</td>
            <td>{{ formatRupiah($peminjaman->pengembalian->biaya_sewa + $peminjaman->pengembalian->denda_sewa) }}</td>
        </tr>
    </table>
@else
    @if ($peminjaman->mobil)
        <div style="background-image: url('{{ asset('storage/image/mobil/' . $peminjaman->mobil->image) }}');"
            class="custom-image-modal mb-3 d-flex justify-content-end align-items-end">
            <div class="p-2">
                <span
                    class="badge badge-primary">{{ $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . '( ' . $peminjaman->mobil->nomor_plat . ' )' }}</span>
            </div>
        </div>
    @endif
    <table class="table table-striped w-100">
        <tr>
            <td class="font-weight-semibold" width="40%">Kode Peminjaman</td>
            <td>{{ $peminjaman->kode_peminjaman }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Penyewa</td>
            <td>{{ $peminjaman->peminjam->nama }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tanggal Mulai</td>
            <td>{{ formatTanggal($peminjaman->tanggal_mulai) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tanggal Selesai</td>
            <td>{{ formatTanggal($peminjaman->tanggal_selesai) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Jumlah Hari</td>
            <td>{{ hitungSelisihHari($peminjaman->tanggal_mulai, $peminjaman->tanggal_selesai) }} Hari</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Status</td>
            <td>{!! statusPeminjaman($peminjaman->status, 'message') !!}</td>
        </tr>
    </table>
@endif
