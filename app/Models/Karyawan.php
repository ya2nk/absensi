<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = "karyawan";
    protected $guarded = [];
    
    function lokasi()
    {
        return $this->hasOne(Lokasi::class,"lokasi_id");
    }
    
    function jabatan()
    {
        return $this->hasOne(Jabatan::class,"jabatan_id");
    }
}
