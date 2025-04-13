<?php

namespace App\Http\Controllers;

use App\Models\PengadaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PengadaanController extends Controller
{


    function getdata_pengadaan()
    {
        $getModel = new PengadaanModel();
        $data = $getModel->getdata_pengadaan();
        return $data;
    }



    function getcontent_pengadaan()
    {


        $result['page_name'] = "Sirkulasi - Pengadaan";
        $result['user_id'] = Session::get('karyawan_id');
        $result['user_role'] = Session::get('karyawan_role');

        return  view('contents.content_pengadaan', $result);
    }


    function get_allapproval_pengadaan(Request $request)
    {
        $id_pengadaan = $request->get('id_pengadaan');
        $getModel = new PengadaanModel();
        $data = $getModel->get_allapproval_pengadaan($id_pengadaan);
        return $data;
    }


    public function action_addpengadaan(Request $request)
    {
        $data_asset = $request->get('data-asset');
        $data_tglbeli = $request->get('data-tglbeli');
        $data_harga = $request->get('data-harga');
        $data_jumlah = $request->get('data-jumlah');
        $data_keterangan = $request->get('data-keterangan');

        $validator = Validator::make($request->all(), [
            'data-asset' => 'required',
            'data-tglbeli' => 'required',
            'data-harga' => 'required',
            'data-jumlah' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        //SET NUMBERSEQUENCE===========================
        $getlast_numseq = DB::table('pengadaan')->orderBy('pengadaan_numseq', 'DESC')->limit(1)->get();
        $result_count = $getlast_numseq->count();
        if ($result_count > 0) {
            $getlast_numseq2 = DB::table('pengadaan')->orderBy('pengadaan_numseq', 'desc')->first();
            $numseq = $getlast_numseq2->pengadaan_numseq + 1;
        } else {
            $numseq = 1;
        }

        $tahun = gmdate("Y", time() + 60 * 60 * 7);
        $bulan = gmdate("m", time() + 60 * 60 * 7);
        $numbersquence = "PE-" . substr($tahun, 2, 2) . $bulan . "-" . str_pad($numseq, '5', '0', STR_PAD_LEFT);
        //SET NUMBERSEQUENCE===========================

        $getaseet_name = DB::table('tb_asset')->where('asset_nama', $data_asset)->first();

        $jumlahnow = (int)$getaseet_name->asset_total + (int)$data_jumlah;
        $totalbeli = (int)$data_jumlah * (int)$data_harga;

        DB::table('pengadaan')->insert([
            'pengadaan_no' => $numbersquence,
            'pengadaan_asset' => $getaseet_name->asset_id,
            'pengadaan_tglbeli' => $data_tglbeli,
            'pengadaan_unit' => Session::get('karyawan_cabang'),
            'pengadaan_harga' => $data_harga,
            'pengadaan_jumlah' => $data_jumlah,
            'pengadaan_total' => $totalbeli,
            'pengadaan_creator' => Session::get('karyawan_nama'),
            'pengadaan_keterangan' => $data_keterangan,
            'pengadaan_status' => "Menunggu Persetujuan",
            'pengadaan_numseq' => $numseq
        ]);


        if (Session::get('karyawan_role') == 'User') {


            $getaseet_kepalasekolah = DB::table('karyawan')
                ->where('karyawan_cabang', Session::get('karyawan_cabang'))
                ->where('karyawan_role', 'Kepala Sekolah')
                ->orderBy('karyawan_id', 'DESC')
                ->limit(1)
                ->first();


            DB::table('pengadaan_approval')->insert([
                'pengadaanappr_no' => $numbersquence,
                'pengadaanappr_person' => $getaseet_kepalasekolah->karyawan_id,
                'pengadaanappr_cabang' => Session::get('karyawan_cabang'),
                'pengadaanappr_scheme' => "1",
                'pengadaanappr_role' => "Persetujuan Kepala Sekolah",
                'pengadaanappr_status' => 'Menunggu'
            ]);



            $getaseet_ketuayayasan = DB::table('karyawan')
                ->where('karyawan_role', 'Ketua Yayasan')
                ->orderBy('karyawan_id', 'DESC')
                ->limit(1)
                ->first();


            DB::table('pengadaan_approval')->insert([
                'pengadaanappr_no' => $numbersquence,
                'pengadaanappr_person' => $getaseet_ketuayayasan->karyawan_id,
                'pengadaanappr_cabang' => Session::get('karyawan_cabang'),
                'pengadaanappr_scheme' => "2",
                'pengadaanappr_role' => "Persetujuan Ketua Yayasan",
                'pengadaanappr_status' => 'Menunggu'
            ]);
        } else if (Session::get('karyawan_role') == 'Kepala Sekolah') {
            $getaseet_ketuayayasan = DB::table('karyawan')
                ->where('karyawan_role', 'Ketua Yayasan')
                ->orderBy('karyawan_id', 'DESC')
                ->limit(1)
                ->first();


            DB::table('pengadaan_approval')->insert([
                'pengadaanappr_no' => $numbersquence,
                'pengadaanappr_person' => $getaseet_ketuayayasan->karyawan_id,
                'pengadaanappr_cabang' => Session::get('karyawan_cabang'),
                'pengadaanappr_scheme' => "1",
                'pengadaanappr_role' => "Persetujuan Ketua Yayasan",
                'pengadaanappr_status' => 'Menunggu'
            ]);
        }



        $response_message = "Data berhasil ditambah";
        return response()->json(['status' => "success", 'message' => $response_message,]);


    }



    public function appr_pengadaan(Request $request)
    {
        $id_approval = $request->get('id_approval');
        $command = $request->get('command');
        $scheme = $request->get('scheme');
        $appr_no = $request->get('appr_no');

        $getdata_pengadaan = DB::table('pengadaan')->where('pengadaan_no', $appr_no)->limit(1)->first();
        $getdata_asset = DB::table('tb_asset')->where('asset_id', $getdata_pengadaan->pengadaan_asset)->limit(1)->first();

        if ($command == 'Setujui') {
            $command_act = "Disetujui";
        } else {
            $command_act = "Ditolak";
        }

        $check_countappr = DB::table('pengadaan_approval')
            ->where([
                ['pengadaanappr_no', '=', $appr_no]
            ])->get();

        $result_check_countappr = $check_countappr->count();



        if($result_check_countappr > 1) {
                DB::table('pengadaan_approval')
                ->where('pengadaanappr_id', $id_approval)
                ->update([
                    'pengadaanappr_status' =>  $command_act,
                    'pengadaanappr_dateapprv' => gmdate("Y-m-d", time() + 60 * 60 * 7)
                ]);


            if ($command == 'Setujui') {
                if($scheme == '2') {
                        DB::table('tb_asset')
                        ->where('asset_id', $getdata_pengadaan->pengadaan_asset)
                        ->update([
                            'asset_total' => (int)$getdata_asset->asset_total + (int)$getdata_pengadaan->pengadaan_jumlah
                        ]);


                         DB::table('pengadaan')
                        ->where('pengadaan_no', $appr_no)
                        ->update([
                            'pengadaan_status' =>  $command_act
                        ]);
                }
            } else {
                     DB::table('pengadaan_approval')
                    ->where('pengadaanappr_no', $appr_no)
                    ->update([
                        'pengadaanappr_status' =>  $command_act
                    ]);

                    DB::table('pengadaan')
                    ->where('pengadaan_no', $appr_no)
                    ->update([
                        'pengadaan_status' =>  $command_act
                    ]);
            }
        }  else {
                DB::table('pengadaan_approval')
                ->where('pengadaanappr_id', $id_approval)
                ->update([
                    'pengadaanappr_status' =>  $command_act,
                    'pengadaanappr_dateapprv' => gmdate("Y-m-d", time() + 60 * 60 * 7)
                ]);

                DB::table('pengadaan')
                ->where('pengadaan_no', $appr_no)
                ->update([
                    'pengadaan_status' =>  $command_act
                ]);

            if ($command == 'Setujui') {
                     DB::table('tb_asset')
                    ->where('asset_id', $getdata_pengadaan->pengadaan_asset)
                    ->update([
                        'asset_total' => (int)$getdata_asset->asset_total + (int)$getdata_pengadaan->pengadaan_jumlah
                    ]);

            }

        }

            return response()->json([
                'status' => "success",
                'message' => "Approval Berhasil",
            ]);

    }



}
