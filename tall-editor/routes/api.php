<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/upload', function (Request $request) {
    $file = $request->file('file');
    $name = $file->hashName(); 
    $extension = $file->extension(); 
    $path = $request->file->storeAs('images', $name);
    $data[] = [
        "id"=> $name,
        "name"=> $name,
        "url"=> \Storage::url($path)
    ];
    return $data;
});