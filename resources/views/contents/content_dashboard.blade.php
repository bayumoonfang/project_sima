    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>


          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $jumlah_asset; ?></h3>

                <p>Asset</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a onclick="getcontent_asset('nav-asset')" class="nav-link nav-asset" style = "cursor: pointer"
                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $jumlah_pengadaan; ?></h3>

                <p>Pengadaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a onclick="getcontent_pengadaan('nav-pengadaan')" class="nav-link nav-pengadaan" style = "cursor: pointer"
                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <?php if($user_role != 'User') { ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $jumlah_lokasi; ?></h3>

                <p>Lokasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a onclick="getcontent_lokasi('nav-lokasi')" class="nav-link nav-lokasi" style = "cursor: pointer"
                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php } ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $jumlah_peminjaman; ?></h3>

                <p>Peminjaman</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a onclick="getcontent_peminjaman('nav-peminjaman')" class="nav-link nav-peminjaman" style = "cursor: pointer"
                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php if($user_role != 'User') { ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
               <h3><?php echo $jumlah_pengembalian; ?></h3>

                <p>Pengembalian</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a onclick="getcontent_pengembalian('nav-pengembalian')" class="nav-link nav-pengembalian" style = "cursor: pointer"
                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php } ?>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->


          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>



