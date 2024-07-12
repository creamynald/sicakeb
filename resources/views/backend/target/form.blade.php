<!-- Modal Tambah/Edit -->
<div class="modal fade modal-lg" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="formModalLabel">Form Data @urlSegment(2)</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <form id="formData" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="dataId" name="dataId">
                    <input type="hidden" id="pegawai_id" name="pegawai_id" value="{{ $pegawai->id }}">
                    <input type="hidden" id="has_child" name="has_child" value="1">
                    <input type="hidden" id="parent_id" name="parent_id">

                    <div class="form-group mb-4 form-jenis-child" style="display: none;">
                        <label for="tahun" class="fs-6 fw-semibold mb-2">Pilih Jenis</label>
                        <select name="jenis_child" id="jenis_child" class="form-select">
                            <option value="">pilih</option>
                            <option value="indikator">Indikator</option>
                            <option value="nonindikator">Program/Kegiatan/Sub Kegiatan</option>
                        </select>
                    </div>

                    <div class="indikator">

                        <div class="form-group mb-4">
                            <label for="tahun" class="required fs-6 fw-semibold mb-2">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" required>
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
                        <div class="row">
                            <div class="form-group mb-4 col-6">
                                <label for="target_kinerja_tahunan" class="required fs-6 fw-semibold mb-2">Target Kinerja Tahunan</label>
                                <input type="text" class="form-control" id="target_kinerja_tahunan"
                                    name="target_kinerja_tahunan">
                                    <small style="color: green;">Masukkan target tanpa satuan contoh (100 Dokumen) cukup masukkan angka 100 tanpa menyertakan kata Dokumen</small>
                            </div>
                            <div class="form-group mb-4 col-6">
                                <label for="satuan" class="required fs-6 fw-semibold mb-2">Satuan Kinerja</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan">
                                    <small style="color: green;">Jika terdapat pengganti kata satuan menjadi simbol, gunakan simbol contoh (Persen) menjadi (%)</small>
                            </div>
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
                                <small style="color: green;">Jika bilangan desimal atau berkoma gunakan titik (.) sebagai pengganti koma (,)</small>
                                </br>
                                <small style="color: green;">Triwulan I - IV Masukkan Target tanpa Satuan</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="jenis_master" class="required fs-6 fw-semibold mb-2">Jenis Master</label>
                        <select name="jenis_master" id="jenis_master" class="form-select">
                            <option value="">Pilih Jenis</option>
                            <option value="program">Program</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="subkegiatan">Subkegiatan</option>
                        </select>
                    </div>

                    <div class="form-group mb-4" id="form-select-master">
                        <label for="master_id" class="required fs-6 fw-semibold mb-2" id="master_label">Pilih Janis Master</label>
                        <select name="master_id" id="master_id" class="form-select" data-control="select2" data-dropdown-parent="#form-select-master">
                            <!-- Opsi akan ditambahkan melalui JavaScript -->
                        </select>
                    </div>


                    <div class="form-group mb-4">
                        <label for="anggaran" class="required fs-6 fw-semibold mb-2">Anggaran</label>
                        <input type="text" class="form-control" id="anggaran" name="anggaran" onkeyup="this.value=addcommas(this.value);">
                        <small style="color: green;">Koma menunjukkan angka ribuan, jangan gunakan titik sebagai pemisah angka ribuan</small>
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
