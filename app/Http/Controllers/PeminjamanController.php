<?php

namespace App\Http\Controllers;

use App\Models\LokasiModel;
use App\Models\PeminjamanModel;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    function getdata_peminjaman()
    {
        $getModel = new PeminjamanModel();
        $data = $getModel->getdata_peminjaman();
        return $data;
    }


    function get_allpeminjaman_available()
    {
        $getModel = new PeminjamanModel();
        $data = $getModel->get_allpeminjaman_available();
        return $data;
    }


    function getcontent_peminjaman()
    {
        $getModel = new SettingsModel();
        $data_divisi = $getModel->getdata_divisi();

        $getModel2 = new LokasiModel();
        $data_suggestlokasi = $getModel2->get_suggestlokasi();
        $data_suggestsublokasi = $getModel2->get_suggestsublokasi();

        $result['page_name'] = "Sirkulasi - Peminjaman";
        $result['data_divisi'] = $data_divisi;
        $result['data_suggestlokasi'] = $data_suggestlokasi;
        $result['data_suggestsublokasi'] = $data_suggestsublokasi;
        $result['user_id'] = Session::get('karyawan_id');
        $result['user_role'] = Session::get('karyawan_role');
        return  view('contents.content_peminjaman', $result);
    }

    public function appr_peminjaman(Request $request) {
        $id_approval = $request->get('id_approval');
        $command = $request->get('command');
        $scheme = $request->get('scheme');
        $appr_no = $request->get('appr_no');


        $getdata_peminjaman = DB::table('peminjaman')->where('pinjam_no', $appr_no)->limit(1)->first();
        $getdata_asset = DB::table('tb_asset')->where('asset_id', $getdata_peminjaman->pinjam_asset)->limit(1)->first();

        if($command == 'Setujui') {
            $command_act = "Disetujui";
        } else {
            $command_act = "Ditolak";
        }


        $check_countappr = DB::table('peminjaman_approval')
            ->where([
                ['pinjamappr_no', '=', $appr_no]
            ])->get();

        $result_check_countappr = $check_countappr->count();

        if ($result_check_countappr > 1) {
                DB::table('peminjaman_approval')
                ->where('pinjamappr_id', $id_approval)
                ->update([
                'pinjamappr_status' =>  $command_act,
                'pinjamappr_dateapprv' => gmdate("Y-m-d", time() + 60 * 60 * 7)
                ]);


            if ($command == 'Setujui') {
                if ($scheme == '2') {

                    DB::table('peminjaman')
                        ->where('pinjam_no', $appr_no)
                        ->update([
                            'pinjam_status' =>  "Dipinjam"
                        ]);
                }
            } else {
                    DB::table('peminjaman_approval')
                    ->where('pinjamappr_no', $appr_no)
                    ->update([
                    'pinjamappr_status' =>  $command_act
                    ]);

                     DB::table('peminjaman')
                    ->where('pinjam_no', $appr_no)
                    ->update([
                        'pinjam_status' =>  $command_act
                    ]);

                $stok_sisa = (int)$getdata_asset->asset_total + 1;
                DB::table('tb_asset')
                    ->where('asset_id', $getdata_asset->pinjam_asset)
                    ->update([
                        'asset_status' =>  'Available',
                        'asset_total' => $stok_sisa
                    ]);
            }
        } else {
                 DB::table('peminjaman_approval')
                ->where('pinjamappr_id', $id_approval)
                ->update([
                    'pinjamappr_status' =>  $command_act,
                    'pinjamappr_dateapprv' => gmdate("Y-m-d", time() + 60 * 60 * 7)
                ]);

                DB::table('peminjaman')
                ->where('pinjam_no', $appr_no)
                ->update([
                'pinjam_status' =>  "Dipinjam"
                ]);

            if ($command_act == 'Ditolak') {
                $stok_sisa = (int)$getdata_asset->asset_total + 1;
                DB::table('tb_asset')
                    ->where('asset_id', $getdata_asset->pinjam_asset)
                    ->update([
                        'asset_status' =>  'Available',
                        'asset_total' => $stok_sisa
                    ]);
            }
        }










            //UPDATE KE MASTER PEMINJAMAN UNTUK APPROVAL TERAKHIR============================

            return response()->json([
                'status' => "success",
                'message' => "Approval Berhasil",
            ]);




    }

    public function action_addpeminjaman(Request $request)
    {
        $data_asset = $request->get('data-asset');
        $data_tglpinjam = $request->get('data-tglpinjam');
        $data_estbalik = $request->get('data-estbalik');
        $data_keterangan = $request->get('data-keterangan');

        $data_id = $request->get('data-id');
        $command = $request->get('data-command');


        $validator = Validator::make($request->all(), [
            'data-asset' => 'required',
            'data-estbalik' => 'required',
            'data-tglpinjam' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "failed",
                'message' => "Mohon maaf,  mohon lengkapi terlebih dahulu form yang masih kosong",
            ]);
            exit();
        }



        //SET NUMBERSEQUENCE===========================
        $getlast_numseq = DB::table('peminjaman')->orderBy('pinjam_numseq', 'DESC')->limit(1)->get();
        $result_count = $getlast_numseq->count();
        if ($result_count > 0) {
            $getlast_numseq2 = DB::table('peminjaman')->orderBy('pinjam_numseq', 'desc')->first();
            $numseq = $getlast_numseq2->pinjam_numseq + 1;
        } else {
            $numseq = 1;
        }

        $tahun = gmdate("Y", time() + 60 * 60 * 7);
        $bulan = gmdate("m", time() + 60 * 60 * 7);
        $numbersquence = "P-" . substr($tahun, 2, 2) . $bulan . "-" . str_pad($numseq, '5', '0', STR_PAD_LEFT);
        //SET NUMBERSEQUENCE===========================


        if ($command == "add") {
            $check_asset = DB::table('tb_asset')
                ->where('asset_id', $data_asset)
                ->where('asset_status', '<>', 'Available')
                ->limit(1)->get()->count();
            if ($check_asset > 0) {
                return response()->json(['message' => "Data gagal disimpan, karena asset tidak tersedia"]);
            } else {

                $getaseet_name = DB::table('tb_asset')
                    ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
                    ->join('karyawan', 'karyawan.karyawan_id', '=', 'tb_lokasi.lokasi_penanggungjawab')
                    ->where('asset_id', $data_asset)->first();



                DB::table('peminjaman')->insert([
                    'pinjam_no' => $numbersquence,
                    'pinjam_asset' => $data_asset,
                    'pinjam_peminjam' => Session::get('karyawan_id'),
                    'pinjam_cabang' => Session::get('karyawan_cabang'),
                    'pinjam_estbalik' => $data_estbalik,
                    'pinjam_tglpinjam' => $data_tglpinjam,
                    'pinjam_keterangan' => $data_keterangan,
                    'pinjam_status' => 'Menunggu Persetujuan',
                    'pinjam_numseq' => $numseq
                ]);

                if($getaseet_name->karyawan_role == "User") {
                    DB::table('peminjaman_approval')->insert([
                        'pinjamappr_no' => $numbersquence,
                        'pinjamappr_person' => $getaseet_name->lokasi_penanggungjawab,
                        'pinjamappr_cabang' => Session::get('karyawan_cabang'),
                        'pinjamappr_scheme' => "1",
                        'pinjamappr_role' => "Persetujuan Penanggung Jawab",
                        'pinjamappr_status' => 'Menunggu'
                    ]);



                    $getaseet_kepalasekolah = DB::table('karyawan')
                        ->where('karyawan_cabang', Session::get('karyawan_cabang'))
                        ->where('karyawan_role', 'Kepala Sekolah')
                        ->orderBy('karyawan_id', 'DESC')
                        ->limit(1)
                        ->first();


                    DB::table('peminjaman_approval')->insert([
                        'pinjamappr_no' => $numbersquence,
                        'pinjamappr_person' => $getaseet_kepalasekolah->karyawan_id,
                        'pinjamappr_cabang' => Session::get('karyawan_cabang'),
                        'pinjamappr_scheme' => "2",
                        'pinjamappr_role' => "Persetujuan Kepala Sekolah",
                        'pinjamappr_status' => 'Menunggu'
                    ]);
                } else {

                    $getaseet_kepalasekolah = DB::table('karyawan')
                        ->where('karyawan_cabang', Session::get('karyawan_cabang'))
                        ->where('karyawan_role', 'Kepala Sekolah')
                        ->orderBy('karyawan_id', 'DESC')
                        ->limit(1)
                        ->first();


                    DB::table('peminjaman_approval')->insert([
                        'pinjamappr_no' => $numbersquence,
                        'pinjamappr_person' => $getaseet_kepalasekolah->karyawan_id,
                        'pinjamappr_cabang' => Session::get('karyawan_cabang'),
                        'pinjamappr_scheme' => "1",
                        'pinjamappr_role' => "Persetujuan Kepala Sekolah",
                        'pinjamappr_status' => 'Menunggu'
                    ]);
                }


                $getdata_asset = DB::table('tb_asset')->where('asset_id', $data_asset)->limit(1)->first();
                $stok_sisa = (int)$getdata_asset->asset_total - 1;
                if ($stok_sisa == 0) {
                    DB::table('tb_asset')
                        ->where('asset_id', $data_asset)
                        ->update([
                            'asset_status' =>  'Dipinjam',
                            'asset_total' => 0
                        ]);
                } else {
                    DB::table('tb_asset')
                        ->where('asset_id', $data_asset)
                        ->update([
                            'asset_total' => $stok_sisa
                        ]);
                }

                $response_message = "Data berhasil ditambah";



            }


        }

        return response()->json([
            'status' => "success",
            'message' => $response_message,
        ]);
    }

    function action_deletepeminjaman()
    {
        $arr_val = request('data');
        foreach ($arr_val as $row) {
            DB::table('tb_lokasi')->where('lokasi_id', $row)->delete();
        }
        return response()->json([
            'status' => "success"
        ]);
    }


    function get_allapproval(Request $request)
    {
        $id_peminjaman = $request->get('id_peminjaman');
        $getModel = new PeminjamanModel();
        $data = $getModel->get_allapproval($id_peminjaman);
        return $data;
    }


    function getdata_detailpeminjaman(Request $request) {
        $id_peminjaman = $request->get('id_peminjaman');
        $getdata_peminjaman = DB::table('peminjaman')
            ->join('tb_asset', 'tb_asset.asset_id', '=', 'peminjaman.pinjam_asset')
            ->join('tb_lokasi', 'tb_lokasi.lokasi_id', '=', 'tb_asset.asset_lokasi')
            ->join('karyawan', 'karyawan.karyawan_id', '=', 'peminjaman.pinjam_peminjam')
        ->where('pinjam_no', $id_peminjaman)->first();
        return response()->json([
            'kembali_asset' => $getdata_peminjaman->asset_nama,
            'kembali_peminjam' => $getdata_peminjaman->karyawan_nama,
            'kembali_tglpinjam' => $getdata_peminjaman->pinjam_tglpinjam,
            'kembali_tglestkembali' => $getdata_peminjaman->pinjam_estbalik,
            'kembali_keterangan' => $getdata_peminjaman->pinjam_keterangan,
            'kembali_pinjamno' => $getdata_peminjaman->pinjam_no
        ]);

    }
}
