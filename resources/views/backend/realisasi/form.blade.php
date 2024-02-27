<div class="modal fade modal-lg" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Data @urlSegment(2)</h5>

            </div>
            <form id="formData" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="dataId" name="dataId">
                    <input type="hidden" id="target_id" name="target_id">
                    {{-- <div class="form-group mb-4">
                        <label for="target_id"
                            class="required fs-6 fw-semibold mb-2">Target</label>
                        <select name="target_id" id="target_id" class="form-select form-select-solid">
                            @foreach ($target as $item)
                                <option value="{{ $item->id }}">{{ $item->sasaran }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="row">
                        <div class="form-group mb-4 col-3">
                            <label for="tw1" class="required fs-6 fw-semibold mb-2">Realisasi TW I</label>
                            <input type="text" class="form-control" id="tw1" name="tw1">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw2" class="required fs-6 fw-semibold mb-2">Realisasi TW II</label>
                            <input type="text" class="form-control" id="tw2" name="tw2">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw3" class="required fs-6 fw-semibold mb-2">Realisasi TW III</label>
                            <input type="text" class="form-control" id="tw3" name="tw3">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw4" class="required fs-6 fw-semibold mb-2">Realisasi TW IV</label>
                            <input type="text" class="form-control" id="tw4" name="tw4">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="pendukung" class="required fs-6 fw-semibold mb-2">Pendukung</label>
                        <input type="text" class="form-control" id="pendukung" name="pendukung">
                    </div>
                    <div class="form-group mb-4">
                        <label for="penghambat" class="required fs-6 fw-semibold mb-2">Penghambat</label>
                        <input type="text" class="form-control" id="penghambat" name="penghambat">
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