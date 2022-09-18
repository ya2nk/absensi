<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    function index()
    {
        return view('pages.master.roles.index');
    }
    
    function data(Request $req)
    {
        $model = Roles::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Roles::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $roles = new Roles; 
        
        if ($req->id != 0) {
            $roles = Roles::find($req->id);
        } 
        
        $roles->nama = strtoupper($req->nama);
        
        if($roles->save()) {
            return response(["error"=>false]);
        } else {
             return response(["error"=>true,"message"=>"Data Gagal disimpan"]);
        }
        
    }
    
    function delete(Request $req)
    {
        if (Roles::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
