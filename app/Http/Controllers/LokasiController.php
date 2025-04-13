<?php

namespace App\Http\Controllers;

use App\Models\LokasiModel;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    function getdata_lokasi()
    {
        $getModel = new LokasiModel();
        $data = $getModel->getdata_lokasi();
        return $data;
    }

    function getcontent_lokasi()
    {
        $getModel = new SettingsModel();
        $data_divisi = $getModel->getdata_divisi();
        $data_cabang = $getModel->getdata_cabang();

        $getModel2 = new LokasiModel();
        $data_suggestlokasi = $getModel2->get_suggestlokasi();
        $data_suggestsublokasi = $getModel2->get_suggestsublokasi();


        $result['page_name'] = "Master - Lokasi";
        $result['data_divisi'] = $data_divisi;
        $result['data_cabang'] = $data_cabang;
        $result['data_suggestlokasi'] = $data_suggestlokasi;
        $result['data_suggestsublokasi'] = $data_suggestsublokasi;

        return  view('contents.content_lokasi', $result);
    }



    public function action_addlokasi(Request $request)
    {
        $data_penanggungjawab = $request->get('data-penanggungjawab');
        $data_cabang = $request->get('data-cabang');
        $data_lokasi = $request->get('data-lokasi');
        $data_sublokasi = $request->get('data-sublokasi');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');

        $validator = Validator::make($request->all(), [
            'data-penanggungjawab' => 'required',
            'data-cabang' => 'required',
            'data-lokasi' => 'required',
            'data-sublokasi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        if ($command == "add") {
            DB::table('tb_lokasi')->insert([
                'lokasi_cabang' => $data_cabang,
                'lokasi_penanggungjawab' => $data_penanggungjawab,
                'lokasi_nama' => $data_lokasi,
                'lokasi_sub' => $data_sublokasi
            ]);
            $response_message = "Data berhasil ditambah";
        } else {
            DB::table('tb_lokasi')
            ->where('lokasi_id', $data_id)
                ->update([
                'lokasi_cabang' => $data_cabang,
                'data_penanggungjawab' => $data_penanggungjawab,
                'lokasi_nama' => $data_lokasi,
                'lokasi_sub' => $data_sublokasi
                ]);
            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }

    function action_deletelokasi()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_lokasi')->where('lokasi_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }



}
