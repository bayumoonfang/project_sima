<?php

namespace App\Http\Controllers;

use App\Models\AssetModel;
use App\Models\LokasiModel;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AssetController extends Controller
{
    function getdata_asset()
    {
        $getModel = new AssetModel();
        $data = $getModel->getdata_asset();
        return $data;
    }

    function getcontent_asset()
    {

        $getModel = new SettingsModel();
        $getModel2 = new LokasiModel();
        $data_kategori = $getModel->getdata_kategori();
        $data_lokasi = $getModel2->getdata_lokasi();
        $data_merek = $getModel->getdata_merek();
        $data_divisi = $getModel->getdata_divisi();

        $result['page_name'] = "Master - Asset";
        $result['data_kategori'] = $data_kategori;
        $result['data_lokasi'] = $data_lokasi;
        $result['data_merek'] = $data_merek;
        $result['data_divisi'] = $data_divisi;
        $result['user_role'] = Session::get('karyawan_role');
        return  view('contents.content_asset', $result);
    }



    public function action_addasset(Request $request)
    {

        $data_nama = $request->get('data-nama');
        $data_kategori = $request->get('data-kategori');
        $data_lokasi = $request->get('data-lokasi');
        $data_merek = $request->get('data-merek');
        $data_command = $request->get('data-command');
        $data_status = $request->get('data-status');
        $data_id = $request->get('data-id');
        $file = $request->file('data-gambar');
        $data_cabang = $request->get('data-cabang');

    if ($data_command == 'add') {
        $validator = Validator::make($request->all(), [
            'data-nama' => 'required',
            'data-kategori' => 'required',
            'data-lokasi' => 'required',
            'data-merek' => 'required',
            'data-status' => 'required',
            'data-cabang' => 'required'
        ]);

    } else {
            $validator = Validator::make($request->all(), [
                'data-nama' => 'required',
                'data-kategori' => 'required',
                'data-lokasi' => 'required',
                'data-merek' => 'required',
                'data-status' => 'required'
            ]);
    }

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        //SET NUMBERSEQUENCE===========================
        $getlast_numseq = DB::table('tb_asset')->orderBy('asset_numseq', 'desc')->limit(1)->get();
        $result_count = $getlast_numseq->count();
        if ($result_count > 0) {
            $getlast_numseq2 = DB::table('tb_asset')->orderBy('asset_numseq', 'desc')->first();
            $numseq = $getlast_numseq2->asset_numseq + 1;
        } else {
            $numseq = 1;
        }
        $tahun = gmdate("Y", time() + 60 * 60 * 7);
        $bulan = gmdate("m", time() + 60 * 60 * 7);
        $numbersquence = "ASSET-" . substr($tahun, 2, 2) . $bulan . "-" . str_pad($numseq, '5', '0', STR_PAD_LEFT);
        //SET NUMBERSEQUENCE===========================

        $imageName = time() . '_' . $file->getClientOriginalName();


        if($data_command == 'add') {
            if ($request->hasFile('data-gambar')) {
                DB::table('tb_asset')->insert([
                    'asset_no' => $numbersquence,
                    'asset_nama' => $data_nama,
                    'asset_kategori' => $data_kategori,
                    'asset_cabang' => $data_cabang,
                    'asset_lokasi' => $data_lokasi,
                    'asset_merek' => $data_merek,
                    'asset_total' => 0,
                    'asset_status' => $data_status,
                    'asset_numseq' => $numseq,
                    'asset_gambar' => $imageName
                ]);

                // $file->getClientOriginalName();
                // $file->store('asset_img', 'public');
                $file->move(public_path('asset_img'), $imageName);
            } else {
                DB::table('tb_asset')->insert([
                    'asset_no' => $numbersquence,
                    'asset_nama' => $data_nama,
                    'asset_kategori' => $data_kategori,
                    'asset_cabang' => $data_cabang,
                    'asset_lokasi' => $data_lokasi,
                    'asset_merek' => $data_merek,
                    'asset_total' => 0,
                    'asset_status' => $data_status,
                    'asset_numseq' => $numseq
                ]);
            }
            $response_message = "Data berhasil ditambah";
        } else {

            DB::table('tb_asset')
                ->where('asset_id', $data_id)
                ->update(['asset_no' => $numbersquence,
                    'asset_nama' => $data_nama,
                    'asset_kategori' => $data_kategori,
                    'asset_lokasi' => $data_lokasi,
                    'asset_merek' => $data_merek,
                    'asset_status' => $data_status
                ]);

            $response_message = "Data berhasil diedit";

        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);

    }


    function action_deleteasset()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_asset')->where('asset_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }


}
