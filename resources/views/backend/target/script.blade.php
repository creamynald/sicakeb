{{-- begin::fetching Pegawai data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#pegawai').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax: "{{ route('target.index') }}",
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

{{-- begin::fetching Rincian Per Pegawawi data using yajra --}}
<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax: "{{ route('target.index') }}",
            // begin::column in data table
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'anggaran',
                    name: 'anggaran'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
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
{{-- end::fetching data using yajra --}}

{{-- begin::create and edit js --}}
<script>
    $(document).ready(function() {
        // begin::add Data
        $('#btnTambah').click(function() {
            // empty the data in form
            $('#formData')[0].reset();
            // empty the data ID
            $('#dataId').val('');
            // empty master id
            $('#master_id').val('');
            // empty parent id
            $('#parent_id').val('');
            // empty has child
            $('#has_child').val('');
            // d-none on select jenis child
            $('.form-jenis-child').css('display', 'none');
            // open modal
            $('#formModal').modal('show');
        });
        // end::add data

        // begin::add child
        $('.btn-tambah').on('click', function() {
            var id = $(this).data('id');
            $('#formData')[0].reset();
            $('#dataId').val('');
            $('#master_id').val('');
            $('#parent_id').val(id);
            $('.form-jenis-child').css('display', '');
            $('.indikator').css('display', 'none');
            $('.nonindikator').css('display', 'none');

            // Fetch data based on data-id
            $.get('{{ url('admin/target') }}/' + id, function(data) {
                $('#sasaran').val(data.sasaran);
                // $('#indikator').val(data.indikator);
                $('#tahun').val(data.tahun);
                $('#jenis_master').val(data.jenis_master);

                updateMasterDropdown(data.master_id);

                $('#jenis_child').change(function() {
                    if ($(this).val() == 'indikator') {
                        $('.indikator').css('display', '');
                        $('.nonindikator').css('display', '');
                        $('#indikator').val('');
                    } else if ($(this).val() == 'nonindikator') {
                        $('.indikator').css('display', 'none');
                        $('.nonindikator').css('display', '');
                        $('#indikator').val(data.indikator);
                        $('#target_kinerja_tahunan').val(data.target_kinerja_tahunan);
                        $('#satuan').val(data.satuan);
                    }
                });
            });

            $('#formModal').modal('show');


        });
        // end::add child

        // begin::edit data
        $(document).on('click', '.btn-edit', function() {
            $('#formData')[0].reset();
            var id = $(this).data('id');
            var parentId = $(this).data('parent-id');

            if (parentId) {
                $('.form-jenis-child').css('display', '');
                $('.indikator').css('display', '');
            } else {
                $('.form-jenis-child').css('display', 'none');
            }

            // url get data based on id
            $.get('{{ url('admin/target') }}/' + id, function(data) {
                // begin::fill value based on id from url to form
                $('#parent_id').val(data.parent_id);
                $('#jenis_child').val(data.jenis_child);
                $('#dataId').val(data.id);
                $('#pegawai_id').val(data.pegawai_id);
                $('#jenis_master').val(data.jenis_master);
                $('#master_id').val(data.master_id);
                $('#tahun').val(data.tahun);
                $('#satuan').val(data.satuan);
                $('#indikator').val(data.indikator);
                $('#sasaran').val(data.sasaran);
                $('#tw1').val(data.tw1);
                $('#tw2').val(data.tw2);
                $('#tw3').val(data.tw3);
                $('#tw4').val(data.tw4);
                $('#anggaran').val(data.anggaran);
                $('#target_kinerja_tahunan').val(data.target_kinerja_tahunan);
                updateMasterDropdown(data.master_id);
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
                url: '{{ url('admin/target/save') }}',
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
                        location.reload();
                    });
                    // end::swall alert
                },
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
                    url: '{{ url('/admin/target') }}/' + id,
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
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let errorMessages = '';
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key].join('<br>') + '<br>';
                                }
                            }
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
