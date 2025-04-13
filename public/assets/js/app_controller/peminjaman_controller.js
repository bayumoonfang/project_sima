     $(document).ready(function() {
        render_data();
get_asset_bycabang();

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




    function get_asset_bycabang() {
          $.ajax({
            type: 'GET',
            url: '/get_asset_bycabang',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Asset</option>';
                for (let r of response) {
                    tab += '<option value="' + r.asset_id + '">' + r.asset_nama + '</option>';
                }
               document.getElementById("data-asset").innerHTML = tab;
            }
        });
    }



        function get_alldivisi() {
        $.ajax({
            type: 'GET',
            url: '/get_alldivisi',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Divisi</option>';
                for (let r of response) {
                    tab += '<option value="' + r.settd_nama + '">' + r.settd_nama + '</option>';
                }
               $('.data-divisi').append(tab);
            }
        });
    }


    function get_allcabang() {
        $.ajax({
            type: 'GET',
            url: '/get_allcabang',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Unit</option>';
                for (let r of response) {
                    tab += '<option value="' + r.cabang_nama + '">' + r.cabang_nama + '</option>';
                }
               $('.data-unit').append(tab);
            }
        });
    }



    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_peminjaman',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        { data: 'pinjam_id', visible: false },
                        { data: 'pinjam_no', title: "No Peminjaman", className: "table_link2" },
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
                        { data: 'pinjam_tglpinjam', title: "Tanggal",
                        render: function(data, type, row) {
                            if(data == null || data == '0000-00-00') {
                                return "-";
                            } else {
                                return moment(data).format('DD-MM-YYYY');
                            }

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
                        { data: 'karyawan_nama', title: "Peminjam",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "max-width : 150px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'pinjam_cabang', title: "Unit" },
                        { data: 'pinjam_status', title: "Status" }
                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }


    function show_addform() {
        $('.add-peminjaman').modal('show');
        $('.modal-title').text("Add peminjaman");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        clearall_input();
    }

     function action_addata(p) {
        if($('#myForm input[type="text"]').hasClass( "is-invalid" )) {
            error_alert("Mohon melengkapi data terlebih dahulu");
            return false;
        } else {
                        $.ajax({
                            type: "GET",
                            url: '/action_addpeminjaman',
                            contentType: 'multipart/form-data',
                            data: $('#myForm').serialize(),
                            cache: false, contentType: false, processData: false, timeout: 10000,
                            statusCode: { 404: function() { error_alert("Request Timeout"); } },
                            success : function (response) {
                                if(response.status == "success") {
                                    render_data();
                                    clearall_input();
                                    $('.modal').modal('hide');
                                    success_alert(response.message);
                                } else {
                                    error_alert(response.message);
                                }

                            }
                        });
        }
    }



    function get_allapproval(value) {
        $.ajax({
            type: 'GET',
            url: '/get_allapproval',
            data : {
                id_peminjaman : value
            },
            success: function(response) {
                let tab;
                var tanggal;
                var btn_apprv;
                tab = '<h5>Daftar Persetujuan </h5>';
                for (let r of response) {
                    if(r.pinjamappr_dateapprv == null) {
                        tanggal = "-";
                    } else {tanggal = moment(r.pinjamappr_dateapprv).format('DD-MM-YYYY');}

                    if((r.pinjamappr_person == $('.user-id').val()) && r.pinjamappr_status == 'Menunggu' && r.pinjam_status == 'Menunggu Persetujuan') {
                        btn_apprv = '<button class="btn btn-primary badge-pill btn-action2" onclick = "appr_peminjaman(this)" data-id = "'+r.pinjamappr_id+'" data-scheme = "'+r.pinjamappr_scheme+'" data-command = "Setujui" style = "margin-right: -25px;">Setujui</button><button class="btn btn-danger badge-pill btn-action2" onclick = "appr_peminjaman(this)" data-id = "'+r.pinjamappr_id+'" data-scheme = "'+r.pinjamappr_scheme+'" data-command = "Tolak">Tolak</button>';
                    } else {btn_apprv = ''};

                    tab += '<li class="list-group-item d-flex justify-content-between align-items-center" style = "height:118px"><div class = "div-apprnama"><b class = "approval-nama">'+r.karyawan_nama+' </b></div><p class = "approval-jabatan">'+r.pinjamappr_role+'</p> <br><br><p class = "approval-jabatan" style = "margin-top : 28px">Tanggal : '+tanggal+'</p> <br><br><button class = "btn btn-secondary btn-status">'+r.pinjamappr_status+'</button>'+btn_apprv+'</li> ';
                }
                document.getElementById("li-approval").innerHTML = tab;
            }

        });

    }


    function appr_peminjaman(p) {
        var id_approval = $(p).data("id");
        var command = $(p).data("command");
        var scheme = $(p).data("scheme");
        Swal.fire({
            title: "Apakah anda yakin ingin "+command+" peminjaman ini ?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Ya, "+command+"",
            }).then((result) => {
            if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: '/appr_peminjaman',
                            data: {
                                id_approval : id_approval,
                                command : command,
                                scheme : scheme,
                                appr_no : $('.data-id').val()
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

        $('.edit-peminjaman').modal('show');
        $('.modal-title').text("Edit peminjaman");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");
        get_allapproval(tbl['pinjam_no']);

        $('.data-id').val(tbl['pinjam_no']);
        $('.edit-asset').val(tbl['asset_nama']);
        $('.edit-cabang').val(tbl['pinjam_cabang']);
        $('.edit-lokasi').val(tbl['lokasi_nama']);
        $('.edit-sublokasi').val(tbl['lokasi_sub']);
        $('.edit-peminjam').val(tbl['karyawan_nama']);
        $('.edit-tglpinjam').val(moment(tbl['pinjam_tglpinjam']).format('DD-MM-YYYY'));
        $('.edit-estkembali').val(moment(tbl['pinjam_estbalik']).format('DD-MM-YYYY'));
        $('.edit-keterangan').val(tbl['pinjam_keterangan']);



        $('#myForm2').find('input:text').attr('disabled', true);
        $('#myForm2').find('select').attr('disabled', true);
        $('#myForm2').find('textarea').attr('disabled', true);
    });





