{{-- begin::fetching Pegawai data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#pegawai').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax: "{{ route('realisasi.index') }}",
            // begin::column in data table
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'eselon',
                    name: 'eselon'
                },
                {
                    data: 'action',
                    name: 'action',
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
{{-- end::fetching Pegawai data using yajra --}}

{{-- begin::create and edit js --}}
<script>
    $(document).ready(function() {
        // begin::add Data
        $('#btnTambah').click(function() {
            // empty the data in form
            $('#formData')[0].reset();
            // empty the data ID
            $('#dataId').val('');
            // open modal
            $('#formModal').modal('show');
        });
        // end::add data

        // begin::edit data
        $(document).on('click', '.btn-edit', function() {
            var targetPk = $(this).attr('data-target-pk');
            var id = $(this).data('id');
            // url get data based on id
            $.get('{{ url('admin/realisasi') }}/' + id, function(data) {
                // begin::fill value based on id from url to form
                $('#dataId').val(data.id);
                $('#target_id').val(targetPk);
                $('#tw1').val(data.tw1);
                $('#tw2').val(data.tw2);
                $('#tw3').val(data.tw3);
                $('#tw4').val(data.tw4);
                $('#realisasi_anggaran').val(data.realisasi_anggaran);
                $('#pendukung').val(data.pendukung);
                $('#penghambat').val(data.penghambat);
                $('#solusi').val(data.solusi);
                $('#capaian').val(data.capaian);
                $('#realisasi_manual').val(data.realisasi_manual);
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
                url: '{{ url('admin/realisasi/save') }}',
                type: 'POST',
                data: formData,
                // Jika Sukses
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
                        location.reload();
                    });
                    // end::swall alert
                },
                // Jika Error
                error: function(response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        let errorMessages =
                        '<div style="text-align: left;"><ol>'; // Initialize errorMessages with the opening <ol> tag

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(message) {
                                    errorMessages += '<li>' + message +
                                    '</li>'; // Add each error as a list item
                                });
                            }
                        }

                        errorMessages += '</ol></div>'; // Close the ordered list after the loop

                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Validasi',
                            html: errorMessages,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                        });
                    }
                }
            });
        });
        // end::save data

        $('#formModal').modal({
            backdrop: 'static',
            keyboard: false
        })
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
                    url: '{{ url('/admin/realisasi') }}/' + id,
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
                                location.reload();
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

{{-- Script for add coma in thousand sparator --}}
<script type="text/javascript">
    function addcommas(x) {
        //remove commas
        retVal = x ? parseFloat(x.replace(/,/g, '')) : 0;

        //apply formatting
        return retVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
{{-- End --}}
