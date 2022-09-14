<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class HomeController extends Controller
{
    function index()
    {
        //$menus = Menus::with('allChildren')->where('parent_id',0)->orderBy('position')->get();
        //dd($menus->toArray());
        return view('pages.home.index');
    }
}
