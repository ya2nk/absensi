<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Checkinout;

class UserController extends ApiController
{
    function profile(Request $request)
    {
        $user        = $request->user();
        $now         = date('Y-m-d');
        $karyawan    = Karyawan::where('nik',$user->username)->first();
        $jamKerja    = getJamKerja($karyawan->id,$karyawan->divisi_id);
        $masuk       = Checkinout::where('tanggal',$now)->where('nik',$user->username)->orderBy('jam_masuk')->value('jam_masuk');
        $pulang      = Checkinout::where('tanggal',$now)->where('nik',$user->username)->orderBy('jam_pulang','desc')->value('jam_pulang');
        
        return $this->successResponse(['karyawan'=>$karyawan,'jam_kerja'=>$jamKerja,'absensi'=>['in'=>$masuk,'out'=>$pulang]]);
    }
}
