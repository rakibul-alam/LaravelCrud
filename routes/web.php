<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::namespace('App\Http\Controllers')->group(function () {
    Route::resource('tasks', TaskController::class);

    Route::get('/tasks/create',  'TaskController@create')->name('tasks.create');

    Route::post('/tasks', 'TaskController@store')->name('tasks.store');


    Route::get('/tasks/{task}/edit','TaskController@edit')->name('tasks.edit');

    Route::put('/tasks/{task}', 'TaskController@update')->name('tasks.update');

    Route::delete('/tasks/{task}','TaskController@destroy')->name('tasks.destroy');

    // Route::post('/task-status/{task}', 'TaskController@taskStatus')->name('update.task-status');

    Route::post('/update-status/{id}', 'TaskController@updateStatus')->name('update.status');


});