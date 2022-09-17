<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanLokasi extends Model
{
    use HasFactory;
    protected $table = "karyawan_lokasi";
    
    function detail()
    {
        return $this->belongsTo(Lokasi::class,'id','lokasi_id');
    }
}
