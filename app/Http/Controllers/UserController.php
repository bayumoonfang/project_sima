<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index()
    {
        $result['page_name'] = "Users";
        // $result['user_fullname'] = Session::get('user_fullname');
        // $result['user_email'] = Session::get('user_email');
        return  view('contents.content_user',$result);
    }


    function getdata_users(Request $request) {
        // $filter = $request->get('filter');
        $getModel = new UserModel();
        $data = $getModel->getdata_users();

        return $data;
    }


    public function action_adduser(Request $request)
    {

        $user_nama = $request->get('user_nama');
        $user_cabang = $request->get('user_cabang');
        $user_status = $request->get('user_status');
        $user_email = $request->get('user_email');
        $user_name = $request->get('user_name');
        $user_password = $request->get('user_password');
        $user_role = $request->get('user_role');
        $command = $request->get('command');
        $karyawan_nik = $request->get('karyawan_nik');


        if($user_role === "Super Admin" || $user_role === "Ketua Yayasan") {
            $validator = Validator::make($request->all(), [
                'user_nama' => 'required',
                'user_status' => 'required',
                'user_email' => 'required',
                'user_name' => 'required',
                'user_password' => 'required',
                'user_role' => 'required'
            ]);
        } else {

            $validator = Validator::make($request->all(), [
                'user_nama' => 'required',
                'user_cabang' => 'required',
                'user_status' => 'required',
                'user_email' => 'required',
                'user_name' => 'required',
                'user_password' => 'required',
                'user_role' => 'required'
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
        $getlast_numseq = DB::table('karyawan')->orderBy('karyawan_numseq', 'DESC')->limit(1)->get();
        $result_count = $getlast_numseq->count();
        if ($result_count > 0) {
            $getlast_numseq2 = DB::table('karyawan')->orderBy('karyawan_numseq', 'desc')->first();
            $numseq = $getlast_numseq2->karyawan_numseq + 1;
        } else { $numseq = 1; }

        $tahun = gmdate("Y", time() + 60 * 60 * 7);  $bulan = gmdate("m", time() + 60 * 60 * 7);
        $numbersquence = "US/" . substr($tahun, 2, 2) . $bulan . "-" . str_pad($numseq, '5', '0', STR_PAD_LEFT);
        //SET NUMBERSEQUENCE===========================



        if($command == "add") {
            $checkduplicated = DB::table('karyawan')
            ->where('karyawan_nama', $user_nama)
            ->orWhere('karyawan_username', $user_name)
            ->limit(1)->get()->count();
            if ($checkduplicated > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena data sudah ada"]);
            } else {
                DB::table('karyawan')->insert([
                    'karyawan_nik' => $numbersquence,
                    'karyawan_nama' => $user_nama,
                    'karyawan_cabang' => $user_cabang,
                    'karyawan_email' => $user_email,
                    'karyawan_username' => $user_name,
                    'karyawan_password' => md5($user_password),
                    'karyawan_role' => $user_role,
                    'karyawan_aktif' => $user_status,
                    'karyawan_numseq' => $numseq
                ]);
                $response_message = "Data berhasil ditambah";
            }
        } else {

             DB::table('karyawan')
            ->where('karyawan_nik', $karyawan_nik)
            ->update([
                'karyawan_nama' => $user_nama,
                'karyawan_cabang' => $user_cabang,
                'karyawan_email' => $user_email,
                'karyawan_username' => $user_name,
                'karyawan_role' => $user_role,
                'karyawan_aktif' => $user_status,
            ]);

            $response_message = "Data berhasil diedit";
        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);



    }


    function action_deleteuser(Request $request)
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            $getuser = DB::table('karyawan')
            ->where('karyawan_id', $row)
            ->first();

            if($getuser->karyawan_role != "Super Admin") {
                DB::table('karyawan')->where('karyawan_id', $row)->delete();
            }
        }
        return response()->json([
            'status' => "success"
        ]);
    }

}
