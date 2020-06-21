<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'TaskController@getIndex',
    'as' => 'task.index'
]);

Route::group(['prefix' => 'admin', 	'middleware' => ['auth', 'verified']], function() {

    Route::get('/', [
        'uses' => 'TaskController@getAdminIndex',
        'as'=> 'admin.index'
    ]);

    Route::get('/create', [
        'uses' => 'TaskController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('/create', [
        'uses' => 'TaskController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'TaskController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('/delete/{id}', [
        'uses' => 'TaskController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('/edit', [
        'uses' => 'TaskController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});

Auth::routes(['verify' => true]);
