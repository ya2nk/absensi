<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JamKerja;

class JamKerjaController extends Controller
{
    function index()
    {
        return view('pages.master.jam-kerja.index');
    }
    
    function data(Request $req)
    {
        $model = JamKerja::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(JamKerja::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $data = new JamKerja; 
        
        if ($req->id != 0) {
            $data = JamKerja::find($req->id);
        } 
        
        $data->nama = strtoupper($req->nama);
        $data->jam_masuk = $req->jam_masuk;
        $data->jam_pulang = $req->jam_pulang;
        $data->crossday = $req->input('crossday',0);
        
        if($data->save()) {
            return response(["error"=>false]);
        } else {
             return response(["error"=>true,"message"=>"Data Gagal disimpan"]);
        }
        
    }
    
    function delete(Request $req)
    {
        if (JamKerja::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
