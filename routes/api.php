<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/task', 'TaskController', [
    'except' => ['edit', 'show', 'create']
])->middleware('auth:api');
Route::resource('/status', 'StatusController', [
    'except' => ['create', 'update', 'destroy', 'edit', 'show', 'store']
])->middleware('auth:api');