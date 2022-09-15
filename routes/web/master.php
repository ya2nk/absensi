<?php
use App\Http\Controllers\ { JabatanController };

Route::prefix("jabatan")->group(function() {
	Route::get("/",[JabatanController::class,"index"]);
});