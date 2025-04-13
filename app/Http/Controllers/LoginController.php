<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function auth() {
        if (!session('isLogin')) {
            return view('authentication.login');
        } else {
            return view('/dashboard');
        }
    }

    public function do_login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }


        $users = DB::table('karyawan')
        ->where([
            ['karyawan_username', '=', $username],
            ['karyawan_password', '=', md5($password)],
            ['karyawan_aktif', '=', 'Aktif'],
        ])->get();

        $result_count = $users->count();

        if ($result_count > 0) {
            foreach ($users as $row) {
                session(['isLogin' => true]);
                session(['karyawan_nik' => $row->karyawan_nik]);
                session(['karyawan_nama' => $row->karyawan_nama]);
                session(['karyawan_cabang' => $row->karyawan_cabang]);
                session(['karyawan_email' => $row->karyawan_email]);
                session(['karyawan_id' => $row->karyawan_id]);
                session(['karyawan_role' => $row->karyawan_role]);
            }

            return response()->json([
                'url' => url('/dashboard'),
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Username atau Password Salah'
            ]);
        }
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/auth');
    }

}
