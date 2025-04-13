     $(document).ready(function() {
        render_data();

    });

    $( function() {
        $( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' });
    });

    $('.data-peminjaman').on('change', function() {

        $('#myForm2').find('input:text').attr('disabled', true);
        $('#myForm2').find('select').attr('disabled', true);
        $('#myForm2').find('textarea').attr('disabled', true);
        if(this.value == "") {
            $('#myForm2').find('input:text').val('');
            $('#myForm2').find('select').val('');
            $('#myForm2').find('textarea').val('');
        } else {
            $.ajax({
                type: "GET",
                url: '/getdata_detailpeminjaman',
                data: {
                    id_peminjaman : this.value
                },
                statusCode: { 404: function() { error_alert("Request Timeout"); } },
                success : function (response) {
                    $('.kembali-asset').val(response.kembali_asset);
                    $('.kembali-peminjam').val(response.kembali_peminjam);
                    $('.kembali-divisi').val(response.kembali_divisi);
                    $('.kembali-tglpinjam').val(response.kembali_tglpinjam);
                    $('.kembali-tglestkembali').val(response.kembali_tglestkembali);
                    $('.kembali-keterangan').val(response.kembali_keterangan);
                    $('.no_peminjaman').val(response.kembali_pinjamno)
                }
            });
        }

    });



    function get_allpeminjaman_available() {
        $.ajax({
            type: 'GET',
            url: '/get_allpeminjaman_available',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Peminjaman</option>';
                for (let r of response) {
                    tab += '<option value="' + r.pinjam_no + '">(' + r.pinjam_no + ') ' + r.asset_nama + '</option>';
                }
               document.getElementById("data-peminjaman").innerHTML = tab;
            }
        });
    }

    function show_addform() {
        $('.add-pengembalian').modal('show');
        $('.modal-title').text("Add Pengembalian");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        $('#myForm2').find('input:text').val('');
        $('#myForm2').find('select').val('');
        $('#myForm2').find('textarea').val('');
         get_allpeminjaman_available();
    }


    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_pengembalian',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'pinjam_id' ,visible : false},
                        { data: 'pinjam_no', title: "No Peminjaman"},
                        { data: 'asset_nama', title: "Asset",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 200px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                                            { data: 'lokasi_nama', title: "Lokasi",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 150px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                                            { data: 'lokasi_sub', title: "Sub Lokasi",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 150px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'pinjam_tglpinjam', title: "Tanggal Pinjam",
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }, },
                        {
                            data: 'pinjam_estbalik', title: "Est. Dikembalikan",
                            render: function (data, type, row) {
                                if(data == "0000-00-00") {
                                    return "-";
                                } else {
                                    return moment(data).format('DD-MM-YYYY');
                                }
                            },
                        },
                        { data: 'pinjam_tglbalik', title: "Tanggal Kembali",
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }, },
                        { data: 'karyawan_nama', title: "Peminjam",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "max-width : 150px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'pinjam_status', title: "Status" }
                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }




    function action_pengembalian() {
        Swal.fire({
            title: "Apakah anda yakin melakukan pengembalian atas peminjaman ini ?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Ya, Saya Yakin",
            }).then((result) => {
            if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: '/action_pengembalian',
                            data: {
                                no_peminjaman : $('.no_peminjaman').val(),
                                tgl_kembali : $('.kembali-tgldikembalikan').val()
                            },
                            statusCode: { 404: function() { error_alert("Request Timeout"); } },
                            success : function (response) {
                                if(response.status == "success") {
                                    render_data();
                                    $('.modal').modal('hide');
                                    success_alert(response.message);
                                } else {
                                    error_alert(response.message);
                                }

                            }
                        });
            }
        });
    }



    $('#myTable').on('click', 'td.table_link2', function(e) {
        var table = $('#myTable').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.edit-pengembalian').modal('show');
        $('.modal-title').text("Add Pengembalian");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");
        get_allapproval(tbl['pinjam_no']);

        $('.data-id').val(tbl['pinjam_no']);
        $('.edit-asset').val(tbl['pinjam_assetval']);
        $('.edit-peminjam').val(tbl['pinjam_peminjam']);
        $('.edit-divisi').val(tbl['pinjam_divisi']);
        $('.edit-tglpinjam').val(moment(tbl['pinjam_tglpinjam']).format('DD-MM-YYYY'));
        $('.edit-tglestkembali').val(moment(tbl['pinjam_tglbalik']).format('DD-MM-YYYY'));
        $('.edit-keterangan').val(tbl['pinjam_keterangan']);



        $('#myForm2').find('input:text').attr('disabled', true);
        $('#myForm2').find('select').attr('disabled', true);
        $('#myForm2').find('textarea').attr('disabled', true);
    });





