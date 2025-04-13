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


<div class="modal fade add-approval" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
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
                      <input type="hidden" class = "data-command" name = "data-command">
                      <input type="hidden" class = "data-id" name="data-id">
                       <div class="form-group">
                            <label for="exampleInputEmail1" class="label-style">Karyawan</label>
                            <select class="form-control form-style data-karyawan form-checkvalue" name = "data-karyawan" id="exampleFormControlSelect1">
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Urutan</label>
                        <select class="form-control form-style data-urutan form-checkvalue" name = "data-urutan" id="exampleFormControlSelect1">
                            <option value="">Pilih Urutan</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                      </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Keterangan</label>
                        <input type="text" class="form-control form-style data-keterangan form-checkvalue" name = "data-keterangan" placeholder="Contoh: Persetujuan 1 ...">
                      </div>

                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-action" onclick="action_addata(this)">Save changes</button>
      </div>
    </div>
  </div>
</div>



 <section class="content">
      <div class="container-fluid">

        <div class = "div-btn-table">
            <button type="button" class="btn btn-primary btn-style" style="width: 135px;" onclick = "show_addform()">
                <i class="fa-solid fa-plus" style="padding-right:6px"></i> Add Data</button>
            <button type="button" class="btn btn-outline-danger" style="width: 110px;" onclick = "delete_data()">
                <i class="fa-solid fa-trash" style="padding-right:6px"></i>Hapus</button>
        </div>
                    <table id="myTable" name="myTable" style="width:100%;zoom:0.8;white-space: nowrap;overflow: auto;margin-bottom: 10px;" class="table hover"></table>
      </div>

 </section>
<script src="{{ asset('js/app_controller/settings/approval_controller.js') }}"></script>
