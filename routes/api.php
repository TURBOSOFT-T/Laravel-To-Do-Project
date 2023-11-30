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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user();});
use App\Http\Controllers\API\AuthController;
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//Route::post('logout', [AuthController::class, 'logout']);
//Route::post('unauthorized', [AuthController::class, 'unauthorized']);
Route::post('refresh', [AuthController::class, 'refreshtoken']);
Route::post('unauthorized', [AuthController::class, 'unauthorized']);
Route::post('details', [AuthController::class, 'details']);
//Route::post('loginGrant', [AuthController::class, 'loginGrant']);


use App\Http\Controllers\API\ProjectController;
use \App\Http\Controllers\API\TaskController;
route::resource('projects', ProjectController::class);
route::resource('tasks', TaskController::class);

use \App\Http\Controllers\API\UserController;
use \App\Http\Controllers\API\RoleController;
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
//Route::resource('search', [UserController::class, 'search']);

Route::group(['middleware' => ['CheckClientCredentials','auth:api']], function() {
  //  Route::post('register', [AuthController::class, 'register']);
//Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('details', [AuthController::class, 'details']);
//Route::post('refreshtoken', [AuthController::class, 'refreshtoken']);
});