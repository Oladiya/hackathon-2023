<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
})->middleware(['auth', 'approved']);

Route::view('/not-approved', 'home')->name('not-approved')->middleware(['auth']);

Route::prefix('tasks')->name('task.')->middleware(['auth', 'approved'])->group(function () {

    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::get('/{id}', [TaskController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{id}', [TaskController::class, 'delete'])->name('delete');

    Route::prefix('/{taskId}/comments')->name('comment.')->group(function () {

        Route::post('/', [CommentController::class, 'store'])->name('store');

    });

});

Route::prefix('links')->name('link.')->middleware(['auth', 'admin', 'approved'])->group(function () {

    Route::get('/', [LinkController::class, 'index'])->name('index');
    Route::get('/create', [LinkController::class, 'create'])->name('create');
    Route::post('/', [LinkController::class, 'store'])->name('store');
    Route::get('/{id}', [LinkController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [LinkController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LinkController::class, 'update'])->name('update');
    Route::delete('/{id}', [LinkController::class, 'delete'])->name('delete');

});

Route::prefix('users')->name('user.')->middleware(['auth', 'admin', 'approved'])->group(function () {

    Route::post('/{id}/set-admin-rights', [UserController::class, 'setAdminRights'])->name('set-admin-rights');
    Route::post('/{id}/remove-admin-rights', [UserController::class, 'removeAdminRights'])->name('remove-admin-rights');
    Route::post('/{id}/approve', [UserController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [UserController::class, 'reject'])->name('reject');
    Route::get('/', [UserController::class, 'index'])->name('index');

});

Auth::routes();

Route::get('/register', function () {
    return redirect()->route('register');
})->name('old-reg');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('first-register');
Route::get('/register/{hash}', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register/{hash}', [RegisterController::class, 'register'])->name('register.store');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

