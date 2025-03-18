<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('moto',[MotoController::class,'index']);
Route::post('/moto',[MotoController::class,'store']);