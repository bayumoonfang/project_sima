<?php

namespace App\Http\Controllers;

use App\Models\PublicModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
    function get_alljabatan()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_alljabatan();
        return $data;
    }


    function get_allcabang()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allcabang();
        return $data;
    }

    function get_alldivisi()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_alldivisi();
        return $data;
    }

    function get_allkaryawan()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allkaryawan();
        return $data;
    }

    function get_allasset()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allasset();
        return $data;
    }

        function get_allkaryawan_user()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allkaryawan_user();
        return $data;
    }


    function get_allasset_all()
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allasset_all();
        return $data;
    }


    function get_alllokasi_filter(Request $request)
    {
        $lokasi = $request->get('lokasi');
        $getModel = new PublicModel();
        $data = $getModel->get_alllokasi_filter($lokasi);
        return $data;
    }


    function get_allasset_filter(Request $request)
    {
        $cabang = $request->get('cabang');
        $getModel = new PublicModel();
        $data = $getModel->get_allasset_filter($cabang);
        return $data;
    }

    function get_karyawanbyunit(Request $request)
    {
        $cabang_nama = $request->get('cabang_nama');
        $getModel = new PublicModel();
        $data = $getModel->get_karyawanbyunit($cabang_nama);
        return $data;
    }

    function get_allasset_filter_bypenanggungjawab(Request $request)
    {
        $getModel = new PublicModel();
        $data = $getModel->get_allasset_filter_bypenanggungjawab();
        return $data;
    }

    function get_asset_bycabang(Request $request)
    {
        $getModel = new PublicModel();
        $data = $getModel->get_asset_bycabang();
        return $data;
    }



}
