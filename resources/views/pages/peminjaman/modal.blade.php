<div class="modal fade" role="dialog" id="createModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sewa Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <div class="custom-image-modal mb-3 d-flex justify-content-end align-items-end" id="bg-img">
                        <div class="p-2">
                            <span class="badge badge-primary" id="merek-mobil"></span>
                        </div>
                    </div>
                    <input type="hidden" name="mobil_id" id="mobil_id" class="form-control">
                    <div class="form-group">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="tanggal_mulai"
                            name="tanggal_mulai">
                        <small class="invalid-feedback" id="errortanggal_mulai"></small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="tanggal_selesai"
                            name="tanggal_selesai">
                        <small class="invalid-feedback" id="errortanggal_selesai"></small>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="konfirmasi" required>
                            <label class="form-check-label" for="konfirmasi">
                                Saya Yakin untuk Menyewa Mobil Ini
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-times mr-2"></i>Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-car mr-2"></i>Sewa Mobil</button>
                </div>
            </form>
        </div>
    </div>
</div>
