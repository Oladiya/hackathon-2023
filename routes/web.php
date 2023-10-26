<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('task.index');
})->middleware('auth');

Route::prefix('tasks')->name('task.')->middleware('auth')->group( function () {

    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::get('/{id}', [TaskController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{id}', [TaskController::class, 'delete'])->name('delete');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

