<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingsModel extends Model
{
    function getdata_merek()
    {

        $getdata = DB::table('tb_setting_merek')
            ->orderBy('settm_nama', 'ASC')
            ->get();

        return $getdata;
    }

    function get_suggestitem_merek()
    {
        $getdata = DB::table('tb_setting_merek')
        ->select('settm_nama', 'settm_id')
        ->groupByRaw('settm_nama, settm_id')
        ->orderBy('settm_nama', 'asc')
        ->get();
        return $getdata;
    }


    function getdata_kategori()
    {
        $getdata = DB::table('tb_setting_kategori')
        ->orderBy('settk_nama', 'ASC')
        ->get();
        return $getdata;
    }

    function getdata_divisi()
    {
        $getdata = DB::table('tb_setting_divisi')
        ->orderBy('settd_nama', 'ASC')
        ->get();
        return $getdata;
    }


    function getdata_cabang()
    {
        $getdata = DB::table('cabang')
        ->orderBy('cabang_nama', 'ASC')
        ->get();
        return $getdata;
    }

    function getdata_approval()
    {
        $getdata = DB::table('tb_setting_approval')
        ->join('karyawan', 'karyawan.karyawan_id' , '=', 'tb_setting_approval.settappr_person')
        ->orderBy('settappr_scheme', 'ASC')
        ->get();
        return $getdata;
    }


    function getdata_jabatan()
    {
        $getdata = DB::table('jabatan')
            ->orderBy('jabatan_nama', 'ASC')
            ->get();
        return $getdata;
    }

}
