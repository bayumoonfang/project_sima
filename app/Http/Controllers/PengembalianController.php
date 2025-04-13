<?php

namespace App\Http\Controllers;

use App\Models\LokasiModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    function getdata_pengembalian()
    {
        $getModel = new PengembalianModel();
        $data = $getModel->getdata_pengembalian();
        return $data;
    }


    function getcontent_pengembalian()
    {
        $getModel = new SettingsModel();
        $data_divisi = $getModel->getdata_divisi();

        $getModel2 = new LokasiModel();
        $data_suggestlokasi = $getModel2->get_suggestlokasi();
        $data_suggestsublokasi = $getModel2->get_suggestsublokasi();

        $result['page_name'] = "Sirkulasi - Pengembalian";
        $result['data_divisi'] = $data_divisi;
        $result['data_suggestlokasi'] = $data_suggestlokasi;
        $result['data_suggestsublokasi'] = $data_suggestsublokasi;
        $result['user_id'] = Session::get('karyawan_id');

        return  view('contents.content_pengembalian', $result);
    }




    public function action_pengembalian(Request $request)
    {
        $no_peminjaman = $request->get('no_peminjaman');
        $tgl_kembali = $request->get('tgl_kembali');


        $validator = Validator::make($request->all(), [
            'tgl_kembali' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        $getdata_peminjaman = DB::table('peminjaman')->where('pinjam_no', $no_peminjaman)->limit(1)->first();
        $getdata_asset = DB::table('tb_asset')->where('asset_id', $getdata_peminjaman->pinjam_asset)->limit(1)->first();

        DB::table('peminjaman')
        ->where('pinjam_no', $no_peminjaman)
        ->update([
            'pinjam_status' =>  'Dikembalikan',
            'pinjam_tglbalik' =>  $tgl_kembali
        ]);

        $stok_sisa = (int)$getdata_asset->asset_total + 1;
        DB::table('tb_asset')
        ->where('asset_id', $getdata_asset->asset_id)
        ->update([
            'asset_status' =>  'Available',
            'asset_total' => $stok_sisa
        ]);


        return response()->json([
            'status' => "success",
            'message' => "Pengembalian Berhasil",
        ]);
    }
}
