@if ($peminjaman && $mode == 'pengembalian')
    @php
        $tanggalSekarang = date('Y-m-d');
        $tanggalSelesai = $peminjaman->tanggal_selesai;

        $selisihHari =
            $tanggalSekarang > $tanggalSelesai
                ? hitungSelisihHari($peminjaman->tanggal_mulai, $tanggalSelesai)
                : hitungSelisihHari($peminjaman->tanggal_mulai, $tanggalSekarang);
        $totalHarga = $selisihHari * $peminjaman->mobil->tarif_sewa_perhari;
        $selisihHariDenda =
            $tanggalSelesai < $tanggalSekarang ? hitungSelisihHari($tanggalSelesai, $tanggalSekarang) : 0;
        $totalDenda = $selisihHariDenda * $peminjaman->mobil->tarif_denda_perhari;
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
        <input type="hidden" name="jumlah_denda_hari" value="{{ $selisihHariDenda }}">
        <input type="hidden" name="biaya_sewa" value="{{ $totalHarga }}">
        <input type="hidden" name="denda_sewa" value="{{ $totalDenda }}">
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
                <td>{{ $selisihHari }} Hari x {{ formatRupiah($peminjaman->mobil->tarif_sewa_perhari) }}</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Jumlah Denda Hari</td>
                <td>{{ $selisihHariDenda }} Hari x {{ formatRupiah($peminjaman->mobil->tarif_denda_perhari) }}</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Biaya Sewa</td>
                <td>{{ formatRupiah($totalHarga) }}</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Biaya Denda Sewa</td>
                <td>{{ formatRupiah($totalDenda) }}</td>
            </tr>
            <tr>
                <td class="font-weight-semibold">Total Biaya</td>
                <td>{{ formatRupiah($totalHarga + $totalDenda) }}</td>
            </tr>
        </table>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="konfirmasi" required>
                <label class="form-check-label" for="konfirmasi">
                    Saya Yakin untuk Mengembalikan Mobil Ini
                </label>
            </div>
        </div>
    </div>
@elseif($peminjaman)
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
@elseif(!$peminjaman)
    <div class="text-center py-1">
        <div class="text-center m-5 py-3">
            <div class="font-weight-semibold"><i class="fas fa-car-crash mr-2"></i>Data Peminjaman Tidak Ditemukan</div>
        </div>
    </div>
@endif
