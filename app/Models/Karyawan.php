<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = "karyawan";
    
    function lokasi()
    {
        return $this->hasMany(KaryawanLokasi::class,"karyawan_id");
    }
    
    function jabatan()
    {
        return $this->hasOne(Jabatan::class,"jabatan_id");
    }
}
