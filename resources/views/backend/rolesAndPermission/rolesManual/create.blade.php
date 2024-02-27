<!-- Modal Tambah/Edit -->
<div class="modal fade" id="manual_create" tabindex="-1" role="dialog" aria-labelledby="manual_createLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manual_createLabel">Form Data @urlSegment(2)</h5>
            </div>
            <form id="formData" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="dataId" name="dataId">
                    <div class="form-group">
                        <label for="name" class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="guard_name" class="fs-6 fw-semibold mb-2">Guard Name</label>
                        <input type="text" class="form-control" id="guard_name" name="guard_name" value="web"
                            disabled>
                    </div>
                </div>
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_add_customer_cancel" class="btn btn-warning me-3"
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
<!--end::Modals-->
