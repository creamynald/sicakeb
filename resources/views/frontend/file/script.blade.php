{{-- begin::fetching data using yajra --}}
<script type="text/javascript">
    function getLastSegmentFromUrl(url) {
            return url.substring(url.lastIndexOf('/') + 1);
        }
    $(function() {
        let opd_id = getLastSegmentFromUrl(window.location.href);
            let routeUrl = "{{ route('pelaporan.get-data', ':opd_id') }}";
            routeUrl = routeUrl.replace(':opd_id', opd_id);

        var table = $('#fileTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax:routeUrl,
            // begin::column in data table
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex' 
                },
                { 
                    data: 'nama', 
                    name: 'nama' 
                },
                { 
                    data: 'lokasi_file', 
                    name: 'lokasi_file' 
                },
                { 
                    data: 'tahun', 
                    name: 'tahun' 
                },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false 
                }
            ]
            order: [[1, 'asc']]
        });
        // begin::search
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
        // end::search
    });
</script>
{{-- end::fetching data using yajra --}}