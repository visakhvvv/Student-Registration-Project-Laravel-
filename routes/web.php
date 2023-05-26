<?php

use App\Http\Controllers\GaltechController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [GaltechController::class, 'login'])->name('login');
Route::post('/', [GaltechController::class, 'checkLogin'])->name("checkLogin");
Route::get('/logout', 'App\Http\Controllers\GaltechController@logout')->name("logout");
Route::get('/dashboard', [GaltechController::class, 'dashboard'])->name("dashboard")->middleware('auth');
Route::get('/addstudent', [GaltechController::class, 'add']);
Route::post('/addstudent', [GaltechController::class, 'create'])->name('create');
Route::get('/liststudent', [GaltechController::class, 'list']);
// Route::get('/edit/{id}','App\Http\Controllers\GaltechController@edit');
// Route::get('/delete/{id}','App\Http\Controllers\GaltechController@delete');
Route::get('/edit/{id}', [GaltechController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [GaltechController::class, 'update'])->name('update');
Route::get('/delete/{id}', [GaltechController::class, 'delete'])->name('delete');
Route::get('/userregistration', [GaltechController::class, 'userregistration']);
Route::post('/userregistration', [GaltechController::class, 'usercreate'])->name("usercreate");
