{{-- begin::fetching data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax: "{{ route('tujuan.index') }}",
            // begin::column in data table
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable : false
                },
                {
                    data: 'opd.nama', name: 'opd.nama'
                },
                {
                    data: 'nama', name: 'nama'
                },
                {
                    data: 'action', name: 'action',
                },
            ],
            // end::column in data table
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
        // begin::add Data
        $('#btnTambah').click(function() {
            // mengambil data opd_id yang sedang login
            var opd_id = '{{auth()->user()->opd_id}}';
            // empty the data in form
            $('#formData')[0].reset();
            // empty the data ID
            $('#dataId').val('');
            // memilih opd_id berdasarkan user yang login
            $('#opd_id').val(opd_id);
            // open modal
            $('#formModal').modal('show');
        });
        // end::add data

        // begin::edit data
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            // url get data based on id
            $.get('admin/tujuan/' + id, function(data) {
                // begin::fill value based on id from url to form
                $('#dataId').val(data.id);
                $('#opd_id').val(data.opd_id);
                $('#nama').val(data.nama);
                // end::fill value based on id from url to form
                // open modal
                $('#formModal').modal('show');
            });
        });
        // end::edit data

        // begin::save data
        $('#formData').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                // url to save the data
                url: 'admin/tujuan/save',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#formModal').modal('hide');
                    // begin::swall alert
                    Swal.fire({
                        title: 'Tersimpan!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: true
                    }).then(() => {
                        // reload the data table
                        $('#myTable').DataTable().ajax.reload();
                    });
                // end::swall alert
                }
            });
        });
        // end::save data
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
                    url: '/admin/tujuan/' + id,
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
