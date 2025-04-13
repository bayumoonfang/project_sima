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


<div class="modal fade add-asset" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="exampleInputEmail1" class="label-style">Nama Asset</label>
                        <input type="text" class="form-control form-style data-nama form-checkvalue" name = "data-nama" placeholder="Enter Nama Asset">
                      </div>

                      <div class="form-group div-cabang">
                        <label for="exampleInputEmail1" class="label-style">Unit</label>
                        <select class="form-control form-style data-cabang form-checkvalue" id="exampleFormControlSelect1" name="data-cabang">
                        </select>
                      </div>

                    <div class="form-group div-lokasi">
                        <label for="exampleInputEmail1" class="label-style">Lokasi</label>
                        <select class="form-control form-style data-lokasi form-checkvalue" name="data-lokasi" id="datalokasi">
                        </select>
                      </div>



                     <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Kategori</label>
                        <select class="form-control form-style data-kategori form-checkvalue" id="exampleFormControlSelect1" name="data-kategori">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($data_kategori as $row) { ?>
                                <option value="<?= $row->settk_nama; ?>"><?= $row->settk_nama; ?></option>
                            <?php } ?>
                        </select>
                      </div>





                        <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Merek</label>
                        <select class="form-control form-style data-merek form-checkvalue" id="exampleFormControlSelect1" name="data-merek">
                            <option value="">Pilih Merek</option>
                            <?php foreach ($data_merek as $row3) { ?>
                                <option value="<?= $row3->settm_nama." ".$row3->settm_tipe; ?>"><?= $row3->settm_nama." ".$row3->settm_tipe; ?></option>
                            <?php } ?>
                        </select>
                      </div>


                     <div class="form-group jmlasset-form">
                        <label for="exampleInputEmail1" class="label-style">Jumlah Asset</label>
                        <input type="number" class="form-control form-style data-jumlah form-checkvalue" name = "data-jumlah" placeholder="Enter Jumlah Asset">
                      </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1" class="label-style">Status</label>
                        <select class="form-control form-style data-status form-checkvalue" id="exampleFormControlSelect1" name="data-status">
                            <option value="">Pilih Status</option>
                            <option value="Dipinjam">Dipinjam</option>
                           <option value="Available">Available</option>
                           <option value="Rusak">Rusak</option>
                           <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                        </select>
                      </div>



                     <div class="form-group form-uploadgbr">
                        <label for="exampleInputEmail1" class="label-style">Gambar</label>
                        <input type="file" class="form-control form-style data-gambar form-checkvalue" name = "data-gambar"  style = "border: none;margin-left: -11px;">
                      </div>

                     <div class="form-group form-gambaredit" style="display: none">
                        <label for="exampleInputEmail1" class="label-style">Gambar</label><br>
                        <a href="#" target="_blank" class="img-url form-style"></a>
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
            <?php if ($user_role != 'Ketua Yayasan') { ?>
                <button type="button" class="btn btn-primary btn-style" style="width: 135px;" onclick = "show_addform()">
                <i class="fa-solid fa-plus" style="padding-right:6px"></i> Add Data</button>


                 {{-- <button type="button" class="btn btn-outline-danger" style="width: 110px;" onclick = "delete_data()">
                <i class="fa-solid fa-trash" style="padding-right:6px"></i>Hapus</button> --}}
            <?php } ?>
        </div>
                    <table id="myTable" name="myTable" style="width:100%;zoom:0.8;white-space: nowrap;overflow: auto;margin-bottom: 10px;" class="table hover"></table>
      </div>

 </section>
<script src="{{ asset('js/app_controller/asset_controller.js') }}"></script>
