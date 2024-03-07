<div class="mb-3">
    <div style="background-image: url({{ asset('storage/image/mobil/' . $mobil->image) }});"
        class="custom-image-modal mb-3 d-flex justify-content-end align-items-end">
        <div class="p-2">
            {!! statusMobil($mobil->status) !!}
        </div>
    </div>
    <table class="table table-striped w-100">
        <tr>
            <td class="font-weight-semibold" width="40%">Merek</td>
            <td>{{ $mobil->merek }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Model</td>
            <td>{{ $mobil->model }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tipe</td>
            <td>{{ $mobil->tipe }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Warna</td>
            <td>{{ $mobil->warna }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Bahan Bakar</td>
            <td>{{ $mobil->bahan_bakar }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tahun Keluar</td>
            <td>{{ $mobil->tahun_keluar }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Kapasitas Penumpang</td>
            <td>{{ $mobil->kapasitas_penumpang }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Nomot Plat</td>
            <td>{{ $mobil->nomor_plat }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tarif Sewa / Hari</td>
            <td>{{ formatRupiah($mobil->tarif_sewa_perhari) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tarif Denda / Hari ( Jika melebihi tanggal selesai sewa)</td>
            <td>{{ formatRupiah($mobil->tarif_denda_perhari) }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Pemilik</td>
            <td>{{ $mobil->user->nama }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Alamat</td>
            <td>{{ $mobil->user->alamat }}</td>
        </tr>
        <tr>
            <td class="font-weight-semibold">No. Telepon</td>
            <td>{{ $mobil->user->nomor_telepon }}</td>
        </tr>
    </table>
</div>
