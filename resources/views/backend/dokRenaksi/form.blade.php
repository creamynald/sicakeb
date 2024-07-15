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
                    <div class="form-group">
                        <label for="opd_id" class="required fs-6 fw-semibold mb-2">Pilih OPD</label>
                        <select name="opd_id" id="opd_id" class="form-select form-select-solid">
                            @foreach ($opd as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group mt-4">
                        <div class="col-md-6">
                            <label for="tahun" class="required fs-6 fw-semibold mb-2">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun">
                        </div>
                        <div class="col-md-6">
                            <label for="urutan" class="required fs-6 fw-semibold mb-2">Urutan</label>
                            <input type="number" class="form-control" id="urutan" name="urutan">
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="link" class="required fs-6 fw-semibold mb-2">Link / Tautan</label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" id="kt_modal_add_customer_cancel" class="btn btn-warning me-3"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" id="btnSimpan">Simpan</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
