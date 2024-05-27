<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JoinController;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/home', 'App\Http\Controllers\HomeController@redirect');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_collaboration_view', 'App\Http\Controllers\AdminController@addview');

Route::post('/upload_collaboration', 'App\Http\Controllers\AdminController@upload');

Route::get('/userdashboard', 'App\Http\Controllers\JoinController@display_collaboration_user');

Route::get('/update_collaboration/{id}', 'App\Http\Controllers\JoinController@update_collaboration')->name('update_collaboration');

Route::post('/edit_collaboration/{id}', 'App\Http\Controllers\JoinController@edit_collaboration')->name('edit_collaboration');

Route::get('/cancel_update_collaboration', 'App\Http\Controllers\JoinController@cancel_update_collaboration')->name('cancel_update_collaboration');

Route::get('/List_MoA', 'App\Http\Controllers\JoinController@display_collaboration_admin');

