<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Area;

class LokasiController extends Controller
{
    function index()
    {
        $data['area'] = Area::orderBy('nama')->get();
        return view('pages.master.lokasi.index',$data);
    }
    
    function data(Request $req)
    {
        $model = Lokasi::with('area')->select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Lokasi::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required',
           'area_id' => 'required',
           'alamat' => 'required'
        ]);
        
        $lokasi = new Lokasi; 
        
        if ($req->id != 0) {
            $lokasi = Lokasi::find($req->id);
        } 
        
        $lokasi->nama = strtoupper($req->nama);
        $lokasi->area_id = $req->area_id;
        $lokasi->alamat = $req->alamat;
        $lokasi->nomor_telp = $req->nomor_telp;
        
        if($lokasi->save()) {
            return response(["error"=>false]);
        } else {
             return response(["error"=>true,"message"=>"Data Gagal disimpan"]);
        }
        
    }
    
    function delete(Request $req)
    {
        if (Lokasi::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
