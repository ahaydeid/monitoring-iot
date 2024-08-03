<div class="modal fade" id="updatePembeli" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background : #0094ff !important;">
            <div class="modal-body mx-3">
                <div class="row">
                    <h4 class="text-center text-light">Edit Pembeli</h4>
                </div>
                <form id="formUpdateKatalog">
                    <div class="row d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Nama Pembeli</label>
                                    <input name="id" id="editid" hidden>
                                    <input type="text" name="nama_pembeli" class="form-control" id="editNamaPembeli" required>
                                </div>                        
                            </div>                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" id="editKontak">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Jenis Sayur</label>
                                    <select class="form-control form-select" name="jenis_sayur" id="editJenisSayur">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Tanggal Panen</label>
                                    <input type="text" name="id_dtl_tanam" id="editId_dtl_tanam" hidden>
                                    <input type="text" name="tgl_panen" id="editTglActPanen" hidden>
                                    <select class="form-control form-select" id="editTgl_panen" required>

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="text-light">Tersedia</label>
                                <input type="number" id="tersediaAct" hidden>
                                <input type="number" name="tersedia" class="form-control" id="editTerSediaStock" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="text-light">Kuantitas Pesan (<small class="text-light" id="note"></small>)</label>
                                <input type="number" name="kuantitas_pesan" class="form-control" id="editKuantitasPesan" required>
                            </div>
                        </div>
                        
                        <div class="text-center col-md-12">
                        <div class="text-center col-md-12">
                            <button 
                                type="submit"
                                class="btn border border-1 border-light text-light mt-3 mb-2 me-3" 
                                style="background: #28a745 !important; 
                                    border-radius :50px;
                                    padding-left : 50px !important;
                                    padding-right : 50px !important;
                                    ">
                                Perbarui
                            </button>
                            <a href="" class="btn btn-warning border border-white text-light mt-2"
                            style="border-radius :50px;
                                    padding-left : 50px !important;
                                    padding-right : 50px !important;">
                                Batal</a>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>