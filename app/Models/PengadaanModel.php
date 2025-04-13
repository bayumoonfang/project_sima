<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PengadaanModel extends Model
{
    function getdata_pengadaan()
    {

        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                $getdata = DB::table('pengadaan')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'pengadaan.pengadaan_asset')
                ->orderBy('pengadaan_id', 'DESC')
                ->get();
        } else {
                $getdata = DB::table('pengadaan')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'pengadaan.pengadaan_asset')
                ->where('pengadaan_unit', Session::get('karyawan_cabang'))
                ->orderBy('pengadaan_id', 'DESC')
                ->get();
        }



        return $getdata;
    }


    function get_allapproval_pengadaan($id_pengadaan)
    {

        $getdata = DB::table('pengadaan')
            ->join('pengadaan_approval', 'pengadaan_approval.pengadaanappr_no', '=', 'pengadaan.pengadaan_no')
            ->join('karyawan', 'karyawan.karyawan_id', '=', 'pengadaan_approval.pengadaanappr_person')
            ->where('pengadaan_no', $id_pengadaan)
            ->orderBy('pengadaanappr_scheme', 'ASC')
            ->get();
        return $getdata;
    }

}
