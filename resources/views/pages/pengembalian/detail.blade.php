<div style="background-image: url('{{ asset('storage/image/mobil/' . $pengembalian->peminjaman->mobil->image) }}');"
    class="custom-image-modal mb-3 d-flex justify-content-end align-items-end">
    <div class="p-2">
        <span
            class="badge badge-primary">{{ $pengembalian->peminjaman->mobil->merek . ' - ' . $pengembalian->peminjaman->mobil->model . '( ' . $pengembalian->peminjaman->mobil->nomor_plat . ' )' }}</span>
    </div>
</div>
<table class="table table-striped w-100">
    <tr>
        <td class="font-weight-semibold" width="40%">Kode Pengembalian</td>
        <td>{{ $pengembalian->peminjaman->kode_peminjaman }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Tanggal Mulai</td>
        <td>{{ formatTanggal($pengembalian->peminjaman->tanggal_mulai) }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Tanggal Selesai</td>
        <td>{{ formatTanggal($pengembalian->peminjaman->tanggal_selesai) }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Tanggal Pengembalian</td>
        <td>{{ formatTanggal($pengembalian->peminjaman->tanggal_pengembalian) }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Jumlah Hari</td>
        <td>{{ $pengembalian->jumlah_hari }} Hari </td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Jumlah Denda Hari</td>
        <td>{{ $pengembalian->jumlah_denda_hari }} Hari</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Biaya Sewa</td>
        <td>{{ formatRupiah($pengembalian->biaya_sewa) }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Biaya Denda Sewa</td>
        <td>{{ formatRupiah($pengembalian->denda_sewa) }}</td>
    </tr>
    <tr>
        <td class="font-weight-semibold">Total Biaya</td>
        <td>{{ formatRupiah($pengembalian->biaya_sewa + $pengembalian->denda_sewa) }}</td>
    </tr>
</table>
