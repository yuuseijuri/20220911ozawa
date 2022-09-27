<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
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
Route::group(['prefix' => '/'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('', function () { return view('welcome'); });
        Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');

        Route::get('home', [TodoController::class, 'index']);
        Route::post('add', [TodoController::class, 'create']);
        Route::post('edit', [TodoController::class, 'update'])->name('edit');
        Route::post('delete', [TodoController::class, 'remove'])->name('delete');

        Route::get('find', [TaskController::class, 'find'])->name('find');
        Route::post('find', [TaskController::class, 'search'])->name('find');
        
        Route::post('edit', [TaskController::class, 'update'])->name('edit');
        Route::post('taskDelete', [TaskController::class, 'remove'])->name('taskDelete');
        Route::get('home', [TodoController::class, 'index'])->name('home');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);
    });
});
require __DIR__.'/auth.php';




