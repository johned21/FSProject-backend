<?php


use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/lists/search', [ToDoListController::class, 'search']);
    Route::post('/lists', [ToDoListController::class, 'store']);
    Route::get('/lists', [ToDoListController::class, 'index']);
    Route::get('/lists/{list}', [ToDoListController::class, 'show']);
    Route::put('/lists/{list}', [ToDoListController::class, 'update']);
    Route::delete('/lists/{list}', [ToDoListController::class, 'destroy']);
});
