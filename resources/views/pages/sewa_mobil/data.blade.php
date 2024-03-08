@forelse ($mobils as $mobil)
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div style="background-image: url({{ asset('storage/image/mobil/' . $mobil->image) }});"
                class="custom-image d-flex justify-content-end align-items-end">
                <div class="p-2">
                    {!! statusMobil($mobil->status) !!}
                </div>
            </div>
            <div class="card-body">
                <div class="card-title font-weight-600 mb-2">{{ $mobil->merek . ' - ' . $mobil->model }}</div>
                <div class="mb-2">
                    <span class="h4 font-weight-bold">{{ formatRupiah($mobil->tarif_sewa_perhari) }}</span> / hari
                </div>
                <small class="d-block small mb-3"><i class="fas fa-user mr-2"></i>Pemilik :
                    {{ $mobil->user->nama }}</small>
                <div class="d-flex">
                    @if (Auth::user())
                        @if ($mobil->status)
                            <button class="btn btn-block btn-outline-success mr-1"
                                onclick="getModal('createModal', '/mobil/{{ $mobil->id }}', 'detailPeminjaman')"><i
                                    class="fas fa-plus mr-2"></i>Sewa</button>
                        @else
                            <button class="btn btn-block btn-secondary mr-1"><i class="fas fa-times mr-2"></i>Tidak
                                Tersedia</button>
                        @endif
                        <button class="btn btn-info" title="Detail {{ $mobil->merek . ' - ' . $mobil->model }}"
                            onclick="getModalDetail('showModal', '/sewa-mobil/{{ $mobil->id }}')"><i
                                class="fas fa-info-circle"></i></button>
                    @else
                        <button class="btn btn-info btn-block"
                            title="Detail {{ $mobil->merek . ' - ' . $mobil->model }}"
                            onclick="getModalDetail('showModal', '/sewa-mobil/{{ $mobil->id }}')"><i
                                class="fas fa-info-circle mr-2"></i>Detail</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="text-center m-5 py-3">
            <div class="font-weight-semibold"><i class="fas fa-car-crash mr-2"></i>Mobil Tidak Ditemukan</div>
        </div>
    </div>
@endforelse

<div class="col-12">
    <div class="d-flex justify-content-center">
        {!! $mobils->links() !!}
    </div>
</div>
