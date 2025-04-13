<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AssetModel extends Model
{
    function getdata_asset()
    {


        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                $getdata = DB::table('tb_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->orderBy('asset_nama', 'ASC')
                ->get();
        } else {
            $getdata = DB::table('tb_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->where('asset_cabang', Session::get('karyawan_cabang'))
                ->orderBy('asset_nama', 'ASC')
                ->get();
        }

        return $getdata;
    }
}
