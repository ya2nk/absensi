<?php
use App\Http\Controllers\ { KaryawanController };

Route::prefix("karyawan")->group(function() {
	Route::get("/",[KaryawanController::class,"index"]);
    Route::post("/data",[KaryawanController::class,"data"]);
    Route::get("/row",[KaryawanController::class,"getRow"]);
    Route::get("/get-nik",[KaryawanController::class,"getNik"]);
    Route::post("/save",[KaryawanController::class,"save"]);
    Route::post("/delete",[KaryawanController::class,"delete"]);
});