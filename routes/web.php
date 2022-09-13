<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [TodoController::class, 'index']);

Route::post('/add', [TodoController::class, 'create']);

Route::post('/edit', [TodoController::class, 'update'])->name('edit');

Route::post('/delete', [TodoController::class, 'remove']);

Route::get('/find', [TaskController::class, 'find']);
Route::post('/find', [TaskController::class, 'search']);
