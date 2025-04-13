<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PengembalianModel extends Model
{
    function getdata_pengembalian()
    {

        if (Session::get('karyawan_role') == 'Super Admin') {
            $getdata = DB::table('peminjaman')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                ->where('pinjam_status', 'Dikembalikan')
                ->orderBy('pinjam_id', 'DESC')
                ->get();
        } else {

                $getdata = DB::table('peminjaman')
                ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
                ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
                ->where('pinjam_cabang', Session::get('karyawan_cabang'))
                ->where('pinjam_status', 'Dikembalikan')
                ->orderBy('pinjam_id', 'DESC')
                ->get();
        }




        return $getdata;
    }
}
