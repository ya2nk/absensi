<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JamKerja;
use App\Models\JamKerjaKaryawan;

class JamKerjaKaryawanController extends Controller
{
    function index()
    {
        $data['jam_kerja'] = JamKerja::orderBy('nama')->get();
        return view('pages.master.jam-kerja-karyawan.index',$data);
    }
    
    function data(Request $req)
    {
        $model = JamKerjaKaryawan::select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(JamKerjaKaryawan::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required' 
        ]);
        
        $data = new JamKerjaKaryawan; 
        
        if ($req->id != 0) {
            $data = JamKerjaKaryawan::find($req->id);
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
        if (JamKerjaKaryawan::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
