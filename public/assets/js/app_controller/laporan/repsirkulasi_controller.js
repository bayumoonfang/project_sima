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
                        url: '/getdata_report_sirkulasi',
                        data : {
                            tglfrom : value1,
                            tglto : value2
                        },
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'pinjam_id', visible : false},
                        { data: 'pinjam_no', title: "No Peminjaman"},
                        { data: 'asset_nama', title: "Asset",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 200px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'karyawan_nama', title: "Peminjam"},
                        { data: 'pinjam_cabang', title: "Unit"},
                         { data: 'pinjam_tglpinjam', title: "Tgl Pinjam",
                            render: function(data, type, row) {
                                if(data == null) {
                                    return "-";
                                } else {
                                    return moment(data).format('DD-MM-YYYY');
                                }

                            }, },
                         { data: 'pinjam_estbalik', title: "Tgl Est. Kembali",
                            render: function(data, type, row) {
                                if(data == "0000-00-00" || data == null) {
                                    return "-";
                                } else {
                                    return moment(data).format('DD-MM-YYYY');
                                }

                            }, },
                         { data: 'pinjam_tglbalik', title: "Tgl Kembali",
                            render: function(data, type, row) {
                                if(data == null || data == "0000-00-00") {
                                    return "-";
                                } else {
                                    return moment(data).format('DD-MM-YYYY');
                                }

                            }, }
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

    function filter_sirkulasi() {
        var datefrom = $('.date_from_sirkulasi').val();
        var dateto = $('.date_to_sirkulasi').val();
        if(datefrom == "" || dateto == "") {
            error_alert("Tanggal harus diisi");
            return false;
        } else {
            render_data(datefrom, dateto);
        }

    }





