<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Roles;
use DB;

class KaryawanController extends Controller
{
    function index()
    {
        $data['jabatan']    = Jabatan::orderBy('nama')->get();
        $data['atasan']     = Karyawan::where('parent_id',0)->orderBy('nama')->get();
        $data['roles']      = Roles::orderBy('nama')->get();
        return view('pages.master.karyawan.index',$data);
    }
    
    function data(Request $req)
    {
        $model = Karyawan::with('jabatan')->select();
        return datatables($model->get())->toJson();
    }
    
    function getRow(Request $req)
    {
        return response(Karyawan::find($req->id));
    }
    
    function getNik(Request $req)
    {
        $prefix = date('dm',strtotime($req->tanggal_masuk));
        $nomor = Karyawan::select(DB::raw("MAX(CAST(SUBSTRING(nik, 4, length(nik)-4) AS UNSIGNED)) as nik"))->value("nik");
        $nomor = (int)$nomor ?? 0;
        $nomor++;
        return $prefix.sprintf("%04s",$nomor);
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
