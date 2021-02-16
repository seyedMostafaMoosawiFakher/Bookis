<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/create/',[UserController::class, 'create'])->name('user.create');
Route::get('/store/',[UserController::class, 'store'])->name('user.store');
Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

//
//Route::middleware(['auth', 'role:master'])->group(function(){
//    Route::get('/', [UserController::class, 'index'])->name('user.index');
//});
//
//Route::middleware(['auth', 'role:writer'])->group(function(){
//    Route::get('/', [UserController::class, 'index'])->name('user.index');
//});
//
//Route::middleware(['auth', 'role:member'])->group(function(){
//    Route::get('/', [UserController::class, 'index'])->name('user.index');
//});


//Route::get('login',function(){
//    return 'login';
//})->name('login');
//
//Route::get('login-test', function(){
//    $user = \App\Models\User::find(1);
//    \Illuminate\Support\Facades\Auth::login($user);
//});
