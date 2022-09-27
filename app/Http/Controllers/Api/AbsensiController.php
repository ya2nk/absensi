<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ { Checkinout,Karyawan,Lembur };
use App\Libs\ProsesAbsen;
use DB;

class AbsensiController extends ApiController
{
    function absensi(Request $req)
    {
        $absen = new Checkinout;
        
        $absen->nik = $req->user()->username;
        $absen->tanggal = date('Y-m-d');
        $absen->jam = date('H:i:s');
        $absen->status = $req->status;
        if ($req->hasFile("photo")) {
            $file = $req->file('photo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/'.$req->user()->username.'/' ;
            $file->move($destinationPath,$fileName);
            $absen->photo = $fileName;
        }
        
        if ($absen->save()) {
            return $this->successResponse(null,"Absen Berhasil disimpan");
        } else {
            return $this->errorResponse("Absen gagal disimpan",401);
        }
    }
    
    function listAbsen(Request $req)
    {
        $parent = Karyawan::where('nik',$req->user()->username)->value('id');
        $absens = Checkinout::where('tanggal',$req->tanggal);
        if ($parent->parent_id == 0) {
             $absens->whereIn('nik',function($q) use($parent) {
                $q->select('nik')->from('karyawan')->where('parent_id',$parent);
            });
        }
       
        if ($req->status_acc != "") {
             $absens->where('status_acc',$req->status_acc);
        }
        if ($req->nik != "") {
            $absens->where('nik',$req->nik);
        }
        
        $absens->orderBy('nik');
        
        return $this->successResponse($absens->get(),"Berhasil Ambil Data Absen");
    }
    
    function listLembur(Request $req)
    {
        $parent = Karyawan::where('nik',$req->user()->username)->value('id');
        $lembur = Lembur::whereBetween('tanggal',[$req->input('tgl1',date('Y-m-d')),$req->input('tgl2',date('Y-m-d'))]);
        if ($parent->parent_id == 0) {
             $lembur->whereIn('nik',function($q) use($parent) {
                $q->select('nik')->from('karyawan')->where('parent_id',$parent);
            });
        }
       
        if ($req->status_acc != "") {
             $lembur->where('status_acc',$req->status_acc);
        }
       
        if ($req->nik != "") {
            $lembur->where('nik',$req->nik);
        }
        
        $lembur->orderBy('nik')->orderBy('tanggal');
        
        return $this->successResponse($lembur->get(),"Berhasil Ambil Data Lembur");
    }
    
    function accAbsen(Request $req)
    {
        (new ProsesAbsen)->proses($req);
        return $this->successResponse(null,"Berhasil Acc Data Absen");
    }
    
    function upsertLembur(Request $req)
    {
        $lembur = Lembur::firstOrNew(['id'=>$req->id]);
        $lembur->jam = $req->jam;
        $lembur->nik = $req->user()->username;
        $lembur->keterangan = $req->keterangan;
        if ($req->id == 0) {
            $lembur->tanggal = date('Y-m-d');
        }
        $lembur->save();
        
        return $this->successResponse(null,"Berhasil Simpan Data Lembur");
    }
    
    function accLembur(Request $req)
    {
        $lembur = Lembur::find($req->id);
        if ($lembur) {
            $absensi = Absensi::where('tanggal',$lembur->tanggal)->where('nik',$lembur->nik)->first();
            if ($absensi){
                if ($absensi->jam_pulang == null) {
                    return $this->errorResponse("Data Tidak bisa diacc karena tidak ada absen pulang",401);
                }
            }
            
            try {
                DB::transaction(function() use($req,$lembur,$absensi) {
                    $lembur->status_acc = 1;
                    $lembur->user_acc = $req->user()->username;
            
                    if($absensi) {
                        $absensi->lembur = timeDiff($lembur->jam_mulai,$absensi->lembur);
                        $absensi->save();
                    }
                });
            } catch (\Exception $e) {
                return $this->errorResponse($e->getMessage(),401);
            }
            
            return $this->successResponse(null,"Data Berhasil Diacc");
            
        }
    }
}
