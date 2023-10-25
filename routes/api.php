<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'api'], function() {
    // GET

    Route::get('/gearboxes', 'BrandsController@getGearboxes')->name('api-get-gearboxes');
});
Route::get('/organizations', [TableController::class, 'index']);
Route::get('/professionals', [TableController::class, 'index2']);



Route::get('/roles', 'UserController@getRoles');
Route::get('/permissions', 'UserController@getPermissions');
