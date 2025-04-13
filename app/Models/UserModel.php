<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    function getdata_users()
    {

        if (Session::get('karyawan_role') == 'Super Admin' || Session::get('karyawan_role') == 'Ketua Yayasan') {
                 $getdata = DB::table('karyawan')
                ->orderBy('karyawan_nama', 'ASC')
                ->get();
        } else {
                $getdata = DB::table('karyawan')
                ->where('karyawan_cabang', Session::get('karyawan_cabang'))
                ->orderBy('karyawan_nama', 'DESC')
                ->get();
        }




        return $getdata;
    }
}
