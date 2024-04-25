<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Data @urlSegment(2)</h5>
            </div>
            <form id="formData" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="dataId" name="dataId">
                    <input type="hidden" class="form-control" id="opd_id" name="opd_id">

                    <div class="form-group mb-4">
                        <label for="tahun" class="required fs-6 fw-semibold mb-2">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun">
                    </div>
                    <div class="form-group mb-4">
                        <label for="rekomendasi_lhe" class="required fs-6 fw-semibold mb-2">Rekomendasi LHE</label>
                        <input type="text" class="form-control" id="rekomendasi_lhe" name="rekomendasi_lhe">
                    </div>
                    <div class="form-group mb-4">
                        <label for="tindak_lanjut" class="required fs-6 fw-semibold mb-2">Tindak Lanjut</label>
                        <input type="text" class="form-control" id="tindak_lanjut" name="tindak_lanjut">
                    </div>
                    <div class="form-group mb-4">
                        <label for="target_penyelesaian" class="required fs-6 fw-semibold mb-2">Target Penyelesaian</label>
                        <input type="text" class="form-control" id="target_penyelesaian" name="target_penyelesaian">
                    </div>
                    <div class="form-group mb-4">
                        <label for="progres" class="required fs-6 fw-semibold mb-2">Progres</label>
                        <input type="text" class="form-control" id="progres" name="progres">
                    </div>
                    <div class="form-group mb-4">
                        <label for="bukti_dukung" class="required fs-6 fw-semibold mb-2">Link Bukti Dukung</label>
                        <input type="text" class="form-control" id="bukti_dukung" name="bukti_dukung">
                    </div>
                </div>
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="" class="btn btn-warning me-3"
                        data-bs-dismiss="modal">Batal</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" id="btnSimpan">Simpan</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2">
                            </span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
        </div>
    </div>
</div>
