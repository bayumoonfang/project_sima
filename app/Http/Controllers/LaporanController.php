<?php

namespace App\Http\Controllers;

use App\Models\LaporanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LaporanController extends Controller
{



    function getdata_report_asset(Request $request)
    {
        $tglfrom = $request->get('tglfrom');
        $tglto = $request->get('tglto');
        $getModel = new LaporanModel();
        $data = $getModel->getdata_report_asset($tglfrom, $tglto );
        return $data;
    }



    function getcontent_report_asset()
    {
        $result['page_name'] = "Laporan - Asset";
        return  view('contents.laporan.content_repasset', $result);
    }


    function getdata_report_sirkulasi(Request $request)
    {
        $tglfrom = $request->get('tglfrom');
        $tglto = $request->get('tglto');
        $getModel = new LaporanModel();
        $data = $getModel->getdata_report_sirkulasi($tglfrom, $tglto);
        return $data;
    }



    function getcontent_report_sirkulasi()
    {
        $result['page_name'] = "Laporan - Sirkulasi";
        return  view('contents.laporan.content_repsirkulasi', $result);
    }


}
