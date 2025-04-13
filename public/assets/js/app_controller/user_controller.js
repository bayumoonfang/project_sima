     $(document).ready(function() {
        render_data();
        get_allcabang();
        check_valueempty();
    });

 function delete_user() {
            var arr = [];
            $(".checkbox-karyawan:checked").each(function(){ arr.push($(this).val()); });
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
                            url: '/action_deleteuser',
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


    function clearall_input() {
        $('.user-email').val("");
        $('#myForm').find('input:text').val('');
        $('.myForm2').find('input:text').val('');
        $('#myForm').find('select').val('');
        $('.myForm2').find('select').val('');
    }



    function show_adduser() {
        $('.addUser').modal('show');
        $('.modal-backdrop').addClass("showbackfull");
        $('.modal-title').text("Add User");
        $('.btn-action').data("command","add");
        $('.btn-action').data("karyawan_nik","");
        $('.user-password').get(0).type = 'text';
        $('.user-password').removeAttr('disabled','disabled');
        clear_valueempty();
        clearall_input();

    }


    $('.user-role').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        if(valueSelected == "Super Admin" || valueSelected == "Ketua Yayasan") {
            $('.div-cabang').hide();
        }else {
            $('.div-cabang').show();
        }

    });



    function action_adduser(p) {
                        var formData = new FormData();
                        formData.append('user_nama', $('.user-nama').val());
                        formData.append('user_cabang', $('.user-cabang').val());
                        formData.append('user_status', $('.user-status').val());
                        formData.append('user_email', $('.user-email').val());
                        formData.append('user_name', $('.user-name').val());
                        formData.append('user_password', $('.user-password').val());
                        formData.append('user_role', $('.user-role').val());
                        formData.append('command', $(p).data('command'));
                        formData.append('karyawan_nik', $(p).data('karyawan_nik') );

                        $.ajax({
                            type: "POST",
                            url: '/action_adduser',
                            contentType: 'multipart/form-data',
                            cache: false, contentType: false, processData: false, timeout: 10000,
                            data: formData,
                            statusCode: {
                                404: function() {
                                    error_alert("Request Timeout");
                                }
                            },
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
               $('.user-cabang').append(tab);
            }
        });
    }





    $('.table_user').on('click', 'td.table_link2', function(e) {
        var table = $('.table_user').DataTable();
        var data = table.row($(this).parents('tr')).data();
        tmptable = data;
        var tbl = tmptable;

        $('.addUser').modal('show');
        $('.modal-backdrop').addClass("showbackfull");
        $('.modal-title').text("Edit User");
        $('.btn-action').data("command","edit");
        $('.btn-action').data("karyawan_nik",tbl['karyawan_nik']);
        $('.user-password').get(0).type = 'password';
        $('.user-password').attr('disabled','disabled');


        $('.user-nama').val(tbl['karyawan_nama']);
        $('.user-cabang').val(tbl['karyawan_cabang']);
        $('.user-status').val(tbl['karyawan_aktif']);
        $('.user-email').val(tbl['karyawan_email']);
        $('.user-name').val(tbl['karyawan_username']);
        $('.user-password').val(tbl['karyawan_password']);
        $('.user-role').val(tbl['karyawan_role']);

        if(tbl['karyawan_role'] == "Super Admin") {
            $('.div-cabang').hide();
        } else if(tbl['karyawan_role'] == "Admin") {
            $('.div-cabang').show();
        }else {
            $('.div-cabang').show();
        }


    });



    function render_data() {
                    $('#myTable').DataTable({
                    destroy: true,
                    ajax: {
                        url: '/getdata_users',
                        dataSrc: "", type: 'GET', datatype: 'JSON'
                    },
                    columns: [
                        {data : 'karyawan_id' ,
                        render: function (data) {
                            return '<input type="checkbox" class = "checkbox-table checkbox-karyawan" value = "'+data+'">'
                        }},
                        {data: 'karyawan_password', visible: false},
                        { data: 'karyawan_nik', title: "NIK", className: "table_link2" },
                        { data: 'karyawan_nama', title: "Nama Karyawan" },
                        { data: 'karyawan_username', title: "Username"},
                        { data: 'karyawan_cabang', title: "Cabang"},
                        { data: 'karyawan_email',title: "Email" },
                        { data: 'karyawan_role', title: "Role" },
                        { data: 'karyawan_aktif', title: "Status" },

                    ], lengthMenu: [8],
                    "oLanguage": {
                        "sEmptyTable": "Tidak ada data ditemukan", "bStateSave": true,
                        "oPaginate": { "sPrevious": "Sebelum", "sNext": "Berikut"}
                    },

                });
    }
