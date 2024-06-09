<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Data @urlSegment(2)</h5>
            </div>
            <form id="formData" enctype="multipart/form-data" method="POST" action="{{ route('saveData') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="dataId" name="dataId">
                    <input type="hidden" class="form-control" id="opd_id" name="opd_id">
            
                    <div class="form-group mb-4">
                        <label for="jenis_file" class="required fs-6 fw-semibold mb-2">Jenis File</label>
                        <select name="jenis_file" id="jenis_file" class="form-control mb-4">
                            <option value="">- Pilih -</option>
                            <option value="RPJMD" @if (request()->get('jenis_file') == 'RPJMD') selected @endif>RPJMD</option>
                            <option value="RENSTRA" @if (request()->get('jenis_file') == 'RENSTRA') selected @endif>RENSTRA</option>
                            <option value="LAKIP" @if (request()->get('jenis_file') == 'LAKIP') selected @endif>LAKIP</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tahun" class="required fs-6 fw-semibold mb-2">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun">
                    </div>
                    <div class="form-group mb-4">
                        <label for="nama" class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group mb-4">
                        <label for="lokasi_file" class="required fs-6 fw-semibold mb-2">File</label>
                        <input type="file" class="form-control" id="lokasi_file" name="lokasi_file">
                    </div>
                </div>
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="button" id="" class="btn btn-warning me-3" data-bs-dismiss="modal">Batal</button>
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
