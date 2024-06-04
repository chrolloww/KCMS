<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\ArchiveController;

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



//User routes
//update collboration
Route::get('/update_collaboration/{id}', 'App\Http\Controllers\JoinController@update_collaboration')->name('update_collaboration');
Route::post('/edit_collaboration/{id}', 'App\Http\Controllers\JoinController@edit_collaboration')->name('edit_collaboration');
Route::get('/cancel_update_collaboration', 'App\Http\Controllers\JoinController@cancel_update_collaboration')->name('cancel_update_collaboration');

//collaboration details
Route::get('/user_detail_{id}', 'App\Http\Controllers\JoinController@user_details_view')->name('collaboration.detail');
Route::post('/update_collaboration/{name}', 'App\Http\Controllers\JoinController@updateCollaborationactivities')->name('activities.add');


//Admin routes
//Add collaboration
Route::get('/add_collaboration_view', 'App\Http\Controllers\AdminController@addview');
Route::post('/upload_collaboration', 'App\Http\Controllers\AdminController@upload');

//Active collaborations
Route::get('/List_LoI', 'App\Http\Controllers\JoinController@display_collaboration_admin_LoI');
Route::get('/List_MoA', 'App\Http\Controllers\JoinController@display_collaboration_admin_MoA');
Route::get('/List_MoU', 'App\Http\Controllers\JoinController@display_collaboration_admin_MoU');

Route::get('/collaborations_{name}', [JoinController::class, 'details'])-> name('collaboration.details');
Route::post('/terminate_{c_name}', 'App\Http\Controllers\JoinController@terminate')->name('collaboration.terminate');

//view documents
Route::get('/view_file_{name}', [PdfController::class, 'view_pdf'])->name('file.details');
Route::get('/file-view/{id}', 'App\Http\Controllers\PdfController@view_tab')->name('file.view');
Route::delete('/file-delete/{id}', 'App\Http\Controllers\PdfController@delete')->name('file.delete');
Route::post('/view_file_{name}', 'App\Http\Controllers\PdfController@store')->name('file.store');

//Archived collaborations
Route::get('/Archived_List_LoI', 'App\Http\Controllers\ArchiveController@display_collaboration_admin_LoI');
Route::get('/Archived_List_MoA', 'App\Http\Controllers\ArchiveController@display_collaboration_admin_MoA');
Route::get('/Archived_List_MoU', 'App\Http\Controllers\ArchiveController@display_collaboration_admin_MoU');
Route::get('/Archived_List_Terminate', 'App\Http\Controllers\ArchiveController@display_collaboration_admin_Terminate');

//staff routes
Route::get('/staff_list_view', 'App\Http\Controllers\AdminController@listview_staff');
Route::get('/staff_list_view_{id}', 'App\Http\Controllers\AdminController@details_view')->name('list.view');
Route::get('/add_staff_view', 'App\Http\Controllers\AdminController@addview_staff');
Route::post('/upload_staff', 'App\Http\Controllers\AdminController@upload_staff');

//Add announcement
Route::get('/add_announcement', [AdminController::class, 'add_announcement'])->name('add_announcement');
Route::post('/publish_announcement', [AdminController::class, 'publish_announcement'])->name('publish_announcement');
Route::post('/update_announcement/{id}', [AdminController::class, 'update_announcement'])->name('update_announcement');
Route::delete('/delete_announcement/{id}', [AdminController::class, 'delete_announcement'])->name('delete_announcement');
