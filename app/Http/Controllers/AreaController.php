<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    function index()
    {
        return view('pages.master.area.index');
    }
    
    function data(Request $req)
    {
        $model = Area::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Area::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $jabatan = new Area; 
        
        if ($req->id != 0) {
            $jabatan = Area::find($req->id);
        } 
        
        $jabatan->nama = strtoupper($req->nama);
        
        if($jabatan->save()) {
            return response(["error"=>false]);
        } else {
             return response(["error"=>true,"message"=>"Data Gagal disimpan"]);
        }
        
    }
    
    function delete(Request $req)
    {
        if (Area::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
