<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PublicModel extends Model
{
    function get_alljabatan()
    {
        $getdata = DB::table('jabatan')
            ->orderBy('jabatan_nama', 'ASC')
            ->get();
        return $getdata;
    }

    function get_allcabang()
    {

        if (Session::get('karyawan_role') == 'Super Admin') {
                $getdata = DB::table('cabang')
                ->orderBy('cabang_nama', 'ASC')
                ->get();
        } else {
                $getdata = DB::table('cabang')
                ->where('cabang_nama', Session::get('karyawan_cabang'))
                ->orderBy('cabang_nama', 'ASC')
                ->get();
        }

        return $getdata;
    }

    function get_alldivisi()
    {
        $getdata = DB::table('tb_setting_divisi')
        ->orderBy('settd_nama', 'ASC')
        ->get();
        return $getdata;
    }

    function get_allkaryawan()
    {
        $getdata = DB::table('karyawan')
        ->where('karyawan_id', '<>' , Session::get('karyawan_id'))
        ->where('karyawan_aktif', 'Aktif')
        ->orderBy('karyawan_nama', 'ASC')
        ->get();
        return $getdata;
    }

    function get_allkaryawan_user()
    {
        $getdata = DB::table('karyawan')
            ->where('karyawan_id', '<>', Session::get('karyawan_id'))
            ->where('karyawan_atasan_id', '<>', 0)
            ->where('karyawan_aktif', 'Aktif')
            ->orderBy('karyawan_nama', 'ASC')
            ->get();
        return $getdata;
    }


    function get_allasset()
    {
        $getdata = DB::table('tb_asset')
        ->where('asset_status', 'Available')
            ->orderBy('asset_nama', 'ASC')
            ->get();
        return $getdata;
    }


    function get_allasset_all()
    {
        $getdata = DB::table('tb_asset')
            ->orderBy('asset_nama', 'ASC')
            ->get();
        return $getdata;
    }



    function get_alllokasi_filter($lokasi)
    {
            $getdata = DB::table('tb_lokasi')
            ->where('lokasi_cabang', $lokasi)
            ->orderBy('lokasi_nama', 'ASC')
            ->get();
        return $getdata;
    }

    function get_allasset_filter($cabang)
    {
            $getdata = DB::table('tb_asset')
            ->where('asset_cabang', $cabang)
            ->orderBy('asset_nama', 'ASC')
            ->get();
        return $getdata;
    }


    function get_karyawanbyunit($cabang_nama)
    {
        $getdata = DB::table('karyawan')
            ->where('karyawan_cabang', $cabang_nama)
            ->whereNotIn('karyawan_role', ['Super Admin', 'Ketua Yayasan'])
            ->orderBy('karyawan_nama', 'ASC')
            ->get();
        return $getdata;
    }



    function get_allasset_filter_bypenanggungjawab()
    {
        $getdata = DB::table('tb_asset')
            ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
            ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
            ->where('lokasi_penanggungjawab', Session::get('karyawan_id'))
            ->orderBy('asset_nama', 'ASC')
            ->get();
        return $getdata;
    }


    function get_asset_bycabang()
    {
        $getdata = DB::table('tb_asset')
            ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
            ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
            ->where('asset_cabang', Session::get('karyawan_cabang'))
            ->orderBy('asset_nama', 'ASC')
            ->get();
        return $getdata;
    }



}
