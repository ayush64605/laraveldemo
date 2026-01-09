<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

//////////////// Auth //////////////////
Route::get("/", [AuthController::class, "login"])->name('login');
Route::post("/loginprocess", [AuthController::class, "loginprocess"])->name("loginprocess");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware(AuthCheck::class)->group(function () {

    Route::get('/index', [ProjectController::class, 'index'])->name('index');

    Route::prefix('project')->name('project.')->group(function () {
        Route::get('show', [ProjectController::class, 'show'])->name('show');
        Route::get('add', [ProjectController::class, 'add'])->name('add');
        Route::post('save', [ProjectController::class, 'save'])->name('save');
        Route::get('update/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('delete/{project}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('details/{project}', [ProjectController::class, 'details'])->name('details');
    });

});

