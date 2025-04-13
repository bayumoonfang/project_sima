     $(document).ready(function() {
        render_data();
        get_allatasan();
    });

    function clearall_input() {
        $('#myForm').find('input:text').val('');
        $('#myForm').find('select').val('');
        $('#myForm').find('input:number').val('');
    }

    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_approval',
                        dataSrc: "", type: 'GET', datatype: 'JSON' },
                    columns: [
                        {data : 'settappr_id' ,
                        render: function (data) {
                            return '<input type="checkbox" class = "checkbox-table checkbox-data" value = "'+data+'">'
                        }},
                        { data: 'karyawan_nama', title: "Nama Karyawan", className: "table_link2" },
                        { data: 'karyawan_jabatan', title: "Jabatan"},
                        { data: 'settappr_scheme', title: "Urutan"},
                        { data: 'settappr_keterangan', title: "Keterangan" },
                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }


    function show_addform() {
        $('.add-approval').modal('show');
        $('.modal-title').text("Add Approval");
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
                            url: '/action_addapproval',
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

        $('.add-approval').modal('show');
        $('.modal-title').text("Edit Approval");
        $('.data-command').val("edit");
        $('.modal-backdrop').addClass("showbackfull");
        $('.btn-action').data("command","edit");

        $('.data-id').val(tbl['settappr_id']);
        $('.data-karyawan').val(tbl['karyawan_nama']);
        $('.data-urutan').val(tbl['settappr_scheme']);
        $('.data-keterangan').val(tbl['settappr_keterangan']);
    });



    function get_allatasan() {
        $.ajax({
            type: 'GET',
            url: '/get_allkaryawan',
            success: function(response) {
                let tab;
                tab = '<option value="">Pilih Karyawan</option>';
                for (let r of response) {
                    tab += '<option value="' + r.karyawan_nama + '">' + r.karyawan_nama + '</option>';
                }
               $('.data-karyawan').append(tab);
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
                            url: '/action_deleteapproval',
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

