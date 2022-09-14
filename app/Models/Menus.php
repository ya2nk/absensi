<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = "menus";
    
    public function children()
    {
        return $this->hasMany(Menus::class, 'parent_id');
    }
    
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
