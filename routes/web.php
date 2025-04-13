<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['LoginSession'])->group(function () {
    Route::get('/', [LoginController::class, 'auth']);
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/getcontent_dashboard', [HomeController::class, 'get_dashboard']);

    Route::get('/getcontent_user', [UserController::class, 'index']);
    Route::get('/getdata_users', [UserController::class, 'getdata_users']);
    Route::match(['get', 'post'], '/action_adduser', [UserController::class, 'action_adduser'])->name('action_adduser');
    Route::match(['get', 'post'], '/action_deleteuser', [UserController::class, 'action_deleteuser'])->name('action_deleteuser');

    Route::get('/getcontent_settings_merek', [SettingsController::class, 'getcontent_settings_merek']);
    Route::get('/getdata_merek', [SettingsController::class, 'getdata_merek']);
    Route::match(['get', 'post'], '/action_addmerek', [SettingsController::class, 'action_addmerek'])->name('action_addmerek');
    Route::match(['get', 'post'], '/action_deletemerek', [SettingsController::class, 'action_delete'])->name('action_deletemerek');

    Route::get('/getcontent_settings_kategori', [SettingsController::class, 'getcontent_settings_kategori']);
    Route::get('/getdata_kategori', [SettingsController::class, 'getdata_kategori']);
    Route::match(['get', 'post'], '/action_addkategori', [SettingsController::class, 'action_addkategori'])->name('action_addkategori');
    Route::match(['get', 'post'], '/action_deletekategori', [SettingsController::class, 'action_deletekategori'])->name('action_deletekategori');


    Route::get('/getcontent_settings_divisi', [SettingsController::class, 'getcontent_settings_divisi']);
    Route::get('/getdata_divisi', [SettingsController::class, 'getdata_divisi']);
    Route::match(['get', 'post'], '/action_adddivisi', [SettingsController::class, 'action_adddivisi'])->name('action_adddivisi');
    Route::match(['get', 'post'], '/action_deletedivisi', [SettingsController::class, 'action_deletedivisi'])->name('action_deletedivisi');


    Route::get('/getcontent_lokasi', [LokasiController::class, 'getcontent_lokasi']);
    Route::get('/getdata_lokasi', [LokasiController::class, 'getdata_lokasi']);
    Route::match(['get', 'post'], '/action_addlokasi', [LokasiController::class, 'action_addlokasi'])->name('action_addlokasi');
    Route::match(['get', 'post'], '/action_deletelokasi', [LokasiController::class, 'action_deletelokasi'])->name('action_deletelokasi');


    Route::get('/getcontent_asset', [AssetController::class, 'getcontent_asset']);
    Route::get('/getdata_asset', [AssetController::class, 'getdata_asset']);
    Route::match(['get', 'post'], '/action_addasset', [AssetController::class, 'action_addasset'])->name('action_addasset');
    Route::match(['get', 'post'], '/action_deleteasset', [AssetController::class, 'action_deleteasset'])->name('action_deleteasset');


    Route::get('/getcontent_settings_cabang', [SettingsController::class, 'getcontent_settings_cabang']);
    Route::get('/getdata_cabang', [SettingsController::class, 'getdata_cabang']);
    Route::match(['get', 'post'], '/action_addcabang', [SettingsController::class, 'action_addcabang'])->name('action_addcabang');
    Route::match(['get', 'post'], '/action_deletecabang', [SettingsController::class, 'action_deletecabang'])->name('action_deletecabang');


    Route::get('/getcontent_settings_approval', [SettingsController::class, 'getcontent_settings_approval']);
    Route::get('/getdata_approval', [SettingsController::class, 'getdata_approval']);
    Route::match(['get', 'post'], '/action_addapproval', [SettingsController::class, 'action_addapproval'])->name('action_addapproval');
    Route::match(['get', 'post'], '/action_deleteapproval', [SettingsController::class, 'action_deleteapproval'])->name('action_deleteapproval');

    Route::get('/getcontent_peminjaman', [PeminjamanController::class, 'getcontent_peminjaman']);
    Route::get('/getdata_peminjaman', [PeminjamanController::class, 'getdata_peminjaman']);
    Route::match(['get', 'post'], '/getdata_detailpeminjaman', [PeminjamanController::class, 'getdata_detailpeminjaman']);

    Route::get('/get_allpeminjaman_available', [PeminjamanController::class, 'get_allpeminjaman_available']);

    Route::match(['get', 'post'], '/action_addpeminjaman', [PeminjamanController::class, 'action_addpeminjaman'])->name('action_addpeminjaman');
    Route::match(['get', 'post'], '/appr_peminjaman', [PeminjamanController::class, 'appr_peminjaman'])->name('appr_peminjaman');




    Route::get('/getcontent_pengembalian', [PengembalianController::class, 'getcontent_pengembalian']);
    Route::get('/getdata_pengembalian', [PengembalianController::class, 'getdata_pengembalian']);
    Route::match(['get', 'post'], '/action_pengembalian', [PengembalianController::class, 'action_pengembalian'])->name('action_pengembalian');


    Route::get('/getcontent_pengadaan', [PengadaanController::class, 'getcontent_pengadaan']);
    Route::get('/getdata_pengadaan', [PengadaanController::class, 'getdata_pengadaan']);
    Route::match(['get', 'post'], '/action_addpengadaan', [PengadaanController::class, 'action_addpengadaan'])->name('action_addpengadaan');
    Route::match(['get', 'post'], '/appr_pengadaan', [PengadaanController::class, 'appr_pengadaan'])->name('appr_pengadaan');


    Route::get('/get_allasset_all', [PublicController::class, 'get_allasset_all']);
    Route::get('/get_allasset', [PublicController::class, 'get_allasset']);
    Route::get('/get_allapproval', [PeminjamanController::class, 'get_allapproval']);
    Route::get('/get_allapproval_pengadaan', [PengadaanController::class, 'get_allapproval_pengadaan']);


    Route::get('/getcontent_settings_jabatan', [SettingsController::class, 'getcontent_settings_jabatan']);
    Route::get('/getdata_jabatan', [SettingsController::class, 'getdata_jabatan']);
    Route::match(['get', 'post'], '/action_addjabatan', [SettingsController::class, 'action_addjabatan'])->name('action_addjabatan');
    Route::match(['get', 'post'], '/action_deletejabatan', [SettingsController::class, 'action_deletejabatan'])->name('action_deletejabatan');


    Route::get('/getcontent_report_asset', [LaporanController::class, 'getcontent_report_asset']);
    Route::match(['get', 'post'], '/getdata_report_asset', [LaporanController::class, 'getdata_report_asset']);

    Route::get('/getcontent_report_sirkulasi', [LaporanController::class, 'getcontent_report_sirkulasi']);
    Route::match(['get', 'post'], '/getdata_report_sirkulasi', [LaporanController::class, 'getdata_report_sirkulasi']);
});

Route::get('/auth', [LoginController::class, 'auth']);
Route::get('/do_login', [LoginController::class, 'do_login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/get_alljabatan', [PublicController::class, 'get_alljabatan']);
Route::get('/get_allcabang', [PublicController::class, 'get_allcabang']);
Route::get('/get_alldivisi', [PublicController::class, 'get_alldivisi']);
Route::get('/get_allkaryawan', [PublicController::class, 'get_allkaryawan']);
Route::get('/get_allkaryawan_user', [PublicController::class, 'get_allkaryawan_user']);
Route::match(['get', 'post'], '/get_alllokasi_filter', [PublicController::class, 'get_alllokasi_filter']);
Route::match(['get', 'post'], '/get_allasset_filter', [PublicController::class, 'get_allasset_filter']);
Route::match(['get', 'post'], '/get_karyawanbyunit', [PublicController::class, 'get_karyawanbyunit']);
Route::match(['get', 'post'], '/get_allasset_filter_bypenanggungjawab', [PublicController::class, 'get_allasset_filter_bypenanggungjawab']);
Route::match(['get', 'post'], '/get_asset_bycabang', [PublicController::class, 'get_asset_bycabang']);
