     $(document).ready(function() {
        render_data();
    });

    function clearall_input() {
        $('#myForm').find('input:text').val('');
    }

    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_cabang',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'cabang_id' ,
                        render: function (data) {
                            return '<input type="checkbox" class = "checkbox-table checkbox-data" value = "'+data+'">'
                        }},
                        { data: 'cabang_nama', title: "Unit", className: "table_link2" },
                        { data: 'cabang_alamat', title: "Alamat"},
                        { data: 'cabang_notelp', title: "Telpon" },
                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }


    function show_addform() {
        $('.add-cabang').modal('show');
        $('.modal-title').text("Add Unit");
        $('.data-command').val("add");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("data_id","");
        clearall_input();
    }

     function action_addata(p) {
                      $.ajax({
                            type: "GET",
                            url: '/action_addcabang',
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



    $('#myTable').on('click', 'td.table_link2', function(e) {
        var table = $('#myTable').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.add-cabang').modal('show');
        $('.modal-title').text("Edit Unit");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");

        $('.data-id').val(tbl['cabang_id']);
        $('.data-cabang').val(tbl['cabang_nama']);
        $('.data-alamat').val(tbl['cabang_alamat']);
        $('.data-phone').val(tbl['cabang_notelp']);
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
                            url: '/action_deletecabang',
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

