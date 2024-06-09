    {{-- begin::fetching data using yajra --}}
    <script>
        $(document).ready(function() {
            $('#fileTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('file.index') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama', name: 'nama' },
                    { data: 'lokasi_file', name: 'lokasi_file' },
                    { data: 'tahun', name: 'tahun' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
                order: [[1, 'asc']]
            });
        });
    </script>
    {{-- end::fetching data using yajra --}}

    {{-- begin::create and edit js --}}
    <script>
        $(document).ready(function() {
            // Tambah Data
            $('#btnTambah').click(function() {
                // Mengambil data opd_id yang sedang login
                var opd_id = '{{auth()->user()->opd_id}}';
                // Menyimpan data opd_id yang valid
                if (opd_id) {
                    // Mengosongkan data di dalam form
                    $('#formData')[0].reset();
                    // Mengosongkan data ID
                    $('#dataId').val('');
                    // Memilih opd_id berdasarkan user yang login
                    $('#opd_id').val(opd_id);
                    // Membuka modal
                    $('#formModal').modal('show');
                } else {
                    console.error("Tidak dapat menemukan opd_id yang valid.");
                }
            });
    
            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                // URL untuk mendapatkan data berdasarkan id
                $.get('admin/file/' + id, function(data) {
                    // Mengisi nilai berdasarkan id dari URL ke dalam form
                    $('#dataId').val(data.id);
                    $('#opd_id').val(data.opd_id);
                    $('#tahun').val(data.tahun);
                    $('#jenis_file').val(data.jenis_file);
                    $('#nama').val(data.nama);
                    $('#lokasi_file').val(data.path);
                    // Membuka modal
                    $('#formModal').modal('show');
                });
            });
    
            // Simpan data
            $('#formData').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'admin/file/save',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#formModal').modal('hide');
                        Swal.fire({
                            title: 'Tersimpan!',
                            text: 'Data berhasil disimpan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: true
                        }).then(() => {
                            $('#myTable').DataTable().ajax.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log error response
                    }
                });
            });
        });
    </script>    
    {{-- end::create and edit js --}}

    {{-- begin::delete data using swall --}}
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Data akan terhapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('delete-form-' + itemId).submit();
                }
            });
        }
    </script>
    {{-- end::delete data using swall --}}