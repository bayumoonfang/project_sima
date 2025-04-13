<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LokasiModel extends Model
{
    function getdata_lokasi()
    {


        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                $getdata = DB::table('tb_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->orderBy('lokasi_nama', 'ASC')
                ->get();
        } else {
                $getdata = DB::table('tb_lokasi')
                ->where('lokasi_cabang', Session::get('karyawan_cabang'))
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                ->orderBy('lokasi_nama', 'ASC')
                ->get();
        }

        return $getdata;
    }


    function get_suggestlokasi()
    {

        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                $getdata = DB::table('tb_lokasi')
                ->select('lokasi_nama', 'lokasi_id')
                ->groupByRaw('lokasi_nama, lokasi_id')
                ->orderBy('lokasi_nama', 'asc')
                ->get();
        } else {
                 $getdata = DB::table('tb_lokasi')
                ->select('lokasi_nama', 'lokasi_id')
                ->where('lokasi_cabang', Session::get('karyawan_cabang'))
                ->groupByRaw('lokasi_nama, lokasi_id')
                ->orderBy('lokasi_nama', 'asc')
                ->get();
        }



        return $getdata;
    }


    function get_suggestsublokasi()
    {

        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                $getdata = DB::table('tb_lokasi')
                ->select('lokasi_sub', 'lokasi_id')
                ->groupByRaw('lokasi_sub, lokasi_id')
                ->orderBy('lokasi_sub', 'asc')
                ->get();
        } else {
                $getdata = DB::table('tb_lokasi')
                ->select('lokasi_sub', 'lokasi_id')
                ->where('lokasi_cabang', Session::get('karyawan_cabang'))
                ->groupByRaw('lokasi_sub, lokasi_id')
                ->orderBy('lokasi_sub', 'asc')
                ->get();
        }


        return $getdata;
    }


}
