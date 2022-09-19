<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    function index()
    {
        return view('pages.master.divisi.index');
    }
    
    function data(Request $req)
    {
        $model = Divisi::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Divisi::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $data = new Divisi; 
        
        if ($req->id != 0) {
            $data = Divisi::find($req->id);
        } 
        
        $data->nama = strtoupper($req->nama);
        
        if($data->save()) {
            return response(["error"=>false]);
        } else {
             return response(["error"=>true,"message"=>"Data Gagal disimpan"]);
        }
        
    }
    
    function delete(Request $req)
    {
        if (Divisi::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
