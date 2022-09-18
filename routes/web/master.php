<?php
use App\Http\Controllers\ { JabatanController,AreaController,LokasiController,KaryawanController,RolesController };

Route::prefix("jabatan")->group(function() {
	Route::get("/",[JabatanController::class,"index"]);
    Route::post("/data",[JabatanController::class,"data"]);
    Route::get("/row",[JabatanController::class,"getRow"]);
    Route::post("/save",[JabatanController::class,"save"]);
     Route::post("/delete",[JabatanController::class,"delete"]);
});

Route::prefix("area")->group(function() {
	Route::get("/",[AreaController::class,"index"]);
    Route::post("/data",[AreaController::class,"data"]);
    Route::get("/row",[AreaController::class,"getRow"]);
    Route::post("/save",[AreaController::class,"save"]);
    Route::post("/delete",[AreaController::class,"delete"]);
});

Route::prefix("roles")->group(function() {
	Route::get("/",[RolesController::class,"index"]);
    Route::post("/data",[RolesController::class,"data"]);
    Route::get("/row",[RolesController::class,"getRow"]);
    Route::post("/save",[RolesController::class,"save"]);
    Route::post("/delete",[RolesController::class,"delete"]);
});

Route::prefix("lokasi")->group(function() {
	Route::get("/",[LokasiController::class,"index"]);
    Route::post("/data",[LokasiController::class,"data"]);
    Route::get("/row",[LokasiController::class,"getRow"]);
    Route::post("/save",[LokasiController::class,"save"]);
    Route::post("/delete",[LokasiController::class,"delete"]);
});

Route::prefix("karyawan")->group(function() {
	Route::get("/",[KaryawanController::class,"index"]);
    Route::post("/data",[KaryawanController::class,"data"]);
    Route::get("/row",[KaryawanController::class,"getRow"]);
    Route::get("/get-nik",[KaryawanController::class,"getNik"]);
    Route::post("/save",[KaryawanController::class,"save"]);
    Route::post("/delete",[KaryawanController::class,"delete"]);
});