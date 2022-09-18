<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ {
	AuthController,HomeController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class,"index"]);

Route::get('/login',[AuthController::class,"loginView"])->name('login');
Route::post('/login',[AuthController::class,"login"]);

Route::middleware(['auth'])->group(function(){
	Route::get('/dashboard',[HomeController::class,"index"]);
	
	Route::name('master')
		->prefix('master')
		->group(__DIR__ . '/web/master.php');
});
