<div class="modal fade" role="dialog" id="createModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="label-modal"></span> Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="image" class="form-label">Foto </label>
                        <input type="file" name="image" id="image" class="dropify" data-height="200">
                        <small class="text-danger error-message" id="errorimage"></small>
                    </div>
                    <div class="form-group">
                        <label for="merek" class="form-label">Merek <span class="text-danger">*</span></label>
                        <select class="form-control" id="merek" name="merek">
                            <option value="">Pilih Merek</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Mitsubishi">Mitsubishi</option>
                            <option value="Daihatsu">Daihatsu</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Isuzu">Isuzu</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Kia">Kia</option>
                            <option value="Hyundai">Hyundai</option>
                            <option value="Ford">Ford</option>
                            <option value="Chevrolet">Chevrolet</option>
                            <option value="BMW">BMW</option>
                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                            <option value="Audi">Audi</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                        <small class="invalid-feedback" id="errormerek"></small>
                    </div>
                    <div class="form-group">
                        <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="model" name="model">
                        <small class="invalid-feedback" id="errormodel"></small>
                    </div>
                    <div class="form-group">
                        <label for="tipe" class="form-label">Tipe <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipe" name="tipe">
                            <option value="">Pilih Tipe</option>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="MPV">MPV</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Truck">Truck</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <small class="invalid-feedback" id="errortipe"></small>
                    </div>
                    <div class="form-group">
                        <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                        <select class="form-control" id="warna" name="warna">
                            <option value="">Pilih Warna</option>
                            <option value="Merah">Merah</option>
                            <option value="Biru">Biru</option>
                            <option value="Hijau">Hijau</option>
                            <option value="Kuning">Kuning</option>
                            <option value="Hitam">Hitam</option>
                            <option value="Putih">Putih</option>
                        </select>
                        <small class="invalid-feedback" id="errorwarna"></small>
                    </div>
                    <div class="form-group">
                        <label for="bahan_bakar" class="form-label">Bahan Bakar <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="bahan_bakar" name="bahan_bakar">
                            <option value="">Pilih Bahan Bakar</option>
                            <option value="Bensin">Bensin</option>
                            <option value="Solar">Solar</option>
                            <option value="Gas">Gas</option>
                            <option value="Listrik">Listrik</option>
                        </select>
                        <small class="invalid-feedback" id="errorbahan_bakar"></small>
                    </div>
                    <div class="form-group">
                        <label for="tahun_keluar" class="form-label">Tahun Keluar <span
                                class="text-danger">*</span></label>
                        <input type="number" minlength="4" class="form-control" id="tahun_keluar"
                            name="tahun_keluar">
                        <small class="invalid-feedback" id="errortahun_keluar"></small>
                    </div>
                    <div class="form-group">
                        <label for="kapasitas_penumpang" class="form-label">Kapasitas Penumpang <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="kapasitas_penumpang"
                            name="kapasitas_penumpang">
                        <small class="invalid-feedback" id="errorkapasitas_penumpang"></small>
                    </div>
                    <div class="form-group">
                        <label for="nomor_plat" class="form-label">Nomor Plat <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nomor_plat" name="nomor_plat">
                        <small class="invalid-feedback" id="errornomor_plat"></small>
                    </div>
                    <div class="form-group">
                        <label for="tarif_sewa_perhari" class="form-label">Tarif Sewa Perhari <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tarif_sewa_perhari"
                            name="tarif_sewa_perhari">
                        <small class="invalid-feedback" id="errortarif_sewa_perhari"></small>
                    </div>
                    <div class="form-group">
                        <label for="tarif_denda_perhari" class="form-label">Tarif Denda Perhari <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tarif_denda_perhari"
                            name="tarif_denda_perhari">
                        <small class="invalid-feedback" id="errortarif_denda_perhari"></small>
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                        <small class="invalid-feedback" id="errorstatus"></small>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-times mr-2"></i>Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
