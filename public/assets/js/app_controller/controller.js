function show_loading() {
    $('.form-content').hide();
    $('.loadingme').show();
}

function hide_loading() {
    $('.loadingme').hide();
    $('.form-content').show();
}

function getcontent_dashboard(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
       $('.nav-atas').text("Dashboard");
      $.ajax({
        type: "GET",
        url: "/getcontent_dashboard",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}



function getcontent_user(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
       $('.nav-atas').text("Users");
      $.ajax({
        type: "GET",
        url: "/getcontent_user",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_lokasi(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
       $('.nav-atas').text("Lokasi");
      $.ajax({
        type: "GET",
        url: "/getcontent_lokasi",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}

function getcontent_asset(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Assets");
      $.ajax({
        type: "GET",
        url: "/getcontent_asset",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_pengadaan(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Pengadaan");
      $.ajax({
        type: "GET",
        url: "/getcontent_pengadaan",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_peminjaman(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Peminjaman");
      $.ajax({
        type: "GET",
        url: "/getcontent_peminjaman",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_pengembalian(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Pengembalian");
      $.ajax({
        type: "GET",
        url: "/getcontent_pengembalian",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}

function getcontent_settings_merek(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
       $('.nav-atas').text("Settings Merek");

      $.ajax({
        type: "GET",
        url: "/getcontent_settings_merek",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}

function getcontent_settings_kategori(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
$('.nav-atas').text("Settings Kategori");
      $.ajax({
        type: "GET",
        url: "/getcontent_settings_kategori",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_settings_jabatan(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
$('.nav-atas').text("Settings Kategori");
      $.ajax({
        type: "GET",
        url: "/getcontent_settings_jabatan",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}

function getcontent_settings_divisi(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
$('.nav-atas').text("Settings Divisi");
      $.ajax({
        type: "GET",
        url: "/getcontent_settings_divisi",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}



function getcontent_settings_cabang(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
      $('.nav-atas').text("Settings Cabang");
      $.ajax({
        type: "GET",
        url: "/getcontent_settings_cabang",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}



function getcontent_settings_approval(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-toogle').removeClass("active");
      $('.nav-settings').addClass("active");
      $('.nav-atas').text("Settings Approval");
      $.ajax({
        type: "GET",
        url: "/getcontent_settings_approval",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_report_asset(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Laporan Asset");
      $.ajax({
        type: "GET",
        url: "/getcontent_report_asset",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}


function getcontent_report_sirkulasi(el) {
      $('.nav-link').removeClass("active");
      $('.'+el+'').addClass("active");
      $('.nav-atas').text("Laporan Sirkulasi");
      $.ajax({
        type: "GET",
        url: "/getcontent_report_sirkulasi",
        dataType: "html",
        beforeSend: function (xhr) {
            show_loading();
        },
        timeout: 5000,
        statusCode: {
            404: function () {
                alert("File tidak ditemukan");
                hide_loading();
            }
        },
        success: function (response) {
            hide_loading();
            $(".form-content").html(response);
        }
    });
}



function success_alert(message) {
    $('.successalert').show();
    $('.messq').text(message);
    setInterval(function() {
        $('.successalert').hide(200);
    }, 5000);
}

function error_alert(message) {
    $('.erroralert').show();
    $('.messq').text(message);
    setInterval(function() {
        $('.erroralert').hide(200);
    }, 5000);
}


function closealert() {
    $('.erroralert').hide(400);
}


function check_valueempty() {
    $('#myForm input[type="text"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("is-invalid");
        } else{
            $(this).removeClass("is-invalid");
        }
    });

    $('#myForm input[type="email"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("is-invalid");
        } else{
            $(this).removeClass("is-invalid");
        }
    });

    $('#myForm select').blur(function(){
        if(!$(this).val()){
            $(this).addClass("is-invalid");
        } else{
            $(this).removeClass("is-invalid");
        }
    });
}


function clear_valueempty() {
    $('#myForm input[type="text"]').blur(function(){
        $(this).removeClass("is-invalid");
    });

    $('#myForm input[type="email"]').blur(function(){
        $(this).removeClass("is-invalid");
    });

    $('#myForm select').blur(function(){
         $(this).removeClass("is-invalid");
    });
}

