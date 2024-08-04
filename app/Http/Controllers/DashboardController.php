<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\DetailTanam;
use App\models\Tanaman;
use App\models\Tanam;
use App\models\Device1;
use Illuminate\Support\Facades\DB;
use DataTables;
class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Monitoring-Admin";
        $data['page']  = "Monitoring Petani";
        $data['device']  = Device1::orderBy('id','DESC')->first();
        $checkPanen = DetailTanam::where('status',"belum panen")->get();
        $dateNow = date('Y-m-d');
        DB::beginTransaction();
        foreach($checkPanen as $panen){
            if($panen->tanggal_panen <= $dateNow ){
                $status = [
                    'status' => 'panen'
                ];
                DetailTanam::where('id', $panen->id)->update($status);
                $tanam = Tanam::where('id',$panen->id_tanam)->first();
                if($tanam->id == $panen->id_tanam){
                    $total = (int)$panen->kuantitas_tanam + (int)$tanam->tersedia;
                    $Tersedia = [
                        'tersedia'   => $total
                    ];
                    Tanam::where('id',$panen->id_tanam)->update($Tersedia);
                }
            }
        }
        DB::commit();
        DB::rollback();
        return view('content.admin.dashboard',$data);
    }
    public function getData(Request $request){
        $data = Tanam::select('tanaman.jenis_sayur','tanam.kuantitas_tanam','tanam.tersedia','tanam.dipesan')
                ->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')
                ->whereNot('tanaman.id',NULL)
                ->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            $btn .= '<a data-id="'.$row->id.'" data-jenis="'.strtoupper($row->jenis_sayur).'" class="btn btn-sm btn-light border border-warning show-dtl" href="#">lihat tanam</a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function autoLoad(){
        $data = Device1::orderBy('id','DESC')->first();
        return response()->json($data);
    }
    public function getTanaman(){
        $data['tanaman'] = Tanaman::whereNot('jenis_sayur',NULL)->get();
        return response()->json($data);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $check = Tanam::where('id_tanaman',$request->jenis_sayur)->count();
            $checkData = Tanam::where('id_tanaman',$request->jenis_sayur)->first();
            $id = '';
            if($check <= 0 ){
                $tanam = [
                    'id_tanaman'      => $request->jenis_sayur,
                    'kuantitas_tanam' => $request->kuantitas_tanam
                ];
                $save = Tanam::create($tanam);
                $id = $save->id;
            }else{
                $id = $checkData->id;
            }
            $Dtltanam = [
                'id_tanam'          => $id,
                'tanggal_tanam'     => $request->tgl_tanam,
                'tanggal_panen'     => $request->tgl_panen,
                'kuantitas_tanam'   => $request->kuantitas_tanam,
                'status'            => 'belum panen',
            ];
            DetailTanam::create($Dtltanam);
            if($check > 0){
                $totalKuantitas = (int)$request->kuantitas_tanam + (int)$checkData->kuantitas_tanam;
                $total = [
                    'kuantitas_tanam' => $totalKuantitas,
                ];
                Tanam::where('id',$checkData->id)->update($total);
            }
            DB::commit();
            $res = [
                'status' => 'success',
                'msg'    => 'Data berhasil disimpan !'
            ];
            return response()->json($res);
        }catch(Exception $e){
            DB::rollback();
            $res = [
                'status' => 'error',
                'msg'    => 'Data gagal disimpan !'
            ];
            return response()->json($res);
        }
    }

    public function getDetail(Request $request){
        $data = DetailTanam::select('detail_tanam.tanggal_tanam',
                                    'detail_tanam.tanggal_panen',
                                    'detail_tanam.kuantitas_tanam',
                                    'detail_tanam.status')
                ->leftJoin('tanam','tanam.id','=','detail_tanam.id_tanam')
                ->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')
                ->whereNot('tanaman.id',NULL)
                ->get();
        return DataTables::of($data)->make(true);
    }

}
