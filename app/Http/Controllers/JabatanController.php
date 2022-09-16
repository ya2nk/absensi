<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    function index()
    {
        return view('pages.master.jabatan.index');
    }
    
    function data(Request $req)
    {
        $model = Jabatan::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Jabatan::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $jabatan = new Jabatan; 
        
        if ($req->id != 0) {
            $jabatan = Jabatan::find($req->id);
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
        if (Jabatan::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
