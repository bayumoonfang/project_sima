<?php

namespace App\Http\Controllers;

use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    function getdata_merek()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_merek();
        return $data;
    }

    function getcontent_settings_merek()
    {

        $getModel = new SettingsModel();
        $data_suggestmerk = $getModel->get_suggestitem_merek();
        $result['page_name'] = "Settings - Merek";
        $result['data_suggestmerk'] = $data_suggestmerk;
        return  view('contents.settings.content_merek', $result);
    }


    public function action_addmerek(Request $request)
    {

        $data_merk = $request->get('data-merek');
        $data_tipe = $request->get('data-tipe');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');


        $validator = Validator::make($request->all(), [
            'data-merek' => 'required',
            'data-tipe' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }




        //SET NUMBERSEQUENCE===========================
        $getlast_numseq = DB::table('tb_setting_merek')->orderBy('settm_numseq', 'desc')->limit(1)->get();
        $result_count = $getlast_numseq->count();
        if ($result_count > 0) {
            $getlast_numseq2 = DB::table('tb_setting_merek')->orderBy('settm_numseq', 'desc')->first();
            $numseq = $getlast_numseq2->settm_numseq + 1;
        } else {
            $numseq = 1;
        }

        $tahun = gmdate("Y", time() + 60 * 60 * 7);
        $bulan = gmdate("m", time() + 60 * 60 * 7);
        $numbersquence = "SETTM" . substr($tahun, 2, 2) . $bulan . "-" . str_pad($numseq, '5', '0', STR_PAD_LEFT);
        //SET NUMBERSEQUENCE===========================


        if ($command == "add") {
            $checkduplicated = DB::table('tb_setting_merek')
            ->where('settm_tipe', $data_tipe)
            ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('tb_setting_merek')->insert([
                    'settm_no' => $numbersquence,
                    'settm_nama' => $data_merk,
                    'settm_tipe' => $data_tipe,
                    'settm_numseq' => $numseq
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            DB::table('tb_setting_merek')
            ->where('settm_no', $data_id)
                ->update([
                    'settm_tipe' => $data_tipe
                ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }


    function action_delete()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_setting_merek')->where('settm_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }




    function getdata_kategori()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_kategori();
        return $data;
    }

    function getcontent_settings_kategori()
    {
        $result['page_name'] = "Settings - Kategori";
        return  view('contents.settings.content_kategori', $result);
    }



    public function action_addkategori(Request $request)
    {

        $data_kategori = $request->get('data-kategori');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');

        $validator = Validator::make($request->all(), [
            'data-kategori' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        if ($command == "add") {
            $checkduplicated = DB::table('tb_setting_kategori')
                ->where('settk_nama', $data_kategori)
                ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('tb_setting_kategori')->insert([
                    'settk_nama' => $data_kategori
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            DB::table('tb_setting_kategori')
                ->where('settk_id', $data_id)
                ->update([
                    'settk_nama' => $data_kategori
                ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);



    }


    function action_deletekategori()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_setting_kategori')->where('settk_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }


    function getdata_divisi()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_divisi();
        return $data;
    }

    function getcontent_settings_divisi()
    {
        $result['page_name'] = "Settings - Divisi";
        return  view('contents.settings.content_divisi', $result);
    }


    public function action_adddivisi(Request $request)
    {

        $data_divisi = $request->get('data-divisi');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');

        $validator = Validator::make($request->all(), [
            'data-divisi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }


        if ($command == "add") {
            $checkduplicated = DB::table('tb_setting_divisi')
            ->where('settd_nama', $data_divisi)
                ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('tb_setting_divisi')->insert([
                    'settd_nama' => $data_divisi
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            DB::table('tb_setting_divisi')
            ->where('settd_id', $data_id)
                ->update([
                    'settd_nama' => $data_divisi
                ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }


    function action_deletedivisi()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_setting_divisi')->where('settd_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }



    function getdata_cabang()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_cabang();
        return $data;
    }

    function getcontent_settings_cabang()
    {
        $result['page_name'] = "Settings - Unit";
        return  view('contents.settings.content_cabang', $result);
    }



    public function action_addcabang(Request $request)
    {

        $data_cabang = $request->get('data-cabang');
        $data_alamat = $request->get('data-alamat');
        $data_phone = $request->get('data-phone');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');

        $validator = Validator::make($request->all(), [
            'data-cabang' => 'required',
            'data-alamat' => 'required',
            'data-phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }


        if ($command == "add") {
            $checkduplicated = DB::table('cabang')
            ->where('cabang_nama', $data_cabang)
            ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('cabang')->insert([
                    'cabang_nama' => $data_cabang,
                    'cabang_alamat' => $data_alamat,
                    'cabang_notelp' => $data_phone
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            DB::table('cabang')
            ->where('cabang_id', $data_id)
                ->update([
                'cabang_nama' => $data_cabang,
                'cabang_alamat' => $data_alamat,
                'cabang_notelp' => $data_phone
                ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }


    function action_deletecabang()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('cabang')->where('cabang_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }



    function getdata_approval()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_approval();
        return $data;
    }

    function getcontent_settings_approval()
    {
        $result['page_name'] = "Settings - Approval";
        return  view('contents.settings.content_approval', $result);
    }



    public function action_addapproval(Request $request)
    {

        $data_karyawan = $request->get('data-karyawan');
        $data_urutan = $request->get('data-urutan');
        $data_keterangan = $request->get('data-keterangan');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');


        $validator = Validator::make($request->all(), [
            'data-karyawan' => 'required',
            'data-urutan' => 'required',
            'data-keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }


        $getdata_karyawan = DB::table('karyawan')->where('karyawan_nama', $data_karyawan)->first();
        if ($command == "add") {
            $checkduplicated = DB::table('tb_setting_approval')
            ->where('settappr_scheme', $data_urutan)
                ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {

                DB::table('tb_setting_approval')->insert([
                    'settappr_person' => $getdata_karyawan->karyawan_id,
                    'settappr_scheme' => $data_urutan,
                    'settappr_keterangan' => $data_keterangan
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            $getdata_approval = DB::table('tb_setting_approval')->where('settappr_id', $data_id)->first();
            if($getdata_approval->settappr_scheme != $data_urutan) {
                     DB::table('tb_setting_approval')
                    ->where('settappr_id', $data_id)
                    ->update([
                        'settappr_person' => $getdata_karyawan->karyawan_id,
                        'settappr_scheme' => $data_urutan,
                        'settappr_keterangan' => $data_keterangan
                    ]);
            } else {
                    DB::table('tb_setting_approval')
                    ->where('settappr_id', $data_id)
                    ->update([
                        'settappr_person' => $getdata_karyawan->karyawan_id,
                        'settappr_keterangan' => $data_keterangan
                    ]);
            }


            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }


    function action_deleteapproval()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_setting_approval')->where('settappr_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }





    function getdata_jabatan()
    {
        $getModel = new SettingsModel();
        $data = $getModel->getdata_jabatan();
        return $data;
    }

    function getcontent_settings_jabatan()
    {
        $result['page_name'] = "Settings - Jabatan";
        return  view('contents.settings.content_jabatan', $result);
    }



    public function action_addjabatan(Request $request)
    {

        $data_jabatan = $request->get('data-jabatan');
        $data_id = $request->get('data-id');
        $command = $request->get('data-command');

        $validator = Validator::make($request->all(), [
            'data-jabatan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        if ($command == "add") {
            $checkduplicated = DB::table('jabatan')
                ->where('jabatan_nama', $data_jabatan)
                ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('jabatan')->insert([
                    'jabatan_nama' => $data_jabatan
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

            DB::table('jabatan')
                ->where('jabatan_id', $data_id)
                ->update([
                    'jabatan_nama' => $data_jabatan
                ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }


    function action_deletejabatan()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('jabatan')->where('jabatan_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }
}
