     $(document).ready(function() {
        render_data();
        get_allcabang();
    });

    function clearall_input() {
        $('.data-nama').val("");
        $('.data-kategori').val("");
        $('.data-lokasi').val("");
        $('.data-merek').val("");
        $('.data-divisi').val("");
        $('.data-jumlah').val("");
        $('.data-status').val("");
        $('.data-command').val("");
        $('.data-gambar').val("");
        $('.data-cabang').val("");
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
               $('.data-cabang').append(tab);
            }
        });
    }



    $('.data-cabang').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $.ajax({
            type: 'GET',
            url: '/get_alllokasi_filter',
            data : {
                lokasi : valueSelected
            },
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Lokasi</option>';
                for (let r of response) {
                    tab += '<option value="' + r.lokasi_id +'">' + r.lokasi_nama + ', ' + r.lokasi_sub + '</option>';
                }
               document.getElementById('datalokasi').innerHTML = tab;
            }
        });

    });



    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_asset',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'asset_id' ,visible : false},
                        { data: 'asset_no', title: "No. Asset", className: "table_link2" },
                        { data: 'asset_nama', title: "Nama Asset" },
                        { data: 'asset_kategori', title: "Kategori" },
                        { data: 'asset_cabang', title: "Unit" },
                        { data: 'lokasi_nama', title: "Lokasi" },
                         { data: 'lokasi_sub', title: "Sub Lokasi" },
                        { data: 'asset_merek', title: "Merek" },
                        { data: 'asset_total', title: "Jumlah" },
                        { data: 'karyawan_nama', title: "Penanggung Jawab" },
                        { data: 'asset_status', title: "Status" },
                        { data: 'lokasi_id', visible: false },
                        { data: 'asset_gambar', visible: false }

                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }


        $('#myTable').on('click', 'td.table_link2', function(e) {
        var table = $('#myTable').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.add-asset').modal('show');
        $('.modal-title').text("Edit Asset");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");


        $('.data-gambar').attr('disabled','disabled');
        $('.data-jumlah').attr('disabled','true');
        $('.jmlasset-form').show();
        // $('.div-lokasi').hide();
        //  $('.div-cabang').hide();

        $('.data-id').val(tbl['asset_id']);
        $('.data-nama').val(tbl['asset_nama']);
        $('.data-kategori').val(tbl['asset_kategori']);
        $('.data-merek').val(tbl['asset_merek']);
        $('.data-jumlah').val(tbl['asset_total']);
        $('.data-status').val(tbl['asset_status']);
        $('.data-cabang').val(tbl['asset_cabang']);


        if(tbl['asset_gambar'] != null) {
            $('.form-uploadgbr').hide();
            $('.form-gambaredit').show();
            $('.img-url').text(tbl['asset_gambar']);
            $('.img-url').attr('href', '/asset_img/' + tbl['asset_gambar']+'');
        } else {
            $('.form-uploadgbr').show();
            $('.form-gambaredit').hide();
        }

   let tab;
   tab += '<option value="' + tbl['asset_lokasi'] +'">' + tbl['lokasi_nama'] + ', ' + tbl['lokasi_sub'] + '</option>';


          $.ajax({
            type: 'GET',
            url: '/get_alllokasi_filter',
            data : {
                lokasi : tbl['asset_cabang']
            },
            success: function(response) {
                for (let r of response) {
                    if(r.lokasi_id != tbl['asset_lokasi']) {
                            tab += '<option value="' + r.lokasi_id +'">' + r.lokasi_nama + ', ' + r.lokasi_sub + '</option>';
                    }

                }
               document.getElementById('datalokasi').innerHTML = tab;
            }
        });


    });


    function show_addform() {
        clearall_input();
        $('.add-asset').modal('show');
        $('.modal-title').text("Add Asset");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        $('.data-gambar').removeAttr('disabled','disabled');
         $('.jmlasset-form').hide();
          $('.div-lokasi').show();
          $('.div-cabang').show();
        $('.form-uploadgbr').show();
        $('.form-gambaredit').hide();

    }

     function action_addata(p) {
        var formData = new FormData();
                formData.append('data-nama', $('.data-nama').val());
                formData.append('data-kategori', $('.data-kategori').val());
                formData.append('data-lokasi', $('.data-lokasi').val());
                formData.append('data-merek', $('.data-merek').val());
                formData.append('data-jumlah', $('.data-jumlah').val());
                formData.append('data-status', $('.data-status').val());
                formData.append('data-gambar', $('.data-gambar').prop('files')[0]);
                formData.append('data-command', $('.data-command').val());
                formData.append('data-id', $('.data-id').val());
                formData.append('data-cabang', $('.data-cabang').val());

                        $.ajax({
                            type: "POST",
                            url: '/action_addasset',
                            contentType: 'multipart/form-data',
                            data: formData,
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







     function delete_data() {
            var arr = [];
            $(".checkbox-data:checked").each(function(){ arr.push($(this).val()); });
            if(arr == "") {  error_alert("Anda belum memilih data yang akan dihapus"); } else {
                Swal.fire({
                title: "Apakah anda yakin menghapus data ini ?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Hapus",
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: "GET",
                            url: '/action_deleteasset',
                            datatype : 'json',
                            data: { data: arr },
                            contentType: 'multipart/form-data', timeout: 10000,
                            statusCode: { 404: function() { error_alert("Request Timeout"); } },
                            success : function (response) {
                                if(response.status == "success") {
                                    render_data();
                                } else {  error_alert(response.message); }
                            }
                        });
                }
                });
            }
    }

