    {{-- begin::fetching data using yajra --}}
    <script type="text/javascript">
        $(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('pelaporan') }}',
                    data: function (d) {
                        d.jenis_file = '{{ $_GET['jenis_file'] ?? '' }}';
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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