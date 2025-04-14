<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LaporanModel extends Model
{
    function getdata_report_asset($tglfrom, $tglto)
    {

 if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
        if($tglfrom == "" || $tglto == "") {
                $getdata = DB::table('tb_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                 ->join('pengadaan', 'pengadaan.pengadaan_asset', '=', 'tb_asset.asset_id')
                ->orderBy('pengadaan_tglbeli', 'DESC')
                ->get();
        } else {
                 $getdata = DB::table('tb_asset')
                 ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                                 ->join('pengadaan', 'pengadaan.pengadaan_asset', '=', 'tb_asset.asset_id')
                ->whereBetween('pengadaan_tglbeli', [$tglfrom, $tglto])
                ->orderBy('pengadaan_tglbeli', 'DESC')
                ->get();
        }

} else {

     if($tglfrom == "" || $tglto == "") {
                $getdata = DB::table('tb_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                                 ->join('pengadaan', 'pengadaan.pengadaan_asset', '=', 'tb_asset.asset_id')
                ->where('asset_cabang', Session::get('karyawan_cabang'))
                ->orderBy('pengadaan_tglbeli', 'DESC')
                ->get();
        } else {
                 $getdata = DB::table('tb_asset')
                 ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                                 ->join('pengadaan', 'pengadaan.pengadaan_asset', '=', 'tb_asset.asset_id')
                ->whereBetween('pengadaan_tglbeli', [$tglfrom, $tglto])
                ->where('asset_cabang', Session::get('karyawan_cabang'))
                ->orderBy('pengadaan_tglbeli', 'DESC')
                ->get();
        }

}

        return $getdata;
    }


    function getdata_report_sirkulasi($tglfrom, $tglto)
    {

 if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
        if ($tglfrom == "" || $tglto == "") {
            $getdata = DB::table('peminjaman')
           ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                ->orderBy('pinjam_tglpinjam', 'DESC')
                ->get();
        } else {
            $getdata = DB::table('peminjaman')

                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                                ->whereBetween('pinjam_tglpinjam', [$tglfrom, $tglto])
                ->orderBy('pinjam_tglpinjam', 'DESC')
                ->get();
        }
 } else {

        if ($tglfrom == "" || $tglto == "") {
            $getdata = DB::table('peminjaman')
           ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                ->where('pinjam_cabang', Session::get('karyawan_cabang'))
                ->orderBy('pinjam_tglpinjam', 'DESC')
                ->get();
        } else {
            $getdata = DB::table('peminjaman')

                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                                ->whereBetween('pinjam_tglpinjam', [$tglfrom, $tglto])
                ->where('pinjam_cabang', Session::get('karyawan_cabang'))
                ->orderBy('pinjam_tglpinjam', 'DESC')
                ->get();
        }

 }

        return $getdata;
    }


}
