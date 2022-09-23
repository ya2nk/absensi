<?php
use App\Http\Controllers\ { CheckinoutController,AbsensiController };

Route::prefix("checkinout")->group(function(){
    Route::get('/',[CheckinoutController::class,"index"]);
    Route::post('/data',[CheckinoutController::class,"data"]);
});

Route::prefix("absensi")->group(function(){
    Route::get('/',[AbsensiController::class,"index"]);
    Route::post('/data',[AbsensiController::class,"data"]);
});