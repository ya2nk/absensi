<?php
namespace App\Libs;
use App\Models\ { Checkinout,Absensi };

class ProsesAbsensi 
{
    function proses($req)
    {
        $absen = Checkinout::find($req->id_checkinout);
        if ($absen) {
            $karyawan    = Karyawan::select('id','divisi_id')->where('nik',$absen->nik)->first();
            $jamKerja    = getJamKerja($karyawan->id,$karyawan->divisi_id);
            
            $tanggal = $absen->tanggal;
            $nik     = $absen->nik;

            $absensi = Absensi::where('nik',$absen->nik)->where('tanggal',$absen->tanggal)->first();
            if ($absensi) {
                if ($absen->status == 0) {
                    if ($absensi->jam_masuk > $absen->jam) {
                        $absensi->jam_masuk = $absen->jam;
                    }

                    if ($absensi->jam_masuk == null) {
                         $absensi->jam_masuk = $absen->jam;
                    }
                } else {
                    if ($absensi->jam_pulang < $absen->jam) {
                        $absensi->jam_pulang = $absen->jam;
                    }

                    if ($absensi->jam_pulang == null) {
                         $absensi->jam_pulang = $absen->jam;
                    }
                }
                $absensi->save();
            } else {
                $data = ['tanggal'=>$absen->tanggal,'nik'=>$absen->tanggal,'jam_kerja_id'=>@jamKerja->jam_kerja_id];
                if ($absen->status == 0) {
                    $data['jam_masuk'] = $absen->jam;
                } else {
                    $data['jam_pulang'] = $absen->jam;

                }
                Absensi::insert($data);
            }

        }
        $absen->status_acc = 1;
        $absen->user_acc = $req->user()->username;
        $absen->save();
    }
    
   
}