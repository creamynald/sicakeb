{{-- begin::fetching data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('pegawai.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'opd.nama', name: 'opd.nama'
                },
                {
                    data: 'nama', name: 'nama'
                },
                {
                    data: 'nip', name: 'nip'
                },
                {
                    data: 'jabatan', name: 'jabatan'
                },
                {
                    data: 'golongan', name: 'golongan'
                },
                {
                    data: 'eselon', name: 'eselon'
                },
                {
                    data: 'action', name: 'action',
                },
            ],
        });
    });
</script>
{{-- end::fetching data using yajra --}}

{{-- begin::create and edit js --}}
<script>
    $(document).ready(function() {
        // Tambah Data
        $('#btnTambah').click(function() {
            $('#formData')[0].reset();
            // Kosongkan data ID
            $('#dataId').val('');
            $('#formModal').modal('show');
        });

        // Edit Data
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.get('admin/pegawai/' + id, function(data) {
                $('#dataId').val(data.id);
                $('#opd_id').val(data.opd_id);
                $('#nama').val(data.nama);
                $('#nip').val(data.nip);
                $('#jabatan').val(data.jabatan);
                $('#golongan').val(data.golongan);
                $('#eselon').val(data.eselon);
                $('#formModal').modal('show');
            });
        });

        // Simpan Data
        $('#formData').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'admin/pegawai/save',
                type: 'POST',
                data: formData,
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
                }
            });
        });
    });
</script>
{{-- begin::create and edit js --}}

{{-- begin::delete data using swall --}}
<script>
    function deleteItem(id) {
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
                // Send AJAX request to delete
                $.ajax({
                    url: '/admin/pegawai/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                $('#myTable').DataTable().ajax.reload();
                            });
                        }
                    }
                });
            }
        });
    }
</script>
{{-- end::delete data using swall --}}