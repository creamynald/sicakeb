{{-- begin::fetching Pegawai data using yajra --}}
<script type="text/javascript">
    function getLastSegmentFromUrl(url) {
            return url.substring(url.lastIndexOf('/') + 1);
        }
    $(function() {
        let opd_id = getLastSegmentFromUrl(window.location.href);
            let routeUrl = "{{ route('pengukuran.get-data', ':opd_id') }}";
            routeUrl = routeUrl.replace(':opd_id', opd_id);

        var table = $('#pegawai').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            // url get data
            ajax:routeUrl,
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
