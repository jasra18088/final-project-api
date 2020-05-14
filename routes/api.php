<?php

use App\User;
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

Route::middleware(['auth:api'])->group(function (){
    // List users
    Route::middleware(['scope:admin'])->get('/users', function (Request $request) {
        return User::get();
    });
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

