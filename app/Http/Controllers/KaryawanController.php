<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Roles;
use App\Models\Divisi;
use App\Models\User;
use App\Models\JamKerja;
use DB;

class KaryawanController extends Controller
{
    function index()
    {
        $data['jabatan']    = Jabatan::orderBy('nama')->get();
        $data['atasan']     = Karyawan::where('parent_id',0)->orderBy('nama')->get();
        $data['roles']      = Roles::orderBy('nama')->get();
        $data['lokasi']     = Lokasi::orderBy('nama')->get();
        $data['divisi']     = Divisi::orderBy('nama')->get();
        $data['jam_kerja'] = JamKerja::orderBy('nama')->get();
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
        $prefix = date('ym',strtotime($req->tanggal_masuk));
        $nomor = Karyawan::select(DB::raw("MAX(CAST(SUBSTRING(nik, 4, length(nik)-4) AS UNSIGNED)) as nik"))->value("nik");
        $nomor = (int)$nomor ?? 0;
        $nomor++;
        return $prefix.sprintf("%04s",$nomor);
    }
    
    function save(Request $req)
    {
        $req->validate([
           'nama' => 'required',
           'lokasi_id' => 'required',
           'jabatan_id' => 'required',
           'alamat' => 'required'
        ]);
        
        
        $data = $req->except(['role_id','email','password','id']);
        
        try {
            DB::transaction(function () use($data,$req) {
                
                if($row = Karyawan::find($req->id)) {
                    $row->update($data);
                }  else {
                    Karyawan::insert($data);
                }
                
                $dataUser['password'] = \Hash::make($req->password);
                $dataUser['role_id'] = $req->role_id;
                $dataUser['username'] = $req->nik;
                $dataUser['email'] = $req->email;
                
                if (User::where('username',$req->nik)->exists()) {
                    if ($req->password == "") {
                        unset($dataUser['password']);
                    }
                    User::where('username',$req->nik)->update($dataUser);
                } else {
                    User::insert($dataUser);
                }
                
            });
        } catch(\Exception $e) {
            return response(['error'=>true,'message'=>$e->getMessage()]);
        }
                            
        return response(['error'=>false]);
        
        
    }
    
    function delete(Request $req)
    {
        if (Lokasi::destroy($req->id)) {
            return response(['error' => false]);
        }
    }
}
