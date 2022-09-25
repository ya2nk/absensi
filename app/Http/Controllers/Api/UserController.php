<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ { Checkinout,Karyawan };

class UserController extends ApiController
{
    function profile(Request $request)
    {
        $user        = $request->user();
        $now         = date('Y-m-d');
        $karyawan    = Karyawan::where('nik',$user->username)->first();
        if ($karyawan) {
            $jamKerja    = getJamKerja($karyawan->id,$karyawan->divisi_id);
            $masuk       = Checkinout::where('tanggal',$now)->where('nik',$user->username)->where('status',0)->orderBy('jam')->value('jam');
            $pulang      = Checkinout::where('tanggal',$now)->where('nik',$user->username)->where('status',1)->orderBy('jam','desc')->value('jam');
        }
       
        
        return $this->successResponse(['karyawan'=>$karyawan,'jam_kerja'=>@$jamKerja,'absensi'=>['in'=>@$masuk,'out'=>@$pulang]]);
    }
}
