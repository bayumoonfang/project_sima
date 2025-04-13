<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a onclick="getcontent_dashboard('nav-dashboard')" class="brand-link nav-link nav-dashboard" style="cursor: pointer">
      {{-- <span class="brand-text font-weight-light">{{ config('variables.appName') }}</span> --}}
      <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 52px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info user-infoname">
          <a href="#" class="d-block">{{ Session::get('karyawan_nama') }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

         <li class="nav-item">
            <a onclick="getcontent_dashboard('nav-dashboard')" class="nav-link nav-dashboard" style="cursor: pointer">
              <i class="nav-icon fa-solid fa-table-columns"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

    <?php if (Session::get('karyawan_role') == 'Ketua Yayasan' || Session::get('karyawan_role') == 'Super Admin') { ?>
        <li class="nav-header">MASTER</li>
          <li class="nav-item">
            <a onclick="getcontent_user('nav-pengguna')" class="nav-link nav-pengguna" style="cursor: pointer">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>

<?php } ?>

 <?php if (Session::get('karyawan_role') == 'Ketua Yayasan' || Session::get('karyawan_role') == 'Super Admin') { ?>
          <li class="nav-item">
            <a onclick="getcontent_lokasi('nav-lokasi')" class="nav-link nav-lokasi" style="cursor: pointer">
              <i class="nav-icon fas fa-solid fa-location-dot"></i>
              <p>
                Lokasi
              </p>
            </a>
          </li>
<?php } ?>


          <li class="nav-item">
            <a onclick="getcontent_asset('nav-asset')" class="nav-link nav-asset" style="cursor: pointer">
              <i class="nav-icon fas fa-solid fa-cubes"></i>
              <p>
                Asset
              </p>
            </a>
          </li>

    <li class="nav-header">PENGADAAN</li>
          <li class="nav-item">
            <a onclick="getcontent_pengadaan('nav-pengadaan')" class="nav-link nav-pengadaan" style="cursor: pointer">
              <i class="nav-icon fa-solid fa-cart-flatbed"></i>
              <p>
                Pengadaan Asset
              </p>
                <?php if($jumlah_pengadaan != '0') { ?>
                    <span class="right badge badge-danger"><?php echo $jumlah_pengadaan; ?></span>
              <?php } ?>
            </a>
          </li>


        <li class="nav-header">SIRKULASI</li>
          <li class="nav-item">
            <a onclick="getcontent_peminjaman('nav-peminjaman')" class="nav-link nav-peminjaman" style="cursor: pointer">
              <i class="nav-icon fas fa-solid fa-clipboard-list"></i>
              <p>
                Peminjaman
              </p>
              <?php if($jumlah_peminjaman != '0') { ?>
                    <span class="right badge badge-danger"><?php echo $jumlah_peminjaman; ?></span>
              <?php } ?>
            </a>
          </li>

           <?php if (Session::get('karyawan_role') == 'User' || Session::get('karyawan_role') == 'Kepala Sekolah') { ?>
          <li class="nav-item">
            <a onclick="getcontent_pengembalian('nav-pengembalian')" class="nav-link nav-pengembalian" style="cursor: pointer">
              <i class="nav-icon fas fa-solid fa-repeat"></i>
              <p>
                Pengembalian
              </p>
            </a>
          </li>
          <?php } ?>




          <li class="nav-header">LAPORAN</li>



              <li class="nav-item">
                <a onclick="getcontent_report_asset('nav-repasset')" class="nav-link nav-repasset" style="cursor: pointer">
                  <i class="nav-icon fas fa-solid fa-clipboard"></i>
                  <p>Assets</p>
                </a>
              </li>

               <li class="nav-item">
                <a onclick="getcontent_report_sirkulasi('nav-reppeminjaman')" class="nav-link nav-reppeminjaman" style="cursor: pointer">
                 <i class="nav-icon fas fa-solid fa-clipboard"></i>
                  <p>Sirkulasi</p>
                </a>
              </li>


               <li class="nav-header">LAINNYA</li>

          <?php if (Session::get('karyawan_role') == 'Super Admin') { ?>
           <li class="nav-item">
            <a href="#" class="nav-link nav-toogle nav-settings">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              {{-- <li class="nav-item">
                <a onclick="getcontent_settings_approval('nav-approval')" class="nav-link nav-approval" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval</p>
                </a>
              </li>


              <li class="nav-item">
                <a onclick="getcontent_settings_jabatan('nav-jabatan')" class="nav-link nav-jabatan" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li> --}}


              <li class="nav-item">
                <a onclick="getcontent_settings_cabang('nav-cabang')" class="nav-link nav-cabang" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="getcontent_settings_merek('nav-merek')" class="nav-link nav-merek" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merek</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="getcontent_settings_kategori('nav-kategori')" class="nav-link nav-kategori" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a onclick="getcontent_settings_divisi('nav-divisi')" class="nav-link nav-divisi" style="cursor: pointer">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <?php } ?>


           <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


