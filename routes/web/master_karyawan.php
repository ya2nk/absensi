<?php
use App\Http\Controllers\ { KaryawanController,JamKerjaKaryawanController };

Route::prefix("karyawan")->group(function() {
	Route::get("/",[KaryawanController::class,"index"]);
    Route::post("/data",[KaryawanController::class,"data"]);
    Route::get("/row",[KaryawanController::class,"getRow"]);
    Route::get("/get-nik",[KaryawanController::class,"getNik"]);
    Route::post("/save",[KaryawanController::class,"save"]);
    Route::post("/delete",[KaryawanController::class,"delete"]);
});

Route::prefix("jam-kerja")->group(function() {
	Route::get("/",[JamKerjaKaryawanController::class,"index"]);
    Route::post("/data",[JamKerjaKaryawanController::class,"data"]);
    Route::get("/row",[JamKerjaKaryawanController::class,"getRow"]);
    Route::get("/get-nik",[JamKerjaKaryawanController::class,"getNik"]);
    Route::post("/save",[JamKerjaKaryawanController::class,"save"]);
    Route::post("/delete",[JamKerjaKaryawanController::class,"delete"]);
});