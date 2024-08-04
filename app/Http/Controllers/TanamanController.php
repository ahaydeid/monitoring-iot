<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanaman;
use App\Models\Tanam;
use Illuminate\Support\Facades\DB;
use DataTables;
class TanamanController extends Controller
{
    public function index()
    {
        $data['title'] = "master jenis sayur";
        $data['page'] = "Master Jenis sayur";
        return view('content.admin.tanaman.index',$data);
    }
    public function getData()
    {
        $data = Tanaman::whereNot('jenis_sayur',NULL)->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '';
                            $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-warning btn-sm me-1 edit-tanaman">Edit</a>';
                            $check = Tanam::where('id_tanaman',$row->id)->count();
                            if($check <= 0){
                            $btn .= '<a href="" data-id="'.$row->id.'" class="btn btn-danger btn-sm del-tanaman">Hapus</a>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function store(Request $request)
    {
        try{
            $data = [
                'jenis_sayur' => $request->jenis_sayur,
                'created_at'  => date('Y-m-d H:m:s')
            ];
            Tanaman::create($data);
            $res = [
                'status' => 'success',
                'msg'    => 'Jenis Sayur Berhasil disimpan !'
            ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Jenis Sayur gagal disimpan !'
            ];
            return response()->json($res);
        }
    }
    public function edit(Request $request)
    {
        $data = Tanaman::where('id',$request->id)->first();
        return response()->json($data);
    }
    public function update(Request $request)
    {
        try{
            $data = [
                'jenis_sayur' => $request->jenis_sayur,
                'updated_at'  => date('Y-m-d H:m:s')
            ];
            Tanaman::where('id',$request->id)->update($data);
            $res = [
                'status' => 'success',
                'msg'    => 'Jenis Sayur Berhasil diupdate !'
            ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Jenis Sayur gagal diupdate!'
            ];
            return response()->json($res);
        }
    }
    public function destroy(Request $request)
    {
        try{
            Tanaman::where('id',$request->id)->delete();
            $res = [
                'status' => 'success',
                'msg'    => 'Jenis Sayur berhasil dihapus !'
            ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Jenis Sayur gagal dihapus !'
            ];
            return response()->json($res);
        }
    }
}
