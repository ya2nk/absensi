<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKerjaKaryawan extends Model
{
    use HasFactory;
    protected $table = 'jam_kerja_karyawan';
    
    function divisi()
    {
        return $this->hasOne(Divisi::class,'id','divisi_id');
    }
    
    function karyawan()
    {
        return $this->hasOne(Karyawan::class,'id','karyawan_id');
    }
    
    function jamKerja()
    {
        return $this->belongsTo(JamKerja::class,'jam_kerja_id');
    }
}
