<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PeminjamanModel extends Model
{
    function getdata_peminjaman()
    {

        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
            $getdata = DB::table('peminjaman')
            ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
            ->orderBy('pinjam_id', 'DESC')
            ->get();
        } else {
                $getdata = DB::table('peminjaman')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                ->where('pinjam_cabang', Session::get('karyawan_cabang'))
                ->orderBy('pinjam_id', 'DESC')
                ->get();
        }

        return $getdata;
    }

    function get_allpeminjaman_available()
    {


        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Kepala Yayasan') {
            $getdata = DB::table('peminjaman')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->where('pinjam_status', 'Dipinjam')
                ->orderBy('pinjam_id', 'DESC')
                ->get();
        } else {
                $getdata = DB::table('peminjaman')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->where('lokasi_penanggungjawab', Session::get('karyawan_id'))
                ->where('pinjam_status', 'Dipinjam')
                ->orderBy('pinjam_id', 'DESC')
                ->get();
        }



        return $getdata;
    }



    function get_allapproval($id_peminjaman)
    {

        $getdata = DB::table('peminjaman')
        ->join('peminjaman_approval', 'peminjaman_approval.pinjamappr_no' ,'=', 'peminjaman.pinjam_no')
        ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman_approval.pinjamappr_person')
        ->where('pinjam_no', $id_peminjaman)
        ->orderBy('pinjamappr_scheme', 'ASC')
        ->get();
        return $getdata;
    }

}
