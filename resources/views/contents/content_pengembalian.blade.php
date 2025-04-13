
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




<div class="modal fade add-pengembalian" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="zoom: 90%;">
                     <div class="form-group">
                            <label for="exampleInputEmail1" class="label-style">Peminjaman</label>
                            <select class="form-control form-style data-peminjaman form-checkvalue" name = "data-peminjaman" id="data-peminjaman">
                            </select>
                      </div>
                      <div class="separator-1"></div>
         <div class="row">


<br><br>
            <div class="col">
                <form id = "myForm2" name="myForm2">
                      <input type="hidden" class= "no_peminjaman">
                      <div class="form-group">
                            <label for="exampleInputEmail1" class="label-style">Asset</label>
                            <input type="text" class="form-control form-style kembali-asset form-checkvalue" readonly>
                      </div>

                      <div class="form-group">
                            <label for="exampleInputEmail1" class="label-style">Peminjam</label>
                            <input type="text" class="form-control form-style kembali-peminjam form-checkvalue" readonly>
                      </div>



                      <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Tgl Pinjam</label>
                        <input type="text" class="form-control form-style kembali-tglpinjam form-checkvalue" readonly>
                      </div>

                                              <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Tgl Est. Dikembalikan</label>
                        <input type="text" class="form-control form-style kembali-tglestkembali form-checkvalue" readonly>
                      </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Keterangan</label>
                        <textarea class="form-control form-style kembali-keterangan form-checkvalue" style = "resize:none" readonly></textarea>
                      </div>

                </form>
            </div>
            <div class = "col">
                     <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Tgl Kembali</label>
                        <input type="text" class="form-control form-style kembali-tgldikembalikan form-checkvalue datepicker" name = "edit-tgldikembalikan" placeholder="Enter Tgl Dikembalikan">
                      </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary btn-action" onclick="action_pengembalian()">Save changes</button>
      </div>
    </div>
  </div>
</div>



 <section class="content">
      <div class="container-fluid">
        <div class = "div-btn-table">
            <button type="button" class="btn btn-primary btn-style" style="width: 192px;" onclick = "show_addform()">
                <i class="fa-solid fa-plus" style="padding-right:6px"></i> Add Pengembalian</button>
            {{-- <button type="button" class="btn btn-outline-danger" style="width: 110px;" onclick = "delete_data()">
                <i class="fa-solid fa-trash" style="padding-right:6px"></i>Hapus</button> --}}
        </div>
                    <table id="myTable" name="myTable" style="width:100%;zoom:0.8;white-space: nowrap;overflow: auto;margin-bottom: 10px;" class="table hover"></table>
      </div>

 </section>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/app_controller/pengembalian_controller.js') }}"></script>
