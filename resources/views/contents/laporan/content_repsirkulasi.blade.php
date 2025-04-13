
    <style>
        div.dt-container div.dt-layout-row div.dt-layout-cell { overflow: auto; } .list-group-item { border: 1px solid rgba(0, 0, 0, .125) !important; } .approval-nama { font-size: 19px; margin-bottom: 14px;    margin-top: -58px; } .approval-jabatan { position: absolute; margin-top: -10px; font-size: 13px; } .btn-status { position: absolute; margin-top: 98px; zoom: 65%;pointer-events: none } .btn-action2 { zoom: 69%; width: 100px; border-radius: 10px; } .div-apprnama { width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 68px; }
    .separator-1 {
        border-bottom: 1px solid #DDDDDD;
        height: 5px;
        width: 97%;
        margin-bottom: 30px
    }
    </style>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $page_name; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a onclick="getcontent_dashboard('nav-dashboard')" style="color:blue;cursor:pointer">Dashboard</a></li>
              <li class="breadcrumb-item active"><?php echo $page_name; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


 <section class="content">
      <div class="container-fluid">
        <div class = "div-btn-table" style="margin-bottom: 10px">
             <div class="form-group" style="display: flex">
                <input type="text" class="form-control date_from_sirkulasi datepicker" placeholder="Date From">
                <input type="text" class="form-control date_to_sirkulasi datepicker2" placeholder="Date To" style="margin-left: 15px">
                <button class="btn btn-primary" style="margin-left: 15px; width: 230px;" onclick="filter_sirkulasi()">Filter</button>
            </div>
        </div>
        <br> <br>
                    <table id="myTable" name="myTable" style="width:100%;zoom:0.8;white-space: nowrap;overflow: auto;margin-bottom: 10px;margin-top : 10px" class="table hover"></table>
      </div>

 </section>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/app_controller/laporan/repsirkulasi_controller.js') }}"></script>
