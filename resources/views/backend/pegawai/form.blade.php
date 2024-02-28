<!--begin::Modals-->
<!-- Modal Tambah/Edit -->
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
                    <div class="form-group" @role('operator') style="display:none;" @endrole>
                        <label for="opd_id" class="required fs-6 fw-semibold mb-2">Nama OPD</label>
                        <select name="opd_id" id="opd_id" class="form-select form-select-solid" readonly>
                            @foreach ($opd as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group mt-4">
                        <label for="nip" class="required fs-6 fw-semibold mb-2">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip">
                    </div>
                    <div class="form-group mt-4">
                        <label for="jabatan" class="required fs-6 fw-semibold mb-2">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                    </div>
                    <div class="form-group mt-4">
                        <label for="golongan" class="required fs-6 fw-semibold mb-2">Golongan</label>
                        <input type="text" class="form-control" id="golongan" name="golongan">
                    </div>
                    <div class="form-group">
                        <label for="eselon" class="required fs-6 fw-semibold mb-2">Eselon</label>
                        <select name="eselon" id="eselon" class="form-select form-select-solid">
                            <option value="">--Pilih--</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
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
<!--end::Modals-->
