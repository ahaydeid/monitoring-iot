<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanam;
class LandingController extends Controller
{
    public function index(){
        return view('content.user.index');
    }
    public function katalog(){
        $data['data'] = Tanam::select('tanaman.jenis_sayur','tanaman.gambar','detail_tanam.tanggal_tanam','detail_tanam.tanggal_panen','tanam.tersedia')
        ->leftJoin('detail_tanam','tanam.id','=','detail_tanam.id_tanam')
        ->leftJoin('tanaman','tanaman.id','=','tanam.id_tanaman')->orderBy('tanaman.jenis_sayur','ASC')->get();
        return view('content.user.katalog',$data);
    }
}
