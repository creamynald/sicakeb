<!-- Modal Tambah/Edit -->
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
                    <input type="hidden" id="pegawai_id" name="pegawai_id" value="{{ $pegawai->id }}">
                    <div class="form-group mb-4">
                        <label for="tahun" class="required fs-6 fw-semibold mb-2">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun">
                    </div>
                    <div class="form-group mb-4">
                        <label for="jenis_master" class="required fs-6 fw-semibold mb-2">Jenis
                            Master</label>
                        <input type="text" class="form-control" id="jenis_master" name="jenis_master"
                            value="{{ $jenis_master }}" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="master_id"
                            class="required fs-6 fw-semibold mb-2">{{ ucfirst($jenis_master) }}</label>
                        <select name="master_id" id="master_id" class="form-select form-select-solid">
                            @foreach ($data_pk as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="anggaran" class="required fs-6 fw-semibold mb-2">Anggaran</label>
                        <input type="text" class="form-control" id="anggaran" name="anggaran" onkeyup="this.value=addcommas(this.value);">
                        <small style="color: green;">Koma menunjukkan angka ribuan, jangan gunakan titik sebagai pemisah angka ribuan</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="sasaran" class="required fs-6 fw-semibold mb-2">Sasaran
                            Strategis</label>
                        <input type="text" class="form-control" id="sasaran" name="sasaran">
                    </div>
                    <div class="form-group mb-4">
                        <label for="indikator" class="required fs-6 fw-semibold mb-2">Indikator
                            Kinerja</label>
                        <input type="text" class="form-control" id="indikator" name="indikator">
                    </div>
                    <div class="form-group mb-4">
                        <label for="target_kinerja_tahunan" class="required fs-6 fw-semibold mb-2">Target Kinerja
                            Tahunan
                            Kinerja</label>
                        <input type="text" class="form-control" id="target_kinerja_tahunan"
                            name="target_kinerja_tahunan">
                    </div>
                    <div class="form-group mb-4">
                        <label for="satuan" class="required fs-6 fw-semibold mb-2">Satuan
                            Kinerja</label>
                        <input type="text" class="form-control" id="satuan" name="satuan">
                    </div>
                    <div class="row">
                        <div class="form-group mb-4 col-3">
                            <label for="tw1" class="required fs-6 fw-semibold mb-2">TW I</label>
                            <input type="text" class="form-control" id="tw1" name="tw1">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw2" class="fs-6 fw-semibold mb-2">TW II</label>
                            <input type="text" class="form-control" id="tw2" name="tw2">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw3" class="fs-6 fw-semibold mb-2">TW III</label>
                            <input type="text" class="form-control" id="tw3" name="tw3">
                        </div>
                        <div class="form-group mb-4 col-3">
                            <label for="tw4" class="fs-6 fw-semibold mb-2">TW IV</label>
                            <input type="text" class="form-control" id="tw4" name="tw4">
                        </div>
                        <div class="form-group mb-12 col-12">
                            <small style="color: green;">Tri Wulan I - IV Masukkan Target tanpa Satuan</small>
                        </div>
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
