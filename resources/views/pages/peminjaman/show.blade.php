@if ($peminjaman)
    @php
        $selisihHari = hitungSelisihHari($peminjaman->tanggal_mulai, date('Y-m-d'));
        $totalHarga = $selisihHari * $peminjaman->mobil->tarif_sewa_perhari;
    @endphp
    <div class="mb-3">
        @if ($peminjaman->mobil)
            <div style="background-image: url('{{ asset('storage/image/mobil/' . $peminjaman->mobil->image) }}');"
                class="custom-image-modal mb-3 d-flex justify-content-end align-items-end">
                <div class="p-2">
                    <span
                        class="badge badge-primary">{{ $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . '( ' . $peminjaman->mobil->nomor_plat . ' )' }}</span>
                </div>
            </div>
        @endif
        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
        <input type="hidden" name="jumlah_hari" value="{{ $selisihHari }}">
        <input type="hidden" name="biaya_sewa" value="{{ $totalHarga }}">
        <table class="table table-striped w-100">
            <tr>
                <td class="font-weight-semibold" width="40%">Kode Peminjaman</td>
                <td>{{ $peminjaman->kode_peminjaman }}</td>
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
                <td>{{ formatTanggal() }}</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Jumlah Hari</td>
                <td>{{ $selisihHari }} Hari</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Biaya Sewa</td>
                <td>{{ formatRupiah($totalHarga) }}</td>
            </tr>
        </table>
    </div>
@else
    <div class="text-center py-1">
        <div class="text-center m-5 py-3">
            <div class="font-weight-semibold"><i class="fas fa-car-crash mr-2"></i>Data Peminjaman Tidak Ditemukan</div>
        </div>
    </div>
@endif
