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
            // open modal
            $('#formModal').modal('show');
        });
        // end::add data

        // begin::edit data
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            // url get data based on id
            $.get('{{url("admin/target")}}/' + id, function(data) {
                // begin::fill value based on id from url to form
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
                url: '{{url("admin/target/save")}}',
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
                }
            });
        });
        // end::save data
    });

    $('#formModal').modal({
        backdrop: 'static',
        keyboard: false
    })
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
                    url: '{{url("/admin/target")}}/' + id,
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


{{-- Script untuk mengambil data berdasarkan pilihan jenis_master --}}
<script>
    document.getElementById('jenis_master').addEventListener('change', function () {
    var jenisMaster = this.value;
    var masterLabel = document.getElementById('master_label');
    var masterDropdown = document.getElementById('master_id');
    masterDropdown.innerHTML = '<option value="">Loading...</option>';

    switch (jenisMaster) {
        case 'program':
            masterLabel.textContent = 'Program';
            break;
        case 'kegiatan':
            masterLabel.textContent = 'Kegiatan';
            break;
        case 'subkegiatan':
            masterLabel.textContent = 'Subkegiatan';
            break;
        default:
            masterLabel.textContent = '';
            break;
    }

    // Berdasarkan jenis_master, lakukan pemanggilan AJAX ke rute yang sesuai
    fetch('{{ route('get-data') }}?jenis_master=' + jenisMaster)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            masterDropdown.innerHTML = '<option value="">Pilih ' + jenisMaster.charAt(0).toUpperCase() + jenisMaster.slice(1) + '</option>';
            data.forEach(function (item) {
                masterDropdown.innerHTML += '<option value="' + item.id + '">' + item.nama + '</option>';
            });
        });
});
</script>
{{-- End --}}
