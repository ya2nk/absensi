<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Checkinout;

class AbsensiController extends ApiController
{
    function absensi(Request $req)
    {
        $absen = new Checkinout;
        
        $absen->nik = $req->nik;
        $absen->tanggal = date('Y-m-d');
        $absen->jam = date('H:i:s');
        $absen->status = $req->status;
        if ($req->hasFile("photo")) {
            $file = $req->file('photo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/'.$req->nik.'/' ;
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
        $absens = Checkinout::where('tanggal',$req->tanggal)->whereIn('nik',function($q) use($parent) {
            $q->select('nik')->from('karyawan')->where('parent_id',$parent);
        })->where('status_acc',0);
        if ($req->nik != "") {
            $absens->where('nik',$req->nik);
        }
        
        $absens->orderBy('nik');
        
        return $this->successResponse($absens->get(),"Berhasil Ambil Data Absen");
    }
}
