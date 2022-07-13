<!-- Ajax Datatable Serverside Data Product  -->
<script>
    var column_name = $(document).find('#tableProduct > thead > tr');
    let params = [];
    $(document).ready(function () {
        $('#tableProduct').DataTable({
            'language': {
                'lengtMenu': 'Tampilkan _MENU_ data per halaman',
                'zeroRecord': 'Maaf data tidak ditemukan',
                'info': 'Menampilan halaman _PAGE_ dari _PAGES_ halaman',
                'infoEmpty': 'Tidak ada data',
                'processing': 'Sedang memproses permintaan anda...',
                'infoFiltered': '(filter dari _MAX_ total data)',
                'searchPlaceholder': 'Cari data ?',
                "sSearch": "Cari :",
                'paginate': {
                    'first': 'Pertama',
                    'last': 'Terakhir',
                    'next': 'Selanjutnya',
                    'previous': 'Sebelumnya'
                }
            },
            "processing": true,
            "serverSide": true,
            'columnDefs': [{
                target: 0,
                orderable: false,
            }, {
                target: 0,
                orderable: false,
            }],
            "destroy": false,
            'order': [
                [0, 'DESC']
            ],
            'paging': true,
            'searching': true,
            'ajax': {
                "url": `{$BaseHref}Product/getDataProduct`,
                'data': function (d) {
                    d.filter_record = params;
                }
            },
            createRow: function (row, data, dataIndex) {
                // Set the data-title atribute
                column_name.find('th').each(function (key, val) {
                    $(row).find('td:eq(' + parseInt(key) + ')')
                        .attr('data-title', $(this).text());
                });
            },
            'deferRender': true
        });
    });

</script>
