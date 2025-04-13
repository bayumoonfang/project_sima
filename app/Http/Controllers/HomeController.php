<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
   function index() {
        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
            $users = DB::table('peminjaman')
                ->where([
                ['pinjam_status', '<>', "Dikembalikan"],
                ])->get();

            $result_count = $users->count();


            $count_pengadaan = DB::table('pengadaan')
                ->where([
                    ['pengadaan_status', "Menunggu Persetujuan"],
                ])->get();

            $result_count_pengadaan = $count_pengadaan->count();


        } else {
            $users = DB::table('peminjaman')
                ->where([
                    ['pinjam_status', '<>', "Dikembalikan"],
                    ['pinjam_cabang', '=', Session::get('karyawan_cabang')]
                ])->get();

            $result_count = $users->count();


            $count_pengadaan = DB::table('pengadaan')
                ->where([
                    ['pengadaan_status', "Menunggu Persetujuan"],
                    ['pengadaan_unit', Session::get('karyawan_cabang')],
                ])->get();

            $result_count_pengadaan = $count_pengadaan->count();


        }

        $result['jumlah_peminjaman'] = $result_count;
        $result['jumlah_pengadaan'] = $result_count_pengadaan;

        return view('dashboard', $result);
   }

   function get_dashboard() {

    if(Session::get('karyawan_role') == "Super Admin" || Session::get('karyawan_role') == 'Ketua Yayasan') {
            $db_asset = DB::table('tb_asset');
            $result_asset = $db_asset->count();

            $db_lokasi = DB::table('tb_lokasi');
            $result_lokasi = $db_lokasi->count();

            $db_peminjaman = DB::table('peminjaman');
            $result_peminjaman = $db_peminjaman->count();

            $db_pengembalian = DB::table('peminjaman')->where('pinjam_status', 'Dikembalikan');
            $result_pengembalian = $db_pengembalian->count();


            $db_pengadaan = DB::table('pengadaan');
            $result_pengadaan = $db_pengadaan->count();


    } else {
            $db_asset = DB::table('tb_asset')
            ->where('asset_cabang', Session::get('karyawan_cabang'));
            $result_asset = $db_asset->count();

            $db_lokasi = DB::table('tb_lokasi')
            ->where('lokasi_cabang', Session::get('karyawan_cabang'));
            $result_lokasi = $db_lokasi->count();

            if(Session::get('karyawan_role') == 'User') {
                $db_peminjaman = DB::table('peminjaman')
                    ->where('pinjam_cabang', Session::get('karyawan_cabang'))
                    ->where('pinjam_peminjam', Session::get('karyawan_id'));
                $result_peminjaman = $db_peminjaman->count();
            } else {
                $db_peminjaman = DB::table('peminjaman')
                    ->where('pinjam_cabang', Session::get('karyawan_cabang'));
                $result_peminjaman = $db_peminjaman->count();
            }


            if (Session::get('karyawan_role') == 'User') {
                $db_pengadaan = DB::table('pengadaan')
                    ->where('pengadaan_unit', Session::get('karyawan_cabang'))
                    ->where('pengadaan_creator', Session::get('karyawan_nama'));
                $result_pengadaan = $db_pengadaan->count();
            } else {
                $db_pengadaan = DB::table('pengadaan')
                    ->where('pengadaan_unit', Session::get('karyawan_cabang'));
                $result_pengadaan = $db_pengadaan->count();
            }


            if (Session::get('karyawan_role') == 'User' || Session::get('karyawan_role') == 'Kepala Sekolah') {
                $db_pengembalian = DB::table('peminjaman')
                    ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                    ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                    ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                    ->where('pinjam_status', 'Dikembalikan')
                    ->where('lokasi_penanggungjawab', Session::get('karyawan_id'));
                $result_pengembalian = $db_pengembalian->count();
            } else     if (Session::get('karyawan_role') == 'Kepala Sekolah') {
                $db_pengembalian = DB::table('peminjaman')
                    ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                    ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                    ->where('pinjam_status', 'Dikembalikan')
                    ->where('pinjam_cabang', Session::get('karyawan_cabang'));
                $result_pengembalian = $db_pengembalian->count();
            } else {
                $db_pengembalian = DB::table('peminjaman')
                    ->where('pinjam_status', 'Dikembalikan');
                $result_pengembalian = $db_pengembalian->count();
            }


    }



        $result['jumlah_asset'] = $result_asset;
        $result['jumlah_lokasi'] = $result_lokasi;
        $result['jumlah_peminjaman'] = $result_peminjaman;
        $result['jumlah_pengembalian'] = $result_pengembalian;
        $result['jumlah_pengadaan'] = $result_pengadaan;
        $result['user_role'] = Session::get('karyawan_role');

        return  view('contents.content_dashboard', $result);
   }
}
