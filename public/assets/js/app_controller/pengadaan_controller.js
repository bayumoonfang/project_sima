     $(document).ready(function() {
        render_data();
        get_asset_bypenanggungjawa();

    });

    $( function() {
        $( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' });
    });



    function get_asset_bypenanggungjawa() {
          $.ajax({
            type: 'GET',
            url: '/get_allasset_filter_bypenanggungjawab',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Asset</option>';
                for (let r of response) {
                    tab += '<option value="' + r.asset_nama + '">' + r.asset_nama + '</option>';
                }
               document.getElementById("data-asset").innerHTML = tab;
            }
        });
    }





    function show_addform() {
        $('.add-pengadaan').modal('show');
        $('.modal-title').text("Add Pengadaan");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        $('#myForm2').find('input:text').val('');
        $('#myForm2').find('select').val('');
        $('#myForm2').find('textarea').val('');
         get_allpeminjaman_available();
        $('.edit-cabang').attr('disabled', false);
        $('.edit-cabang').hide();
        $('.edit-creator').hide();
        $('.edit-asset').attr('disabled', false);
        $('.edit-tglbeli').attr('disabled', false);
        $('.edit-harga').attr('disabled', false);
        $('.edit-jumlah').attr('disabled', false);
        $('.edit-keterangan').attr('disabled', false);
    }


    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_pengadaan',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'pengadaan_id', visible : false},
                        { data: 'pengadaan_no', title: "No Pengadaan", className: "table_link2" },
                        { data: 'pengadaan_unit', title: "Unit" },
                        { data: 'asset_nama', title: "Asset",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "width : 200px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                        { data: 'pengadaan_tglbeli', title: "Tgl Pengadaan",
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }, },
                        { data: 'pengadaan_jumlah', title: "Jumlah" },
                        { data: 'pengadaan_harga', title: "Harga" ,
                            render : function (data) {
                                    return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        },

                         { data: 'pengadaan_total', title: "Total" ,
                            render : function (data) {
                                    return (data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            }
                        },
                         { data: 'pengadaan_status', title: "Status" },

                        { data: 'pengadaan_creator', title: "Creator",
                            render : function (data) {
                                return '<div data-toggle="tooltip" data-placement="top" title="'+data+'" style = "max-width : 150px;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;cursor:pointer">'+data+'</div>';
                            }
                        },
                         { data: 'pengadaan_keterangan', visible : false},
                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }



    function get_allapproval_pengadaan(value) {
        $.ajax({
            type: 'GET',
            url: '/get_allapproval_pengadaan',
            data : {
                id_pengadaan : value
            },
            success: function(response) {
                let tab;
                var tanggal;
                var btn_apprv;
                tab = '<h5>Daftar Persetujuan </h5>';
                for (let r of response) {
                    if(r.pengadaanappr_dateapprv == null) {
                        tanggal = "-";
                    } else {tanggal = moment(r.pengadaanappr_dateapprv).format('DD-MM-YYYY');}

                    if((r.pengadaanappr_person == $('.user-id').val()) && r.pengadaanappr_status == 'Menunggu' && r.pengadaan_status == 'Menunggu Persetujuan') {
                        btn_apprv = '<button class="btn btn-primary badge-pill btn-action2" onclick = "appr_pengadaan(this)" data-id = "'+r.pengadaanappr_id+'" data-scheme = "'+r.pengadaanappr_scheme+'" data-command = "Setujui" style = "margin-right: -25px;">Setujui</button><button class="btn btn-danger badge-pill btn-action2" onclick = "appr_pengadaan(this)" data-id = "'+r.pengadaanappr_id+'" data-scheme = "'+r.pengadaanappr_scheme+'" data-command = "Tolak">Tolak</button>';
                    } else {btn_apprv = ''};

                    tab += '<li class="list-group-item d-flex justify-content-between align-items-center" style = "height:118px"><div class = "div-apprnama"><b class = "approval-nama">'+r.karyawan_nama+' </b></div><p class = "approval-jabatan">'+r.karyawan_role+'</p> <br><br><p class = "approval-jabatan" style = "margin-top : 28px">Tanggal : '+tanggal+'</p> <br><br><button class = "btn btn-secondary btn-status">'+r.pengadaanappr_status+'</button>'+btn_apprv+'</li> ';
                }
                document.getElementById("li-approval-pengadaan").innerHTML = tab;
            }

        });

    }


$('#myTable').on('click', 'td.table_link2', function(e) {
        var table = $('#myTable').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.edit-pengadaan').modal('show');
        $('.modal-title').text("Edit Pengadaan");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");
        get_allapproval_pengadaan(tbl['pengadaan_no']);
 $('.edit-cabang').show();
 $('.edit-creator').show();
        $('.data-id').val(tbl['pengadaan_no']);
        $('.edit-cabang').val(tbl['pengadaan_unit']);
        $('.edit-creator').val(tbl['pengadaan_creator']);
        $('.edit-asset').val(tbl['asset_nama']);
        $('.edit-tglbeli').val(moment(tbl['pengadaan_tglbeli']).format('DD-MM-YYYY'));
        $('.edit-harga').val(tbl['pengadaan_harga']);
        $('.edit-jumlah').val(tbl['pengadaan_jumlah']);
        $('.edit-keterangan').val(tbl['pengadaan_keterangan']);
        $('.edit-cabang').attr('disabled', true);
        $('.edit-asset').attr('disabled', true);
        $('.edit-tglbeli').attr('disabled', true);
        $('.edit-harga').attr('disabled', true);
        $('.edit-jumlah').attr('disabled', true);
        $('.edit-keterangan').attr('disabled', true);
        $('.edit-creator').attr('disabled', true);
    });



     function appr_pengadaan(p) {
        var id_approval = $(p).data("id");
        var command = $(p).data("command");
        var scheme = $(p).data("scheme");
        Swal.fire({
            title: "Apakah anda yakin ingin "+command+" pengadaan ini ?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Ya, "+command+"",
            }).then((result) => {
            if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: '/appr_pengadaan',
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




    function action_pengadaan() {
        Swal.fire({
            title: "Apakah anda yakin melakukan pengadaan atas asset ini ?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Ya, Saya Yakin",
            }).then((result) => {
            if (result.isConfirmed) {
                       $.ajax({
                            type: "GET",
                            url: '/action_addpengadaan',
                            contentType: 'multipart/form-data',
                            data: $('#myForm').serialize(),
                            cache: false, contentType: false, processData: false, timeout: 10000,
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







