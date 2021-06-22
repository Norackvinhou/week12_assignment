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

// find route in route:list command
// first register route an account in postman
// second login route the account, after login it will give u bearer token
// then go to create task route,dont forget to put the bearer key token, and create task with title and description in the body
// and then after create u can go to view todo route, pass the token in again, and its will give the user todo list.



Route::get('/welcome',function(){
return 'hi';
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {

    Route::post('register', [App\Http\Controllers\UserController::class, 'register']);
    Route::post('login', [App\Http\Controllers\UserController::class, 'login']);

    // passport auth api
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'user']);
        Route::get('logout', [App\Http\Controllers\UserController::class, 'logout']);

        // todos resource route
        Route::resource('todos', App\Http\Controllers\TodoController::class);
    });

});
