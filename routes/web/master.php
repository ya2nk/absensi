<?php
use App\Http\Controllers\ { JabatanController };

Route::prefix("jabatan")->group(function() {
	Route::get("/",[JabatanController::class,"index"]);
    Route::post("/data",[JabatanController::class,"data"]);
    Route::get("/row",[JabatanController::class,"getRow"]);
    Route::post("/save",[JabatanController::class,"save"]);
     Route::post("/delete",[JabatanController::class,"delete"]);
});