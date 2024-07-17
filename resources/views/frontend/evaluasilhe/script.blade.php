{{-- begin::fetching data using yajra --}}
<script type="text/javascript">
    function getLastSegmentFromUrl(url) {
            return url.substring(url.lastIndexOf('/') + 1);
        }
    $(function() {
        let opd_id = getLastSegmentFromUrl(window.location.href);
            let routeUrl = "{{ route('evaluasi.get-data', ':opd_id') }}";
            routeUrl = routeUrl.replace(':opd_id', opd_id);

        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            resposive: true,
            // url get data
            ajax:routeUrl,
            // begin::column in data table
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable : false
                },
                {
                    data: 'rekomendasi_lhe',
                    name: 'rekomendasi_lhe'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'tindak_lanjut',
                    name: 'tindak_lanjut'
                },
                {
                    data: 'target_penyelesaian',
                    name: 'target_penyelesaian'
                },
                {
                    data: 'progres',
                    name: 'progres'
                },
                {
                    data: 'bukti_dukung',
                    name: 'bukti_dukung'
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