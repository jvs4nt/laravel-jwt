<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')-> name("login");
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(TodoController::class)->group(function () {
    Route::get('todos', 'index');
    Route::post('todo', 'store');
    Route::get('todo/{id}', 'show');
    Route::put('todo/{id}', 'update');
    Route::delete('todo/{id}', 'destroy');
}); 

Route::group([
   'middleware' => ['auth:api'] //, 'cors','api',
    ], function($router) {
        Route::get('/user/recuperar/{id}', 'App\Http\Controllers\UserController@recuperar');
        Route::post('/user/editar/{id}', 'App\Http\Controllers\UserController@editar');
        Route::post('/user/cadastrar', 'App\Http\Controllers\UserController@cadastrar');

    });