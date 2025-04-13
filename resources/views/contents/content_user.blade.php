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


<div class="modal fade addUser" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="zoom: 90%;">
         <div class="row">
            <div class="col">
                <form id = "myForm" name="myForm">

                      <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Nama Karyawan</label>
                        <input type="text" class="form-control form-style user-nama form-checkvalue" placeholder="Enter Nama Karyawan">
                      </div>


                     <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Role</label>
                        <select class="form-control form-style user-role form-checkvalue" id="exampleFormControlSelect1">
                            <option value="">Pilih Role</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="User">User</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                            <option value="Ketua Yayasan">Ketua Yayasan</option>
                        </select>
                      </div>

                      <div class="form-group div-cabang">
                        <label for="exampleInputEmail1" class="label-style">Unit</label>
                        <select class="form-control form-style user-cabang form-checkvalue" id="exampleFormControlSelect1">
                        </select>
                      </div>


                                        <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Status Karyawan</label>
                        <select class="form-control form-style user-status form-checkvalue" id="exampleFormControlSelect1">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                      </div>
</form>
            </div>
            <div class="col">
                 <form id = "myForm" class="myForm2" name="myForm">

                    {{-- <div class="form-group div-atasan">
                        <label for="exampleInputEmail1" class="label-style">Atasan</label>
                        <select class="form-control form-style user-atasan form-checkvalue" id="user-atasan">
                        </select>
                      </div> --}}


                                            <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Email</label>
                        <input type="email" class="form-control form-style user-email" placeholder="Enter Email Karyawan">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Username</label>
                        <input type="text" class="form-control form-style user-name form-checkvalue" placeholder="Enter Username Karyawan">
                      </div>


                                            <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Password</label>
                        <input type="text" class="form-control form-style user-password form-checkvalue" placeholder="Enter Password Karyawan">
                      </div>


                 </form>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-action" onclick="action_adduser(this)">Save changes</button>
      </div>
    </div>
  </div>
</div>



 <section class="content">
      <div class="container-fluid">

        <div class = "div-btn-table">
            <button type="button" class="btn btn-primary btn-style" style="width: 135px;" onclick = "show_adduser()">
                <i class="fa-solid fa-plus" style="padding-right:6px"></i> Add Data</button>
            <button type="button" class="btn btn-outline-danger" style="width: 110px;" onclick = "delete_user()">
                <i class="fa-solid fa-trash" style="padding-right:6px"></i>Hapus</button>
        </div>
                    <table id="myTable" name="myTable" style="width:100%;zoom:0.8;white-space: nowrap;overflow: auto;margin-bottom: 10px;" class="table hover table_user "></table>
      </div>

 </section>
<script src="{{ asset('js/app_controller/user_controller.js') }}"></script>
