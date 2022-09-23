<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkinout;

class CheckinoutController extends Controller
{
    function index()
    {
        return view('pages.master.checkinout.index');
    }
    
    function data(Request $req)
    {
        $model = Checkinout::select();
        return datatables($model->get())->toJson();
    }
    
    
}
