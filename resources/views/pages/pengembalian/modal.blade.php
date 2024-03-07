<div class="modal fade" role="dialog" id="createModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="d-flex justify-content-between align-items-center w-100 mb-4">
                    <h5 class="modal-title">Pengembalian Mobil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group w-100">
                    <div class="input-group">
                        <input type="text" placeholder="Cari Nomor Plat ...." name="nomor_plat" class="form-control"
                            id="nomor_plat">
                        <div class="input-group-append">
                            <button onclick="cariPlatNomor()" class="btn btn-primary"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body" id="data-pengembalian">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-times mr-2"></i>Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-car mr-2"></i>Pengembalian
                        Mobil</button>
                </div>
            </form>
        </div>
    </div>
</div>
