@include('layouts.header')
@include('layouts.navbar')
@include('layouts.sidebarmenu')

{{-- sidebar-collapse --}}
<body class="hold-transition sidebar-mini">
  <div class="content-wrapper" style="overflow: auto">
    <div class="row justify-content-center loadingme" style="display: none">
        <div class="container" style="text-align: center;">
            <img src="{{ asset('img/loading-ico2.gif') }}" style="width: 115px;margin-top: 18%;"><br>
        </div>
    </div>
    <div class = "form-content">

    </div>
  </div>
  <input class="roleme" type = "hidden" value="<?php echo Session::get('karyawan_role'); ?>">

  <footer class="main-footer">
    <strong> Duakata Developer
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>



@include('layouts.footer')
<script>
    $(document).ready(function () {
        // if($('.roleme').val() == 'Admin') {
        //     getcontent_dashboard("nav-dashboard");
        // } else {
        //     getcontent_peminjaman('nav-peminjaman');
        // }
         getcontent_dashboard("nav-dashboard");

    });
</script>
