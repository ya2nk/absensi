<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Auth;

class AuthController extends Controller
{
	function loginView()
	{
		return view('pages.auth.login');
	}
	
	function index()
	{
		$user = Auth::user();
		if (!$user){
			return redirect('login');
		}
		return redirect('/dashboard');
	}
	
	function login(Request $request)
	{
		$request->validate([
			'username' => 'required',
			'password' => 'required',
		]);
			
		$credentials = $request->only('username', 'password');
 		//dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        } else {
			return redirect()->back()->withErrors(['message'=>'Username atau password Salah'])->withInput();
		}
	}
}