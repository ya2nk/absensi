<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JabatanController extends Controller
{
    function index()
    {
        return view('pages.master.jabatan');
    }
}
