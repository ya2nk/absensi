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
        $model = JamKerjaKaryawan::with(['divisi','karyawan','jamKerja'])->select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(JamKerjaKaryawan::find($req->id));
    }
    
    function save(Request $req)
    {
        $req->validate([
            'divisi_id' => 'required',
            'karyawan_id' => 'required',
            'jam_kerja_id' => 'required',
            'tanggal_berlaku' => 'required',
        ]);
        
        $data = new JamKerjaKaryawan; 
        
        if ($req->id != 0) {
            $data = JamKerjaKaryawan::find($req->id);
        } 
        
        $data->divisi_id = $req->divisi_id;
        $data->karyawan_id = $req->karyawan_id;
        $data->jam_kerja_id = $req->jam_kerja_id;
        $data->tanggal_berlaku = $req->tanggal_berlaku;
        
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
