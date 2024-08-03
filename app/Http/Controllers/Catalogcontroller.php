<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\Tanam;
use App\Models\Tanaman;
use App\Models\DetailTanam;
use Illuminate\Support\Facades\DB;
use DataTables;
class Catalogcontroller extends Controller
{
    public function index()
    {
        $data['title'] = "Katalog Petani";
        $data['page'] = "Katalog";
        $data['jenis'] = Tanam::select('tanam.id','tanaman.jenis_sayur')
                        ->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')->get();
        return view('content.admin.catalog.index',$data);
    }
    public function getData(){
        $data = Katalog::select('katalog.*','tanaman.jenis_sayur','detail_tanam.tanggal_panen')
                ->leftJoin('detail_tanam','detail_tanam.id','=','katalog.id_detail_tanam')
                ->leftJoin('tanam','tanam.id','=','detail_tanam.id_tanam')
                ->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')
                ->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if($row->status != "selesai"){
                                $btn .= '<a  data-id='.$row->id.' class="mb-1 btn btn-warning btn-sm shadow-sm me-1 edit-katalog" href="javascript:void(0)" >Edit</a>';
                                $btn .= '<a data-id='.$row->id.' class="mb-1 btn btn-danger btn-sm shadow-sm del-katalog me-1" href="#">Hapus</a>';
                                $btn .= '<a data-id='.$row->id.' class="btn btn-success btn-sm shadow-sm selesai-pesan" href="#">Selesai</a>';
                            }else{
                                $btn .= '<a class="btn btn-light border border-waring btn-sm shadow-sm" href="javascript:void(0)">Pesan Selesai</a>';  
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function getDataPanen(Request $request){
        $data = DetailTanam::where('id_tanam',$request->id)->where('status','panen')->get();
        return response()->json($data);
    }
    public function getStokPanen(Request $request){
        $data = DetailTanam::select('tanam.tersedia','detail_tanam.tanggal_panen','detail_tanam.id')
                    ->leftJoin('tanam','tanam.id','=','detail_tanam.id_tanam')
                    ->where('detail_tanam.id',$request->id)->first();
        return response()->json($data);
    }
    public function create(Request $request)
    {
        $data = Tanaman::select('id','jenis_sayur')->get();
        return response()->json($data);
    }
    public function getTgl(Request $request){
        $data = Detail_tanam::where('id_tanaman',$request->id)->get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $kat = new Katalog();
            $kat->nama_pembeli      = $request->nama_pembeli;
            $kat->id_detail_tanam   = $request->id_dtl_tanam;
            $kat->tanggal_panen     = $request->tgl_panen;
            $kat->kontak            = $request->kontak;
            $kat->kuantitas_pesan   = $request->kuantitas_pesan;
            $kat->status            = "belum selesai";
            $kat->save();

            $rowData = Tanam::select('tanam.id','tanam.tersedia')->leftJoin('detail_tanam','detail_tanam.id_tanam','=','tanam.id')
                        ->where('detail_tanam.id',$request->id_dtl_tanam)->first();
            if($rowData != null){
                $stockPanen = (int)$rowData->tersedia - (int)$request->kuantitas_pesan;
                Tanam::where('id',$rowData->id)->update(['tersedia'=>$stockPanen]);
            }
            DB::commit();
            $res = [
                'status' => "success",
                'msg'    => "katalog berhasil disimpan"
            ];
            return response()->json($res);
        }catch(Exception $e){
            DB::rollback();
            $res = [
                'status' => "error",
                'msg'    => "katalog gagal disimpan"
            ];
            return response()->json($res);
        }
    }
    public function edit(Request $request)
    {
        $data['data'] = Katalog::select('katalog.id',
                                        'katalog.nama_pembeli',
                                        'katalog.kontak',
                                        'katalog.kuantitas_pesan',
                                        'katalog.tanggal_panen',
                                        'katalog.id_detail_tanam',
                                        'tanam.id_tanaman',
                                        'tanam.tersedia',
                                        'tanaman.jenis_sayur')
                            ->leftJoin('detail_tanam','detail_tanam.id','katalog.id_detail_tanam')
                            ->leftJoin('tanam','detail_tanam.id_tanam','tanam.id')
                            ->leftJoin('tanaman','tanaman.id','tanam.id_tanaman')
                            ->where('katalog.id',$request->id)->first();
        
        $data['tanaman'] = Tanam::select('tanam.id','tanaman.jenis_sayur')->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')->whereNot('jenis_sayur',NULL)->get();
        return response()->json($data);
    }
    public function update(Request $request)
    {
        try{
            DB::beginTransaction();
            $cekdata = Katalog::select('katalog.kuantitas_pesan','tanam.tersedia','tanam.id')
                                ->leftJoin('detail_tanam','detail_tanam.id','=','katalog.id_detail_tanam')
                                ->leftJoin('tanam','tanam.id','=','detail_tanam.id_tanam')
                                ->where('katalog.id',$request->id)
                                ->where('katalog.id_detail_tanam',$request->id_dtl_tanam)
                                ->where('katalog.tanggal_panen',$request->tgl_panen)
                                ->first();
            if($cekdata != null){
                if((int)$cekdata->kuantitas_pesan >  (int)$request->kuantitas_pesan){
                    $stockAv = (int)$cekdata->tersedia - ((int)$request->kuantitas_pesan - (int)$cekdata->kuantitas_pesan);
                }else if((int)$cekdata->kuantitas_pesan <  (int)$request->kuantitas_pesan){
                    $stockAv = (int)$cekdata->tersedia + ((int)$cekdata->kuantitas_pesan - (int)$request->kuantitas_pesan);
                }else if((int)$cekdata->kuantitas_pesan == (int)$request->kuantitas_pesan){
                    $stockAv =(int)$cekdata->tersedia;
                }
                Tanam::where('id',$cekdata->id)->update(['tersedia'=>$stockAv]);
            }
            $data = [
                'nama_pembeli'      => $request->nama_pembeli,
                'kontak'            => $request->kontak,
                'id_detail_tanam'   => $request->id_dtl_tanam,
                'tanggal_panen'     => $request->tgl_panen,
                'kuantitas_pesan'   => $request->kuantitas_pesan,
                'status'            => 'belum selesai',
            ];
            Katalog::where('id',$request->id)->update($data);
            DB::commit();
            $res = [
                'status' => "success",
                'msg'    => "Katalog telah diperbarui!"
            ];
            return response()->json($res);
        }catch(Exceptiion $e){
            DB::rollback();
            $res = [
                'status' => "error",
                'msg'    => "Katalog gagal diperbarui!"
            ];
            return response()->json($res);
        }
    } 
    public function Pesananselesai(Request $request){
        try{
            Katalog::where('id',$request->id)->update(['status'=>'selesai']);
        $res = [
            'status' => "success",
            'msg'    => "Pesanan telah selesai!"
        ];
        return response()->json($res);
    }catch (Exception $e){
        $res = [
            'status' => "success",
            'msg'    => "Pesanan gagal selesai!"
        ];
        return response()->json($res);
    }
    }
    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();
            $katalog = Katalog::where('id',$request->id)->first();
            $tanam   = Katalog::select('tanam.id','tanam.tersedia')
                        ->leftJoin('detail_tanam','detail_tanam.id','=','katalog.id_detail_tanam')
                        ->leftJoin('tanam','tanam.id','=','detail_tanam.id_tanam')
                        ->where('katalog.id',$request->id)->first();
            $stock = (int)$katalog->kuantitas_pesan + (int)$tanam->tersedia;
            Tanam::where('id',$tanam->id)->update(['tersedia'=>$stock]);
            Katalog::where('id',$request->id)->delete();
            DB::commit();
            $res = [
                'status' => "success",
                'msg'    => "katalog berhasil dihapus!"
            ];
            return response()->json($res);
        }catch (Exception $e){
            DB::rollback();
            $res = [
                'status' => "success",
                'msg'    => "katalog gagal dihapus!"
            ];
            return response()->json($res);
        }
    }
}
 