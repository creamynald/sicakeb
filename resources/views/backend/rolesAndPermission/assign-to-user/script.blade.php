{{-- begin::fetching data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('assign-to-user.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'opd.nama',
                    name: 'opd.nama',
                    render: function(data, type, row) {
                        if (!data || data.length === 0) {
                            // Menggunakan class 'badge bg-primary text-white' untuk styling
                            return '<span class="badge bg-danger text-white">OPD Not Specified</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    // get role names from roles table
                    data: 'roles',
                    name: 'roles.name',
                    render: function(data, type, full, meta) {
                        return data.map(function(item) {
                            return '<span class="badge bg-primary text-white">' + item
                                .name + '</span>';
                        }).join(' ');
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ],
        });

        // begin::search
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
        // end::search
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
            $.get('admin/assignable/' + id, function(data) {
                $('#dataId').val(data.id);
                $('#role').val(data.role);
                $('#permissions').val(data.permissions);
                $('#formModal').modal('show');
            });
        });

        // Simpan Data
        $('#formData').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'admin/assignable/save',
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
                    url: '/admin/assignable/' + id,
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

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            // Check if datatable is properly initialized
            if (datatable) {
                datatable.search(e.target.value).draw();
            } else {
                console.error('Datatable is not properly initialized.');
            }
        });
    }
</script>
{{-- end::delete data using swall --}}
