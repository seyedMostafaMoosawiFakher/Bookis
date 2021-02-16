<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::resource('user',UserController::class);
Route::resource('auth',AuthController::class);








//Route::middleware(['auth', 'role:master'])->group(function(){
//    Route::get('/', [UserController::class, 'index'])->name('user.index');
//});

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

//تغییر روت ریسورس
//Route::post('user/{id}',[UserController::class,'store'])->name('user.store');

// USER routes
//Route::get('/create/',[UserController::class, 'create'])->name('user.create');
//Route::get('/store/',[UserController::class, 'store'])->name('user.store');
//Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
//Route::get('/destroy/{user}', [UserController::class, 'desrtoy'])->name('user.destroy');
//Route::get('/users', [UserController::class, 'index'])->name('user.index');

//روتهای اتنتیکیت خودم
//Route::get('/authenticate', [\App\Http\Controllers\AuthController::class, 'create'])->name('authenticate');
//Route::post('/authenticate', [\App\Http\Controllers\AuthController::class, 'store'])->name('onauthenticate');
