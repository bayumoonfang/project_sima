     $(document).ready(function() {
        render_data();
        get_allcabang();
    });

    function clearall_input() {
        $('#myForm').find('input:text').val('');
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

        if(valueSelected != "") {
            $('.form-penanggungjawab').show();
              $.ajax({
                type: 'GET',
                url: '/get_karyawanbyunit',
                data : {
                    cabang_nama : $('.data-cabang').val()
                },
                success: function(response) {
                    let tab;
                    tab = '<option value="">Pilih Penanggung Jawab</option>';
                    for (let r of response) {
                        tab += '<option value="' + r.karyawan_id + '">' + r.karyawan_nama + '</option>';
                    }
                 document.getElementById('data-penanggungjawab').innerHTML = tab;
                }
            });

         }else {
           $('.form-penanggungjawab').hide();
           $('.data-penanggungjawab').val("");
        }

    });



    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_lokasi',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'lokasi_id' ,
                        render: function (data) {
                            return '<input type="checkbox" class = "checkbox-table checkbox-data" value = "'+data+'">'
                        }},
                        { data: 'lokasi_nama', title: "Lokasi", className: "table_link2" },
                        { data: 'lokasi_cabang', title: "Unit" },
                        { data: 'lokasi_sub', title: "Sub Lokasi" },
                        { data: 'karyawan_nama', title: "Penanggung Jawab" },
                        { data: 'lokasi_penanggungjawab', visible: false }

                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }


    function show_addform() {
        $('.add-lokasi').modal('show');
        $('.modal-title').text("Add Lokasi");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        $('.form-penanggungjawab').hide();
        $('.data-penanggungjawab').val("");
        $('.data-cabang').val("");
        clearall_input();
    }

     function action_addata(p) {
        if($('#myForm input[type="text"]').hasClass( "is-invalid" )) {
            error_alert("Mohon melengkapi data terlebih dahulu");
            return false;
        } else {
                        $.ajax({
                            type: "GET",
                            url: '/action_addlokasi',
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



    $('#myTable').on('click', 'td.table_link2', function(e) {
        var table = $('#myTable').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.add-lokasi').modal('show');
        $('.modal-title').text("Edit Lokasi");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");

        $('.data-id').val(tbl['lokasi_id']);
        $('.data-cabang').val(tbl['lokasi_cabang']);
        $('.data-divisi').val(tbl['lokasi_divisi']);
        $('.data-lokasi').val(tbl['lokasi_nama']);
        $('.data-sublokasi').val(tbl['lokasi_sub']);
        let tab;
        tab += '<option value="' + tbl['lokasi_penanggungjawab'] + '">' + tbl['karyawan_nama'] + '</option>';
            $.ajax({
                type: 'GET',
                url: '/get_karyawanbyunit',
                data : {
                    cabang_nama : tbl['lokasi_cabang']
                },
                success: function(response) {

                    for (let r of response) {
                        if(r.karyawan_id != tbl['lokasi_penanggungjawab']) {
                                    tab += '<option value="' + r.karyawan_id + '">' + r.karyawan_nama + '</option>';
                        }

                    }
                 document.getElementById('data-penanggungjawab').innerHTML = tab;
                 $('.form-penanggungjawab').show();
                }
            });

    });



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
                            url: '/action_deletelokasi',
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

