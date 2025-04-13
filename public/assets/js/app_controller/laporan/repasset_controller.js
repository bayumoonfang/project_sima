     $(document).ready(function() {
        render_data("","");
    });

    $( function() {
        $( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' });
        $(".datepicker2").datepicker({dateFormat : 'yy-mm-dd'});
    });

    function clearall_input() {
        $('#myForm').find('input:text').val('');
        $('#myForm').find('select').val('');
        $('#myForm').find('textarea').val('');
    }





    function render_data(value1,value2) {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_report_asset',
                        data : {
                            tglfrom : value1,
                            tglto : value2
                        },
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'asset_id' ,visible : false},
                        { data: 'asset_no', title: "No Assets"},
                        { data: 'asset_nama', title: "Asset",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 200px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'asset_kategori', title: "Kategori"},
                        { data: 'lokasi_nama', title: "Lokasi"},
                        { data: 'lokasi_sub', title: "Sub Lokasi"},
                        { data: 'asset_merek', title: "Merek"},
                         { data: 'asset_total', title: "Total Asset"},
                         { data: 'asset_status', title: "Status"},
                         { data: 'pengadaan_tglbeli', title: "Tgl Beli",
                            render: function(data, type, row) {
                                if(data == null) {
                                    return "-";
                                } else {
                                    return moment(data).format('DD-MM-YYYY');
                                }

                            }, },
                        { data: 'pengadaan_harga', title: "Harga Beli",
                            render : function (data) {
                                    return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        },
                    ], lengthMenu: [5],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },
                       layout: {
                            topStart: {
                                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                            }
                        }

                });
    }

    function filter_asset() {
        var datefrom = $('.date_from_asset').val();
        var dateto = $('.date_to_asset').val();
        if(datefrom == "" || dateto == "") {
            error_alert("Tanggal harus diisi");
            return false;
        } else {
            render_data(datefrom, dateto);
        }

    }





