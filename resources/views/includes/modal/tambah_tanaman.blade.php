<div class="modal fade" id="tambahTanaman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background : #0094ff !important;">
            <div class="modal-body mx-3">
                <div class="row">
                    <h4 class="text-center text-light">Tambah Tanaman</h4>
                </div>
                <form id="formAddTanaman">
                    <div class="row">
                        <div class="mb-3">
                            <label class="text-light">Jenis Sayur</label>
                            <select name="jenis_sayur" class="form-control form-select" id="jenisSayur" required>

                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Tanggal Tanam</label>
                                    <input type="date" name="tgl_tanam" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-light">Tanggal Panen</label>
                                    <input type="date" name="tgl_panen" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="text-light">Quantitas Tanam (gr)</label>
                            <input type="number" name="kuantitas_tanam" class="form-control" required>
                        </div>
                        <div class="text-center col-md-12">
                            <button 
                                type="submit"
                                class="btn border border-1 border-light text-light mt-3 mb-2 me-3" 
                                style="background: #28a745 !important; 
                                    border-radius :50px;
                                    padding-left : 50px !important;
                                    padding-right : 50px !important;
                                    ">
                                Tanam
                            </button>
                            <a href="" class="btn btn-warning border border-white text-light mt-2"
                            style="border-radius :50px;
                                    padding-left : 50px !important;
                                    padding-right : 50px !important;">
                                Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>